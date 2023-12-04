<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $categ = Categoria::all()->sortBy('nombre');
        $productos = Producto::orderBy('nombre')->paginate(6);
        $categorias = Categoria::orderBy('nombre')->paginate(6);

        return view('carro', compact('productos', 'categorias', 'categ', 'buscar'));
    }
}
