<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function table()
    {
        $sql = DB::select("SELECT
        grado.id_grado,
        grado.grado,
        grado.seccion,
        seccion.id_seccion,
        seccion.seccion as 'nom_seccion'
        FROM
        grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion");

        return view('horario/table')
            ->with('sql', $sql);
    }

    public function index($id)
    {
        $grado = DB::select("SELECT
        grado.id_grado,
        grado.grado,
        grado.seccion,
        seccion.id_seccion,
        seccion.seccion as 'nom_seccion'
        FROM
        grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion where id_grado=?", [$id]);

        $sql = DB::select('SELECT
        `events`.id,
        `events`.title,
        `events`.color,
        `events`.`start`,
        `events`.`end`,
        `events`.curso,
        `events`.grado,
        materia.id_materia,
        materia.nombre
        FROM
        `events`
        INNER JOIN materia ON `events`.curso = materia.id_materia where grado=?', [$id]);
        $sql2 = DB::select('select * from materia');

        return view('horario/index')
            ->with('events', $sql)
            ->with('grado', $grado)
            ->with('sql2', $sql2);
    }


    public function store(Request $request)
    {

        try {
            $sql = DB::insert(
                'insert into events (color,start,end,curso,grado) values (?,?,?,?,?)',
                [$request->color, $request->start, $request->end, $request->curso, $request->grado]
            );
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back();
        } else {
            return back();
        }

        //return response()->json(['dato' => $pro_final, 200]);
    }
    public function update($id, $start, $end)
    {
        try {
            $sql = DB::update('update events set start=?, end=? where id=?', [$start, $end, $id]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return response()->json(['dato' => "OK", 200]);
        } else {
            return response()->json(['dato' => "OFF", 200]);
        }
    }


    public function updateTitle(Request $request)
    {
        if ($request->delete != null) {
            try {
                $sql = DB::update('delete from events where id=?', [$request->id]);
            } catch (\Throwable $th) {
                $sql = 0;
            }
        } else {
            try {
                $sql = DB::update('update events set curso=?, title=?, color=? where id=?', [$request->curso, $request->title, $request->color, $request->id]);
            } catch (\Throwable $th) {
                $sql = 0;
            }
        }

        if ($sql == 1) {
            return back();
        } else {
            return back();
        }
    }


    public function eliminar()
    {
        try {
            $sql = DB::update('delete from events');
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('correcto', "Lista de horarios eliminado exitosamente");
        } else {
            return back()->with('incorrecto', "Error al aliminar horarios");
        }
    }
}
