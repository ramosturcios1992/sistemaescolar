<?php

use App\Http\Controllers\CompetenciaController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\GradoSeccionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioDocenteController;
use App\Http\Controllers\HorarioEstudianteController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\NotaDocenteController;
use App\Http\Controllers\NotaEstudianteController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\UsuarioUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('inicio')->middleware('verified');

/* info */
Route::get('info-institucion', [InstitucionController::class, 'index'])->name('info.index')->middleware('verified');
Route::post('info-institucion-modificar', [InstitucionController::class, 'update'])->name('info.update')->middleware('verified');


/* recuperar clave */
Route::post('ingresar-correo', [CorreoController::class, 'index'])->name('mail.index');
Route::get('/recuperar_clave/Formulario/{correo}', function ($correo) {
    return view('recuperar_clave/Formulario', compact('correo'));
});
Route::post('recuperar-clave', [CorreoController::class, 'recuperar'])->name('mail.recuperar');

//ver Perfil
Route::get('ver-perfil', [PerfilController::class, 'index'])->name('verPerfil.index')->middleware('verified');
Route::post('ver-perfil-editar', [PerfilController::class, 'update'])->name('verPerfil.update')->middleware('verified');
/* modificar contraseña */
Route::post('modificar-contraseña', [PerfilController::class, 'modificarContrasenia'])->name('verPerfil.modificarClave')->middleware('verified');

//HORARIOS-GENERAL
Route::get('horarios-lista-grados', [HorarioController::class, 'table'])->name('horarios.table')->middleware('verified');
Route::get('horarios-de-clase-{id}', [HorarioController::class, 'index'])->name('horarios.index')->middleware('verified');
Route::get('insertar-horarios-de-clase', [HorarioController::class, 'store'])->middleware('verified');
Route::get('actualizar-horarios-de-clase/{id}/{start}/{end}', [HorarioController::class, 'update'])->middleware('verified');
Route::get('actualizarTitle-horarios-de-clase', [HorarioController::class, 'updateTitle'])->middleware('verified');
Route::get('eliminar-horarios-de-clase', [HorarioController::class, 'eliminar'])->name('horarios.eliminar')->middleware('verified');

//HORARIOS-DOCENTE
Route::get('mis-cursos-docente', [HorarioDocenteController::class, 'table'])->name('horariosDocente.table')->middleware('verified');
Route::get('horarios-docente-de-clase', [HorarioDocenteController::class, 'index'])->name('horariosDocente.index')->middleware('verified');

//HORARIOS-ESTUDIANTE
Route::get('mis-cursos-estudiante', [HorarioEstudianteController::class, 'table'])->name('horariosEstudiante.table')->middleware('verified');
Route::get('horarios-estudiante-de-clase', [HorarioEstudianteController::class, 'index'])->name('horariosEstudiante.index')->middleware('verified');

// usuario
Route::get('usuarios-ver', [UsuarioUserController::class, 'index'])->name('usuarios.index')->middleware('verified');
Route::get('usuarios-vista-crear', [UsuarioUserController::class, 'create'])->name('usuarios.create')->middleware('verified');
Route::post('usuarios-insertar', [UsuarioUserController::class, 'store'])->name('usuarios.store')->middleware('verified');
Route::get('usuarios-{id}-vista-editar', [UsuarioUserController::class, 'edit'])->name('usuarios.edit')->middleware('verified');
Route::post('usuarios-actualizar', [UsuarioUserController::class, 'update'])->name('usuarios.update')->middleware('verified');
Route::get('usuarios-{id}-eliminar', [UsuarioUserController::class, 'destroy'])->name('usuarios.destroy')->middleware('verified');

//tipo_usuario
Route::get('tipo-usuarios-ver', [TipoUsuarioController::class, 'index'])->name('tipo_usuarios.index')->middleware('verified');
Route::get('tipo-usuarios-vista-crear', [TipoUsuarioController::class, 'create'])->name('tipo_usuarios.create')->middleware('verified');
Route::get('tipo-usuarios-{id}-vista-editar', [TipoUsuarioController::class, 'edit'])->name('tipo_usuarios.edit')->middleware('verified');
Route::post('tipo-usuarios-insertar', [TipoUsuarioController::class, 'store'])->name('tipo_usuarios.store')->middleware('verified');
Route::post('tipo-usuarios-actualizar', [TipoUsuarioController::class, 'update'])->name('tipo_usuarios.update')->middleware('verified');
Route::get('tipo-usuarios-{id}-eliminar', [TipoUsuarioController::class, 'destroy'])->name('tipo_usuarios.destroy')->middleware('verified');


//semestre
Route::get('semestres-ver', [SemestreController::class, 'index'])->name('semestres.index')->middleware('verified');
Route::get('semestres-vista-crear', [SemestreController::class, 'create'])->name('semestres.create')->middleware('verified');
Route::get('semestres-{id}-vista-editar', [SemestreController::class, 'edit'])->name('semestres.edit')->middleware('verified');
Route::post('semestres-insertar', [SemestreController::class, 'store'])->name('semestres.store')->middleware('verified');
Route::post('semestres-actualizar', [SemestreController::class, 'update'])->name('semestres.update')->middleware('verified');
Route::get('semestres-{id}-eliminar', [SemestreController::class, 'destroy'])->name('semestres.destroy')->middleware('verified');


//seccion
Route::get('seccions-ver', [SeccionController::class, 'index'])->name('seccions.index')->middleware('verified');
Route::get('seccions-vista-crear', [SeccionController::class, 'create'])->name('seccions.create')->middleware('verified');
Route::get('seccions-{id}-vista-editar', [SeccionController::class, 'edit'])->name('seccions.edit')->middleware('verified');
Route::post('seccions-insertar', [SeccionController::class, 'store'])->name('seccions.store')->middleware('verified');
Route::post('seccions-actualizar', [SeccionController::class, 'update'])->name('seccions.update')->middleware('verified');
Route::get('seccions-{id}-eliminar', [SeccionController::class, 'destroy'])->name('seccions.destroy')->middleware('verified');


//estudiante
Route::get('estudiantes-ver', [EstudianteController::class, 'index'])->name('estudiantes.index')->middleware('verified');
Route::get('estudiantes-vista-crear', [EstudianteController::class, 'create'])->name('estudiantes.create')->middleware('verified');
Route::get('estudiantes-{id}-vista-editar', [EstudianteController::class, 'edit'])->name('estudiantes.edit')->middleware('verified');
Route::post('estudiantes-insertar', [EstudianteController::class, 'store'])->name('estudiantes.store')->middleware('verified');
Route::post('estudiantes-actualizar', [EstudianteController::class, 'update'])->name('estudiantes.update')->middleware('verified');
Route::get('estudiantes-{id}-eliminar', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy')->middleware('verified');

// grado
Route::get('grados-ver', [GradoController::class, 'index'])->name('grados.index')->middleware('verified');
Route::get('grados-vista-crear', [GradoController::class, 'create'])->name('grados.create')->middleware('verified');
Route::post('grados-insertar', [GradoController::class, 'store'])->name('grados.store')->middleware('verified');
Route::get('grados-{id}-vista-editar', [GradoController::class, 'edit'])->name('grados.edit')->middleware('verified');
Route::post('grados-actualizar', [GradoController::class, 'update'])->name('grados.update')->middleware('verified');
Route::get('grados-{id}-eliminar', [GradoController::class, 'destroy'])->name('grados.destroy')->middleware('verified');


//docente
Route::get('docentes-ver', [DocenteController::class, 'index'])->name('docentes.index')->middleware('verified');
Route::get('docentes-vista-crear', [DocenteController::class, 'create'])->name('docentes.create')->middleware('verified');
Route::get('docentes-{id}-vista-editar', [DocenteController::class, 'edit'])->name('docentes.edit')->middleware('verified');
Route::post('docentes-insertar', [DocenteController::class, 'store'])->name('docentes.store')->middleware('verified');
Route::post('docentes-actualizar', [DocenteController::class, 'update'])->name('docentes.update')->middleware('verified');
Route::get('docentes-{id}-eliminar', [DocenteController::class, 'destroy'])->name('docentes.destroy')->middleware('verified');


//director
Route::get('directors-ver', [DirectorController::class, 'index'])->name('directors.index')->middleware('verified');
Route::get('directors-vista-crear', [DirectorController::class, 'create'])->name('directors.create')->middleware('verified');
Route::get('directors-{id}-vista-editar', [DirectorController::class, 'edit'])->name('directors.edit')->middleware('verified');
Route::post('directors-insertar', [DirectorController::class, 'store'])->name('directors.store')->middleware('verified');
Route::post('directors-actualizar', [DirectorController::class, 'update'])->name('directors.update')->middleware('verified');
Route::get('directors-{id}-eliminar', [DirectorController::class, 'destroy'])->name('directors.destroy')->middleware('verified');


//curso
Route::get('cursos-ver', [CursoController::class, 'index'])->name('cursos.index')->middleware('verified');
Route::get('cursos-vista-crear', [CursoController::class, 'create'])->name('cursos.create')->middleware('verified');
Route::get('cursos-{id}-vista-editar', [CursoController::class, 'edit'])->name('cursos.edit')->middleware('verified');
Route::post('cursos-insertar', [CursoController::class, 'store'])->name('cursos.store')->middleware('verified');
Route::post('cursos-actualizar', [CursoController::class, 'update'])->name('cursos.update')->middleware('verified');
Route::get('cursos-{id}-eliminar', [CursoController::class, 'destroy'])->name('cursos.destroy')->middleware('verified');


//competencias
Route::get('competencias-ver', [CompetenciaController::class, 'index'])->name('competencias.index')->middleware('verified');
Route::get('competencias-vista-crear', [CompetenciaController::class, 'create'])->name('competencias.create')->middleware('verified');
Route::get('competencias-{id}-vista-editar', [CompetenciaController::class, 'edit'])->name('competencias.edit')->middleware('verified');
Route::post('competencias-insertar', [CompetenciaController::class, 'store'])->name('competencias.store')->middleware('verified');
Route::post('competencias-actualizar', [CompetenciaController::class, 'update'])->name('competencias.update')->middleware('verified');
Route::get('competencias-{id}-eliminar', [CompetenciaController::class, 'destroy'])->name('competencias.destroy')->middleware('verified');


//materias
Route::get('materias-ver', [MateriaController::class, 'index'])->name('materias.index')->middleware('verified');
Route::get('materias-vista-crear', [MateriaController::class, 'create'])->name('materias.create')->middleware('verified');
Route::get('materias-{id}-vista-editar', [MateriaController::class, 'edit'])->name('materias.edit')->middleware('verified');
Route::post('materias-insertar', [MateriaController::class, 'store'])->name('materias.store')->middleware('verified');
Route::post('materias-actualizar', [MateriaController::class, 'update'])->name('materias.update')->middleware('verified');
Route::get('materias-{id}-eliminar', [MateriaController::class, 'destroy'])->name('materias.destroy')->middleware('verified');



// estados
Route::get('cambiar-{id}-estado', [EstadoController::class, 'estado'])->name('estado')->middleware('verified');



//notas
Route::get('notas-ver', [NotaController::class, 'index'])->name('notas.index')->middleware('verified');
Route::get('notas-verNotas-{id}-{grado}-{anio}', [NotaController::class, 'verNotas'])->name('notas.verNotas')->middleware('verified');
Route::get('notas-verNotas-{anio}', [NotaController::class, 'eliminarNotas'])->name('notas.eliminarNotas')->middleware('verified');
//NOTAS POR SEMESTRES
Route::get('notas-semestre-verNotas-{id}-{grado}-{semestre}-{anio}', [NotaController::class, 'verNotasSemestre'])->name('notas.verNotasSemestre')->middleware('verified');
//NOTAS FINALES
Route::get('notas-finales-{id}-{grado}-{anio}', [NotaController::class, 'verNotasFinales'])->name('notas.verNotasFinales')->middleware('verified');


//notas-docente
Route::get('notas-docente-ver', [NotaDocenteController::class, 'index'])->name('notasDocente.index')->middleware('verified');
Route::get('notas-docente-verNotas-{id_curso}-{id_grado}-{anio}', [NotaDocenteController::class, 'verNotas'])->name('notasDocente.verNotas')->middleware('verified');

Route::get('notas-docente-actualizar/{id}/{nota1}/{nota2}/{nota3}/{sem}/{anio}', [NotaDocenteController::class, 'actualizar'])->name('notasDocente.actualizar')->middleware('verified');;
Route::get('notas-docente-actualizar2/{id}/{nota1}/{nota2}/{nota3}/{curso}/{semestre}/{anio}', [NotaDocenteController::class, 'actualizar2'])->name('notasDocente.actualizar2')->middleware('verified');;
//NOTAS POR SEMESTRES
Route::get('verNotas-por-semestre-docente-{id_curso}-{id_grado}-{semestre}-{anio}', [NotaDocenteController::class, 'verNotasPorSemestre'])->name('notasDocente.verNotasPorSemestre')->middleware('verified');
//NOTAS FINALES
Route::get('verNotas-finales-docente-{id_curso}-{id_grado}-{anio}', [NotaDocenteController::class, 'verNotasFinales'])->name('notasDocente.verNotasFinales')->middleware('verified');



//notas-estudiante
Route::get('notas-estudiante-ver-{anio}', [NotaEstudianteController::class, 'index'])->name('notasEstudiante.index')->middleware('verified');
Route::get('notas-estudiante-ingresar-anio', [NotaEstudianteController::class, 'ingresarAnio'])->name('notasEstudiante.ingresarAnio')->middleware('verified');
//Route::get('notas-estudiante-verNotas-{id_curso}-{id_grado}', [NotaDocenteController::class, 'verNotas'])->name('notasEstudiante.verNotas')->middleware('verified');
//NOTAS POR SEMESTRES
Route::get('notas-estudiante-semestre-{semestre}-{anio}', [NotaEstudianteController::class, 'verNotasPorSemestre'])->name('notasEstudiante.verNotasPorSemestre')->middleware('verified');
//NOTAS FINALES
Route::get('notas-estudiante-final-{anio}', [NotaEstudianteController::class, 'verNotasFinales'])->name('notasEstudiante.verNotasFinales')->middleware('verified');
