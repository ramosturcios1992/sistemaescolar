<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";
    protected $primaryKey = "id";
    protected $timestamps=false;
    protected $fillable = [
        "nombre",
        "ubicacion",
        "ruc",
        "telefono"
    ];
}
