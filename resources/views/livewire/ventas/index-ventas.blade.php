@section('title', 'Venta | Ebeli')
<x-app-layout>

    <div class="bg-white shadow">
        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            <h2 class="ml-2 font-semibold text-xl text-gray-800 leading-tight">
                Detalles del pago
            </h2>
            <a href="{{route('conciliaciones')}}"><i class="fa-solid fa-arrow-left mr-4"></i></a>
        </div>
    </div>

    <div class="mt-4 p-4 max-w-screen-xl mx-auto min-h-screen">

        <div class="md:px-4 text-center">
            <p class="mt-2 text-sm font-light ml-2"><strong>{{ $cliente->name }}</strong> {{ $cliente->email }}</p>
        </div>

        <div class="mt-4 md:px-4 flex flex-wrap text-sm md:text-base justify-center">
            @if ($venta->tipo_pago == 0)
                <p class="font-medium ml-2">Transferencia Bancaria - Ref.
                    {{ $venta->referencia }}</p>
            @else
                <p class="font-medium ml-2">Pago Móvil Bancario - Ref.
                    {{ $venta->referencia }}</p>
            @endif
            <p class="ml-2">desde el banco {{ $venta->banco }}.</p>
            @if ($venta->tipo_pago == 1)
                <p class="ml-2">Teléfono:
                    {{ $venta->codigo }}-{{ $venta->telf }}.</p>
            @endif
            <p class="ml-2">Registrado el día
                {{ date('d-m-Y', strtotime($venta->fecha)) }}</p>

            <p class="mx-2 text-lime-700 font-medium">Total pagado Bs.
                {{ number_format($venta->total, 2, ',', '.') }}
            </p>

        </div>

        <div class="mt-8 md:p-4 border rounded-md">
            @foreach ($detalles as $detal)
                <div class="flex items-center ml-2 my-4">

                    <div class="w-[160px] mr-2 md:mr-4 ">
                        <img src="{{ asset('/storage/productos/' . $detal->producto->imagen) }}" alt=""
                            title="" class="rounded md:w-[160px]">
                    </div>

                    <div>
                        <p class="inline-block bg-lime-700 text-white rounded font-bold text-center text-sm md:text-lg px-2 mb-2 capitalize">
                            {{ $detal->producto->nombre }}</p>
                        <div class="text-xs md:text-sm">
                            <p class="hidden md:block">{{ $detal->producto->descripcion }}</p>
                            <p>{{ $detal->cantidad }} unidades / <strong
                                    class="text-lime-700">{{ $detal->precio }} USD por
                                    unidad</strong>
                            </p>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
