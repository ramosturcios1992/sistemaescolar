<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'dni',
        'name',
        'apellido',
        'email',
        'password',
        'tipo',
        'telefono',
        'grado',
        'direccion',
        'estado',
        'foto',
        
    ];
}
