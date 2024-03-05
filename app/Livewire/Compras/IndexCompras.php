<?php

namespace App\Livewire\Compras;

use App\Models\Detalleventa;
use App\Models\Medio;
use App\Models\Producto;
use App\Models\Tasa;
use App\Models\Venta;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IndexCompras extends Component
{
    public $open = false;
    public $open_edit = false;
    public $medio, $vencimiento, $mes, $ano;

    public $open_reporte = false;
    public $problema, $detalle, $venta;

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'mes' => 'required',
            'ano' => 'required',
        ];
    }

    public function mount(Medio $medio)
    {
        $this->medio = $medio;
    }

    public function edit(Medio $medio)
    {
        $this->medio = $medio;
        $this->open_edit = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $this->medio->vencimiento = str_pad($this->mes, 2, '0', STR_PAD_LEFT) . '/' . $this->ano;
        $this->medio->update($validatedData);


        $this->reset(['open_edit', 'mes', 'ano']);  //cierra el modal y limpia los campos del formulario
        $this->dispatch('index-compras');
    }

    public function cancelar()
    {
        $this->reset(['open_reporte', 'problema', 'detalle']);  //cierra el modal     
        $this->dispatch('index-compras');
    }

    public function contactar(Venta $venta)
    {
        $this->venta = $venta;
        $this->open_reporte = true;
    }

    public function render()
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

        //actualizar precios de los productos que estan en el carrito de compras

        foreach (CartFacade::getContent() as $item) {

            $producto = Producto::find($item->id);

            if ($producto <> null) {
                CartFacade::update($item->id, ['price' => $producto->precio]);
            } else {
                CartFacade::remove($item->id); //elimina el item del carrito por producto eliminado en la DB
            }
        }

        $bolivares = 0;
        $tasa = tasa::orderBy('id', 'desc')->first();
        if ($tasa <> null) {
            $bolivares = CartFacade::getsubtotal() * $tasa->valtasa;
        }

        //Compras realizadas por el usuario
        $compras = Venta::where('id_user', '=', Auth::user()->id)->orderBy('id')->paginate(8);

        // Ventas realizadas al usuario recibidas como un array
        $ventas = venta::where('id_user', '=', Auth::user()->id)->pluck('id')->toArray();
        //dd($ventas);
        //Productos comprados por el usuario
        $producto_comprado = Detalleventa::whereIn('id_venta', $ventas)->orderBy('id', 'desc')
            ->paginate(6, ['*'], 'inscribirbs');

        return view('livewire.compras.index-compras', compact('medios', 'bolivares', 'compras', 'producto_comprado'));
    }
}
