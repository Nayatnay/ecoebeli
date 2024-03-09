<?php

namespace App\Http\Controllers;

use App\Models\Detalleventa;
use App\Models\Reportesc;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index($ventas)
    {                     
        $venta = Venta::where('id', '=', $ventas)->first();
        $detalles = Detalleventa::where('id_venta', '=', $ventas)->get();
        $cliente = User::where('id', '=', $venta->id_user)->first();

        return view('livewire.ventas.index-ventas', compact('venta', 'detalles', 'cliente'));
    }
}
