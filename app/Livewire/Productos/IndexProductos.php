<?php

namespace App\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class IndexProductos extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $open_crear = false;
    public $open_delete = false;
    public $open_edit = false;
    public $identificador, $codigo, $id_categoria, $nombre, $descripcion, $imagen, $precio, $stock, $imagenva;
    public $categoria, $producto;

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'codigo' => 'required|unique:productos,codigo,' . $this->producto->id,
            'id_categoria' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'imagenva' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100,max_width=640,max_height=480|max:2048',
            'precio' => 'required',
            'stock' => 'required',
        ];
    }

    public function mount(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->identificador = rand();
    }

    public function delete(Producto $producto)
    {
        $this->producto = $producto;
        $this->open_delete = true;
    }

    public function destroy()
    {
        $this->producto->delete();
        $this->reset(['open_delete']);  //cierra el modal     
        $this->dispatch('index-productos');
    }

    public function edit(Producto $producto)
    {
        $this->producto = $producto;
        $this->codigo = $producto->codigo;
        $this->id_categoria = $producto->id_categoria;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->imagen = $producto->imagen;
        $this->precio = $producto->precio;
        $this->stock = $producto->stock;

        $this->imagenva = null;

        $this->open_edit = true;
    }

    public function update()
    {
        if ($this->imagenva <> null) {
            $this->imagen = $this->imagenva;
            $fileName = time() . '.' . $this->imagen->extension();
            $this->imagen->storeAs('public/productos', $fileName);
            $this->imagen = $fileName;

            $validatedData = $this->validate();
            $this->producto->update($validatedData);
        } else {
            $this->producto->codigo = $this->codigo;
            $this->producto->id_categoria = $this->id_categoria;
            $this->producto->nombre = $this->nombre;
            $this->producto->descripcion = $this->descripcion;
            $this->producto->stock = $this->stock;
            $this->producto->precio = $this->precio;
            $this->producto->update();
        }

        $this->imagenva = null;

        $this->reset(['open_edit', 'codigo', 'id_categoria', 'nombre', 'descripcion', 'imagen', 'stock', 'precio']);  //cierra el modal y limpia los campos del formulario
        $this->identificador = rand();
        $this->dispatch('index-productos');
    }


    public function render(Request $request)
    {
        $this->identificador = rand();
        $buscar = $request->buscar;

        if ($buscar == "Todas las Categorías") {
            $buscar = "";
        }

        $categ = Categoria::all()->sortBy('nombre');;

        if ($request->categoria <> null) {
            $productos = Producto::where('id_categoria', '=', $request->categoria)
                ->orderBy('id', 'desc')->paginate(8);
            if (count($productos) == 0) {
                $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'desc')->paginate(8);
            }
        } else {
            $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(8);
        }

        return view('livewire.productos.index-productos', compact('productos', 'buscar', 'categ'));
    }
}
