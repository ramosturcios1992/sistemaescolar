<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SemestreModel extends Model
{
    protected $table='semestre';
    protected $primaryKey='id_semestre';
    protected $timestamps=false;
    protected $fillable=[
        'semestre',
        'año'
    ];
}
