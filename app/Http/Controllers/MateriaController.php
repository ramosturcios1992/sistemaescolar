<?php

namespace App\Http\Controllers;

use App\Http\Requests\MateriaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    public function index()
    {
        $sql = DB::select(" select *from materia
         ");
        return view('materias/table', compact('sql'));
    }
    public function create()
    {        
        return view('materias/crear');
    }
    public function edit($id)
    {      
        $sql = DB::select("SELECT * from materia where id_materia=?", [$id]);
        return view('materias/modificar', compact('sql'));
    }
    public function store(MateriaRequest $request)
    {   
        $verificar = DB::select(
            'select count(*) as total from materia where nombre=?',
            [$request->nombre]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Los Datos ya existen');
            }
        }

        try {
            $sql = DB::insert(
                'insert into materia(nombre) values(?)',
                [$request->nombre]
            );
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Curso Registrado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Registrar');
        }
    }
    public function update(MateriaRequest $request)
    {
        $verificar = DB::select(
            'select count(*) as total from materia where nombre=? and id_materia!=?',
            [$request->nombre, $request->id]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Los Datos ya existen');
            }
        }

        try {
            $nombre = $request->nombre;
            $id = $request->id;
            $sql = DB::update('update materia set nombre=? where id_materia=?', [$nombre, $id]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Curso Modificado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from materia where id_materia = ?', [$id]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Curso Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Eliminar');
        }
    }
}
