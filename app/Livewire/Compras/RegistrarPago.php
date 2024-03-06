<?php

namespace App\Livewire\Compras;

use App\Models\Detalleventa;
use App\Models\Producto;
use App\Models\Tasa;
use App\Models\Venta;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class RegistrarPago extends Component
{
    public $open = false;
    public $tipo_pago, $referencia, $banco, $codigo, $telf, $fecha, $total, $tasa;

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

    public function mount(Tasa $tasa)
    {
        $bolivar = 0;
        $tasa = tasa::orderBy('id', 'desc')->first();
        if ($tasa <> null) {
            $bolivar = CartFacade::getsubtotal() * $tasa->valtasa;
        }

        $this->fecha = date('Y-m-d');
        $this->total = number_format($bolivar, 2, '.', '');
    }

    public function pagar()
    {
        if ($this->tipo_pago == 0) {
            $this->codigo = 0;
            $this->telf = 0;
        }
        if ($this->tipo_pago == 1) {
            if ($this->codigo == 0 || $this->telf == 0) {
                $this->codigo = null;
                $this->telf = null;
            }
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
            'reporte' => 0,
        ]);

        $venta = Venta::orderBy('id', 'desc')->first();

        foreach (CartFacade::getContent() as $item) {
            Detalleventa::create([
                'id_venta' => $venta->id,
                'id_producto' => $item->id,
                'cantidad' => $item->quantity,
                'precio' => $item->price,
                'descuento' => 0,
            ]);

            //Actualizar el stock del producto vendido
            $stockproducto = Producto::where('id', '=', $item->id)->first();
            $stockproducto->stock = $stockproducto->stock - $item->quantity;
            $stockproducto->update();
        }

        CartFacade::clear();

        $this->reset(['open', 'tipo_pago', 'referencia', 'banco', 'codigo', 'telf']);

        return redirect()->route('admincom')->with('info', 'ok');;
    }

    public function cancelar()
    {
        $this->reset(['open', 'tipo_pago', 'referencia', 'banco', 'codigo', 'telf']);
    }

    public function render()
    {
        return view('livewire.compras.registrar-pago');
    }
}
