<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categoria;
use App\Models\Producto;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CarroController extends Controller
{

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $categ = Categoria::all()->sortBy('nombre');
        $productos = Producto::orderBy('nombre')->paginate(6);
        $produc = Producto::where('precio', '<>', 0)->inRandomOrder()->limit(8)->get();

        //actualizar precios de los productos que estan en el carrito de compras

        foreach (CartFacade::getContent() as $item) {

            $producto = Producto::find($item->id);

            if ($producto <> null) {
                CartFacade::update($item->id, ['price' => $producto->precio]);
            } else {
                CartFacade::remove($item->id); //elimina el item del carrito por producto eliminado en la DB
            }
        }

        return view('carro', compact('productos', 'produc',  'categ', 'buscar'));
    }

    public function adicion(Request $request)
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

        return redirect()->Route('carro')->with('info', 'ok');
    }

    public function removeItem(Request $request)
    {
        CartFacade::remove($request->rowId);

        return redirect()->Route('carro')->with('eliminado', 'ok');
    }

    public function updateqty(Request $request)
    {
        if ($request->cant == 0) {
            CartFacade::remove($request->rowId);
            return redirect()->Route('carro')->with('eliminado', 'ok');
        }

        //CartFacade::update( $request->rowId, ['quantity' => $request->cant]); //me aumenta la cantidad NO FUNCIONÓ

        CartFacade::remove($request->rowId);

        $producto = Producto::find($request->rowId);

        if ($producto->stock < $request->cant) {
            CartFacade::add(
                $producto->id,
                $producto->nombre,
                $producto->precio,
                $producto->stock,
                array("imagen" => $producto->imagen)
            );
        } else {
            CartFacade::add(
                $producto->id,
                $producto->nombre,
                $producto->precio,
                $request->cant,
                array("imagen" => $producto->imagen)
            );
        }

        return redirect()->Route('carro')->with('actualizado', 'ok');
    }

    public function adicompra(Producto $producto)
    {
        $producto = Producto::find($producto->id);

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
        } 
        /*else {
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
            
        }*/

        return redirect()->Route('admincom');
    }

    public function verificalog()
    {
        if (auth()->user()) {
            return redirect(route('admincom'));
        } else {
            return redirect(route('login'));
        }
    }
}
