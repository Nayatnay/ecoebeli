<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Ebeli&trade;</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialised">
    
    @livewire('cabecera.nav-cabeza')

    {{ session(['varval' => $buscar]) }}
    
    <div class="bg-gray-200 text-sm sm:text-base font-semibold py-2 shadow">
        <div class="max-w-screen-xl mx-auto px-6">
            @if ($productos->firstItem() == 0)
                <span>0 resultados para</span>
                </span> <span class="text-orange-700"> "{{ $buscar }}" </span>
            @else
                <span>{{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{ $productos->total() }}
                    resultados para
                </span>
                <span class="text-orange-700"> "{{ $buscar }}" </span>
            @endif
        </div>
    </div>

    <!-- muestra productos que cumplen con la condicion de búqueda    -->
    <div class="max-w-screen-xl mx-auto">
        @if ($productos->count())

            <div
                class="text-black grid gap-x-2 gap-y-4 md:gap-y-8 grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 mt-0 px-6 py-8">

                @foreach ($productos as $producto)
                    <div
                        class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">

                        <div class="flex h-[50%] items-start">
                            <a href="{{ route('detalproducto', $producto->id) }}">
                                <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt=""
                                    title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                            </a>
                        </div>

                        <div class="w-full p-4 font-bold text-xl">
                            <a href="{{ route('detalproducto', $producto->id) }} ">
                                <p class="text-ellipsis line-clamp-1">{{ $producto->nombre }}</p>
                                <p class="text-sm font-normal text-ellipsis line-clamp-1">{{ $producto->descripcion }}
                                </p>
                            </a>
                            <p class="mt-2 flex items-start text-sm font-bold">{{ $producto->stock }}+ <strong
                                    class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">existencias</strong>
                            </p>
                            <div class="flex items-start mt-2">
                                <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                                <span class="text-3xl font-semibold"> {{ intval($producto->precio) }}</strong></span>
                                @php
                                    $decimal = substr($producto->precio, -2);
                                @endphp
                                @if ($decimal != 0)
                                    <span
                                        class="mt-0.5 ml-0.5 text-sm font-light">{{ substr($producto->precio, -2) }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        @endif

        @if ($productos->hasPages())
            <div class="mx-4 md:mx-8 px-4 py-2 border border-gray-300 rounded-md text-center my-10">
                {{ $productos->onEachSide(0)->links() }}
            </div>
        @endif

    </div>

    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <x-Identificate></x-Identificate>

    <!--            pie de pagina FOOTER               -->

    <x-footer></x-footer>

    <script>
        function ShowSelected() {
            /* Para obtener el valor */
            var cod = document.getElementById("categoria").value;
            //alert(cod);

            /* Para obtener el texto */
            var combo = document.getElementById("categoria");
            var selected = combo.options[combo.selectedIndex].text;
            //alert(selected);
            document.getElementById("buscar").value = selected;
            document.getElementById("buscar").focus();
        }
    </script>

</body>

</html>
