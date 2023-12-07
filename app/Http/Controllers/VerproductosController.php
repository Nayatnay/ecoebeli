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

    public function index(Request $request, $buscar)
    {
        $buscar = $request->buscar;

        $categ = Categoria::all()->sortBy('nombre');

        $producto_buscado = Categoria::where('nombre', '=', $buscar)
            ->orwhere('descripcion', '=', $buscar)->first();

        if ($producto_buscado == null) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');
        } else {
            $productos = Producto::where('id_categoria', '=', $producto_buscado->id)
                ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');
        }

        return view('verproductos', compact('productos', 'categ', 'buscar'));
    }
}
