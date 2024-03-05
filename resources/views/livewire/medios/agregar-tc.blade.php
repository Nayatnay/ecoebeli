<div>
    <div class="text-base md:text-lg font-medium text-lime-700">
        <p wire:click="$set('open', true)" class="cursor-pointer inline-block  hover:underline">
            <i class="fa-regular fa-credit-card mr-1"></i>
            Agregar nueva tarjeta de crédito/débito
        </p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b text-zinc-800">Nueva Tarjeta</p>
        </x-slot>

        <x-slot name="content" class="">

            <div class=" mb-4">
                <x-label for="codigo" value="{{ __('Número de tarjeta') }}" class="text-zinc-800" />
                <x-input id="codigo" class="block mt-1 " type="text" name="codigo" wire:model.defer="codigo"
                    required autofocus />
                <x-input-error for="codigo" />
            </div>
            <div class=" mb-4">
                <x-label for="nombre" value="{{ __('Nombre impreso en la tarjeta') }}" class="text-zinc-800" />
                <x-input id="nombre" class="block mt-1 " type="text" name="nombre" wire:model.defer="nombre"
                    required autofocus />
                <x-input-error for="nombre" />
            </div>
            <div class="mb-4">
                <x-label for="vencimiento" value="{{ __('Fecha de vencimiento') }}" class="text-zinc-800 mb-1" />
                <select name="mes" id="mes" wire:model.defer="mes"
                    class="text-xs font-medium rounded-lg border-gray-300 focus:ring-0 focus:outline-none hover:cursor-pointer p-2 text-black">
                    <option value="">Mes</option>
                    @for ($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <x-input-error for="mes" />
                <select name="ano" id="ano" wire:model.defer="ano"
                    class="text-xs font-medium rounded-lg border-gray-300 focus:ring-0 focus:outline-none hover:cursor-pointer p-2 text-black">
                    <option value="">Año</option>
                    @for ($i = 2024; $i < 2045; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <x-input-error for="ano" />
            </div>
            <div class="mb-4">
                <x-label for="cvc" value="{{ __('Código de seguridad (CVV)') }}" class="text-zinc-800" />
                <x-input id="cvc" class="w-24 block mt-1" type="password" name="cvc" maxlength="4"
                    wire:model.defer="cvc" required autofocus />
                <x-input-error for="cvc" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex">
                <x-secondary-button wire:click="cancelar" wire:target="cancelar" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                    Agrega tu tarjeta
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>

</div>
