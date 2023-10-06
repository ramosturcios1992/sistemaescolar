<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetenciaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetenciaController extends Controller
{
    public function index()
    {
        $sql = DB::select(" select competencia.id_competencias,competencia.competencia,competencia.curso,competencia.`año`,
        curso.id_curso,curso.nombre
         from competencia inner join curso ON curso.id_curso=competencia.curso ");
        return view('competencias/table', compact('sql'));
    }
    public function create()
    {
        $sql = DB::select('select *from curso');        
        return view('competencias/crear', compact('sql'));
    }
    public function edit($id)
    {
        $sql2 = DB::select('select *from curso');   
        $sql = DB::select("SELECT *from competencia where id_competencias=?", [$id]);
        return view('competencias/modificar', compact('sql'))->with('sql2',$sql2);
    }
    public function store(CompetenciaRequest $request)
    {
        try {
            $sql = DB::insert(
                'insert into competencia(competencia,curso,año) values(?,?,?)',
                [$request->nombre, $request->curso, $request->año]
            );
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Competencia Registrado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Registrar');
        }
    }
    public function update(CompetenciaRequest $request)
    {
       
        try {
            $nombre = $request->nombre;
            $curso = $request->curso;
            $año = $request->año;
            $id = $request->id;
            $sql = DB::update('update competencia set competencia=?, curso=?,año=? where id_competencias=?', [$nombre, $curso, $año, $id]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Competencia Modificado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from competencia where id_competencias = ?', [$id]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Competencia Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Eliminar');
        }
    }
}
