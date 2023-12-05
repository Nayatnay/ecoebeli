<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\WithPagination;


class EbeliController extends Controller
{
    use WithPagination;

    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::all()->sortBy('nombre');

        if ($buscar <> null) {
            return redirect()->route('verproductos', compact('buscar'));
        }

        return view('ebeli', compact('categ', 'buscar', 'categorias'));     
    }
}