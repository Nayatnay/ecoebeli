<?php

namespace App\Livewire\Tasa;

use App\Models\Tasa;
use Livewire\Component;

class IndexTasa extends Component
{
    public $tasa, $valtasa;
    public $open_edit = false;

    public function render()
    {
        $tasas = tasa::paginate(15);
        $ultimatasa = tasa::orderBy('id', 'desc')->first();
        return view('livewire.tasa.index-tasa', compact('tasas', 'ultimatasa'));
    }
}
