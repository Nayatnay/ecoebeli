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

                <div class="w-full mt-4 border border-lime-600 min-h-0 overflow-auto rounded-lg text-base">

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
                                    <td class="px-2 w-48 text-right text-lime-600">
                                        {{ number_format($ventas->total, 2, ',', '.') }} BS.
                                    </td>
                                    <td
                                        class="bg-lime-600 border border-gray-300 text-white px-2 w-40 text-sm font-medium text-center">
                                        <a href="#" wire:click="alerta({{ $ventas }})"
                                            title="Marcar como conciliado" class="hover:underline">
                                            Conciliar
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

                <div class="w-full mt-4 border min-h-0 overflow-auto rounded-lg text-base">

                    <table
                        class="table-fixed bg-white w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                        <tbody class="text-left text-base">

                            @foreach ($ventascon as $ventasc)
                                <tr class="h-8 odd:bg-gray-50">
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
                                    <td class="px-2 w-40 text-sm text-center"></td>
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
                    <p class="text-2xl text-lime-700 font-medium">{{number_format($ventasconmes, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">CONCILIADAS</p>
                </div>
                <div class="my-4 md:my-0">
                    <p class="text-2xl text-lime-700 font-medium">{{number_format($ventassinmes, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 font-medium">PENDIENTES DE CONCILIACION</p>
                </div>
                <div>
                    <p class="text-2xl text-lime-700 font-medium">{{number_format($totproductos, 0, ',', '.') }}</p>
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

            <x-danger-button wire:click="conciliar" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                Sí, Conciliar el pago
            </x-danger-button>
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

</div>
