<?php

namespace App\Http\Controllers;

use App\Accion;
use App\Order;
use Illuminate\Http\Request;

class AccionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return datatables()->of(Accion::latest())
                ->addColumn('action', 'admin.acciones.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.acciones.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->expectsJson()) {
            try {
                Accion::create(request()->all());
                return response('Accion registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Accion  $accion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $accion = Accion::findOrFail($id);
            return response($accion, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Accion  $accion
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,  $key)
    {
        $accion = Accion::findOrfail($key);
        return view('admin.acciones.show', compact('accion'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->expectsJson()) {
            try {
                $accion = Accion::findOrFail($request->id);
                $accion->update(request()->all());
                return response('Accion actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Accion  $accion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Accion::findOrFail($id)->delete();
            return response('Accion deleted successfully.');
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Accion  $accion
     * @return \Illuminate\Http\Response
     */
    public function ordersAccion($accion)
    {
        if (request()->expectsJson()) {
            return datatables()->of(Order::where('accion_id', $accion)->latest())
                ->addIndexColumn()
                ->toJson();
        }
    }
}
