<?php

namespace App\Livewire\Productos;

use App\Models\Categoria;
use App\Models\id_Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearProducto extends Component
{
    use WithFileUploads;

    public $open_crear = false;
    public $identificador, $codigo, $id_categoria, $id_subcategoria, $nombre, $marca, $color, $talla;
    public $descripcion, $imagen, $precio, $stock;

    protected $listeners = ['render'];

    protected $rules = [
        'codigo' => 'required|unique:productos',
        'id_categoria' => 'required',
        'id_subcategoria' => 'required',
        'nombre' => 'required',
        'marca' => 'required',
        'color' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100,max_width=640,max_height=480|max:2048',
        'precio' => 'required',
        'stock' => 'required',
    ];

    public function mount() // Lo estoy usando para eliminar el nombre de la imagen que se selecciono anteriormente en el modal
    {
        $this->identificador = rand();
    }

    public function save()
    {
        $this->validate();

        $fileName = time() . '.' . $this->imagen->extension();
        $this->imagen->storeAs('public/productos', $fileName);

        Producto::create([
            'codigo' => $this->codigo,
            'id_categoria' => $this->id_categoria,
            'id_subcategoria' => $this->id_subcategoria,
            'nombre' => $this->nombre,
            'marca' => $this->marca,
            'color' => $this->color,
            'talla' => $this->talla,
            'descripcion' => $this->descripcion,
            'imagen' => $fileName,
            'precio' => $this->precio,
            'stock' => $this->stock,
        ]);

        $this->reset(['open_crear', 'codigo', 'id_categoria', 'id_subcategoria', 'nombre', 'marca', 'color', 'talla', 'descripcion', 'imagen', 'precio', 'stock']);
        $this->identificador = rand(); // reemplaza el valor del identificador. Reseteará el nombre de la imagen seleccionada anteriormente
        return redirect()->route('adminpro')->with('creado', 'ok');
    }

    public function cancelar(){
        $this->reset(['open_crear', 'codigo', 'id_categoria', 'id_subcategoria', 'nombre', 'marca', 'color', 'talla', 'descripcion', 'imagen', 'precio', 'stock']);
        $this->identificador = rand(); 
    }


    public function render()
    {
        $categorias = Categoria::all()->sortBy('nombre');
        $subcategorias = Subcategoria::all()->sortBy('nombre');
        return view('livewire.productos.crear-producto', compact('categorias', 'subcategorias'));
    }
}
