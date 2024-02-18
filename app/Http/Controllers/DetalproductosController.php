<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DetalproductosController extends Controller
{
    public $slug;

    protected $listeners = ['render'];

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index($buscar)
    {             
        $categ = Categoria::all()->sortBy('nombre');

        $producto = Producto::where('slug', '=', $buscar)->first();
 
        $prodssimil = Producto::where('id', '<>', $producto->id)
            ->where('id_subcategoria', '=', $producto->id_subcategoria)
            ->orderBy('nombre')->paginate(6, ['*'], 'prosimilar');

        //$buscar = $producto->slug;
        return view('detalproducto', compact('producto', 'categ', 'buscar', 'prodssimil'));
    }
}
