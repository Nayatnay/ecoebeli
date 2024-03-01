@section('title', 'Pagos recibidos | Ebeli')
<div>
    <div class="bg-white shadow">
        <div class="p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pagos Recibidos
            </h2>

        </div>
    </div>

    <div class="mt-4 p-4 max-w-screen-xl mx-auto min-h-screen">

        <div class="pl-4">
            Cociliaciones pendientes
        </div>

        @if ($ventassin->count())

            <div class="w-full mt-4 border  min-h-0 overflow-auto rounded-lg text-base">

                <table
                    class="table-fixed bg-white w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                    <tbody class="text-left text-base">

                        @foreach ($ventassin as $ventas)
                            <tr class="h-8 odd:bg-gray-100">
                                <td class="pl-2 w-28">{{ date('d-m-Y', strtotime($ventas->fecha)) }}</td>
                                @if ($ventas->tipo_pago == 0)
                                    <td class="pl-2 w-48">Transferencia Bancaria</td>
                                @else
                                    <td class="pl-2 w-48">Pago Móvil Bancario</td>
                                @endif
                                <td class="pl-2 w-48">{{ $ventas->banco }}</td>
                                <td class="pl-2 w-48">{{ $ventas->referencia }}</td>
                                @if ($ventas->tipo_pago == 0)
                                    <td class="pl-2 w-40"></td>
                                @else
                                    <td class="pl-2 w-40">{{ $ventas->codigo }}-{{ $ventas->telf }}</td>
                                @endif
                                <td class="px-2 w-48 font-normal text-right">Bs.
                                    {{ number_format($ventas->total, 2, ',', '.') }}
                                </td>
                                <td class="px-2 w-40 text-sm text-center">
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

        <!--Pagos cociliados -->

        <div class="mt-10 pl-4">
            Pagos Conciliados
        </div>

        @if ($ventascon->count())

            <div class="w-full mt-4 border  min-h-0 overflow-auto rounded-lg text-base">

                <table
                    class="table-fixed bg-white w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                    <tbody class="text-left text-base">

                        @foreach ($ventascon as $ventasc)
                        <tr class="h-8 odd:bg-gray-100">
                            <td class="pl-2 w-28">{{ date('d-m-Y', strtotime($ventasc->fecha)) }}</td>
                            @if ($ventasc->tipo_pago == 0)
                                <td class="pl-2 w-48">Transferencia Bancaria</td>
                            @else
                                <td class="pl-2 w-48">Pago Móvil Bancario</td>
                            @endif
                            <td class="pl-2 w-48">{{ $ventasc->banco }}</td>
                            <td class="pl-2 w-48">{{ $ventasc->referencia }}</td>
                            @if ($ventasc->tipo_pago == 0)
                                <td class="pl-2 w-40"></td>
                            @else
                                <td class="pl-2 w-40">{{ $ventasc->codigo }}-{{ $ventasc->telf }}</td>
                            @endif
                            <td class="px-2 w-48 font-normal text-right">Bs.
                                {{ number_format($ventasc->total, 2, ',', '.') }}
                            </td>
                            <td class="px-2 w-40 text-sm text-center"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                <span>Sin resultados </span>
            </div>
        @endif

        @if ($ventascon->hasPages())
            <div class="mt-4 px-4 py-2 text-center ">
                {{ $ventascon->onEachSide(0)->links() }}
            </div>
        @endif

        <div class="max-w-screen-xl mx-auto w-full mt-12">
            <p class="mb-4 pl-4">Totales conciliados por mes</p>
            <form action="" wire:submit="consultar" class="flex items-center border rounded-tl rounded-bl w-72">
                <input type="month" name="fecha" id="fecha" value="" wire:model="fecha" class="w-full border-none focus:ring-0 bg-white rounded-tl rounded-bl" required>
                <button type="submit" class="border p-2 rounded-tr rounded-br bg-lime-600 text-white">Consultar</button>
            </form>
        </div>
    
        

    </div>
<p class="text-2xl">{{$totales}}</p>
    <!--            pie de pagina FOOTER               -->

    <x-footer></x-footer>

    <!--Modal delete -->

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

    <!--Modal delete -->

    <x-confirm-modal wire:model="open_totales">

        <x-slot name="title">
            <p class="text-gray-700">Total Conciliado {{date('M-Y', strtotime($this->fecha))}}</p>
        </x-slot>

        <x-slot name="content">          
            <p class="text-2xl font-bold text-lime-700">Bs. {{number_format($this->totales, 2, ',', '.')}}</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open_totales', false)">
                Cerrar
            </x-secondary-button>

        </x-slot>
    </x-confirm-modal>

</div>
