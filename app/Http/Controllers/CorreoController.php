<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorreoRequest;
use App\Http\Requests\RecuperarClaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorreoController extends Controller
{
    public function index(CorreoRequest $request)
    {
        $correo = $request->email;
        $sql = DB::select('select * from usuario where email=?', [$correo]);

        if ($sql == null) {
            return back()->with('error-correo', 'se ha producido un error');
        } else {
            return view('recuperar_clave/Recupera', compact('sql'));
        }
    }

    public function recuperar(RecuperarClaveRequest $request)
    {
        $clave2 = $request->clave2;
        $clave3 = $request->clave3;
        $correo = $request->txtcorreo;
        if ($clave2 != $clave3) {
            return back()->with('error-clave', 'Error, las contraseñas no coinciden');
        }
        $claveE = md5($clave2);
        try {
            $sql = DB::insert('update usuario set password=? where email=?', [
                $claveE,
                $correo
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with('correcto', 'Su contraseña fue modificado exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al modificado');
        }
    }
}
