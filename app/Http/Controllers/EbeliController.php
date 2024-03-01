<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class EbeliController extends Controller
{

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index(request $request)
    {
        $buscar = $request->buscar;
        $categ = Categoria::all()->sortBy('nombre');
        $categorias = Categoria::orderBy('nombre')->paginate(12);

        return view('ebeli', compact('categ', 'buscar', 'categorias'));
    }
}
