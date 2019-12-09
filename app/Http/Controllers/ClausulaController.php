<?php

namespace App\Http\Controllers;

use App\Clausula;
use Illuminate\Http\Request;

class ClausulaController extends Controller
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
            return datatables()->of(Clausula::get())
                ->addColumn('action', 'admin.clausulas.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.clausulas.index');
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
                Clausula::create(request()->all());
                return response('Clausula registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Clausula  $clausula
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $clausula = Clausula::findOrFail($id);
            return response($clausula, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Clausula  $clausula
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,  $key)
    {
        $clausula = Clausula::findOrfail($key);
        return view('admin.clausulas.show', compact('accion'));
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
                $clausula = Clausula::findOrFail($request->id);
                $clausula->update(request()->all());
                return response('Clausula actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Clausula  $clausula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Clausula::findOrFail($id)->delete();
            return response('Clausula deleted successfully.');
        }
        return abort(404);
    }
}
