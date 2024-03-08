@section('title', 'Pagos recibidos | Ebeli')
<div>
    <div class="bg-white shadow">
        <div class="p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pagos Recibidos
            </h2>

        </div>
    </div>

    <div class="p-4 max-w-screen-xl mx-auto min-h-screen">

        <div class="border-b border-gray-300 my-10 pb-20">


            <div class="pl-4">
                Cociliaciones Pendientes
            </div>

            @if ($ventassin->count())

                <div class="w-full mt-4 border border-zinc-800 min-h-0 overflow-auto rounded-lg text-base">

                    <table
                        class="rounded-lg table-fixed w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                        <tbody class="text-left text-base">

                            @foreach ($ventassin as $ventas)
                                <tr class="h-10 odd:bg-gray-50">
                                    <td class="pl-2 w-28">{{ date('d-m-Y', strtotime($ventas->fecha)) }}</td>
                                    @if ($ventas->tipo_pago == 0)
                                        <td class="pl-2 w-48">Transferencia Bancaria</td>
                                    @else
                                        <td class="pl-2 w-48 text-lime-600">Pago Móvil Bancario</td>
                                    @endif
                                    <td class="pl-2 w-48">{{ $ventas->banco }}</td>
                                    <td class="pl-2 w-48">{{ $ventas->referencia }}</td>
                                    @if ($ventas->tipo_pago == 0)
                                        <td class="pl-2 w-40"></td>
                                    @else
                                        <td class="pl-2 w-40">{{ $ventas->codigo }}-{{ $ventas->telf }}</td>
                                    @endif
                                    <td class="px-2 w-32 text-right text-lime-600">
                                        {{ number_format($ventas->total, 2, ',', '.') }} BS.
                                    </td>
                                    <td
                                        class="px-1 w-20 text-sm font-bold text-center">
                                        <a href="#" wire:click="alerta({{ $ventas }})"
                                            title="Marcar como conciliado" class="hover:underline">
                                            Conciliar
                                        </a>
                                    </td>
                                    <td
                                        class="text-lime-500 px-1 w-10 text-sm font-medium text-center">
                                        <a href="#" wire:click="contactar({{ $ventas }})" title="Contactar"
                                            class="hover:text-lime-600">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </td>
                                    <td
                                        class="bg-zinc-800 text-white px-1 w-8 text-sm font-medium text-center">
                                        <a href="{{route('venta', $ventas)}}" title="Detalles"
                                            class="hover:text-lime-400">
                                            <i class="fa-solid fa-ellipsis-vertical p-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-4 bg-white text-sm font-semibold sm:px-10 px-5 py-2 shadow">
                    <span>No hay pagos por conciliar </span>
                </div>
            @endif

            @if ($ventassin->hasPages())
                <div class="mt-4 px-4 py-2 text-center ">
                    {{ $ventassin->onEachSide(0)->links() }}
                </div>
            @endif
        </div>

        <!--Pagos cociliados -->

        <div class="mt-10">
            <div class="mt-10 pl-4">
                Pagos Conciliados
            </div>

            @if ($ventascon->count())

                <div class="w-full mt-4 border border-zinc-800 min-h-0 overflow-auto rounded-lg text-base">

                    <table
                        class="table-fixed bg-white w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                        <tbody class="text-left text-base">

                            @foreach ($ventascon as $ventasc)
                                <tr class="h-10 odd:bg-gray-50">
                                    <td class="pl-2 w-28">{{ date('d-m-Y', strtotime($ventasc->fecha)) }}</td>
                                    @if ($ventasc->tipo_pago == 0)
                                        <td class="pl-2 w-48">Transferencia Bancaria</td>
                                    @else
                                        <td class="pl-2 w-48 text-lime-600">Pago Móvil Bancario</td>
                                    @endif
                                    <td class="pl-2 w-48">{{ $ventasc->banco }}</td>
                                    <td class="pl-2 w-48">{{ $ventasc->referencia }}</td>
                                    @if ($ventasc->tipo_pago == 0)
                                        <td class="pl-2 w-40"></td>
                                    @else
                                        <td class="pl-2 w-40">{{ $ventasc->codigo }}-{{ $ventasc->telf }}</td>
                                    @endif
                                    <td class="px-2 w-48 text-lime-600 text-right">Bs.
                                        {{ number_format($ventasc->total, 2, ',', '.') }}
                                    </td>
                                    <td class="px-1 w-20 text-sm font-bold text-center"></td>
                                    <td
                                        class="text-lime-500 px-1 w-10 text-sm font-medium text-center">
                                        <a href="#" wire:click="contactar({{ $ventasc }})" title="Contactar"
                                            class="hover:text-lime-600">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </td>
                                    <td
                                        class="bg-zinc-800 text-white px-1 w-8 text-sm font-medium text-center">
                                        <a href="{{route('venta', $ventasc)}}" title="Detalles"
                                            class="hover:text-lime-400">
                                            <i class="fa-solid fa-ellipsis-vertical p-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-4 bg-white text-sm font-semibold sm:px-10 px-5 py-2 shadow">
                    <span>No hay pagos conciliados </span>
                </div>
            @endif

            @if ($ventascon->hasPages())
                <div class="mt-4 px-4 py-2 text-center ">
                    {{ $ventascon->onEachSide(0)->links() }}
                </div>
            @endif
        </div>

        <div class="max-w-screen-xl mx-auto w-full mt-12 text-center">

            <div class="py-4 border-b">
                <p>VENTAS DEL ULTIMO MES</p>
            </div>

            <div class="flex flex-col md:flex-row justify-around py-4 border-b">
                <div>
                    <p class="text-2xl text-lime-700 font-medium">{{ number_format($ventasconmes, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">CONCILIADAS</p>
                </div>
                <div class="my-4 md:my-0">
                    <p class="text-2xl text-lime-700 font-medium">{{ number_format($ventassinmes, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">PENDIENTES DE CONCILIACION</p>
                </div>
                <div>
                    <p class="text-2xl text-lime-700 font-medium">{{ number_format($totproductos, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">PRODUCTOS</p>
                </div>
            </div>
        </div>


        <div class="max-w-screen-xl mx-auto w-full my-14">

            <form action="" wire:submit="consultar" class="flex flex-col items-center p-2 rounded">
                <p class="px-4">CONSULTA OTROS TOTALES</p>
                <input type="month" name="fecha" id="fecha" value="" wire:model="fecha"
                    class="border-none focus:ring-0 bg-white mt-4 mb-8" required>
                <button type="submit" class="border p-2 bg-lime-600 text-white w-full rounded">
                    Consultar
                </button>
            </form>
        </div>

    </div>

    <!-- pie de pagina FOOTER -->

    <x-footer></x-footer>

    <!--Modal conciliar -->

    <x-confirmation-modal wire:model="open">

        <x-slot name="title">
            Esta acción no podrá ser reversada
        </x-slot>

        <x-slot name="content">
            ¿Ha verificado que el pago ha sido cargado en sus cuentas?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancelar
            </x-secondary-button>

            <x-advert-button wire:click="conciliar" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                Sí, Conciliar el pago
            </x-advert-button>
        </x-slot>
    </x-confirmation-modal>

    <!--Modal totales -->

    <x-confirm-modal wire:model="open_totales">

        <x-slot name="title">
            <p class="text-lime-700">Ventas de {{ date('M-Y', strtotime($this->fecha)) }}</p>
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-around text-center">
                <div>
                    <p class="text-xl font-bold text-lime-700">{{ number_format($this->totalescon, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">CONCILIADAS</p>
                </div>
                <div class="my-4 md:my-0 mx-6 md:border-x px-4">
                    <p class="text-xl font-bold text-lime-700">{{ number_format($this->totalessin, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">PENDIENTES DE CONCILIACION</p>
                </div>
                <div>
                    <p class="text-xl font-bold text-lime-700">{{ number_format($this->totalespro, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">PRODUCTOS</p>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open_totales', false)">
                Cerrar
            </x-secondary-button>

        </x-slot>
    </x-confirm-modal>

    <!--Modal reporte -->

    <x-reportar-modal wire:model="open_reporte">

        <x-slot name="title">
            <p>Reportar un problema</p>
            <p class="text-xs font-extrabold cursor-pointer" wire:click="cancelar"><i class="fa-solid fa-x"></i></p>
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-label for="problema" value="{{ __('¿Cuál es el problema con este pago?') }}"
                    class="text-zinc-800 font-medium " />
                <select name="problema" id="problema" wire:model="problema" onchange="fntnpro()"
                    class="w-full mt-2 p-2 text-xs rounded-md border font-medium text-zinc-600 border-gray-200 focus:border-gray-300 focus:ring-0">
                    <option class="text-xs md:text-sm bg-gray-100" value="0">Selecciona el tipo de problema
                    </option>
                    <option class="text-xs md:text-sm" value="1">No registrado en cuenta
                    </option>
                    <option class="text-xs md:text-sm" value="2">Monto inferior al indicado en la orden</option>
                    <option class="text-xs md:text-sm" value="3">Otro</option>
                </select>
                <x-input-error for="problema" />
            </div>

            <div id="detalleprob" class="hidden w-full">
                <x-label for="detalle" value="{{ __('Explique el problema con este pago') }}" class="text-zinc-800 font-medium " />
                
                    <textarea name="detalle" wire:model="detalle"
                    class="mt-2 w-full text-xs rounded-md border-l-8 
                     text-zinc-600 focus:ring-0">
                    </textarea>
                
            </div>

        </x-slot>

        <x-slot name="footer">
            <button wire:click="enviar" class="px-4 py-1 rounded-md text-white bg-lime-600 hover:text-black hover:bg-lime-500">
                Enviar
            </button>
        </x-slot>

    </x-reportar-modal>

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

</div>
