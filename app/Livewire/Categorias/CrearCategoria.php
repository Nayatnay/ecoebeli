<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CrearCategoria extends Component
{
    use WithFileUploads;

    public $open_crear = false;
    public $imagen, $identificador, $nombre, $descripcion;
    public $slug;

    protected $listeners = ['render'];

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100,max_width=640,max_height=480|max:2048'
    ];

    public function mount() // Lo estoy usando para eliminar el nombre de la imagen que se selecciono anteriormente en el modal
    {
        $this->identificador = rand();
    }

    public function save()
    {
        $this->validate();

        $fileName = time() . '.' . $this->imagen->extension();
        $this->imagen->storeAs('public/categorias', $fileName);
        $nombre = $this->nombre;
        $slug = $this->slug;
        $descripcion = $this->descripcion;

        Categoria::create([
            'nombre' => $nombre,
            'slug' => $slug,
            'descripcion' => $descripcion,
            'imagen' => $fileName,
        ]);

        $this->reset(['open_crear', 'nombre', 'descripcion', 'imagen']);
        $this->identificador = rand(); // reemplaza el valor del identificador. Reseteará el nombre de la imagen seleccionada anteriormente
        return redirect()->route('admincat')->with('creado', 'ok');
    }

    public function cancelar(){
        $this->reset(['open_crear', 'nombre', 'descripcion', 'imagen']);
        $this->identificador = rand(); 
    }

    public function render()
    {
        $this->identificador = rand();
        return view('livewire.categorias.crear-categoria');
    }

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Categoria::class, 'slug', $this->nombre);
    }

}
