<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class EbeliController extends Controller
{
    use WithPagination;

    protected $listeners = ['render'];

    public function index(request $request)
    {
        $buscar = $request->buscar;
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::all()->sortBy('nombre');

        if ($buscar == "Todas las Categorías") {
            return redirect()->Route('/', compact('buscar'));
        } else {
            if ($buscar <> null) {
                //$this->redirectRoute('verproductos', ['buscar' => $buscar]); con livewire
                return redirect()->Route('verproductos', compact('buscar'));
            }
        }

        return view('ebeli', compact('categ', 'buscar', 'categorias'));
    }
}
