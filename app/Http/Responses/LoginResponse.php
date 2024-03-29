<?php

namespace App\Http\Responses;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        // here i am checking if the currently logout in users has a role_id of 2 which 
        //make him a regular user and then redirect to the users dashboard else the admin dashboard
        if (auth()->user()->role_id == 2) {
            return redirect()->intended(config('fortify.home'));
        }
        //return redirect()->intended(config('fortify.admin.home'));
        
        $rutita = session('urlcall');
        $buscado = session('varval');
        $producto = session('varvalpro');
    
        if (session('varval') == null && session('varvalpro') == null) {
            return redirect($rutita);
        }

        if (session('varval') <> null ) {
            $buscar = Str::slug($buscado, '-');
            return redirect()->Route($rutita, compact('buscar'));
        }

        if (session('varvalpro') <> null) {
            return redirect()->Route($rutita, compact('producto'));
        }        
    }
}
