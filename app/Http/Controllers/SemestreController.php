<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemestreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemestreController extends Controller
{
    public function index()
    {
        $sql = DB::select('select *from semestre');
        return view('semestres/table', compact('sql'));
    }
    public function create()
    {
        return view('semestres/crear');
    }
    public function edit($id)
    {
        $sql = DB::select('select *from semestre where id_semestre=?', [$id]);
        return view('semestres/modificar', compact('sql'));
    }
    public function store(SemestreRequest $request)
    {

        $semestre = $request->semestre;
        $año = $request->año;
        $verificar=DB::select('select count(*) as total from semestre where semestre=? and año=?', [$semestre,$año]);
        foreach ($verificar as $i) {
            if ($i->total>=1) {
                return back()->with('duplicado', 'Error, Estos datos ya existen');
            }
        }
        try {
            $sql = DB::insert('insert into semestre(semestre,año) values(?,?)', [$semestre,$año]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Semestre Registrado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Registrar');
        }
    }
    public function update(SemestreRequest $request)
    {
        $semestre = $request->semestre;
        $año = $request->año;
        $verificar=DB::select('select count(*) as total from semestre where (semestre=? and año=?) and id_semestre!=?',
        [$semestre,$año,$request->id]);
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Estos datos ya existen');
            }
        }
        try {
            $id = $request->id;
            $sql = DB::update('update semestre set semestre=?, año=? where id_semestre=?', [$semestre, $año,$id]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Semestre Modificado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from semestre where id_semestre = ?', [$id]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Semestre Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Eliminar');
        }
    }
}
