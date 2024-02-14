<?php

namespace App\Livewire\Tienda;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use EloquentFilter\Filterable;

class IndexTienda extends Component
{
    use WithPagination;
    use Filterable;

    public $sort = 'id';
    public $direc = 'asc';
    public $filtro, $id_subcategoria, $marca, $color, $talla;

    public array $filters = array();

    protected $listeners = ['render'];
    
    public array $filtersToMerge = [
        'id_subcategoria' => [],
        'marca' => [],
        'color' => [],
        'talla' => [],
    ];

    public function mount()
    {
        $this->filters = array_merge($this->filtersToMerge, $this->filters);
    }

    public function order()
    {
        if ($this->filtro == 0) {
            $this->sort = 'id';
            $this->direc = 'asc';
        }

        if ($this->filtro == 1) {
            $this->sort = 'precio';
            $this->direc = 'asc';
        }

        if ($this->filtro == 2) {
            $this->sort = 'precio';
            $this->direc = 'desc';
        }
    }

    public function render()
    {

        $subcateg = Subcategoria::orderby('nombre')->get();
        $marcas= Producto::select('marca')->distinct()->get(); //selecciona un solo registro por marca
        $colores= Producto::select('color')->distinct()->get(); //selecciona un solo registro por marca
        $tallas= Producto::select('talla')->distinct()->where('talla', '<>', "")->get(); //selecciona un solo registro por marca
        
        $productos = Producto::query()
            ->when($this->filters['id_subcategoria'], function ($query) {
                return $query->where('id_subcategoria', '=', $this->filters['id_subcategoria']);
            })
            
            ->when($this->filters['marca'], function ($query) {
                return $query->where('marca', '=', $this->filters['marca']);
            })

            ->when($this->filters['color'], function ($query) {
                return $query->where('color', '=', $this->filters['color']);
            })

            ->when($this->filters['talla'], function ($query) {
                return $query->where('talla', '=', $this->filters['talla']);
            })

            ->orderby($this->sort, $this->direc)->paginate(24, ['*'], 'prodlink');

        return view('livewire.tienda.index-tienda', compact('productos', 'subcateg', 'marcas', 'colores', 'tallas' ));

    }
}
