<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotaEstudianteController extends Controller
{
    public function index($anio)
    {
        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre where año=?', [$anio]);

        return view('notas_estudiante/cursos')
            ->with('sql', [])
            ->with('semestre', $semestre)
            ->with('consulta', [])
            ->with('anio', $anio);
    }

    public function ingresarAnio()
    {
        $anio = DB::select('select año from semestre group by año');
        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre');

        return view('notas_estudiante/ingresa_anio')
            ->with('anio', $anio);
    }

    public function verNotasPorSemestre($semestre, $anio)
    {
        $id = Auth::user()->id;
        $grado = Auth::user()->grado;
        $sql = DB::select("SELECT
        nota.id_nota,
        nota.estudiante,
        nota.curso,
        nota.semestre,
        nota.nota1,
        nota.nota2,
        nota.nota3,
        nota.promedio,
        curso.nombre,
        curso.id_grado
        FROM
        nota
        INNER JOIN curso ON nota.curso = curso.id_curso
        where estudiante=? and semestre=?", [$id, $semestre]);

        $array = [];
        foreach ($sql as $value) {
            array_push($array, $value->curso);
        }
        if ($array == null) {
            $array = [""];
        }


        $consulta = DB::select('SELECT * from curso
        where  id_grado=? and id_curso not in (' . implode(',', array_map('intval', $array)) . ')', [$grado]);

        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre where año=?', [$anio]);
        return view('notas_estudiante/cursos', compact('sql'))
            ->with('semestre', $semestre)
            ->with('consulta', $consulta)
            ->with('anio', $anio);;
    }
    public function verNotasFinales($anio)
    {
        $id = Auth::user()->id;
        $grado = Auth::user()->grado;
        $sql = DB::select("SELECT
        usuario.id,
        usuario.dni,
		usuario.grado,
        usuario.`name`,
        usuario.apellido,
        nota.estudiante,
        nota.curso,
        nota.anio,
        nota.id_nota,
        sum(promedio) as 'suma',
        -- CAST(sum(promedio)/3 as INT) as 'pro_total',
        ROUND(sum(promedio)/3) as 'pro_total',
        curso.nombre
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        LEFT JOIN curso ON curso.id_curso=nota.curso
        where tipo=3 and estudiante=? and grado=? and anio=?
        GROUP BY curso", [$id, $grado, $anio]);

        $array = [];
        foreach ($sql as $value) {
            array_push($array, $value->curso);
        }
        if ($array == null) {
            $array = [""];
        }



        $consulta = DB::select('SELECT * from curso
        where  id_grado=? and id_curso not in (' . implode(',', array_map('intval', $array)) . ')', [$grado]);


        return view('notas_estudiante/notas_finales', compact('sql'))
            ->with('consulta', $consulta)
            ->with('curso')
            ->with('anio', $anio);
    }
}
