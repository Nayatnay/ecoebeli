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
        
        if ($request->categoria == null && $buscar == "Todas las Categorías") {
            $categitem = 1;
            $buscar = null;
            $categorias = Categoria::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->orderBy('nombre')->get();

            return view('ebeli', compact('categorias', 'categ', 'buscar', 'categitem'));
           
        } 
        if ($request->categoria == null && $buscar <> "Todas las Categorías") {
            $categitem = 0;
            $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                ->orderBy('nombre')->paginate(5, ['*'], 'prodlink');
                
            return view('ebeli', compact('productos', 'categ', 'buscar', 'categitem'));
        }

        if ($request->categoria <> null) {
        
            $categitem = 0;
            $productos = Producto::where('id_categoria', '=', $request->categoria)
            ->orwhere('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->orderBy('nombre')->paginate(5, ['*'], 'prodlink');
            
            return view('ebeli', compact('productos', 'categ', 'buscar', 'categitem'));
        }
    }
}
