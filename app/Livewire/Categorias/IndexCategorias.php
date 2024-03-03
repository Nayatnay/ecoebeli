<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use App\Models\Producto;
use BaconQrCode\Renderer\Path\Path;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class IndexCategorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $open_delete = false;
    public $open_edit = false;
    public $msg = false;
    public $categoria, $imagen, $nombre, $descripcion, $identificador, $imagenva;
    public $slug;

    public function mount(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->identificador = rand();
    }

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:categorias,nombre,' . $this->categoria->id,
            'descripcion' => 'required',
            'imagen' => 'required',
            //'imagenva' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100,max_width=640,max_height=480|max:2048' . $this->categoria->id,
        ];
    }

    public function delete(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $cat_search = Producto::where('id_categoria', '=', $categoria->id)->first();
        if ($cat_search == null) {
            $this->open_delete = true;
        } else {
            $this->msg = true;
        }
    }

    public function destroy()
    {
        $this->categoria->delete();
        $this->reset(['open_delete']);  //cierra el modal     
        $this->dispatch('index-categorias');
    }

    public function edit(Categoria $categoria)
    {

        $this->categoria = $categoria;
        $this->nombre = $categoria->nombre;
        $this->slug = $categoria->slug;
        $this->descripcion = $categoria->descripcion;
        $this->imagen = $categoria->imagen;

        $this->imagenva = null;

        $this->open_edit = true;
    }

    public function update()
    {

        $this->categoria->slug = Str::slug($this->nombre, '-');

        if ($this->imagenva <> null) {
            $this->imagen = $this->imagenva;
            $fileName = time() . '.' . $this->imagen->extension();
            $this->imagen->storeAs('public/categorias', $fileName);
            $this->imagen = $fileName;
        }
        
        $validatedData = $this->validate();
        $this->categoria->update($validatedData);
        
        $this->imagenva = null;

        $this->reset(['open_edit', 'nombre', 'descripcion', 'imagen']);  //cierra el modal y limpia los campos del formulario
        $this->identificador = rand();
        $this->dispatch('index-categorias');
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

        $categorias = Categoria::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(8, ['*'], 'categ');

        return view('livewire.categorias.index-categorias', compact('categorias', 'categ', 'buscar'));
    }
}
