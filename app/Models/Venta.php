<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'tipo_pago',
        'referencia',
        'banco',
        'fecha',
        'codigo',
        'telf',
        'impuesto',
        'total',
        'estado',
        'reporte',
    ];

    //Relacion uno a muchos

    public function detalleventas()
    {
        return $this->hasMany('App\Models\Detalleventa', 'id_venta');
    }

    //Relacion uno a muchos

    public function reportesc()
    {
        return $this->hasMany('App\Models\Reportesc', 'id_venta');
    }

    //Relacion uno a muchos (inversa)

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
