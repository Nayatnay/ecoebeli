<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableObserver;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Categoria extends Model
{
    use HasFactory;
    //use Sluggable;
    //use SluggableScopeHelpers;


    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'imagen',
    ];

    /*
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombre',
                //'separator' => '_', //En caso de querer usar un separador distinto al predeterminado "-"
            ],
        ];
    }

    public function sluggableEvent(): string
    {
        
         * Default behaviour -- generate slug before model is saved.
        
        return SluggableObserver::SAVING;

         * Optional behaviour -- generate slug after model is saved.
         * This will likely become the new default in the next major release.
      
        return SluggableObserver::SAVED;
    }

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Categoria::class, 'slug', $this->nombre);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    */

    //Relaciones uno a muchos

    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'id_categoria');
    }

    public function subcategorias()
    {
        return $this->hasMany('App\Models\Subcategoria', 'id_categoria');
    }

    //Control de atributos

    public function nombre(): Attribute
    {
        return new Attribute(
            $get = fn ($value) => ucfirst($value),
            $set = fn ($value) => strtolower($value)
        );
    }
}
