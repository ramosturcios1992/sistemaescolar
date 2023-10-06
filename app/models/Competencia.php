<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $table = 'competencia';
    protected $primaryKey = 'id_competencia';
    protected $timestamps = false;
    protected $fillable=[
        'competencia',
        'curso',
        'año'       
    ];
}
