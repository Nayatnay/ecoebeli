<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito | Ebeli&trade;</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialised bg-gray-100">

    @livewire('cabecera.nav-cabeza')

    <div class="p-4">

        <div class="flex flex-col items-center sm:flex-row sm:items-start bg-white rounded shadow p-4 sm:p-8 ">
            <div>
                <img src="{{asset('img/carg.png')}}" alt="Compras" title="Compras" width="200" class="p-4">
            </div>
            <div class="sm:ml-8">
                <h2 class="text-center sm:texl-left text-3xl font-semibold px-6 mb-4">Tu carrito de Ebeli está vacío</h2>

                <a href="#" class="block text-center sm:texl-lef mx-6 text-sm sm:text-lg font-bold bg-lime-500 hover:bg-lime-400 px-4 py-2 rounded-md">Compra las ofertas del día</a>

            </div>

        </div>


        <div class="mt-4 text-xs font-semibold text-gray-700">
            <p>El precio y la disponibilidad de los productos de Ebeli.com están sujetos a cambio.
                En el carrito de compras puedes dejar temporalmente los productos que quieras.
                Aparecerá el precio más reciente de cada producto.
            </p>
        </div>

    </div>

    <div class="mt-10 p-4 bg-white">

        <p class="mt-4 text-2xl font-bold">Recomendaciones y tendencias de compras</p>

        <!-- muestra productos que cumplenm con la condicion de búqueda    -->

        @if ($productos->count())

        <div class="mt-4 text-black grid gap-x-2 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-3 lg:grid-cols-6">

            @foreach ($productos as $producto)

            <div class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">
                <div class="flex h-[50%] items-start ">
                    <a href="#">
                        <img src="{{asset('/storage/productos/'.$producto->imagen)}}" alt="" title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                    </a>
                </div>

                <div class="w-full p-4 font-bold text-xl ">
                    <a href="#">
                        <p class="text-ellipsis line-clamp-1">{{$producto->nombre}}</p>
                        <p class="text-sm font-normal text-ellipsis line-clamp-1">{{$producto->descripcion}}</p>
                    </a>
                    <p class="mt-2 flex items-start text-sm font-bold">{{$producto->stock}}+ <strong class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">existencias</strong></p>
                    <div class="flex items-start mt-4">
                        <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                        <span class="text-3xl font-semibold"> {{intval($producto->precio);}}</strong></span>
                        @php
                        $decimal = substr($producto->precio, -2);
                        @endphp
                        @if ($decimal <> 0)
                            <span class="mt-0.5 ml-0.5 text-sm font-normal">{{substr($producto->precio, -2);}}</span>
                            @endif
                    </div>
                </div>
            </div>

            @endforeach

        </div>

        @else
        <div class="bg-white text-orange-700 text-base font-semibold sm:px-10 px-2 py-2 shadow">
            <span>Sin Stock </span> " </span>
        </div>
        @endif

        @if ($productos->hasPages())
        <div class="px-4 py-2 border border-gray-300 rounded-md text-center my-10">
            {{$productos->onEachSide(0)->links()}}
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