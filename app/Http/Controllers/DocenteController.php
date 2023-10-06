<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarDocenteRequest;
use App\Http\Requests\DocenteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    public function index()
    {
        $sql = DB::select("select * from usuario where tipo=2");
        return view('docentes/table', compact('sql'));
    }
    public function create()
    {
        return view('docentes/crear');
    }
    public function store(DocenteRequest $request)
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
            2,
            $request->telefono,
            $request->direccion,
            1
        ]);
        } catch (\Throwable $th) {
            $sql=0;
        }

        if ($sql == 1) {
            return back()->with('correcto', 'Docente registrado exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al registrar');
        }
    }

    public function edit($id)
    {
        $sql = DB::select("select * from usuario where id=?", [$id]);
        return view('docentes/modificar', compact('sql'));
    }

    public function update(ActualizarDocenteRequest $request)
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
            return back()->with('correcto', 'Docente modificado exitosamente');
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
            return back()->with('correcto', 'Docente Eliminado Exitosamente');
        } else {
            return back()->with('incorrecto', 'Error al eliminar');
        }
    }
}
