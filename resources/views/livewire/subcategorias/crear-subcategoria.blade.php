<div>
    <div class="text-sm cursor-point font-light ">
        <p wire:click="$set('open_crear', true)" class="cursor-pointer">Nueva Subcategoría</p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open_crear">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b text-zinc-800">Crear Nueva Subcategoría</p>
        </x-slot>

        <x-slot name="content" class="">

            <div class=" mb-4">
                <x-label for="nombre" value="{{ __('Nombre Subcategoría') }}" class="text-zinc-800" />
                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" wire:model.defer="nombre" required autofocus />
                <x-input-error for="nombre" />
            </div>
            <div class=" mb-4">
                <x-label for="id_categoria" value="{{ __('Categoría') }}" class="text-zinc-800" />
                <select name="id_categoria" wire:model.defer="id_categoria"
                    class="w-full px-2 py-3 text-sm rounded-md border border-gray-200 focus:border-gray-300 focus:ring-0 text-zinc-800">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="id_categoria" />
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