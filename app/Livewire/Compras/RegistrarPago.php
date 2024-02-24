<?php

namespace App\Livewire\Compras;

use Livewire\Component;

class RegistrarPago extends Component
{
    public $open = false;
    public $tipo_pago, $referencia, $banco, $codigo, $telf, $fecha, $total;

    protected $listeners = ['render'];

    protected $rules = [
        'tipo_pago' => 'required',
        'referencia' => 'required',
        'banco' => 'required',
        'fecha' => 'required',
        'codigo' => 'required',
        'telf' => 'required',
        
        'total' => 'required',
        
    ];

    public function pagar()
    {
        if ($this->tipo_pago == 0) {
            $this->codigo = 0;
            $this->telf = 0;
        }
        
        dd($this->codigo);
    }

    public function cancelar()
    {
        $this->reset(['open', 'referencia']);
    }

    public function render()
    {
        return view('livewire.compras.registrar-pago');
    }
}
