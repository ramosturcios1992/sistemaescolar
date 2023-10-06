<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarDirectorRequest;
use App\Http\Requests\DirectorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectorController extends Controller
{
    public function index()
    {
        $sql = DB::select("select * from usuario where tipo=1");
        return view('directors/table', compact('sql'));
    }
    public function create()
    {
        return view('directors/crear');
    }
    public function store(DirectorRequest $request)
    {
        $clave = $request->clave;
        $clave2 = $request->clave2;
        if ($clave != $clave2) {
            return back()->with('error-clave', 'Error, las contraseñas no coinciden');
        }
        $claveE = md5($clave2);
        try {
            $sql = DB::insert('insert into usuario(dni,name,apellido,email,password,tipo,telefono,direccion,estado)
        values(?,?,?,?,?,?,?,?,?)', [
            $request->dni,
            $request->nombre,
            $request->apellido,
            $request->email,
            $claveE,
            1,
            $request->telefono,
            $request->direccion,
            1
        ]);
        } catch (\Throwable $th) {
            $sql=0;
        }

        if ($sql == 1) {
            return back()->with('correcto', 'Administrador registrado exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al registrar');
        }
    }

    public function edit($id)
    {
        $sql = DB::select("select * from usuario where id=?", [$id]);
        return view('directors/modificar', compact('sql'));
    }

    public function update(ActualizarDirectorRequest $request)
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
                'update usuario set dni=?, name=?, apellido=?,email=?,telefono=?,direccion=? where id=?',
                [
                    $request->dni,
                    $request->nombre,
                    $request->apellido,
                    $request->correo,
                    $request->telefono,
                    $request->direccion,                    
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
            return back()->with('correcto', 'Administrador modificado exitosamente');
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
            return back()->with('correcto', 'Administrador Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al eliminar');
        }
    }
}
