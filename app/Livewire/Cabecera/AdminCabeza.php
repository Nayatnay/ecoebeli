<?php

namespace App\Livewire\Cabecera;

use App\Models\Reportesc;
use App\Models\Venta;
use Livewire\Component;

class AdminCabeza extends Component
{
    public function render()
    {
        $reclamos = count(Reportesc::where('estado', '=', 1)->get());
        $concilia = count(Venta::where('estado', '=', 0)->get());

        return view('livewire.cabecera.admin-cabeza', compact('reclamos', 'concilia'));
    }
}
