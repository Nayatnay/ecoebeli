<?php

namespace App\Livewire\Ventas;

use App\Models\Detalleventa;
use App\Models\User;
use App\Models\Venta;
use Livewire\Component;

class IndexVentas extends Component
{
    public $ventas;

    protected $listeners = ['render'];

    public function mount(Venta $ventas)
    {
        $this->ventas = $ventas;
    }
    public function render()
    {
        $venta = Venta::where('id', '=', $this->ventas->id)->first();
        $detalles = Detalleventa::where('id_venta', '=', $this->ventas->id)->get();
        $cliente = User::where('id', '=', $this->ventas->id_user)->first();

        return view('livewire.ventas.index-ventas', compact('venta', 'detalles', 'cliente'));
    }
}
