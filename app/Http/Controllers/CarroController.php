<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;
class CarroController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

       /*$nido = [];
        $items = CartFacade::getContent();
        foreach ($items as $row) {
            $nido[]['id'] = $row;
        }
       dd($nido);*/
        $categ = Categoria::all()->sortBy('nombre');
        $productos = Producto::orderBy('nombre')->paginate(6);
        $produc = Producto::where('precio', '<=', 100)->inRandomOrder()->limit(8)->get();

        return view('carro', compact('productos', 'produc',  'categ', 'buscar'));
    }

    public function adicion(Request $request)
    {

        $producto = Producto::find($request->id);

        if (empty($producto)) {
            return redirect('/');
        }

        CartFacade::add(
            $producto->id,
            $producto->nombre,
            $producto->precio,
            1,
            array("imagen" => $producto->imagen)

        );

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
        
        CartFacade::remove($request->rowId);

        $producto = Producto::find($request->rowId);

        CartFacade::add(
            $producto->id,
            $producto->nombre,
            $producto->precio,
            $request->cant,
            array("imagen" => $producto->imagen)

        );

        return redirect()->Route('carro')->with('actualizado', 'ok');
    }

    public function adicompra(Producto $producto)
    {
        $producto = Producto::find($producto->id);

        if (empty($producto)) {
            return redirect('/');
        }

        CartFacade::add(
            $producto->id,
            $producto->nombre,
            $producto->precio,
            1,
            array("imagen" => $producto->imagen)

        );

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
