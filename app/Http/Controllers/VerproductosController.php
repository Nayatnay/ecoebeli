<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class VerproductosController extends Controller
{
    use WithPagination;

    protected $listeners = ['render'];

    public function vertienda(Request $request)
    {
        $buscar = $request->buscar;

        $categ = Categoria::all()->sortBy('nombre');
        
        $productos = Producto::orderBy('nombre')->paginate(24, ['*'], 'prodlink');

        return view('tienda', compact('productos', 'categ', 'buscar'));
    }

    public function index(Request $request, $buscar)
    {
        
        $buscar = $request->buscar;

        $categ = Categoria::all()->sortBy('nombre');
        
        $producto_buscado = Categoria::where('nombre', '=', $buscar)
            ->orwhere('descripcion', '=', $buscar)->first();

        $conteo_productos = 0;

        if ($producto_buscado == null) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');

            $conteo_productos = count(Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->get());
        } else {
            $productos = Producto::where('id_categoria', '=', $producto_buscado->id)
                ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');

            $conteo_productos = count(Producto::where('id_categoria', '=', $producto_buscado->id)->get());
        }

        return view('verproductos', compact('productos', 'categ', 'buscar', 'conteo_productos'));
    }
}
