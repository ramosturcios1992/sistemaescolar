<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradoController extends Controller
{
    public function index()
    {
        $sql = DB::select('select grado.id_grado,grado.grado,grado.seccion,seccion.seccion 
        from grado inner join seccion ON seccion.id_seccion=grado.seccion');
        return view('grados/table', compact('sql'));
    }
    public function create()
    {
        $sql = DB::select('select * from seccion');
        return view('grados/crear', compact('sql'));
    }
    public function edit($id)
    {
        $sql = DB::select('select * from grado where id_grado=?', [$id]);
        $sql2 = DB::select('select * from seccion');
        return view('grados/modificar', compact('sql'))->with('sql2',$sql2);
    }
    public function store(GradoRequest $request)
    {
        $grado = $request->grado;
        $seccion = $request->seccion;
        $verificar = DB::select(
            'select count(*) as total from grado where grado=? and seccion=?',
            [$grado, $seccion]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Estos datos ya existen');
            }
        }
        try {
            $sql = DB::insert('insert into grado(grado,seccion) values(?,?)', [$request->grado,$request->seccion]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Grado Registrado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Registrar');
        }
    }
    public function update(GradoRequest $request)
    {
        $grado = $request->grado;
        $seccion = $request->seccion;
        $verificar = DB::select(
            'select count(*) as total from grado where (grado=? and seccion=?) and id_grado!=?',
            [$grado,$seccion, $request->id]
        );
        foreach ($verificar as $i) {
            if ($i->total >= 1) {
                return back()->with('duplicado', 'Error, Estos datos ya existen');
            }
        }
        try {
            $id = $request->id;
            $sql = DB::update('update grado set grado=?, seccion=? where id_grado=?', [$grado,$seccion, $id]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Grado Modificado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Modificar');
        }
    }

    public function destroy($id)
    {
        try {
            $sql = DB::delete('delete from grado where id_grado = ?', [$id]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == 1) {
            return back()->with('correcto', 'Grado Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al Eliminar');
        }
    }
}
