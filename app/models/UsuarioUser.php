<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UsuarioUser
 * @package App\Models
 * @version November 12, 2020, 1:32 pm -05
 *
 * @property \App\Models\TipoUsuario $tipo
 * @property string $dni
 * @property string $name
 * @property string $apellido
 * @property string $email
 * @property string $password
 * @property integer $tipo
 * @property string $remember_token
 * @property string|\Carbon\Carbon $email_verified_at
 */
class UsuarioUser extends Model
{
    //use SoftDeletes;

    public $table = 'usuario';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'dni',
        'name',
        'apellido',
        'email',
        'password',
        'tipo',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'string',
        'name' => 'string',
        'apellido' => 'string',
        'email' => 'string',
        'password' => 'string',
        'tipo' => 'integer',
        'remember_token' => 'string',
        'email_verified_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'apellido' => 'nullable|string|max:255',
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'tipo' => 'nullable|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\TipoUsuario::class, 'tipo');
    }
}
