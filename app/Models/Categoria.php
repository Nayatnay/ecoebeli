<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
    ];

    //Relaciones uno a muchos

    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'id_categoria');
    }
}
