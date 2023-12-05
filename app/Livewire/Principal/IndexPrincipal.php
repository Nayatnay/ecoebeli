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
            dd('listo');
            //return redirect()->route('verproductos', compact('buscar'));
        }
        
        return view('livewire.principal.index-principal', compact('categorias', 'categ', 'buscar'));


        /*$buscar = $request->buscar;

        if ($buscar == "Todas las Categorías") {
            $buscar = "";
        }

        $categ = Categoria::all()->sortBy('nombre');

        $categorias = Categoria::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->get()->sortBydesc('id');

        $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->get()->sortBydesc('id');
       */
        
    }
}
