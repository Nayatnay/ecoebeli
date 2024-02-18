<?php

namespace App\Livewire\Subcategorias;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Illuminate\Support\Str;

class CrearSubcategoria extends Component
{
    public $open_crear = false;
    public $nombre, $id_categoria;
    public $slug;

    protected $listeners = ['render'];

    protected $rules = [
        'nombre' => 'required',
        'id_categoria' => 'required',
    ];

    public function cancelar()
    {
        $this->reset(['open_crear', 'nombre']);
    }

    public function save()
    {
        $this->validate();
        
        $this->slug = Str::slug($this->nombre, '-');
        
        Subcategoria::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'id_categoria' => $this->id_categoria,
        ]);

        $this->reset(['open_crear', 'id_categoria','nombre']);
       return redirect()->route('adminsubcat')->with('creado', 'ok');
    }

    public function render()
    {
        $categorias = Categoria::all()->sortBy('nombre');
        return view('livewire.subcategorias.crear-subcategoria', compact('categorias'));
    }

    /*
    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Subcategoria::class, 'slug', $this->nombre);
    }
*/
}
