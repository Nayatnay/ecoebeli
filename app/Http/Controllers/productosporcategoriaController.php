<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithPagination;

class productosporcategoriaController extends Controller
{
    use WithPagination;

    public $slug, $cati;

    protected $listeners = ['render'];

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index($buscar)
    {
        
        $categ = Categoria::all()->sortBy('nombre');
        $categoria_buscada = Categoria::where('slug', '=', $buscar)->first();

        $conteo_productos = 0;
        $buscar = $categoria_buscada->nombre;

        $productos = Producto::where('id_categoria', '=', $categoria_buscada->id)
            ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');

        $conteo_productos = count(Producto::where('id_categoria', '=', $categoria_buscada->id)->get());

        return view('productosporcategoria', compact('productos', 'categ', 'buscar', 'conteo_productos'));
    }

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Categoria::class, 'slug', $this->cati);
    }
}
