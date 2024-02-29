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
    public $filtro, $id_subcategoria, $marca, $color, $talla, $precio, $value, $value2;

    public array $filters = array();

    protected $listeners = ['render'];

    public array $filtersToMerge = [
        'id_subcategoria' => [],
        'marca' => [],
        'color' => [],
        'talla' => [],
        'precio' => [],
    ];

public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->filters['id_subcategoria'] = "";
        $this->filters['marca'] = "";
        $this->filters['color'] = "";
        $this->filters['talla'] = "";
        $this->filters['precio'] = "";
    }

    public function clearan()
    {
        $this->filters['precio'] = "";
    }

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

        if ($this->filters['precio'] == 25) {
            $this->value = 0;
            $this->value2 = $this->filters['precio'];
        }
        if ($this->filters['precio'] == 50) {
            $this->value = 25;
            $this->value2 = $this->filters['precio'];
        }
        if ($this->filters['precio'] == 100) {
            $this->value = 50;
            $this->value2 = $this->filters['precio'];
        }
        if ($this->filters['precio'] == 200) {
            $this->value = 100;
            $this->value2 = $this->filters['precio'];
        }
        if ($this->filters['precio'] == 201) {
            $this->value = $this->filters['precio'];
            $this->value2 = 100000;
        }
        

        $subcateg = Subcategoria::orderby('nombre')->get();
        $marcas = Producto::select('marca')->distinct()->get(); //selecciona un solo registro por marca
        $colores = Producto::select('color')->distinct()->get(); //selecciona un solo registro por marca
        $tallas = Producto::select('talla')->distinct()->where('talla', '<>', "")->get(); //selecciona un solo registro por marca

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

            ->when($this->filters['precio'], function ($query) {
                return $query->where('precio', '>=', $this->value)->where('precio', '<=', $this->value2);
            })

            ->orderby($this->sort, $this->direc)->paginate(12, ['*'], 'prodlink');

        return view('livewire.tienda.index-tienda', compact('productos', 'subcateg', 'marcas', 'colores', 'tallas'));
    }
}
