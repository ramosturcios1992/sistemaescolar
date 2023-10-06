<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'id_tipo_usuario';
    protected $timestamps = false;

    protected $fillable=[
        'tipo'
    ];

}
