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
       */
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
            array("imagen"=>$producto->imagen)

        );

        return redirect()->Route('carro')->with('info', 'ok');
    }
}
