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

        $prodssimil = Producto::where('id', '<>', $producto->id)
        ->where('id_subcategoria', '=', $producto->id_subcategoria)
            ->orderBy('nombre')->paginate(6, ['*'], 'prosimilar');

        return view('detalproducto', compact('producto', 'categ', 'buscar', 'prodssimil'));
    }
}
