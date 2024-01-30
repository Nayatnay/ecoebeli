<?php

namespace App\Livewire\Medios;

use App\Models\Medio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class AgregarTc extends Component
{
    public $open = false;
    public $id_user, $codigo, $nombre, $vencimiento, $cvc, $mes, $ano;

    protected $listeners = ['render'];

    protected $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'vencimiento' => 'required',
        'cvc' => 'required',
    ];

    public function save()
    {        
        if ($this->mes == null || $this->ano == null) {
            $this->mes = '01';
            $this->ano = '2024';
        }
        
        $this->vencimiento = str_pad($this->mes, 2, '0', STR_PAD_LEFT) . '/' . $this->ano;
        
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