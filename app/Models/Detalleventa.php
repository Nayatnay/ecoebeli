<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventa extends Model
{
    use HasFactory;

    //Relacion uno a muchos (inversa)

    public function venta(){
        return $this->belongsTo('App\Models\Venta', 'id_venta');
    }
}
