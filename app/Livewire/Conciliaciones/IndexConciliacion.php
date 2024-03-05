<?php

namespace App\Livewire\Conciliaciones;

use App\Models\Detalleventa;
use App\Models\Venta;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class IndexConciliacion extends Component
{
    public $open = false;
    public $open_totales = false;
    public $ventas, $fecha, $totalescon, $totalessin, $totalespro, $fechita, $mes, $ano;

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

    public function contactar(Venta $ventas)
    {
        dd($ventas);
    }

    public function consultar()
    {
        $this->mes = date('m', strtotime($this->fecha));
        $this->ano = date('Y', strtotime($this->fecha));

        $pagosconciliados = Venta::whereMonth('fecha', $this->mes)->whereYear('fecha', $this->ano)
            ->where('estado', '=', 1)->get()->sum('total');
        $pagosnoconciliados = Venta::whereMonth('fecha', $this->mes)->whereYear('fecha', $this->ano)
            ->where('estado', '=', 0)->get()->sum('total');

        // Todas las Ventas del mes recibidas como un array
        $ventas = Venta::whereMonth('fecha', $this->mes)->whereYear('fecha', $this->ano) //
            ->pluck('id')->toArray();


        //Productos comprados por las ventas del mes
        $totproductos = Detalleventa::whereIn('id_venta', $ventas)->get()->sum('cantidad');

        $this->totalescon = $pagosconciliados;
        $this->totalessin = $pagosnoconciliados;
        $this->totalespro = $totproductos;

        $this->open_totales = true;
    }

    public function render()
    {
        //Obtener ultimo mes del año
        $fecha = date('Y-m');
        $nuevafecha = strtotime('-1 months', strtotime($fecha));
        $nuevafecha = date('Y-m', $nuevafecha);

        $mm = date('m', strtotime($nuevafecha));  //obtener mes
        $yy = date('Y', strtotime($nuevafecha)); // obtener año

        $ventassin = Venta::where('estado', '=', 0)->orderBy('id', 'desc')->paginate(12, ['*'], 'vsin');
        $ventascon = Venta::where('estado', '=', 1)->orderBy('id', 'desc')->paginate(12, ['*'], 'vcon');

        $ventassinmes = Venta::whereMonth('fecha', $mm)->whereYear('fecha', $yy) //Total ventas del mes sin conciliar
            ->where('estado', '=', 0)->get()->sum('total');

        $ventasconmes = Venta::whereMonth('fecha', $mm)->whereYear('fecha', $yy) //Total ventas del mes conciliadas
            ->where('estado', '=', 1)->get()->sum('total');

        // Todas las Ventas del ultimo mes recibidas como un array
        $ventas = Venta::whereMonth('fecha', $mm)->whereYear('fecha', $yy) //
            ->pluck('id')->toArray();


        //Productos comprados por las ventas del ultimo mes
        $totproductos = Detalleventa::whereIn('id_venta', $ventas)->get()->sum('cantidad');

        return view('livewire.conciliaciones.index-conciliacion', compact('ventassin', 'ventascon', 'ventassinmes', 'ventasconmes', 'totproductos'));
    }
}
