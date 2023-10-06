<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
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
            'dni'=>'required|integer|digits:8|min:1|unique:usuario',
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'email'=>'required|email|max:100|unique:usuario',
            'clave1'=>'required|string|max:100|min:8',
            'clave2'=>'required|string|max:100|min:8',
            'tipo'=>'required',
        ];
    }

    public function attributes()
    {
        return[
            'email'=>'correo',
            'clave1'=>'clave',
            'clave2'=>'repetir clave'
        ];
    }
}
