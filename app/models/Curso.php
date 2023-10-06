<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'id_curso';
    protected $timestamps = false;
    protected $fillable=[
        'nombre',
        'docente',
        'id_grado'       
    ];
}
