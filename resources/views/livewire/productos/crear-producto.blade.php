<div>
    <div class="text-sm cursor-point font-light ">
        <p wire:click="$set('open_crear', true)" class="cursor-pointer">Nuevo producto</p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open_crear">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b text-zinc-800">Crear Nueva categoría</p>
        </x-slot>

        <x-slot name="content" class="">

            <div class=" mb-4">
                <x-label for="nombre" value="{{ __('Nombre') }}" class="text-zinc-800" />
                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" wire:model.defer="nombre" required autofocus />
                <x-input-error for="nombre" />
            </div>
            <div class=" mb-4">
                <x-label for="descripcion" value="{{ __('Descripción') }}" class="text-zinc-800" />
                <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" wire:model.defer="descripcion" required autofocus />
                <x-input-error for="descripcion" />
            </div>
            <div class=" mb-4">
                <x-label for="id_categoria" value="{{ __('Categoría') }}" class="text-zinc-800" />
                <select name="id_categoria" wire:model.defer="id_categoria" class="w-full px-2 py-3 text-sm rounded-md border border-gray-200 focus:border-gray-300 focus:ring-0 text-zinc-800">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
                <x-input-error for="id_categoria" />
            </div>
            <div class="flex flex-wrap">
                <div class="mb-4">
                    <x-label for="codigo" value="{{ __('Código') }}" class="text-zinc-800" />
                    <x-input id="codigo" class="block mt-1" type="text" name="codigo" wire:model.defer="codigo" required autofocus />
                    <x-input-error for="codigo" />
                </div>
                <div class="mb-4 sm:mx-2">
                    <x-label for="stock" value="{{ __('Existencias') }}" class="text-zinc-800" />
                    <x-input id="stock" class="block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" step="any" name="stock" wire:model.defer="stock" required autofocus />
                    <x-input-error for="stock" />
                </div>
                <div class="mb-4">
                    <x-label for="precio" value="{{ __('Precio') }}" class="text-zinc-800" />
                    <x-input id="precio" class="block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" step="any" name="precio" wire:model.defer="precio" required autofocus />
                    <x-input-error for="precio" />
                </div>
            </div>           
            <div class="text-xs text-left lg:text-sm">
                <label for="{{$identificador}}" class="cursor-pointer hover:underline">Agregar una Imagen</label>
                <input id="{{$identificador}}" type="file" style="visibility:hidden;" name="imagen" wire:model="imagen" class="" required />
                <x-input-error for="imagen" />
            </div>

            <div wire:loading wire:target="imagen" class="w-full text-xs font-normal">
                <strong>¡Cargando Imagen! </strong>
                <span>Espere mientras se carga la imagen...</span>
            </div>

            <div class="mt-4 h-44 max-h-44">
                @if ($imagen)
                <img src="{{$imagen->temporaryUrl()}}" class="p-4 border border-zinc-500 rounded" width="240">
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex">
                <x-secondary-button wire:click="cancelar" wire:target="cancelar" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                    Aceptar
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>

</div>