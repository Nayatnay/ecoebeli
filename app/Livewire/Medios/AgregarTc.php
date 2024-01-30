<?php

namespace App\Livewire\Medios;

use App\Models\Medio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarTc extends Component
{
    public $open = false;
    public $id_user, $codigo, $nombre, $vencimiento, $cvc;

    protected $listeners = ['render'];

    protected $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'vencimiento' => 'required',
        'cvc' => 'required',
    ];

    public function save()
    {
        dd($this->vencimiento);
        
        if($this->vencimiento == null){
            $this->vencimiento = '01/2024';
        }

        $this->validate();

        $codigo = $this->codigo;
        $nombre = $this->nombre;
        $vencimiento = $this->vencimiento;
        $cvc = $this->cvc;

        Medio::create([
            'id_user' => Auth::user()->id,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'vencimiento' => $vencimiento,
            'cvc' => $cvc,
        ]);

        $this->reset(['open', 'codigo', 'nombre', 'vencimiento', 'cvc']);
        
        return redirect()->route('compra');
    }


    public function cancelar()
    {
        $this->reset(['open', 'codigo', 'nombre', 'vencimiento', 'cvc']);
    }

    public function render()
    {
        return view('livewire.medios.agregar-tc');
    }
}
