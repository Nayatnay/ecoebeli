<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportesc extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_venta',
        'id_user',
        'mensaje',
        'estado',
    ];

     //Relaciones uno a muchos (inversa)

     public function venta(){
        return $this->belongsTo('App\Models\Venta', 'id_venta');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');
    }

}
