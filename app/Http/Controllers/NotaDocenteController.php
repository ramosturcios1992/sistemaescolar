<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotaDocenteController extends Controller
{
    public function index()
    {
        $selecAnio = DB::select('select año from semestre group by año');

        $id = Auth::user()->id;

        $sql = DB::select("select curso.id_curso,curso.nombre,curso.docente,grado.id_grado,grado.grado,grado.seccion,
        seccion.id_seccion,
        seccion.seccion as 'nombre_seccion',usuario.name,usuario.apellido
        from usuario 
        inner join curso ON curso.docente=usuario.id
        inner join grado ON grado.id_grado=curso.id_grado
        inner join seccion ON seccion.id_seccion=grado.seccion where docente=?", [$id]);

        return view('notas_docente/cursos', compact('sql'))->with('anio', $selecAnio);
    }
    public function verNotas($id_curso, $id_grado, $anio)
    {


        $doc = Auth::user()->id;
        $verificar = DB::select('select * from curso where id_curso=? and id_grado=?', [$id_curso, $id_grado]);
        if ($verificar == null) {
            return back()->with('mensaje-error', 'Ud no puede acceder a este sitio');
        } else {
            foreach ($verificar as $i) {
                if ($i->docente != $doc) {
                    return back()->with('mensaje-error', 'Ud no puede acceder a este sitio');
                }
            }
        }

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
        ', [$id_curso, $id_grado]);

        $sql3 = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.apellido,
        usuario.grado
        FROM
        usuario
        where tipo=3 and grado=?', [$id_grado]);

        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre where año=?', [$anio]);

        return view('notas_docente/table')
            ->with('sql', [])
            ->with('curso', $id_curso)
            ->with('grado', $id_grado)
            ->with('gradoSeccion', $gradoSeccion)
            ->with('semestre', $semestre)
            ->with('consulta', [])
            ->with('nom_semestre', 'SELECCIONAR UN SEMESTRE...')
            ->with('anio', $anio);;
    }

    public function actualizar($id, $nota1, $nota2, $nota3, $sem, $anio)
    {
        $nota1 = intval($nota1);
        $nota2 = intval($nota2);
        $nota3 = intval($nota3);
        $pro = round(($nota1 + $nota2 + $nota3) / 3);

        $sql = DB::update('update nota set semestre=?, nota1=?, nota2=?, nota3=?, promedio=?, anio=? where id_nota=?', [
            $sem,
            $nota1,
            $nota2,
            $nota3,
            $pro,
            $anio,
            $id
        ]);



        $sql2 = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.apellido,
        nota.id_nota,
        nota.estudiante,
        nota.nota1,
        nota.nota2,	
        nota.nota3,
        nota.promedio
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        where id_nota=?', [$id]);
        foreach ($sql2 as $i) {
            $pro_final = $i->promedio;
        }
        return response()->json(['dato' => $pro_final, 200]);
    }

    public function actualizar2($id, $nota1, $nota2, $nota3, $curso, $semestre, $anio)
    {
        $nota1 = intval($nota1);
        $nota2 = intval($nota2);
        $nota3 = intval($nota3);
        $pro = round(($nota1 + $nota2 + $nota3) / 3);

        $sql3 = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.apellido,
        nota.id_nota,
        nota.estudiante,
        nota.nota1,
        nota.nota2,	
        nota.nota3,
		nota.curso,
        nota.semestre,
        nota.promedio
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        where estudiante=? and curso=? and semestre=?', [$id, $curso, $semestre]);

        if ($sql3 == null) {
            $sql = DB::update('insert into nota(estudiante,curso,semestre,nota1,nota2,nota3,promedio,anio)values(?,?,?,?,?,?,?,?)', [
                $id,
                $curso,
                $semestre,
                $nota1,
                $nota2,
                $nota3,
                $pro,
                $anio,

            ]);
        } else {
            $sql = DB::update('update nota set nota1=?, nota2=?, nota3=?, promedio=?, anio=? where estudiante=? and curso=? and semestre=? and anio=?', [
                $nota1,
                $nota2,
                $nota3,
                $pro,
                $anio,
                $id,
                $curso,
                $semestre,
                $anio
            ]);
        }




        $sql2 = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.apellido,
        nota.id_nota,
        nota.estudiante,
        nota.nota1,
        nota.nota2,	
        nota.nota3,
				nota.curso,
        nota.promedio
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        where estudiante=? and curso=?', [$id, $curso]);
        foreach ($sql2 as $i) {
            $pro_final = $i->promedio;
        }
        return response()->json(['dato2' => $pro_final, 200]);
    }

    public function verNotasPorSemestre($id_curso, $id_grado, $id_semestre, $anio)
    {
        $doc = Auth::user()->id;
        $verificar = DB::select('select * from curso where id_curso=? and id_grado=?', [$id_curso, $id_grado]);
        if ($verificar == null) {
            return back()->with('mensaje-error', 'Ud no puede acceder a este sitio');
        } else {
            foreach ($verificar as $i) {
                if ($i->docente != $doc) {
                    return back()->with('mensaje-error', 'Ud no puede acceder a este sitio');
                }
            }
        }

        $sql = DB::select('SELECT
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
        where tipo=3 and curso=? and grado=? and semestre=?', [$id_curso, $id_grado, $id_semestre]);


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
        ', [$id_curso, $id_grado]);

        $sql3 = DB::select('SELECT
        usuario.id,
        usuario.`name`,
        usuario.apellido,
        usuario.grado
        FROM
        usuario
        where tipo=3 and grado=?', [$id_grado]);

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
        where tipo=3 and grado=? and id not in (' . implode(',', array_map('intval', $array)) . ')', [$id_grado]);

        //CONSULTA DE SEMESTRES
        $semestre = DB::select('select * from semestre where año=?', [$anio]);

        $nom_semestre = DB::select('select * from semestre where id_semestre=?', [$id_semestre]);
        return view('notas_docente/table', compact('sql'))
            ->with('sql', $sql)
            ->with('curso', $id_curso)
            ->with('grado', $id_grado)
            ->with('sql3', $sql3)
            ->with('gradoSeccion', $gradoSeccion)
            ->with('consulta', $consulta)
            ->with('semestre', $semestre)
            ->with('nom_semestre', $nom_semestre)
            ->with('id_semestre', $id_semestre)
            ->with('anio', $anio);

        // return $consulta;SELECCIONAR UN SEMESTRE...
    }

    public function verNotasFinales($id_curso, $id_grado, $anio)
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
        -- CAST(sum(promedio)/3 as INT) as 'pro_total'
        ROUND(sum(promedio)/3) as 'pro_total'
        FROM
        usuario
        LEFT JOIN nota ON nota.estudiante = usuario.id
        where tipo=3 and curso=? and grado=? and anio=?
		GROUP BY id", [$id_curso, $id_grado, $anio]);

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
        ', [$id_curso, $id_grado]);

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
        where tipo=3 and grado=? and id not in (' . implode(',', array_map('intval', $array)) . ')', [$id_grado]);


        return view('notas_docente/notas_finales')
            ->with('sql', $sql)
            ->with('gradoSeccion', $gradoSeccion)
            ->with('consulta', $consulta);
    }
}
