<?php

namespace App\Livewire\Tasa;

use App\Models\Tasa;
use Livewire\Component;

class CrearTasa extends Component
{
    public $tasa, $valtasa;
    public $open = false;

    protected $listeners = ['render'];

    protected $rules = [
        'valtasa' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Tasa::create([
            'valtasa' => $this->valtasa,
        ]);

        $this->reset(['open', 'valtasa']);
        return redirect()->route('tasa');
    }

    public function cancelar(){
        $this->reset(['open', 'valtasa']); 
    }

    public function render()
    {
        return view('livewire.tasa.crear-tasa');
    }
}
