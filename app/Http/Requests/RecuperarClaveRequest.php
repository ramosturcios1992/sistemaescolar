<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecuperarClaveRequest extends FormRequest
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
            'clave2'=>'required|min:8|max:50',
            'clave3'=>'required|min:8|max:50'
        ];
    }

    public function attributes()
    {
        return [
            'clave2'=>'contraseña',
            'clave3'=>'repetir contraseña'
        ];
    }
}
