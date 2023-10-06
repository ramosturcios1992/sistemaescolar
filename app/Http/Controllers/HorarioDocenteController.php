<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HorarioDocenteController extends Controller
{
    public function table()
    {
        $id = Auth::user()->id;
        $sql = DB::select("SELECT
        grado.id_grado,
        grado.grado,
        grado.seccion,
        seccion.id_seccion,
        seccion.seccion AS nom_seccion,
        curso.docente,
        curso.id_curso,
        curso.nombre
        FROM
        grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion
        INNER JOIN curso ON curso.id_grado = grado.id_grado        
        where docente=? ", [$id]);

        return view('horario-docente/table')
            ->with('sql', $sql);
    }

    public function index()
    {
        $id_docente = Auth::user()->id;
        $cursosDocente = DB::select(' SELECT
        curso.id_curso,
        curso.nombre,
        curso.docente,
        curso.id_grado
        FROM
        curso
        where docente=?', [$id_docente]);

        $array = [''];
        $array2 = [''];
        $misql='';
        foreach ($cursosDocente as $value) {
            $misql=$misql." nombre='$value->nombre' AND `events`.grado=$value->id_grado OR ";
            array_push($array, $value->nombre);
            array_push($array2, $value->id_grado);
        }
        if ($array == null) {
            $array = [''];
        }      
       
        if ($array2 == null) {
            $array2 = [''];
        }

        $str = "'" . implode("','", $array) . "'";
        $str2 = "'" . implode("','", $array2) . "'";      

        $sql = DB::select("SELECT 
        materia.nombre,
        `events`.id,
        `events`.title,
        `events`.color,
        `events`.`start`,
        `events`.`end`,
        `events`.curso,
        `events`.grado,
        materia.id_materia,
        grado.grado AS nom_grado,
        grado.seccion,
        seccion.seccion as 'nom_seccion'
        FROM
        `events`
        INNER JOIN materia ON `events`.curso = materia.id_materia
        INNER JOIN grado ON `events`.grado = grado.id_grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion
        WHERE $misql nombre=''");

          return view('horario-docente/index')
              ->with('events', $sql);
        //return [$misql,$array, $sql,$str, $str2];
    }
}
