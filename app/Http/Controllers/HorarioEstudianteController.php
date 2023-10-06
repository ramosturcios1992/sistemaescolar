<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HorarioEstudianteController extends Controller
{
    public function table()
    {
        $id_user = Auth::user()->id;
        $consultaUser = DB::select("select grado from usuario where id=? and tipo=3", [$id_user]);
        foreach ($consultaUser as $item) {
            $id = $item->grado;
        }

        $sql = DB::select("SELECT
        curso.id_curso,
        curso.nombre,
        curso.docente,
        curso.id_grado,
        usuario.id,
        usuario.`name`,
        usuario.apellido
        FROM
        curso
        INNER JOIN usuario ON curso.docente = usuario.id
         where id_grado=?", [$id]);

        return view('horario-estudiante/table')
            ->with('sql', $sql);
    }

    public function index()
    {
        $id_user = Auth::user()->id;
        $consultaUser = DB::select("select grado from usuario where id=? and tipo=3", [$id_user]);
        foreach ($consultaUser as $item) {
            $id = $item->grado;
        }

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

        return view('horario-estudiante/index')
            ->with('events', $sql)
            ->with('grado', $grado)
            ->with('sql2', $sql2);
    }
}
