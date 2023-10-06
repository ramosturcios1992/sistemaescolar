<?php

namespace App\Http\Controllers;

use App\Repositories\UsuarioUserRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\UsuarioFormRequest;
use App\models\Usuario;
use App\Models\UsuarioUser;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

class UsuarioUserController extends AppBaseController
{
    /** @var  UsuarioUserRepository */
    private $usuarioUserRepository;

    /**
     * Display a listing of the UsuarioUser.
     *
     * @param Request $request
     *
     * @return Response
     */

    public function index()
    {
        $sql = DB::select('select id,dni,name,apellido,email,telefono,password,usuario.tipo,
        tipo_usuario.tipo as "tipo_usuario",estado
        from usuario inner join tipo_usuario ON usuario.tipo=tipo_usuario.id_tipo_usuario');
        return view('usuario_users/table', compact('sql'));
    }
    public function create()
    {
        $sql = DB::select('select *from tipo_usuario');
        return view('usuario_users/crear', compact('sql'));
    }
    public function store(UsuarioFormRequest $request)
    {
        // $clave1 = $request->clave1;
        // $clave2 = $request->clave2;
        // if ($clave1 != $clave2) {
        //     return back()->with('error-clave', 'Las contraseñas no coinciden');
        // }
        // $claveE = md5($clave1);
        // try {
        //     $sql = DB::insert('insert into usuario(dni,name,apellido,email,password,tipo)values(?,?,?,?,?,?)', [
        //         $request->dni,
        //         $request->nombre,
        //         $request->apellido,
        //         $request->email,
        //         $claveE,
        //         $request->tipo,
        //     ]);
        // } catch (\Throwable $th) {
        //     $sql=0;
        // }
        // if ($sql == 1) {
        //     return back()->with('correcto', 'Usuario registrado exitosamente');
        // } else {
        //     return back()->with('incorrecto', 'Error al registrar');
        // }
    }

    public function edit($id)
    {
        $sql = DB::select('select id,dni,name,apellido,email,password,usuario.tipo,
         tipo_usuario.tipo as "tipo_usuario"
         from usuario inner join tipo_usuario ON usuario.tipo=tipo_usuario.id_tipo_usuario where id=?', [$id]);
        return view('usuario_users/modificar', compact('sql'));
    }

    public function update(ActualizarUsuarioRequest $request)
    {
        // $verificar = DB::select(
        //     'select count(*) as total from usuario where (dni=? or email=?) and id!=?',
        //     [$request->dni, $request->email,$request->id]
        // );
        // foreach ($verificar as $i) {
        //     if ($i->total >= 1) {
        //         return back()->with('duplicado', 'Error, El Dni o Correo ya existe');
        //     }
        // }

        // try {
        //     $sql = DB::update(
        //         'update usuario set dni=?, name=?, apellido=?, email=?, tipo=? where id=?',
        //         [
        //             $request->dni,
        //             $request->nombre,
        //             $request->apellido,
        //             $request->email,
        //             $request->tipo,
        //             $request->id,
        //         ]
        //     );
        //     if ($sql == 0) {
        //         $sql = 1;
        //     }
        // } catch (\Throwable $th) {
        //     $sql = 0;
        // }
        // if ($sql == 1) {
        //     return back()->with('correcto', 'Usuario modificado exitosamente');
        // } else {
        //     return back()->with('incorrecto', 'Error al modificar');
        // }
    }

    public function destroy($id)
    {
        // try {
        //     $sql = DB::delete('delete from usuario where id = ?', [$id]);
        // } catch (\Throwable $th) {
        //     $sql=0;
        // }
        // if ($sql == 1) {
        //     return back()->with('correcto', 'Usuario Eliminado Exitosamente');
        // } else {
        //     return back()->with('incorrecto', 'Error al eliminar');
        // }
    }







    /*public function index(){

    }
    public function create(){

    }
    public function show(){

    }
    public function edit(){

    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){

    }*/
}
