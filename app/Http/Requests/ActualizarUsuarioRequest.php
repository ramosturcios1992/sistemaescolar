<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarUsuarioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'dni'=>'required|integer|digits:8|min:1',
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'email'=>'required|email|max:100',
            'tipo'=>'required',
        ];
    }

    public function attributes()
    {
        return[
            'email'=>'correo',
        ];
    }
}
