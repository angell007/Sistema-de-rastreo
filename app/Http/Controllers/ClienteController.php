<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use App\Order;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('role', ['except' => 'ordersCliente']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->expectsJson()) {
            return datatables()->of(Cliente::latest())
                ->addColumn('action', 'admin.clientes.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.clientes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {

        if ($request->expectsJson()) {
            try {
                Cliente::create(request()->all());
                return response('Cliente registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $cliente = Cliente::findOrFail($id);
            return response($cliente, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,  $key)
    {
        $cliente = Cliente::findOrfail($key);
        return view('admin.clientes.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request)
    {
        if ($request->expectsJson()) {
            try {
                $cliente = Cliente::findOrFail($request->id);
                $cliente->update(request()->all());
                return response('Cliente actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Cliente::findOrFail($id)->delete();
            return response('Cliente deleted successfully.');
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function ordersCliente($cliente)
    {
        if (request()->expectsJson()) {
            return datatables()->of(Order::where('cliente_id', $cliente)->latest())
                ->addColumn('action', 'admin.OrdersCliente.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
    }
}
