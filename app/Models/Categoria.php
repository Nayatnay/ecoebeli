<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    //Relaciones uno a muchos

    public function subcategorias()
    {
        return $this->hasMany('App\Models\Subcategoria', 'id_categoria');
    }

    /*public function getRouteKeyName()
    {
        return 'slug';
        
    }
*/
    public function nombre(): Attribute
    {
        return new Attribute(
            $get = fn ($value) => ucfirst($value),
            $set = fn ($value) => strtolower($value)
        );
    }
}
