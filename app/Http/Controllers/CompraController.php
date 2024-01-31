<?php

namespace App\Http\Controllers;

use App\Models\Medio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{

    public $open = false;

    public function index()
    {

        $medios = Medio::where('id_user', '=', Auth::user()->id)->get();


        foreach ($medios as $medio) {
           
            if (substr($medio->vencimiento, -4) < date("Y")) {
                $medio->vencimiento = "Vencido " . $medio->vencimiento;
                $medio->save();
            }
            if (substr($medio->vencimiento, -4) == date("Y")) {
                if (substr($medio->vencimiento, 0, 1) <> "V") {
                    if (substr($medio->vencimiento, 0, 2) <= date("m")) {
                        $medio->vencimiento = "Vencido " . $medio->vencimiento;
                        $medio->save();
                    }
                }
            }
        }
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

    public function editmedio(Medio $medio)
    {
        $medio->delete();

        return redirect(route('compra'));
    }
}
