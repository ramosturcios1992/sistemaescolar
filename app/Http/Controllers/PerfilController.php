<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModificarPerfilRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    
    public function index()
    {
        $id = Auth::user()->id;
        $sql = DB::select('select *from usuario where id=?', [$id]);
        $sql2 = DB::select("select grado.id_grado,grado.grado,grado.seccion,seccion.seccion as 'seccion1',seccion.id_seccion
        FROM
        grado
        INNER JOIN seccion ON seccion.id_seccion = grado.seccion
        INNER JOIN usuario ON usuario.grado = grado.id_grado where usuario.id=$id");
        return view('ver-perfil/perfil', compact('sql'))->with('sql2', $sql2);
    }

    
    
    public function update(ModificarPerfilRequest $request)
    {
        $id = Auth::user()->id;
        $tipo = Auth::user()->tipo;
        $dni = $request->dni;
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $email = $request->email;
        $direccion = $request->direccion;
        $grado = $request->grado;
        $telefono = $request->telefono;
        $verificarDni = DB::select('select * from usuario where dni = ? and id!=?', [$dni, $id]);
        if ($verificarDni != null) {
            return back()->with('dni', 'El numero de Dni ya esta en uso');
        }
        $verificarCorreo = DB::select('select * from usuario where email = ? and id!=?', [$email, $id]);
        if ($verificarCorreo != null) {
            return back()->with('correo', 'La direccion de correo ya esta en uso');
        }
        if ($tipo == 3) {
            try {
                $sql = DB::update('update usuario set dni=?, name=?, apellido=?, email=?,telefono=?,
                direccion=? where id=?', [$dni, $nombre, $apellido, $email, $telefono, $direccion, $id]);
                if ($sql == 0) {
                    $sql = 1;
                }
            } catch (\Throwable $th) {
            }
        } else {
            try {
                $sql = DB::update('update usuario set dni=?, name=?, apellido=?, email=?,telefono=?,
                direccion=? where id=?', [$dni, $nombre, $apellido, $email, $telefono, $direccion, $id]);
                if ($sql == 0) {
                    $sql = 1;
                }
            } catch (\Throwable $th) {
            }
        }

        if ($sql == 1) {
            return back()->with('correcto', 'Datos modificados correctamente');
        } else {
            return back()->with('incorrecto', 'Error al modificar los datos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function modificarContrasenia(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            "clave" => "required|min:8",
            "nuevoClave" => "required|min:8"
        ]);

        if (md5($request->clave) == md5($request->nuevoClave)) {
            try {
                $claveMD5 = md5($request->clave);
                $sql = DB::update('update usuario set password=? where id=?', [$claveMD5, $id]);
                if ($sql == 0) {
                    $sql = 1;
                }
            } catch (\Throwable $th) {
            }
            if ($sql == 1) {
                return back()->with('correcto', "Contraseña Modificado Existosamente");
            } else {
                return back()->with('incorrecto', "Error al modificicar contraseña");
            }
        } else {
            return back()->with('error-clave', "Las contraseñas no coinciden");
        }
    }
}
