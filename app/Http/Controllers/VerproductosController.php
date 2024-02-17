<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class VerproductosController extends Controller
{
    use WithPagination;

    public $sort = 'id';
    public $direc = 'desc';
    public $slug, $cati;

    protected $listeners = ['render'];

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index(Request $request, $buscar)
    {

        $buscar = $request->buscar;
        
        $categ = Categoria::all()->sortBy('nombre');
        $producto_buscado = Categoria::where('slug', '=', $buscar)
            ->orwhere('descripcion', '=', $buscar)->first();
            
        $buscar =$producto_buscado->nombre;
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

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Categoria::class, 'slug', $this->cati);
    }
}
