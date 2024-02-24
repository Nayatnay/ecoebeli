<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class BuscarController extends Controller
{
    use WithPagination;

    protected $listeners = ['render'];

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index(request $request)
    {
        $buscar = Str::slug($request->buscar);
        
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::all()->sortBy('nombre');

        if ($request->buscar == "Todas las Categorías") {
            return redirect()->Route('/');
        } else {
            if ($request->buscar <> null) {
                return redirect()->Route('verproductos', compact('buscar'));
            } else {
                return view('buscar', compact('categorias', 'categ', 'buscar'));
            }
        }
    }
}
