<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = DB::select('select * from empresa');
        return view('info.index')->with("sql", $sql);
    }

    public function update(Request $request)
    {
        $request->validate([
            "nombre" => "required"
        ]);
        try {
            $sql = DB::update('update empresa set nombre=?, ubicacion=?, ruc=?, telefono=?',[
                $request->nombre,
                $request->ubicacion,
                $request->ruc,
                $request->telefono
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("correcto", "Datos modificados correctamente");
        } else {
            return back()->with("incorrecto", "Error al modificar los datos");
        }
    }
}
