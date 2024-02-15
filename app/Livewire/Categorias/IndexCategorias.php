<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use BaconQrCode\Renderer\Path\Path;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class IndexCategorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $open_delete = false;
    public $open_edit = false;
    public $categoria, $imagen, $nombre, $descripcion, $identificador, $imagenva;

    public function mount(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->identificador = rand();
    }

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'imagenva' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100,max_width=640,max_height=480|max:2048'
        ];
    }

    public function delete(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->open_delete = true;
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
        $this->descripcion = $categoria->descripcion;
        $this->imagen = $categoria->imagen;

        $this->imagenva = null;

        $this->open_edit = true;
    }

    public function update()
    {
        if ($this->imagenva <> null) {           
            $this->imagen = $this->imagenva;
            $fileName = time() . '.' . $this->imagen->extension();
            $this->imagen->storeAs('public/categorias', $fileName);
            $this->imagen = $fileName;        
        
            $validatedData = $this->validate();
            $this->categoria->update($validatedData);

        } else{
            $this->categoria->nombre=$this->nombre;
            $this->categoria->descripcion=$this->descripcion;            
            $this->categoria->update();
        }     

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
