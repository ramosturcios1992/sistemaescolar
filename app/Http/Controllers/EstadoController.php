<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadoController extends Controller
{
    public function estado($id)
    {
        $sql = DB::select('select * from usuario where id = ?', [$id]);
        foreach ($sql as $i) {
            $estado = $i->estado;
        }
        if ($estado == 1) {
            $sql2 = DB::update('update usuario set estado=0 where id = ?', [$id]);
            return back()->with('estado', 'USUARIO SUSPENDIDO');
        } else {
            $sql2 = DB::update('update usuario set estado=1 where id = ?', [$id]);
            return back()->with('estado', 'USUARIO ACTIVO');
        }
    }
}
