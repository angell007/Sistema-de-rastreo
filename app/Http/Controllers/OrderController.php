<?php

namespace App\Http\Controllers;

use App\Accion;
use App\Clausula;
use App\Empresa;
use App\Order;
use App\Http\Requests\OrderRequest;
use App\Mail\OrdenEmail;
use App\Repository\OrderRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;

class OrderController extends Controller
{
    public function __construct(OrderRepository $orderRepository)
    {
        $this->middleware('auth', ['except' => ['printOrder', 'show']]);
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $acciones = $this->orderRepository->acciones();
        $tecnicos = $this->orderRepository->tecnicos();
        $clientes = $this->orderRepository->clientes();
        return view('admin.orders.index', compact('tecnicos', 'acciones', 'clientes'));
    }

    public function data()
    {
        if (request()->expectsJson()) {
            return datatables(DB::table('orders')->select('fecha_ingreso', 'referencia', 'serial', 'consecutivo', 'estado', 'diagnostico', 'id')->latest()) //9 285, 291 300
                ->editColumn('action', function ($data) {
                    $button = '
                    <div class="text-lg-right text-nowrap">
                    ';
                    $button  .= '<a class="btn btn-xs btn-icon btn-primary edit-equipo" href="javascript:void(0)" onclick="editarEquipo(' . $data->id . ')"
                    data-toggle="tooltip" title="Editar">
                    <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                    </a>';
                    $button .= '<a class="btn btn-xs btn-dark" href="/orders/' . $data->id . '" title="Historial">
                    <i class="fa fa-fw fa-calendar"></i>
                    </a>';
                    $button .= '<a class="btn btn-xs btn-warning" href="/orders/printOrder/' . $data->id . '" target="_blank" title="Descargar">
                    <i class="fa fa-fw fa-print"></i>
                    </a>';
                    $button  .= '<a class="btn btn-xs btn-success" id="btnOrderEnviar"  onclick="orderEnviar(' . $data->id . ')" href="javascript:void(0)" title="enviar">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </a>';
                    $button .= '<a class="btn btn-xs btn-icon btn-danger delete-equipo" href="javascript:void(0)" onclick="eliminarEquipo(' . $data->id . ')"
                    data-toggle="tooltip" title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                    $button .= '
                    </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                $order = Order::create(request()->all());

                foreach ($request->accion_id as  $key => $accion) {
                    $accionId = Accion::where('nombre', $key)->first();
                    if (!$order->accions()->where('accion_id', $accionId->id)->first()) {
                        $order->accions()->attach($accionId);
                    }
                }

                return response('Order registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $order = Order::findOrFail($id);
            $accions = $order->accions()->get();
            return response(['order' => $order, 'accions' => $accions], 200);
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,  $key)
    {
        $order = Order::findOrfail($key);
        $tecnicos = $this->orderRepository->tecnicos();

        return view('admin.orders.show', compact('order', 'tecnicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $order = Order::findOrFail($request->id);
                $order->update(request()->all());
                $order->accions()->detach();

                if (!is_null($request->accion_id)) {
                    foreach ($request->accion_id as  $key => $accion) {
                        $accionId = Accion::where('nombre', $key)->first();
                        if (!$order->accions()->where('accion_id', $accionId->id)->first()) {
                            $order->accions()->attach($accionId);
                        }
                    }
                }

                return response('Order registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Order::findOrFail($id)->delete();
            return response('Order deleted successfully.');
        }
        return abort(404);
    }

    public function printOrder($key)
    {
        try {

            $order = Order::with('cliente', 'accions')->findOrfail($key);
            $empresa = Empresa::first();
            $clausulas = Clausula::all();
            $facadePdf = App::make('dompdf.wrapper');
            $pdf = $facadePdf->loadView('admin.orders.impreso', compact('order', 'clausulas', 'empresa'));
            return $pdf->stream(time() . $order->consecutivo . '.pdf');
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }

    public function filtro($finicio, $ffin)
    {
        try {

            $inicio = Carbon::createFromDate($finicio);
            $fin = Carbon::createFromDate($ffin)->addDays(1);

            if (request()->expectsJson()) {
                return datatables(DB::table('orders')
                    ->whereBetween('fecha_ingreso', [$inicio, $fin])
                    ->select('fecha_ingreso', 'referencia', 'serial', 'consecutivo', 'estado', 'diagnostico', 'id', 'total')->latest())
                    ->addColumn('action', function ($data) {
                        $button = '
                    <div class="text-lg-right text-nowrap">
                    ';
                        $button  .= '<a class="btn btn-xs btn-icon btn-primary edit-equipo" href="javascript:void(0)" onclick="editarEquipo(' . $data->id . ')"
                    data-toggle="tooltip" title="Editar">
                    <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                    </a>';
                        $button .= '<a class="btn btn-xs btn-dark" href="/orders/' . $data->id . '" title="Historial">
                    <i class="fa fa-fw fa-calendar"></i>
                    </a>';
                        $button .= '<a class="btn btn-xs btn-warning" href="/orders/printOrder/' . $data->id . '" target="_blank" title="Descargar">
                    <i class="fa fa-fw fa-print"></i>
                    </a>';
                        $button  .= '<a class="btn btn-xs btn-success" id="btnOrderEnviar"  onclick="orderEnviar(' . $data->id . ')" href="javascript:void(0)" title="enviar">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </a>';
                        $button .= '<a class="btn btn-xs btn-icon btn-danger delete-equipo" href="javascript:void(0)" onclick="eliminarEquipo(' . $data->id . ')"
                    data-toggle="tooltip" title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                        $button .= '
                    </div>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
            }
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }

    // try {

    //     $inicio = Carbon::createFromDate($finicio);
    //     $fin = Carbon::createFromDate($ffin)->addDays(1);

    //     if (request()->expectsJson()) {

    //         $data = Cache::remember('filtroOrdenes', Carbon::now()->addHour(1), function () {
    //             return Order::whereBetween('fecha_ingreso', [$this->inicio, $this->fin])->get();
    //         });

    //         return datatables()->of($data)
    //             ->addColumn('action', 'admin.orders.actions')
    //             ->rawColumns(['action'])
    //             ->addIndexColumn()
    //             ->toJson();
    //     }
    // } catch (\Throwable $th) {
    //     return json_encode($th->getMessage());
    // }

    public function enviar($key)
    {

        try {
            $order = Order::with('cliente')->findOrFail($key);
            $clausulas = Clausula::all();
            $empresa = Empresa::first();
            Mail::to($order->cliente->email)->send(new OrdenEmail($order, $clausulas, $empresa));
            return response('Envio correcto.', 200);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
    }
}
