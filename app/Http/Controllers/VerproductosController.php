<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Str;

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

    public function index($buscar)
    {
        $titulo = str_replace("-", " ", $buscar);
    //dd($titulo);
        $categ = Categoria::all()->sortBy('nombre');
        $productos = producto::where('nombre', 'LIKE', '%' . $titulo . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $titulo . '%')
            ->orderBy('nombre')->paginate(6, ['*'], 'prodlink');

        if ($productos == null) {
            $conteo_productos = 0;
        } else {

            $conteo_productos = count(producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->get());
        }

        //$buscar = Str::slug($buscar, '-');
        return view('verproductos', compact('productos', 'categ', 'buscar', 'conteo_productos', 'titulo'));
    }
    
    /*
    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Categoria::class, 'slug', $this->cati);
    }
    */
}
