@section('title', 'Tasa $ | Ebeli')
<div>

    <div class="bg-white shadow">

        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold md:text-2xl text-lime-700 leading-tight">
                Tasa dolar del Día: {{ $ultimatasa->valtasa }}<strong class="text-sm font-normal text-gray-600"> BS/USD</strong>
            </h2>

            @livewire('tasa.crear-tasa')

        </div>
    </div>

    <div class="mt-4 p-4 max-w-screen-xl mx-auto min-h-screen">

        @if ($tasas->count())

            <div class="w-full mt-4 border  min-h-0 overflow-auto rounded-lg text-base">

                <table
                    class="table-fixed bg-white w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                    <tbody class="text-left text-base">

                        @foreach ($tasas as $tasa)
                            <tr class="h-8 hover:bg-gray-100 odd:bg-gray-100">
                                <td class="pl-4 w-48">{{ $tasa->id }}</td>
                                <td class="pl-4 w-48">{{ date('d-m-Y H:i:s', strtotime($tasa->created_at)) }}</td>
                                <td class="pl-2 w-96 min-w-96 text-gray-600">Bs. {{ $tasa->valtasa }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                <span>0 resultados para </span> <span class="text-orange-700"> "{{ $buscar }}" </span>
            </div>
        @endif

        @if ($tasas->hasPages())
            <div class="mt-4 px-4 py-2 border-2 rounded-lg text-center ">
                {{ $tasas->onEachSide(0)->links() }}
            </div>
        @endif

    </div>

     <!--            pie de pagina FOOTER               -->

     <x-footer></x-footer>

     <!--Modal edit -->

</div>
