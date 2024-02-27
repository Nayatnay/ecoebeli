<?php

namespace App\Livewire\Tasa;

use App\Models\Tasa;
use Livewire\Component;

class IndexTasa extends Component
{
    public $tasa, $valtasa;
    public $open_edit = false;

    protected function rules()
    {
        return [
            'tasa.valtasa' => 'required',
        ];
    }

    public function mount(Tasa $tasa)
    {
        $this->tasa = $tasa;
    }
    
    public function edit(tasa $tasa)
    {      
        $this->tasa = $tasa;
        //dd($this->tasa->valtasa);
        $this->open_edit = true;
    }

    public function update()
    {
        //dd($this->tasa);
        $validatedData = $this->validate();
        
        $this->tasa->update($validatedData);

        $this->reset(['open_edit', 'tasa']);  //cierra el modal y limpia los campos del formulario
        $this->dispatch('tasa.index-tasa');
    }


    public function render()
    {
       $tasas = tasa::all();
        return view('livewire.tasa.index-tasa', compact('tasas'));
    }
}
