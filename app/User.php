<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password','apellidoPaterno','apellidoMaterno','sexo','rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function fotos(){
        return $this->hasMany('App\Foto');
    }
    public function productos(){
        return $this->hasMany('App\Producto');
    }
    public function ventas(){
        return $this->hasMany('App\Venta','vendedor_id','id');
    }
    public function compras(){
        return $this->hasMany('App\Venta','comprador_id','id');
    }
    public function fullname(){
        return $this->nombre.' '.$this->apellidoPaterno.' '.$this->apellidoMaterno;
    }
    public function rol(){
        return $this->belongsTo('App\Rol');
    }
}
