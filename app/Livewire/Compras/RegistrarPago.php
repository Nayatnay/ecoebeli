<?php

namespace App\Livewire\Compras;

use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
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
        
        $this->validate();

        Venta::create([
            'id_user' => Auth::user()->id,
            'tipo_pago' => $this->tipo_pago,
            'referencia' => $this->referencia,
            'banco' => $this->banco,
            'fecha' => $this->fecha,
            'codigo' => $this->codigo,
            'telf' => $this->telf,
            'total' => $this->total,
            'impuesto' => 0,
            'estado' => 0,
        ]);

        $this->reset(['open', 'tipo_pago', 'referencia', 'banco', 'fecha', 'codigo', 'telf', 'total']);
        
        return redirect()->route('admincom');
        
    }

    public function cancelar()
    {
        $this->reset(['open', 'tipo_pago', 'referencia', 'banco', 'fecha', 'codigo', 'telf', 'total']);
    }

    public function render()
    {
        return view('livewire.compras.registrar-pago');
    }
}
