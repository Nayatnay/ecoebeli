<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\WithPagination;

class BuscarController extends Controller
{
    use WithPagination;

    protected $listeners = ['render'];

    public function index(request $request)
    {
        $buscar = $request->buscar;
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::all()->sortBy('nombre');

        if ($buscar == "Todas las Categorías") {
            return redirect()->Route('/');
        } else {
            if ($buscar <> null) {
                return redirect()->Route('verproductos', compact('buscar'));
            }
        }

        return view('buscar', compact('categorias', 'categ', 'buscar'));
    }
}
