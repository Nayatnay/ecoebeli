<?php

namespace App\Livewire\Tienda;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTienda extends Component
{
    use WithPagination;

    public $sort = 'id';
    public $direc = 'asc';
    public $filtro;

    protected $listeners = ['render'];

    public function order()
    {       
        if ($this->filtro == 0){
            $this->sort = 'id';
            $this->direc = 'asc';
        }
       
        if ($this->filtro == 1){
            $this->sort = 'precio';
            $this->direc = 'asc';
        }
        
        if ($this->filtro == 2){
            $this->sort = 'precio';
            $this->direc = 'desc';
        }        
    }

    public function render()
    {        
        $productos = Producto::orderby($this->sort, $this->direc)->paginate(24, ['*'], 'prodlink');

        return view('livewire.tienda.index-tienda', compact('productos'));
    }
}
