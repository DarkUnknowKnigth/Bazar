<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'caracteristicas',
        'disponibles',
        'precioPropuesto',
        'precioVendido',
        'consignado',
        'user_id',
        'area_id'
    ];
    public function fotos(){
        return $this->hasMany('App\Foto');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function ventas(){
        return $this->hasMany('App\Venta');
    }
    public function area(){
        return $this->belongsTo('App\Area');
    }
}
