<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeccionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeccionController extends Controller
{
    public function index()
    {
        $sql = DB::select('select *from seccion');
        return view('seccions/table', compact('sql'));
    }
    public function create()
    {
        return view('seccions/crear');
    }
    public function edit($id)
    {
        $sql = DB::select('select *from seccion where id_seccion=?', [$id]);
        return view('seccions/modificar', compact('sql'));
    }
    public function store(SeccionRequest $request)
    {       
        $seccion = $request->seccion;
        $verificar=DB::select('select count(*) as total from seccion where seccion=?', [$seccion]);
        foreach ($verificar as $i) {
            if ($i->total>=1) {
                return back()->with('duplicado', 'Error, Estos datos ya existen');
            }
        }
        try {
            $sql = DB::insert('insert into seccion(seccion) values(?)', [$request->seccion]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Sección Registrado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Registrar');
        }
    }
    public function update(SeccionRequest $request)
    {
        $seccion = $request->seccion;
        $verificar=DB::select('select count(*) as total from seccion where seccion=? and id_seccion!=?',
        [$seccion,$request->id]);
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Estos datos ya existen');
            }
        }
        try {
            $id = $request->id;
            $sql = DB::update('update seccion set seccion=? where id_seccion=?', [$seccion, $id]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Sección Modificado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from seccion where id_seccion = ?', [$id]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Sección Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Eliminar');
        }
    }
}
