<div>
    <div class="text-sm cursor-point font-light ">
        <p wire:click="$set('open_crear', true)" class="cursor-pointer">Nueva categoría</p>
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