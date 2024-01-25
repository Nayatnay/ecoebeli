<div>
    <div class="text-xs font-semibold text-orange-600 hover:underline">
        <p wire:click="$set('open', true)" class="cursor-pointer">Ver Medios de Pago para este Producto</p>
    </div>

    <!--Modal crear -->
    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            <div class="mb-8">
                <p class="text-2xl">Medios de pago para este producto</p>
            </div>

        </x-slot>

        <x-slot name="content">

            <p class="text-lg font-medium"><i class="fa-solid fa-dollar-sign mr-4"></i>Tarjetas de Crédito Visa/Mastercard/American Express</p>

            <p class="my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta repudiandae debitis sit
                voluptatibus,
                non quisquam consequuntur nemo dolores culpa quod sint tempore voluptatum enim eum, labore eaque qui
                alias voluptas!
            </p>

            <p class="text-lg font-medium">Tarjetas de Débito Internacional</p>

            <p class="my-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur molestiae dolor
                aliquam reprehenderit
                nihil consectetur dignissimos, iusto asperiores adipisci. Voluptates veritatis atque voluptatem odio
                adipisci expedita iusto repellendus tempora esse?</p>

            <p class="text-lg font-medium">Plataformas PayPal/AirTM</p>

            <p class="my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed temporibus id tenetur vel,
                aspernatur
                dolorum
                tempora quibusdam numquam similique iure iusto fuga sint quae, quo consequuntur nemo nobis accusantium.
                Quas.
            </p>
        </x-slot>

        <x-slot name="footer">
            <p wire:click="$set('open', false)" class="cursor-pointer">Cerrar</p>
        </x-slot>

    </x-dialog-modal>

</div>