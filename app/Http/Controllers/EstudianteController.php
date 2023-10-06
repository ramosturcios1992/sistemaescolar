<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarEstudianteRequest;
use App\Http\Requests\EstudianteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function index()
    {
        $sql = DB::select("select id,dni,name,apellido,email,password,tipo,telefono,usuario.grado as 'id_grado',
        direccion,estado,foto,grado.grado,seccion.seccion
                from seccion inner join grado ON grado.seccion=seccion.id_seccion
                inner join usuario ON grado.id_grado=usuario.grado
        where tipo=3");
        return view('estudiantes/table', compact('sql'));
    }
    public function create()
    {
        $sql = DB::select("select grado.id_grado,grado.grado,grado.seccion,seccion.seccion as 'seccion1',seccion.id_seccion from grado
        inner join seccion ON seccion.id_seccion=grado.seccion");
        $sql2 = DB::select('select *from semestre');
        return view('estudiantes/crear', compact('sql'))->with('sql2', $sql2);
    }
    public function store(EstudianteRequest $request)
    {
        $clave = $request->clave;
        $clave2 = $request->clave2;
        if ($clave != $clave2) {
            return back()->with('error-clave', 'Error, las contraseñas no coinciden');
        }
        $claveE = md5($clave2);
        try {
            $sql = DB::insert('insert into usuario(dni,name,apellido,email,password,tipo,telefono,grado,
        direccion,estado)values(?,?,?,?,?,?,?,?,?,?)', [
            $request->dni,
            $request->nombre,
            $request->apellido,
            $request->email,
            $claveE,
            3,
            $request->telefono,
            $request->grado,
            $request->direccion,
            1
        ]);
        } catch (\Throwable $th) {
           $sql=0;
        }


        if ($sql == 1) {
            return back()->with('correcto', 'Estudiante registrado exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al registrar');
        }
    }

    public function edit($id)
    {
        $sql = DB::select("select id,dni,name,apellido,email,password,tipo,telefono,usuario.grado as 'id_grado',
        direccion,estado,foto,grado.grado,seccion.seccion
                from seccion inner join grado ON grado.seccion=seccion.id_seccion
                inner join usuario ON grado.id_grado=usuario.grado
        where tipo=3 and id=?", [$id]);
        $sql2 = DB::select("select grado.id_grado,grado.grado,grado.seccion,seccion.seccion as 'seccion1',seccion.id_seccion from grado
        inner join seccion ON seccion.id_seccion=grado.seccion");
        return view('estudiantes/modificar', compact('sql'))->with('sql2', $sql2);
    }

    public function update(ActualizarEstudianteRequest $request)
    {
        $verificar = DB::select(
            'select count(*) as total from usuario where (dni=? or email=?) and id!=?',
            [$request->dni, $request->correo, $request->id]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, El Dni o Correo ya existe');
            }
        }

        try {
            $sql = DB::update(
                'update usuario set dni=?, name=?, apellido=?,direccion=?, 
                email=?,telefono=?, grado=? where id=?',
                [
                    $request->dni,
                    $request->nombre,
                    $request->apellido,
                    $request->direccion,
                    $request->correo,
                    $request->telefono,
                    $request->grado,
                    $request->id,
                ]
            );
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }



        if ($sql == 1) {
            return back()->with('correcto', 'Estudiante modificado exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from usuario where id = ?', [$id]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Estudiante Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al eliminar');
        }
    }
}
