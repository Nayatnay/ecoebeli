<?php

namespace App\Livewire\Carrito;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Livewire\Component;

class IndexCarrito extends Component
{
    public function render(Request $request)
    {
        $buscar = $request->buscar;

        $categ = Categoria::all()->sortBy('nombre');
        $productos = Producto::orderBy('nombre')->paginate(6);
        
        
        return view('livewire.carrito.index-carrito', compact('categ', 'productos', 'buscar'));
    }
}
