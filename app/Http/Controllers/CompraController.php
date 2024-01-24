<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        return view('compra');
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
