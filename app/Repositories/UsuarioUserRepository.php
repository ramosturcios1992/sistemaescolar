<?php

namespace App\Repositories;

use App\Models\UsuarioUser;
use App\Repositories\BaseRepository;

/**
 * Class UsuarioUserRepository
 * @package App\Repositories
 * @version November 12, 2020, 1:32 pm -05
*/

class UsuarioUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UsuarioUser::class;
    }
}
