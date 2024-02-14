<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = [   
        'id_categoria',
        'id_subcategoria',
        'codigo',
        'nombre',
        'marca',
        'color',
        'talla',
        'descripcion',
        'imagen',
        'precio',
        'stock',  
    ];

    //Relacion uno a muchos (inversa)

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'id_categoria');
    }

    public function nombre(): Attribute
    {
        return new Attribute(
            $get = fn ($value) => ucfirst($value),
            $set = fn ($value) => strtolower($value)
        );
    }
}
