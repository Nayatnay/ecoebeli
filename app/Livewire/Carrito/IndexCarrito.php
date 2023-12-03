<?php

namespace App\Livewire\Carrito;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class IndexCarrito extends Component
{
    public function render()
    {
        $categorias = Categoria::all()->sortByDesc('id');

        $productos = Producto::all()->sortByDesc('id');
        
        return view('livewire.carrito.index-carrito', compact('categorias', 'productos'));
    }
}
