<?php

namespace App\Livewire\Cabecera;

use App\Models\categoria;
use Illuminate\Http\Request;
use Livewire\Component;

class NavCabeza extends Component
{
    public $buscar;

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render(Request $request)
    {
        $buscar = $request->buscar;

        $categ = categoria::all()->sortBy('nombre');
        $categorias = categoria::all()->sortBy('nombre');

        return view('livewire.cabecera.nav-cabeza', compact('categ', 'buscar', 'categorias'));
    }
}
