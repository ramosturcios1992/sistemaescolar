<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{
    public function index()
    {
        $sql = DB::select('select *from tipo_usuario');
        return view('tipo_usuarios/table', compact('sql'));
    }
    public function create()
    {
        return view('tipo_usuarios/crear');
    }
    public function edit($id)
    {
        $sql = DB::select('select *from tipo_usuario where id_tipo_usuario=?', [$id]);
        return view('tipo_usuarios/modificar', compact('sql'));
    }
    public function store(TipoUsuarioRequest $request)
    {
        // $tipo = $request->tipo;
        // try {
        //     $sql = DB::insert('insert into tipo_usuario(tipo) values(?)', [$tipo]);
        // } catch (\Throwable $th) {
        //     $sql = 0;
        // }
        // if ($sql == 1) {
        //     return back()->with('correcto', 'Tipo de Usuario Registrado Exitosamente');
        // } else {
        //     return back()->with('incorrecto', 'Error al Registrar');
        // }
        return back()->with('aviso', 'NO PUEDES HACER CAMBIOS CON ESTOS REGISTROS DEBIDO A QUE EL SISTEMA FUE DESARROLLADO EN RELACIÓN A ELLO. PARA MAS INFORMACIÓN CONSULTE CON EL ADMINISTRADOR');
    }
    public function update(TipoUsuarioRequest $request)
    {
        // $verificar = DB::select(
        //     'select count(*) as total from tipo_usuario where tipo=? and id_tipo_usuario!=?',
        //     [$request->tipo, $request->id]
        // );
        // foreach ($verificar as $i) {
        //     if ($i->total >= 1) {
        //         return back()->with('duplicado', 'Error, el tipo de usuario ya existe');
        //     }
        // }
        // try {
        //     $id = $request->id;
        //     $tipo = $request->tipo;
        //     $sql = DB::update('update tipo_usuario set tipo=? where id_tipo_usuario=?', [$tipo, $id]);
        //     if ($sql == 0) {
        //         $sql = 1;
        //     }
        // } catch (\Throwable $th) {
        //     $sql = 0;
        // }
        // if ($sql == 1) {
        //     return back()->with('correcto', 'Tipo de Usuario Modificado Exitosamente');
        // } else {
        //     return back()->with('incorrecto', 'Error al Modificar');
        // }
        return back()->with('aviso', 'NO PUEDES HACER CAMBIOS CON ESTOS REGISTROS DEBIDO A QUE EL SISTEMA FUE DESARROLLADO EN RELACIÓN A ELLO. PARA MAS INFORMACIÓN CONSULTE CON EL ADMINISTRADOR');
    }

    public function destroy($id)
    {
        // try {
        //     $sql = DB::delete('delete from tipo_usuario where id_tipo_usuario = ?', [$id]);
        // } catch (\Throwable $th) {
        //     $sql=0;
        // }
        // if ($sql == 1) {
        //     return back()->with('correcto', 'Tipo de Usuario Eliminado Exitosamente');
        // } else {
        //     return back()->with('incorrecto', 'Error al Eliminar');
        // }
        return back()->with('aviso', 'NO PUEDES HACER CAMBIOS CON ESTOS REGISTROS DEBIDO A QUE EL SISTEMA FUE DESARROLLADO EN RELACIÓN A ELLO. PARA MAS INFORMACIÓN CONSULTE CON EL ADMINISTRADOR');
    }
}
