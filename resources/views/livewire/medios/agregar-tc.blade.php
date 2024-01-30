<div>
    <div class="text-xs md:text-sm font-normal text-orange-600 hover:underline">
        <p wire:click="$set('open', true)" class="cursor-pointer">
            <i class="fa-regular fa-credit-card mr-4"></i>
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
                <select name="mes" id="mes"
                    class="text-xs font-medium rounded-lg border-gray-300 focus:ring-0 focus:outline-none hover:cursor-pointer p-2 text-black"
                    onchange="ShowSelected();">
                    @for ($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <select name="ano" id="ano"
                    class="text-xs font-medium rounded-lg border-gray-300 focus:ring-0 focus:outline-none hover:cursor-pointer p-2 text-black"
                    onchange="ShowSelected();">
                    @for ($i = 2024; $i < 2045; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <x-input id="vencimiento" type="text" name="vencimiento" wire:model.defer="vencimiento"/>
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
                    Aceptar
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>

    <script>
        function ShowSelected() {
            /* Para obtener el valor */
            var cod = document.getElementById("mes").value;
            var cod = document.getElementById("ano").value;
            /* Para obtener el texto */
            var combo = document.getElementById("mes");
            var combodos = document.getElementById("ano");

            var selected = combo.options[combo.selectedIndex].text + '/' + combodos.options[combodos.selectedIndex].text;
            //alert(selected);
            document.getElementById("vencimiento").value = selected;
            document.getElementById("vencimiento").text = selected;
        }
    </script>

</div>
