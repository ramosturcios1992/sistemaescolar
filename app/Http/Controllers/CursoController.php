<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    public function index()
    {
        $sql = DB::select(" SELECT curso.id_curso,curso.nombre,curso.docente,curso.id_grado,grado.grado,seccion.seccion,
        usuario.name as 'docente_nom',usuario.apellido from usuario 
                        inner join curso ON usuario.id=curso.docente
                inner join grado ON grado.id_grado=curso.id_grado
                inner join seccion ON seccion.id_seccion=grado.seccion
         ");
        return view('cursos/table', compact('sql'));
    }
    public function create()
    {
        $sql = DB::select('select *from usuario where tipo=2');
        $sql3 = DB::select('select *from materia');
        $sql2 = DB::select("select id_grado,grado,grado.seccion as 'id_seccion',seccion.seccion from grado
        inner join seccion ON seccion.id_seccion=grado.seccion");
        return view('cursos/crear', compact('sql'))->with('sql2', $sql2)->with('sql3', $sql3);
    }
    public function edit($id)
    {
        $sql3 = DB::select('select *from usuario where tipo=2');
        $sql4 = DB::select('select *from materia');
        $sql2 = DB::select("select id_grado,grado,grado.seccion as 'id_seccion',seccion.seccion from grado
        inner join seccion ON seccion.id_seccion=grado.seccion");
        $sql = DB::select("SELECT curso.id_curso,curso.nombre,curso.docente,curso.id_grado,grado.grado,seccion.seccion,
        usuario.name as 'docente_nom',usuario.apellido from usuario 
                        inner join curso ON usuario.id=curso.docente
                inner join grado ON grado.id_grado=curso.id_grado
                inner join seccion ON seccion.id_seccion=grado.seccion where id_curso=?", [$id]);
        return view('cursos/modificar', compact('sql'))->with('sql2', $sql2)->with('sql3', $sql3)->with('sql4', $sql4);
    }
    public function store(CursoRequest $request)
    {
        $verificar = DB::select(
            'select count(*) as total from curso where nombre=? and id_grado=?',
            [$request->nombre, $request->grado]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Los Datos ya existen');
            }
        }

        try {
            $sql = DB::insert(
                'insert into curso(nombre,docente,id_grado) values(?,?,?)',
                [$request->nombre, $request->docente, $request->grado]
            );
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Curso Asignado al docente Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Registrar');
        }
    }
    public function update(CursoRequest $request)
    {
        $verificar = DB::select(
            'select count(*) as total from curso where nombre=? and id_grado=? and id_curso!=?',
            [$request->nombre,  $request->grado, $request->id]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Los Datos ya existen');
            }
        }

        try {
            $nombre = $request->nombre;
            $docente = $request->docente;
            $grado = $request->grado;
            $id = $request->id;
            $sql = DB::update('update curso set nombre=?, docente=?,id_grado=? where id_curso=?', [$nombre, $docente, $grado, $id]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Curso Asignado Modificado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from curso where id_curso = ?', [$id]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Curso Asignado Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Eliminar');
        }
    }
}
