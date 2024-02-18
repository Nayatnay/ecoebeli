<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class EbeliController extends Controller
{
    use WithPagination;

    protected $listeners = ['render'];

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index(request $request)
    {
        $buscar = $request->buscar;
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::all()->sortBy('nombre');

        return view('ebeli', compact('categ', 'buscar', 'categorias'));
    }
}
