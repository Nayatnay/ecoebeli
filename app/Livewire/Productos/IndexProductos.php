<?php

namespace App\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
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
    public $identificador, $codigo, $id_categoria, $id_subcategoria, $nombre, $marca, $color, $talla;
    public $descripcion, $imagen, $precio, $stock, $imagenva;
    public $categoria, $subcategoria, $producto;

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'codigo' => 'required|unique:productos,codigo,' . $this->producto->id,
            'id_categoria' => 'required',
            'id_subcategoria' => 'required',
            'nombre' => 'required',
            'marca' => 'required',
            'color' => 'required',
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
        $this->id_subcategoria = $producto->id_subcategoria;
        $this->nombre = $producto->nombre;
        $this->marca = $producto->marca;
        $this->color = $producto->color;
        $this->talla = $producto->talla;
        $this->descripcion = $producto->descripcion;
        $this->imagen = $producto->imagen;
        $this->precio = $producto->precio;
        $this->stock = $producto->stock;

        $this->imagenva = null;

        $this->open_edit = true;
    }

    public function update()
    {

        $subycat = Subcategoria::where('id', '=', $this->id_subcategoria,)->first();
        $this->id_categoria = $subycat->id_categoria;

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
            $this->producto->id_subcategoria = $this->id_subcategoria;
            $this->producto->nombre = $this->nombre;
            $this->producto->marca = $this->marca;
            $this->producto->color = $this->color;
            $this->producto->talla = $this->talla;
            $this->producto->descripcion = $this->descripcion;
            $this->producto->stock = $this->stock;
            $this->producto->precio = $this->precio;
            $this->producto->update();
        }

        $this->imagenva = null;

        $this->reset(['open_edit', 'codigo', 'id_categoria', 'id_subcategoria', 'nombre', 'marca', 'color', 'talla', 'descripcion', 'imagen', 'stock', 'precio']);  //cierra el modal y limpia los campos del formulario
        $this->identificador = rand();
        $this->dispatch('index-productos');
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render(Request $request)
    {
        $this->identificador = rand();
        $buscar = $request->buscar;

        if ($buscar == "Todas las Categorías") {
            $buscar = "";
        }

        $categ = Categoria::all()->sortBy('nombre');
        $subcategorias = Subcategoria::all()->sortBy('nombre');

        if ($request->categoria <> null) {
            $productos = Producto::where('id_categoria', '=', $request->categoria)
                ->orderBy('id', 'desc')->paginate(8, ['*'], 'prodlink');
            if (count($productos) == 0) {
                $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'desc')->paginate(8, ['*'], 'prodlink');
            }
        } else {
            $productos = Producto::where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(8, ['*'], 'prodlink');
        }

        return view('livewire.productos.index-productos', compact('productos', 'buscar', 'categ', 'subcategorias'));
    }
}
