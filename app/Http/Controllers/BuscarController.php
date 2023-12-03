<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class BuscarController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        if ($buscar == "Todas las Categorías") {
            $buscar = "";
        }

        $categ = Categoria::all();

        $categorias = Categoria::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->get()->sortBy('nombre');

        $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->get()->sortBy('nombre');

        return view('buscar', compact('categorias', 'productos', 'categ', 'buscar'));
    }
}
