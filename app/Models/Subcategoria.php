<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableObserver;

class Subcategoria extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'id_categoria',
        'nombre',
        'slug',
    ];

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
        /**
         * Default behaviour -- generate slug before model is saved.
         */
        return SluggableObserver::SAVING;

        /**
         * Optional behaviour -- generate slug after model is saved.
         * This will likely become the new default in the next major release.
         */
        return SluggableObserver::SAVED;
    }

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Subcategoria::class, 'slug', $this->nombre);
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
