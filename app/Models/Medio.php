<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'codigo',
        'nombre',
        'vencimiento',
        'cvc',
    ];

    //Relacion uno a muchos (inversa)

    public function user()
    {
        return $this->belongsTo('App\Models\user', 'id_user');
    }
}
