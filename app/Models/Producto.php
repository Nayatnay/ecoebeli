<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = [        
        'codigo',
        'id_categoria',
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'stock',  
    ];

    //Relacion uno a muchos (inversa)

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'id_categoria');
    }
}
