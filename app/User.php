<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const USUARIO_ADMINISTRADOR = 'ADMIN';

    const USUARIO_CORRIENTE = 'USUARIO';

    const USUARIO_VERIFICADO = '1';

    protected $fillable = [
        'id', 'nombres','apellidos','sexo','direccion','telefono','email', 'password',
        'token','active','rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','token',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function orden()
    {
        return $this->hasMany('App\Orden');
    }

    public static function generarVerificationToken()
    {
        return str_random(40);    
    }

    public function esAdministrador()
    {
        return strtoupper($this->rol->nombre) == User::USUARIO_ADMINISTRADOR;   
    }

    public function esVerificado()
    {
        return $this->active == User::USUARIO_VERIFICADO;
    }
}
