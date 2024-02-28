<div>
    <div class="text-sm cursor-point font-light ">
        <p wire:click="$set('open', true)" class="cursor-pointer">Nueva tasa</p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b text-zinc-800">Crear Nueva tasa</p>
        </x-slot>

        <x-slot name="content" class="">

            <div class=" mb-4">
                <x-label for="valtasa" value="{{ __('Tasa') }}" class="text-zinc-800" />
                <x-input id="valtasa"
                    class="text-sm block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    type="number" step="any" name="valtasa" wire:model.defer="valtasa" autocomplete="off"/>
                <x-input-error for="valtasa" />
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
