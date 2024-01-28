<div>
    <div class="text-xs font-bold hover:underline">
        <p wire:click="$set('open', true)" class="cursor-pointer">Ver los Medios de Pago</p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            <div class="mb-8">
                <p class="text-2xl">Medios de pago para este producto</p>
            </div>

        </x-slot>

        <x-slot name="content">

            <p class="text-lg font-medium"><i class="fa-solid fa-dollar-sign mr-4"></i>Pago a acordar con el vendedor</p>

            <p class="my-4">Ponte en contacto con el vendedor para conocer los medios de pago que acepta además de los
                indicados a continuacion.
            </p>

            <p class="text-lg font-medium">Transferencia Bancaria Banesco</p>

            <p class="my-4">Cuenta corriente 0134-2563-52-3645212352. De de Ebeli.com Ecommerce personal. Código de
                Identificacion Fiscal RIF. J-30521685-9
            </p>

            <p class="text-lg font-medium">Tarjetas de Crédito Visa/Mastercard/American Express</p>

            <p class="my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta repudiandae debitis sit
                voluptatibus,
            </p>

            <p class="text-lg font-medium">Tarjetas de Débito Internacional</p>

            <p class="my-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur molestiae dolor
                aliquam reprehenderit
            </p>

            <p class="text-lg font-medium">Plataformas PayPal/AirTM</p>

            <p class="my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed temporibus id tenetur vel,
                aspernatur
                dolorum
            </p>

        </x-slot>

        <x-slot name="footer">
            <p wire:click="$set('open', false)" class="cursor-pointer">Cerrar</p>
        </x-slot>

    </x-dialog-modal>

</div>
