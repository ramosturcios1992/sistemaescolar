<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $estado = Auth::user()->estado;
        if ($estado == 1) {
            $sql = DB::select('select count(*) as total from usuario where tipo=1');
            $sql2 = DB::select('select count(*) as total from usuario where tipo=2');
            $sql3 = DB::select('select count(*) as total from usuario where tipo=3');
            $sql4 = DB::select('select count(*) as total from usuario');
            $sql5 = DB::select('select count(*) as total from materia');
            $sql6 = DB::select('select avg(promedio) as promedio from nota');
            $sql7 = DB::select('select max(promedio) as promedio from nota');
            $sql8 = DB::select('select min(promedio) as promedio from nota');
            $sql9 = DB::select('select count(*) as total from seccion');
            $sql10 = DB::select('select count(*) as total from grado');
            //$datos = DB::select('select *from institucion');
            return view('home')
                ->with('sql', $sql)
                ->with('sql2', $sql2)
                ->with('sql3', $sql3)
                ->with('sql4', $sql4)
                ->with('sql5', $sql5)
                ->with('sql6', $sql6)
                ->with('sql7', $sql7)
                ->with('sql8', $sql8)
                ->with('sql9', $sql9)
                ->with('sql10', $sql10);
                //->with('datos', $datos);
        } else {
            session()->invalidate();
            session()->regenerateToken();
            return back()->with('mensaje', 'USUARIO SUSPENDIDO, consulte con el Administrador');
        }
    }
}
