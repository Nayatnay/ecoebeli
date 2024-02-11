<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalproductosController extends Controller
{
    public $resultado;

    public function index(Producto $producto)
    {

        $buscar = $producto->id;

        $categ = Categoria::all()->sortBy('nombre');

        $producto = Producto::where('id', '=', $buscar)->first();

        $pruebas = [$producto->nombre];

        foreach ($pruebas as $texto) {
            if (preg_match('/^\W*(?:\w+\W+){0}(?:de\W+)?\w+/iu', $texto, $match)) {
                $resultado =  $match[0];
            }
        }

        $this->resultado = $match[0];
        $prodssimil = Producto::where('id', '<>', $producto->id)
            ->Where(function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->resultado . '%')
                    ->orwhere('descripcion', 'LIKE', '%' . $this->resultado . '%');
            })->orderBy('nombre')->paginate(6, ['*'], 'prosimilar');
     
        return view('detalproducto', compact('producto', 'categ', 'buscar', 'prodssimil'));
    }
}
