<?php

namespace App\Livewire\Subcategorias;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSubcategorias extends Component
{
    use WithPagination;

    public $open_delete = false;
    public $open_edit = false;
    public $categoria, $subcategoria, $nombre, $id_categoria;

    public function mount(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    protected $listeners = ['render'];

    protected function rules()
    {
        return [
            'nombre' => 'required',
            'id_categoria' => 'required',
            ];
    }

    public function delete(Subcategoria $subcategoria)
    {
        $this->subcategoria = $subcategoria;
        $this->open_delete = true;
    }

    public function destroy()
    {
        $this->subcategoria->delete();
        $this->reset(['open_delete']);  //cierra el modal     
        $this->dispatch('index-subcategorias');
    }

    public function edit(Subcategoria $subcategoria)
    {
        $this->subcategoria = $subcategoria;
        
        $this->id_categoria = $subcategoria->id_categoria;
        $this->nombre = $subcategoria->nombre;

        $this->open_edit = true;
    }

    public function update()
    {           
            $validatedData = $this->validate();
            $this->subcategoria->update($validatedData);

        $this->reset(['open_edit', 'nombre', 'categoria']);  //cierra el modal y limpia los campos del formulario
        $this->dispatch('index-subcategorias');
    
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render(Request $request)
    {
        $buscar = $request->buscar;

        if ($buscar == "Todas las Categorías") {
            $buscar = "";
        }

        $categ = categoria::all()->sortBy('nombre');

        $subcategorias = Subcategoria::where('nombre', 'LIKE', '%' . $buscar . '%')
            ->orderBy('id', 'desc')->paginate(8, ['*'], 'subcateg');
        
        return view('livewire.subcategorias.index-subcategorias', compact('buscar', 'subcategorias', 'categ',));
    }
}
