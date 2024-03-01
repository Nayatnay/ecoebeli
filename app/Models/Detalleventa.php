<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio',
        'descuento',
    ];

    //Relaciones uno a muchos (inversa)

    public function venta(){
        return $this->belongsTo('App\Models\Venta', 'id_venta');
    }

    public function producto(){
        return $this->belongsTo('App\Models\Producto', 'id_producto');
    }
}
