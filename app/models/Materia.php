<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materia';
    protected $primaryKey = 'id_materia';
    protected $timestamps = false;
    protected $fillable=[
        'nombre'            
    ];
}
