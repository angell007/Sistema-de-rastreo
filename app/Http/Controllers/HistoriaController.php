<?php

namespace App\Http\Controllers;

use App\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $key)
    {

        if ($request->expectsJson()) {
            return datatables()->of(Historia::with('user', 'order')
                ->where('order_id', $key)
                ->latest())
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
    public function store(Request $request)
    {
        if ($request->expectsJson()) {
            try {
                Historia::create(request()->all());
                return response('Historia registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $historia = Historia::findOrFail($id);
            return response($historia, 200);
        }
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = request()->all();
        $data['acciones'] = implode(' ', $request->acciones);

        if ($request->expectsJson()) {
            try {
                $historia = Historia::findOrFail($request->id);
                $historia->update($data);
                return response('Historia actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Historia::findOrFail($id)->delete();
            return response('Historia Eliminada correctamente.');
        }
        return abort(404);
    }
}
