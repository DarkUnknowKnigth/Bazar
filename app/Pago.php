<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable=[
        'fecha',
        'monto',
        'entregado',
        'user_id'
    ];
    public function ventas(){
        return $this->belongsToMany('App\Venta','pago_venta','pago_id','venta_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
