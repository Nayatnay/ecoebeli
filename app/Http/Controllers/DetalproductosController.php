<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalproductosController extends Controller
{
    public function index(Producto $producto)
    {
        $buscar = $producto->id;

        $categ = Categoria::all()->sortBy('nombre');
        
        $producto = Producto::where('id', '=', $buscar)->first();

        return view('detalproducto', compact('producto', 'categ', 'buscar'));
    }
}
