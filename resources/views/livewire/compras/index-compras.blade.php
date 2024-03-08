@section('title', 'Compras | Ebeli')
<div class="bg-gray-100">

    <div class="shadow bg-gray-50">
        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            @if (\Cart::getTotalQuantity() == 1)
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mi Compra de <strong class="text-lime-700 ml-1">{{ \Cart::getTotalQuantity() }}
                        artículo</strong>
                </h2>
            @else
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mi Compra de <strong class="text-lime-700 ml-1">{{ \Cart::getTotalQuantity() }}
                        artículos</strong>
                </h2>
            @endif
        </div>
    </div>

    <!-- Cuerpo de Compras -->

    <div class="min-h-screen">


        <div class="max-w-screen-xl mx-auto p-4 flex flex-col md:flex-row justify-between mt-8 mb-4">

            <div class="w-full md:mr-2 p-2 md:p-4 rounded-lg bg-white border border-gray-200">

                <div class="w-full text-base p-4">
                    <div class="flex flex-col md:flex-row border-b border-gray-300 pb-4">
                        <div class="font-bold md:mr-6">
                            <p>1. Dirección para el envío</p>
                        </div>
                        <div class="text-gray-600 text-sm mt-2 md:mt-0 ml-5 md:ml-0">
                            <p class="uppercase">{{ Auth::user()->name }} </p>
                            <p> {{ Auth::user()->pais }}-{{ Auth::user()->estado }}-{{ Auth::user()->ciudad }}</p>
                            <p>{{ Auth::user()->direccion }} - CP.{{ Auth::user()->cp }}</p>
                        </div>
                    </div>

                </div>

                <div class="w-full p-4 text-base">
                    <p class="font-bold">2. Método de pago</p>
                    <div class="flex justify-between text-sm font-medium border-b border-gray-300 pb-2 mb-2">
                        <p class="w-full sm:basis-2/5"></p>
                        <p class="hidden sm:block w-full sm:basis-2/5">Nombre en la Tarjeta</p>
                        <p class="hidden sm:block basis-1/5 text-right">Vencimiento</p>
                    </div>
                    @foreach ($medios as $medio)
                        <div class="py-1">
                            <div class="hidden sm:flex items-center justify-between text-sm text-gray-700">
                                @if (substr($medio->codigo, 0, 1) == 3)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal"><strong>American
                                            Express</strong> que termina en
                                        {{ substr($medio->codigo, -4) }}
                                    </p>
                                @endif
                                @if (substr($medio->codigo, 0, 1) == 4)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal"><strong>Visa</strong> que
                                        termina en
                                        {{ substr($medio->codigo, -4) }}
                                    </p>
                                @endif
                                @if (substr($medio->codigo, 0, 1) == 5)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal">
                                        <strong>Mastercard</strong>
                                        que termina en
                                        {{ substr($medio->codigo, -4) }}
                                    </p>
                                @endif
                                @if (substr($medio->codigo, 0, 1) != 3 && substr($medio->codigo, 0, 1) != 4 && substr($medio->codigo, 0, 1) != 5)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal"><strong>Tarjeta</strong>
                                        que
                                        termina en
                                        {{ substr($medio->codigo, -4) }}
                                    </p>
                                @endif
                                <p class="hidden sm:block basis-2/5"> {{ $medio->nombre }}</p>
                                @if (substr($medio->vencimiento, 0, 1) == 'V')
                                    <p class="hidden sm:block basis-1/5 text-right text-lime-700 font-bold text-xs">
                                        {{ $medio->vencimiento }}</p>
                                @else
                                    <p class="hidden sm:block basis-1/5 text-right">{{ $medio->vencimiento }}</p>
                                @endif

                                <a href="#" wire:click="edit({{ $medio }})" title="Actualizar"
                                    class="text-center text-lg text-lime-700 ml-2 px-1 hover:bg-gray-200 rounded-sm">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>

                            </div>
                            <div class="sm:hidden block w-full text-sm">
                                @if (substr($medio->codigo, 0, 1) == 3)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal">American
                                        Express <strong>...{{ substr($medio->codigo, -4) }}</strong>
                                    </p>
                                @endif
                                @if (substr($medio->codigo, 0, 1) == 4)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal">Visa
                                        <strong>...{{ substr($medio->codigo, -4) }}</strong>
                                    </p>
                                @endif
                                @if (substr($medio->codigo, 0, 1) == 5)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal">Mastercard
                                        <strong>...{{ substr($medio->codigo, -4) }}</strong>
                                    </p>
                                @endif
                                @if (substr($medio->codigo, 0, 1) != 3 && substr($medio->codigo, 0, 1) != 4 && substr($medio->codigo, 0, 1) != 5)
                                    <p class="w-full sm:basis-2/5 font-medium sm:font-normal">Tarjeta
                                        <strong>...{{ substr($medio->codigo, -4) }}</strong>
                                    </p>
                                @endif
                                @if (substr($medio->vencimiento, 0, 1) == 'V')
                                    <p>{{ $medio->nombre }} - <strong
                                            class="text-lime-700 text-xs">{{ $medio->vencimiento }}</strong></p>
                                @else
                                    <p>{{ $medio->nombre }} - {{ $medio->vencimiento }}</p>
                                @endif

                                <a href="#" wire:click="edit({{ $medio }})" title="Actualizar"
                                    class="text-center text-lg text-lime-700 ml-2 px-1 hover:bg-gray-200 rounded-sm">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4">
                    @livewire('medios.agregar-tc')
                </div>

                <div class="p-4 border-t text-sm text-justify">
                    <p>Para <strong>tramitar su pago desde Venezuela</strong> hágalo a través de la Banca
                        <strong>Banesco Banca Universal,</strong> con transferencia o pago móvil
                        a la cuenta 0134-0426-77-5236-541234, Telf. 0414.1823819. Titular de la cuenta
                        <strong>Ebeli, C.A. </strong> Registro de Identificación Fiscal J-30621425-8.
                    </p>
                    <div class="mt-4 text-xs font-medium">
                        <span>Para utilizar otros medios de pago </span>
                        <a href="https://wa.me/+584126067734?text=Hola. Me gustaria conocer los medios de pago que acepta además de los indicados en la web."
                            target="_blank" class="text-lime-700 hover:underline">Contacte al vendedor +58-4126067734
                        </a>
                    </div>

                </div>

            </div>

            <div>
                <div class="border border-gray-200 rounded-lg mt-4 md:mt-0 md:ml-2 w-full md:w-[280px] bg-white">
                    <div class="px-4 py-3  border-b border-gray-200 rounded-t-lg">
                        <p class="text-lg font-bold">Orden de Compra</p>
                        <p class="text-xs">Puedes completar la compra de tus {{ \Cart::getTotalQuantity() }} artículos
                            o
                            revisar y editar tu pedido antes de que sea definitivo.</p>
                    </div>
                    <div class="p-4 text-sm">
                        <div class="flex justify-between ">
                            <p>Total pedido:</p>
                            <p>US$ {{ number_format(\Cart::getSubtotal(), 2, '.', '.') }}</p>
                        </div>
                        <div class="flex justify-between my-2">
                            <p>Envío:</p>
                            <p class=""> US$ {{ number_format(0, 2, '.', '.') }}</p>
                        </div>
                        <div class="flex justify-between border-b pb-4">
                            <p>Impuestos:</p>
                            <p class=""> US$ {{ number_format(0, 2, '.', '.') }}</p>
                        </div>
                        <div class="flex justify-between text-lg font-medium pt-4 text-lime-700">
                            <p>Total Pedido:</p>
                            <p class=""> US$ {{ number_format(\Cart::getSubtotal(), 2, '.', '.') }}</p>
                        </div>
                    </div>
                    <div class="p-4 border-t border-gray-200 rounded-b-lg">
                        @livewire('medios.mediosde-pago')
                        <a href="https://wa.me/+584126067734?text=Hola. Me gustaria conocer los medios de pago que acepta además de los indicados en la web."
                            target="_blank" class="hover:underline text-xs">Contacto en Venezuela +58-4126067734
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registro de pago -->

        <div class="max-w-screen-xl mx-auto p-4 my-6">

            <div class="w-full p-6 md:p-8 rounded-lg bg-white border border-gray-200">
                @if (\Cart::getSubtotal() != 0)
                    @if ($bolivares == 0)
                        <div class="font-bold pb-4 border-b">
                            <p>3. Registrar el pago <i class="fa-regular fa-bell text-orange-600 ml-4"></i></p>
                        </div>
                        <div class="my-4 text-sm">
                            <p>La opción para registrar su pago estará activa en pocos minutos.</p>
                        </div>
                    @else
                        <div class="font-bold pb-4 border-b">
                            <p>3. Registrar el pago</p>
                        </div>

                        <div class="my-8">
                            <div class="mb-6 text-sm">
                                Asegúrate de realizar tu pago por el monto exacto a la tasa del día.
                                Tu pago pendiente en moneda nacional es de
                                <strong> Bs. {{ number_format($bolivares, 2, '.', '.') }} </strong>
                            </div>
                            @livewire('compras.registrar-pago')
                        </div>
                    @endif
                @else
                    <div class="font-bold pb-4 border-b">
                        <p>3. Registrar el pago</p>
                    </div>

                    <div class="my-6 text-base md:text-xl md:pl-4">
                        <p class="font-medium mb-4 text-lime-700">Sin pagos pendientes</p>
                        <p class="text-xs md:text-base font-normal text-gray-700 text-justify">Llena tu carrito con
                            los
                            artículos de tu
                            preferencia, ropa, artículos para el hogar,
                            electrónicos, y más. Continúa comprando en <a href="{{ route('admintienda') }}"
                                class="text-lime-700 underline font-medium">tu tienda.</a></p>
                    </div>
                @endif

            </div>

        </div>

        <!-- Historial de compras -->

        <div class="max-w-screen-xl mx-auto md:mt-6 mb-20 p-4">

            <div class="bg-white rounded-lg p-4">

                <p class="mt-4 px-2 md:px-4 text-2xl font-bold">Historial de Compras</p>

                @if ($producto_comprado->count())

                    <div class="md:p-4">
                        @php
                            $idcompra = 0;
                        @endphp
                        @foreach ($producto_comprado as $product)
                            @if ($idcompra != $product->id_venta)
                                @php
                                    $idcompra = $product->id_venta;
                                @endphp

                                <div class="pt-4 border-t mt-8">
                                    <div class="flex flex-wrap text-xs">

                                        @if ($product->venta->tipo_pago == 0)
                                            <p class="font-medium ml-2">Transferencia Bancaria - Ref.
                                                {{ $product->venta->referencia }}</p>
                                        @else
                                            <p class="font-medium ml-2">Pago Móvil Bancario - Ref.
                                                {{ $product->venta->referencia }}</p>
                                        @endif
                                        <p class="ml-2">desde el banco {{ $product->venta->banco }}.</p>
                                        @if ($product->venta->tipo_pago == 1)
                                            <p class="ml-2">Teléfono:
                                                {{ $product->venta->codigo }}-{{ $product->venta->telf }}.</p>
                                        @endif
                                        <p class="ml-2">Registrado el día
                                            {{ date('d-m-Y', strtotime($product->venta->fecha)) }}</p>
                                    </div>
                                    <div class="flex items-center justify-between font-bold text-sm ">
                                        <p class="mx-2 text-lime-700">Total pagado Bs.
                                            {{ number_format($product->venta->total, 2, ',', '.') }}
                                        </p>
                                        @if ($product->venta->reporte == 1)
                                            <p class="text-xs rounded-md p-2 font-normal hover:underline cursor-pointer text-orange-600"
                                                wire:click="vereport({{ $product->id_venta }})">
                                                <i class="fa-regular fa-star mr-1 "></i>
                                                Reporte en Proceso
                                            </p>
                                        @else
                                            <p class="text-xs text-lime-700 font-normal hover:underline cursor-pointer"
                                                wire:click="contactar({{ $product->id_venta }})">
                                                <i class="fa-regular fa-message mr-1"></i>
                                                Informar problema con esta compra
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            @endif


                            <div class="flex items-center ml-2 my-4">

                                <div class="w-[160px] mr-2 md:mr-4 ">
                                    <img src="{{ asset('/storage/productos/' . $product->producto->imagen) }}"
                                        alt="" title="" class="rounded md:w-[160px]">
                                </div>

                                <div class="">
                                    <p
                                        class="inline-block bg-lime-700 text-white rounded font-bold text-center text-sm md:text-lg px-2 mb-2 capitalize">
                                        {{ $product->producto->nombre }}</p>
                                    <div class="text-xs md:text-sm">
                                        <p class="hidden md:block">{{ $product->producto->descripcion }}</p>
                                        <p>{{ $product->cantidad }} unidades / <strong
                                                class="text-lime-700">{{ $product->precio }} USD por
                                                unidad</strong>
                                        </p>
                                    </div>


                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                        <span>Sin resultados </span>
                    </div>
                @endif

                @if ($producto_comprado->hasPages())
                    <div class="md:w-1/2 mx-auto px-4 py-2 text-center my-20">
                        {{ $producto_comprado->onEachSide(0)->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <x-Identificate></x-Identificate>


    <!--            pie de pagina FOOTER               -->

    <x-footer></x-footer>

    <!--Modal edit -->

    <x-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b">Actualizar medio de pago</p>
        </x-slot>

        <x-slot name="content">

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

        </x-slot>

        <x-slot name="footer">
            <div class="flex">
                <x-secondary-button wire:click="$set('open_edit', false)" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>

    <!--Modal reporte -->

    <x-reportar-modal wire:model="open_reporte">

        <x-slot name="title">
            <p>Informar un problema</p>
            <p class="text-xs font-extrabold cursor-pointer" wire:click="cancelar"><i class="fa-solid fa-x"></i></p>
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-label for="problema" value="{{ __('¿Cuál es el problema con esta compra?') }}"
                    class="text-zinc-800 font-medium " />
                <select name="problema" id="problema" wire:model="problema" onchange="fntnpro()" required
                    class="w-full mt-2 p-2 text-xs rounded-md border font-medium text-zinc-600 border-gray-200 focus:border-gray-300 focus:ring-0">
                    <option class="text-xs md:text-sm bg-gray-100" value="0">Selecciona el tipo de problema
                    </option>
                    <option class="text-xs md:text-sm" value="1">No he recibido el producto</option>
                    <option class="text-xs md:text-sm" value="2">El producto llegó dañado</option>
                    <option class="text-xs md:text-sm" value="3">Otro</option>
                </select>
                <x-input-error for="problema" />
            </div>

            <div id="detalleprob" class="hidden w-full">
                <x-label for="detalle" value="{{ __('Explique el problema con esta compra') }}"
                    class="text-zinc-800 font-medium " />

                    <div class="bg-red-100">
                        <textarea name="detalle" wire:model="detalle"
                    class="mt-2 w-full text-xs rounded-md border-l-8 
                     text-zinc-600 focus:ring-0">
                    </textarea>
                    </div>
                

            </div>

        </x-slot>

        <x-slot name="footer">
            <button wire:click="enviar" class="px-4 py-1 rounded-md text-white bg-lime-600 hover:text-black hover:bg-lime-500">
                Enviar
            </button>
        </x-slot>

    </x-reportar-modal>

    <!--Modal motivo del reporte -->

    <x-reportmsg-modal wire:model="open_mssg">

        <x-slot name="title">
            <p><i class="fa-solid fa-circle-exclamation mr-2"></i>Reporte</p>
            <p class="text-xs font-extrabold cursor-pointer" wire:click="$set('open_mssg', false)"><i
                    class="fa-solid fa-x"></i></p>
        </x-slot>

        <x-slot name="footer">
            <p class="text-xs ">* Su solicitud <strong>{{ $this->mssg }}</strong> está siendo atendida. ¡Gracias por su confianza!</p>
        </x-slot>

    </x-reportmsg-modal>

    <!------------------------------------------------------>

    <script>
        function fntnpro() {
            var opcion = document.getElementById("problema").value;
            if (opcion == 3) {
                document.getElementById("detalleprob").style.display = "block";
            } else {
                document.getElementById("detalleprob").style.display = "none";
            }
        }
    </script>

    @if (session('info') == 'ok')
        <script>
            Swal.fire({
                title: '¡Gracias!',
                text: 'Su pago ha sido registrado con éxito. La orden de despacho ya fue generada. Esté atento a su correo electrónico.',
                confirmButtonColor: '#4b7b18',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    <script>
        const input = document.getElementById("codigo");

        input.addEventListener("input", function() {
            const inputValue = this.value.replace(/\s/g, ""); // quitamos todos los espacios encontrados...
            if (inputValue !== "") {
                const result = inputValue.match(/.{1,4}/g).join(
                    " "); // y agregamos un espacio cada 4 caracteres, uso join(" ") para quitar las comas...
                this.value = result; // Y el valor del input será la cadena modificada.
            }
        });
    </script>

</div>
