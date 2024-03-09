<?php

namespace App\Livewire\Reclamos;

use App\Models\Reportesc;
use App\Models\Venta;
use Livewire\Component;

class IndexReclamos extends Component
{
    public $reclamo;
    public $open = false;

    protected $listeners = ['render'];

    public function mount(Reportesc $reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function marcar(Reportesc $reclamo)
    {
        $this->reclamo = $reclamo;
        $this->open = true;
        
    }

    public function resolver()
    {
        $reclamo = $this->reclamo;

        $reclamo->estado = 0; //repor atendido y resuelto
        $reclamo->update();        
        
        $venta = Venta::where('id', '=', $reclamo->id_venta)->first();
        $venta->reporte = 2; //reclamo atendido y resuelto
        $venta->update();

        $this->reset(['open']);  //cierra el modal     
        $this->dispatch('index-reclamos');

    }

    public function render()
    {
        $reclamosp = Reportesc::where('estado', '=', 1)->orderBy('id')->paginate(12, ['*'], 'reclamos');
        $reclamosr = Reportesc::where('estado', '=', 0)->orderBy('id')->paginate(12, ['*'], 'reclamos');

        return view('livewire.reclamos.index-reclamos', compact('reclamosp', 'reclamosr'));
    }
}
