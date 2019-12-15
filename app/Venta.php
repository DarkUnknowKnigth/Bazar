<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable=[
        'fecha',
        'precioVenta',
        'producto_id',
        'vendedor_id',
        'comprador_id',
        'cantidad'
    ];
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
    public function comprador(){
        return $this->belongsTo('App\User','comprador_id','id');
    }
    public function vendedor(){
        return $this->belongsTo('App\User','vendedor_id','id');

    }
    public function pagos(){
        return $this->belongsToMany('App\Pago','pago_venta','venta_id','pago_id');
    }
}
