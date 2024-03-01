<?php

namespace App\Livewire\Conciliaciones;

use App\Models\Venta;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class IndexConciliacion extends Component
{
    public $open = false;
    public $open_totales = false;
    public $ventas, $fecha, $totales, $fechita, $mes, $ano;

    protected $listeners = ['render'];

    public function alerta(Venta $ventas)
    {
        $this->ventas = $ventas;
        $this->open = true;
    }

    public function conciliar()
    {
        $this->ventas->estado = 1;
        $this->ventas->update();

        $this->reset(['open']);  //cierra el modal     
        $this->dispatch('index-conciliacion');
    }

    public function consultar()
    {
        $this->mes = date('m', strtotime($this->fecha));
        $this->ano = date('Y', strtotime($this->fecha));

        $pagosconciliados = Venta::whereMonth('fecha', $this->mes)->whereYear('fecha', $this->ano)
        ->where('estado', '=', 1)->get()->sum('total');
        
        $this->totales = $pagosconciliados;
        $this->open_totales = true;
    }

    public function render()
    {
        $ventassin = Venta::where('estado', '=', 0)->orderBy('id', 'desc')->paginate(15, ['*'], 'vsin');
        $ventascon = Venta::where('estado', '=', 1)->orderBy('id', 'desc')->paginate(15, ['*'], 'vcon');

        return view('livewire.conciliaciones.index-conciliacion', compact('ventassin', 'ventascon'));
    }
}
