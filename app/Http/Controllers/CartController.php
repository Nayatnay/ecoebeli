<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $producto = Producto::find($request->id);

        if (empty($producto)) {
            return redirect('/');
        }

        if ($producto->stock <= 0) {
            return redirect()->back();
        }

        $car = CartFacade::get($producto->id);
        if ($car == null) {
            CartFacade::add(
                $producto->id,
                $producto->nombre,
                $producto->precio,
                1,
                array("imagen" => $producto->imagen)
            );
        } else {
            $catt = $car->quantity + 1;
            if ($catt > $producto->stock) {
                return redirect()->back();
            } else {
                CartFacade::add(
                    $producto->id,
                    $producto->nombre,
                    $producto->precio,
                    1,
                    array("imagen" => $producto->imagen)
                );
            }
        }
        
        $producto = $producto->slug;
        return redirect()->Route('detalleproducto', compact('producto'))->with('info', 'ok');
    }

    public function clear()
    {
        CartFacade::clear();
        return redirect()->back();
    }
}
