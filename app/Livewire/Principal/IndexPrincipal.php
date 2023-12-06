<?php

namespace App\Livewire\Principal;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Producto;

class IndexPrincipal extends Component
{
    public function render(request $request)
    {
        $buscar = $request->buscar;
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::all()->sortBy('nombre');

        if ($buscar <> null) {
            //return redirect()->route('verproductos', compact('buscar'));
        }
        
        return view('livewire.principal.index-principal', compact('categorias', 'categ', 'buscar'));
        
    }
}
