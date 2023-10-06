<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table='seccion';
    protected $primaryKey='id_seccion';
    protected $timestamps=false;
    protected $fillable=[
        'seccion',
    ];
}
