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
        if ($buscar == "Todas las Categorías") {
            $buscar = null;
        }
       
        $categ = Categoria::all()->sortBy('nombre');
        $producto_buscado = Categoria::where('nombre', '=', $buscar)
            ->orwhere('descripcion', '=', $buscar)->first();

        if ($producto_buscado == null) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');
        }else{
            $productos = Producto::where('id_categoria', '=', $producto_buscado->id)
            ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');
        }
        
        return view('livewire.carrito.index-carrito', compact('categ', 'productos', 'buscar'));
    }
}
