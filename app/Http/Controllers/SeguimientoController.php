<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Order;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!is_null(request()->numero)) {
            switch (request()->filtro) {
                case 'Serial':
                    $order =  Order::where('serial', request()->numero)->get()->last();
                    if (!is_null($order)) {
                        return view('admin.seguimientos.show', compact('order'));
                    }
                    return back()->with('status', 'Debes ingresar datos validos');
                    break;
                case 'Referencia':

                    $order =  Order::where('referencia', request()->numero)->get()->last();
                    if (!is_null($order)) {
                        return view('admin.seguimientos.show', compact('order'));
                    }
                    return back()->with('status', 'Debes ingresar datos validos');
                    break;

                case 'Orden':

                    $order =  Order::where('consecutivo', request()->numero)->first();
                    if (!is_null($order)) {
                        return view('admin.seguimientos.show', compact('order'));
                    }
                    return back()->with('status', 'Debes ingresar datos validos');
                    break;

                case 'Cedula':
                    $cliente =  Cliente::where('tipo_identificacion', 'Cedula')
                        ->where('identificacion', request()->numero)->first();

                    if (!is_null($cliente)) {

                        return view('admin.clientes.show', compact('cliente'));
                    }
                    return back()->with('status', 'Debes ingresar datos validos');
                    break;

                case 'Nit':
                    $cliente =  Cliente::where('tipo_identificacion', 'Nit')
                        ->where('identificacion', request()->numero)->first();

                    if (!is_null($cliente)) {

                        return view('admin.clientes.show', compact('cliente'));
                    }
                    return back()->with('status', 'Debes ingresar datos validos');
                    break;

                case 'Pasaporte':

                    $cliente =  Cliente::where('tipo_identificacion', 'Pasaporte')
                        ->where('identificacion', request()->numero)->first();

                    if (!is_null($cliente)) {

                        return view('admin.clientes.show', compact('cliente'));
                    }
                    return back()->with('status', 'Debes ingresar datos validos');
                    break;

                default:
                    break;
            }
        }
        return back()->with('status', 'Debes ingresar datos validos');
    }
}
