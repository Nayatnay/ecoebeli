<div>
    <div class="text-base md:text-lg font-medium text-lime-700">
        <p wire:click="$set('open', true)" class="cursor-pointer inline-block  hover:underline">
            <i class="fa-solid fa-money-bill mr-1"></i>
            Agregar información del pago
        </p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b text-zinc-800">Registrar Pago</p>
        </x-slot>

        <x-slot name="content" class="">

            <div class="flex items-center">
                <div class="flex items-center mr-2">
                    <x-input type="radio" id="transferencia" onclick="HiddenTelf();" name="tipo_pago"
                        wire:model.defer="tipo_pago" value="0" class="mr-2 text-orange-600" required />
                    <x-label for="transferencia" value="Transferencia" class="text-zinc-800" />
                </div>

                <div class="flex items-center ml-2">
                    <x-input type="radio" id="pagomovil" onclick="ShowTelf();" name="tipo_pago"
                        wire:model.defer="tipo_pago" value="1" class="mr-2 text-orange-600" required />
                    <x-label for="pagomovil" value="Pago móvil" class="text-zinc-800" />
                </div>
            </div>
            <x-input-error for="tipo_pago" />

            <div class="mt-8 mb-4">
                <x-label for="referencia" value="{{ __('Nº Referencia') }}" class="ml-4 text-zinc-800" />
                <x-input id="referencia"
                    class="w-full text-sm block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    type="number" step="any" name="referencia" wire:model.defer="referencia" required />
                <x-input-error for="referencia" />
            </div>

            <div class="mb-4 w-full md:w-1/2">
                <x-label for="banco" value="{{ __('Banco Emisor') }}" class="ml-4 text-zinc-800" />
                <select name="banco" wire:model.defer="banco"
                    class=" text-sm pl-4 block mt-1 w-full text-gray-800 border-gray-200 focus:border-gray-300 focus:ring-0 rounded-md shadow-sm'"
                    type="text" name="banco" :value="old('banco')" required autocomplete="banco">
                    <option value="">Banco</option>
                    <option value="0001-BCV">0001 - Banco Central de Venezuela</option>
                    <option value="0102-BDV">0102 - Banco de Venezuela S.A. Banco Universal</option>
                    <option value="0104-BVC">0104 - Venezolano de Crédito S.A. Banco Universal</option>
                    <option value="0105-MERCANTIL">0105 - Banco Mercantil, C.A Banco Universal</option>
                    <option value="0108-BBVA">0108 - Banco Provincial, S.A. Banco Universal</option>
                    <option value="0114-BANCARIBE">0114 - Bancaribe C.A. Banco Universal</option>
                    <option value="0115-BE-EXTERIOR">0115 - Banco Exterior C.A. Banco Universal</option>
                    <option value="0128-CARONI">0128 - Banco Caroní C.A. Banco Universal</option>
                    <option value="0134-BANESCO">0134 - Banesco S.A.C.A. Banco Universal</option>
                    <option value="0137-SOFITASA">0137 - Banco Sofitasa C.A. Banco Universal</option>
                    <option value="0151-BFC">0151 - BFC Banco Fondo Común C.A. Banco Universal</option>
                    <option value="0156-100%BANCO">0156 - 100% Banco, C.A. Banco Universal</option>
                    <option value="0157-DELSUR">0157 - DelSur, C.A. Banco Universal</option>
                    <option value="0163-DELTESORO">0163 - Banco del Tesoro, C.A. Banco Universal</option>
                    <option value="0166-AGRICOLA">0166 - Banco Agrícola de Venezuela, C.A Banco Universal</option>
                    <option value="0168-BANCRECER">0168 - Bancrecer, S.A. Banco Microfinanciero</option>
                    <option value="0172-BANCAMIGA">0172 - Bancamiga, C.A. Banco Microfinanciero</option>
                    <option value="0174-BANPLUS">0174 - Banplus, C.A. Banco Universal</option>
                    <option value="0175-BICENTENARIO">0175 - Banco Bicentenario C.A. Banco Universal</option>
                    <option value="0177-BANFANB">0177 - Banco de la Fuerza Armada Nacional Bolivariana BANFANB
                        Banco
                        Universal</option>
                    <option value="0190-CITIBANK">0190 - Citibank N.A. Banco Universal</option>
                    <option value="0191-BNC">0191 - Banco Nacional de Crédito, C.A. Banco Universal</option>
                    <option value="0601-IMCP">0601 - Instituto Municipal de Crédito Popular Institución
                        Financiera
                    </option>
                </select>
                <x-input-error for="banco" />
            </div>

            <div class="mb-4" id="divtelf">
                <x-label for="codigo" value="{{ __('Teléfono Emisor') }}" class="ml-4 text-zinc-800" />

                <div class="flex">
                    <select name="codigo" id="codigo"
                        class="w-28 text-sm pl-4 block mt-1 text-gray-800 border-gray-200 focus:border-gray-300 focus:ring-0 rounded-md shadow-sm'"
                        type="text" name="codigo" :value="old('codigo')" wire:model.defer="codigo"
                        autocomplete="codigo">
                        <option value="0">Código</option>
                        <option value="0412">0412</option>
                        <option value="0414">0414</option>
                        <option value="0416">0416</option>
                        <option value="0424">0424</option>
                        <option value="0426">0426</option>
                    </select>
                    <x-input id="telf"
                        class="w-32 text-sm block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                        type="number" step="any" name="telf" wire:model.defer="telf" />
                </div>
                <x-input-error for="telf" />
            </div>

            <div class="mb-4  w-full md:w-60">
                <x-label for="fecha" value="{{ __('Fecha de pago') }}" class="ml-4 text-zinc-800" />
                <x-input id="fecha" class="text-sm w-full block mt-1" type="date" name="fecha"
                    wire:model="fecha" required />
                <x-input-error for="fecha" />
            </div>

            <div class="mb-4  w-full md:w-60">
                <x-label for="total" value="{{ __('Monto') }}" class="ml-4 text-zinc-800" />
                <x-input id="total" value=""
                    class="w-full text-sm block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    type="number" step="any" name="total" wire:model="total" required />
                <x-input-error for="total" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex">
                <x-secondary-button wire:click="cancelar" wire:target="cancelar" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="pagar" wire:loading.attr="disabled" wire:target="pagar">
                    Registrar tu Pago
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>
<!--
    <script>
        window.addEventListener('load', function() {
            var transf = document.getElementById("transferencia");
            var pagmo = document.getElementById("pagomovil");

            if (transf.checked == false && pagmo.checked == false) {
                document.getElementById("divtelf").style.display = "none";
            } else {

                if (transf.checked == true) {
                    document.getElementById("divtelf").style.display = "none";
                }
                if (pagmo.checked == true) {
                    document.getElementById("divtelf").style.display = "block";
                }
            }
        });
    </script>
-->
    <script>
        function HiddenTelf() {
            document.getElementById("divtelf").style.display = "none";
        };
    </script>

    <script>
        function ShowTelf() {
            document.getElementById("divtelf").style.display = "block";
        };
    </script>

</div>
