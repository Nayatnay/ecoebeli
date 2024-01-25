<?php

namespace App\Livewire\Medios;

use Livewire\Component;

class MediosdePago extends Component
{
    public $open = false;
    
    public function render()
    {
        return view('livewire.medios.mediosde-pago');
    }
}
