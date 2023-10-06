<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarEstudianteRequest extends FormRequest
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
            'dni' => 'required|max:8|min:1',
            'nombre' => 'required|min:1|max:100',
            'apellido' => 'required|min:1|max:100',
            'correo' => 'required|email|min:1|max:100',
            'grado' => 'required',
        ];
    }
}
