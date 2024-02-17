<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Producto extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [   
        'id_categoria',
        'id_subcategoria',
        'codigo',
        'nombre',
        'slug',
        'marca',
        'color',
        'talla',
        'descripcion',
        'imagen',
        'precio',
        'stock',  
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombre',
                //'separator' => '_', En caso de querer usar un separador distinto al predeterminado "-"
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


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
