<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable=[
        'fecha',
        'monto',
        'entregado'
    ];
    public function vantas(){
        return $this->belongsToMany('App\Venta','pago_venta','pago_id','venta_id');
    }
}
