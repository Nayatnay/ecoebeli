@section('title', 'Tasa $ | Ebeli')
<div>

    <div class="bg-white shadow">
        @foreach ($tasas as $tasa)
            <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tasa dolar del Día <strong>Bs. {{ $tasa->valtasa }}</strong>
                </h2>

                <a href="#" wire:click="edit({{ $tasa }})" title="Editar"> Actualizar </a>
            </div>
        @endforeach

    </div>

    <!--Modal edit -->

    <x-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b">Actualizar Tasa dolar</p>
        </x-slot>

        <x-slot name="content">

            <div class=" mb-4">
                <x-label for="valtasa" value="{{ __('valtasa') }}" class="text-zinc-800" />
                <x-input id="valtasa" class="block mt-1 w-full" type="text" name="valtasa" wire:model.defer="tasa.valtasa"
                    required autofocus />
                <x-input-error for="valtasa" />
            </div>

            <div class=" mb-4">
                <x-label for="id" value="{{ __('id') }}" class="text-zinc-800" />
                <x-input id="id" class="block mt-1 w-full" type="text" name="id" wire:model="id" required
                    autofocus />
                <x-input-error for="id" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex">
                <x-secondary-button wire:click="$set('open_edit', false)" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Aceptar
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>

</div>
