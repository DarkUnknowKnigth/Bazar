<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable=['path','producto_id','user_id'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function producto(){
        return $this->belongsTo('App\Foto');
    }
}
