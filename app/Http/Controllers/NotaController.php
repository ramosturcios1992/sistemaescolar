<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    public function index()
    {
        $selecAnio = DB::select('select año from semestre group by año');

        $sql = DB::select("select curso.id_curso,nombre,docente,curso.id_grado,usuario.`name`,usuario.apellido,grado.grado,grado.seccion,seccion.seccion as 'section',
        usuario.tipo
        from usuario inner join curso ON curso.docente=usuario.id
        inner join grado ON grado.id_grado=curso.id_grado
        inner join seccion ON grado.seccion=seccion.id_seccion");
        return view('notas/cursos', compact('sql'))->with('anio', $selecAnio);
    }
    public function verNotas($id, $grado, $anio)
    {

        $gradoSeccion = DB::select('SELECT
        grado.id_grado,
        grado.grado,
        grado.seccion,
        curso.nombre,
        curso.id_curso,
        seccion.seccion as "nom_seccion"
        FROM
        grado
        INNER JOIN curso ON curso.id_grado = grado.id_grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion
        where id_curso=? and grado.id_grado=?
        ', [$id, $grado]);

        $sql2 = DB::select("select curso.docente,usuario.name,usuario.apellido
        from curso inner join usuario ON usuario.id=curso.docente
        where id_curso=?", [$id]);
        $sql3 = DB::select("select *from curso where id_curso=?", [$id]);
        foreach ($sql3 as $key) {
            $curso = $key->nombre;
        }

        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre where año=?', [$anio]);
        return view('notas/table')
            ->with('sql', [])
            ->with('sql2', $sql2)
            ->with('curso', $curso)
            ->with('consulta', [])
            ->with('semestre', $semestre)
            ->with('gradoSeccion', $gradoSeccion)
            ->with('id', $id)
            ->with('grado', $grado)
            ->with('anio', $anio);
    }

    public function verNotasSemestre($id, $grado, $semestre, $anio)
    {
        //semestre  1
        $sql = DB::select("SELECT
        usuario.id,
        usuario.dni,
        usuario.`name`,
        usuario.apellido,
        usuario.grado,
        nota.id_nota,
        nota.estudiante,
        nota.curso,
        nota.semestre,
        nota.nota1,
        nota.nota2,	
        nota.nota3,
        nota.promedio
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        where tipo=3 and grado=? and curso=? and semestre=?", [$grado, $id, $semestre]);

        $gradoSeccion = DB::select('SELECT
        grado.id_grado,
        grado.grado,
        grado.seccion,
        curso.nombre,
        curso.id_curso,
        seccion.seccion as "nom_seccion"
        FROM
        grado
        INNER JOIN curso ON curso.id_grado = grado.id_grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion
        where id_curso=? and grado.id_grado=?
        ', [$id, $grado]);

        $sql2 = DB::select("select curso.docente,usuario.name,usuario.apellido
        from curso inner join usuario ON usuario.id=curso.docente
        where id_curso=?", [$id]);
        $sql3 = DB::select("select *from curso where id_curso=?", [$id]);
        foreach ($sql3 as $key) {
            $curso = $key->nombre;
        }

        $array = [];
        foreach ($sql as $value) {
            array_push($array, $value->id);
        }
        if ($array == null) {
            $array = [""];
        }


        $consulta = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.apellido,
        usuario.grado
        FROM
        usuario
        where tipo=3 and grado=? and id not in (' . implode(',', array_map('intval', $array)) . ')', [$grado]);

        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre where año=?', [$anio]);
        return view('notas/table', compact('sql'))
            ->with('sql2', $sql2)
            ->with('curso', $curso)
            ->with('consulta', $consulta)
            ->with('semestre', $semestre)
            ->with('id', $id)
            ->with('grado', $grado)
            ->with('gradoSeccion', $gradoSeccion)
            ->with('anio', $anio);
    }

    public function create()
    {
        return view('semestres/crear');
    }
    public function edit($id)
    {
        $sql = DB::select('select *from semestre where id_semestre=?', [$id]);
        return view('semestres/modificar', compact('sql'));
    }

    public function verNotasFinales($id, $grado, $anio)
    {
        $sql = DB::select("SELECT
        usuario.id,
        usuario.dni,
        usuario.`name`,
        usuario.apellido,
        nota.estudiante,
        nota.curso,
        nota.anio,
        sum(promedio) as 'suma',        
        -- CAST(sum(promedio)/3 AS INT) as 'pro_total'
        ROUND(sum(promedio)/3) as 'pro_total'
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        where tipo=3 and curso=? and grado=? and anio=?
		GROUP BY id", [$id, $grado, $anio]);

        $gradoSeccion = DB::select('SELECT
        grado.id_grado,
        grado.grado,
        grado.seccion,
        curso.nombre,
        curso.id_curso,
        seccion.seccion as "nom_seccion"
        FROM
        grado
        INNER JOIN curso ON curso.id_grado = grado.id_grado
        INNER JOIN seccion ON grado.seccion = seccion.id_seccion
        where id_curso=? and grado.id_grado=?
        ', [$id, $grado]);

        $array = [];
        foreach ($sql as $value) {
            array_push($array, $value->id);
        }
        if ($array == null) {
            $array = [""];
        }


        $consulta = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.`dni`,
        usuario.apellido,
        usuario.grado
        FROM
        usuario
        where tipo=3 and grado=? and id not in (' . implode(',', array_map('intval', $array)) . ')', [$grado]);


        return view('notas/notas_finales')
            ->with('sql', $sql)
            ->with('gradoSeccion', $gradoSeccion)
            ->with('consulta', $consulta);
    }

    public function eliminarNotas($anio)
    {
        try {
            $sql = DB::delete('delete from nota where anio=?', [$anio]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("mensaje", "Notas eliminado Correctamente");
        } else {
            return back()->with("inmensaje", "Error al eliminar las notas");
        }
    }
}
