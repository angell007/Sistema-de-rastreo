<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Repository\EmpresaRepository;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    private $imgUploader;
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository)
    {
        $this->empresaRepository = $empresaRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            try {
                $empresa = Empresa::first();
                return response($empresa, 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }

        return view('admin.empresa.formRegister');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request)
    {
        if ($request->expectsJson()) {

            try {
                $empresa = Empresa::first();

                if (is_null($empresa)) {
                    $this->empresaRepository->save();
                    return response('Datos de Empresa correctamente registrados ', 200);
                }
                $this->empresaRepository->update();
                return response('Datos de Empresa correctamente actualizados ', 200);
                
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }

        return abort(404);
    }
}
