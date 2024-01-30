<?php

namespace App\Http\Controllers;

use App\Models\Medio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        
        $medios = Medio::where('id_user', '=', Auth::user()->id)->get();

        return view('compra', compact('medios'));
    }

    public function verificalog()
    {
        if (auth()->user()) {
            return redirect(route('compra'));
        } else {
            return redirect(route('login'));
        }
    }
}
