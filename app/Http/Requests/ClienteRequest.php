<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'tipo_identificacion' => 'required',
            // 'identificacion' => 'required|numeric|digits_between:1,10|unique:clientes,identificacion',
            'ciudad' => 'required',
            'departamento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'identificacion.digits_between' => 'El numero de identificacion debe contener entre 1 y 10 numeros',
            'identificacion.unique' => 'El numero de identificacion ya se encuentra registrado',
        ];
    }
}
