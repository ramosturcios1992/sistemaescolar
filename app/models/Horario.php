<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "events";
    protected $primaryKey = "id";
    protected $timestamps = false;
    protected $fillable = [
        "title",
        "color",
        "start",
        "end",
        "codigo"
    ];
}
