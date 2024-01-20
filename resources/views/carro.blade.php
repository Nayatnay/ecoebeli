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

    <div class="flex flex-col md:flex-row max-w-screen-xl mx-auto">

        <div class="p-4">

            @if (count(Cart::getContent()))
                <div class="bg-white md:px-4 py-8 md:p-8">
                    <div class="flex flex-col md:flex-row items-end justify-between">
                        <div class="flex items-end">
                            <img src="{{ asset('img/car.png') }}" alt="Compras" title="Compras" width="32px">
                            <p class="mt-2 md:mt-0 sm:text-2xl text-xl lg:text-3xl font-medium md:ml-2">Carrito</p>
                        </div>
                        @if (session('info'))
                            <div class="mensaje text-gray-700 text-xs text-right font-bold">
                                Producto Agregado con éxito
                            </div>
                        @endif
                    </div>
                    <div class="w-full flex justify-between text-sm border-b pb-1">
                        <p class="text-orange-600 font-mediun">Productos Seleccionados</p>
                        <p>Precio</p>
                    </div>
                    <div class="">
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach (Cart::getContent() as $item)
                            <div class="flex items-center mt-4 border-b pb-4">
                                <div>
                                    <img src="{{ asset('/storage/productos/' . $item->attributes->imagen) }}"
                                        width="96px" class="rounded mr-4">
                                </div>
                                <div class="w-full flex items-start justify-between">
                                    <div class="ml-4">
                                        <p class="text-2xl text-left font-normal">{{ $item->name }}</p>
                                        <p class="text-sm text-left">Cant.: {{ $item->quantity }}</p>

                                        <a href="#"
                                            class="block text-xs text-left text-orange-600 hover:underline">
                                            Eliminar
                                        </a>

                                    </div>
                                    <div>
                                        <p class="text-xl text-right font-semibold">US$
                                            {{ number_format($item->price, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @php
                                $subtotal = $subtotal + $item->price * $item->quantity;
                            @endphp
                        @endforeach
                    </div>

                    <div class="flex items-start justify-between">
                        
                        <div class="text-right text-xs text-orange-600 hover:underline">
                            <a href="{{ route('clear') }}">Vaciar carrito</a>
                        </div>
                        <div class="text-xl text-right font-semibold">
                            <p>Subtotal: US$ {{ number_format($subtotal, 2) }}</p>
                        </div>

                    </div>

                </div>
            @else
                <div class="bg-white md:px-4 py-8 md:p-8">
                    <div class="flex flex-col md:flex-row md:items-end items-center justify-center">
                        <img src="{{ asset('img/carg.png') }}" alt="Compras" title="Compras" width="32px">
                        <p class="mt-2 md:mt-0 sm:text-2xl text-xl lg:text-3xl font-medium md:ml-2">Tu carrito de Ebeli
                            está vacío
                        </p>
                    </div>
                    <div class="mt-2 pb-2 text-center border-b md:text-base lg:text-lg ">
                        <p>Llena tu carrito con los artículos de tu preferencia, ropa, artículos para el hogar,
                            electrónicos, y
                            más.
                            Continúa comprando en <a href="{{ route('/') }}"
                                class="text-lime-600 hover:underline">ebeli.com.</a>
                        </p>
                    </div>
                    <div class="mt-8 text-base font-medium text-center ">
                        <a href="#1" class="bg-lime-600 hover:bg-lime-700 text-white rounded-full px-6 py-2">Compra
                            las ofertas del día
                        </a>
                    </div>
                </div>
            @endif
            <div class="mt-4 text-xs font-semibold text-gray-700">
                <p>El precio y la disponibilidad de los productos de Ebeli.com están sujetos a cambio.
                    En el carrito de compras puedes dejar temporalmente los productos que quieras.
                    Aparecerá el precio más reciente de cada producto.
                </p>
            </div>
        </div>

        <div class="p-4 text-sm">
            <div class="rounded-lg border border-gray-200 w-72 p-4 bg-white">
                <div class="mb-4">
                    <p class="text-lg font-semibold">Recomendaciones de productos en nuestra tienda</p>
                </div>
                @if ($productos->count())
                    @foreach ($produc as $product)
                        <div class="flex items-center mt-6">
                            <a href="{{ route('detalproducto', $product->id) }} ">
                                <div class="min-w-[96px] mr-4">
                                    <img src="{{ asset('/storage/productos/' . $product->imagen) }}" alt=""
                                        title="" width="96px" class="rounded ">
                                </div>
                            </a>

                            <div class="w-full">
                                <a href="{{ route('detalproducto', $product->id) }} ">
                                    <div>
                                        <p class="text text-orange-400">{{ $product->nombre }}</p>
                                        <p class="text-xs font-medium"><i class="fa-solid fa-store text-yellow-300"></i>
                                            {{ $product->stock }}+ existencias
                                        </p>
                                        <span class="text-base font-semibold"> US${{ $product->precio }}</span>
                                    </div>
                                </a>

                                <div class="my-4">
                                    <form action="{{ route('adicion') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="submit" value="Agregar al carrito"
                                            class="block text-xs font-medium px-4 py-2 border rounded-full bg-yellow-300 hover:bg-yellow-400">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    <div class="mt-10 p-4 bg-white">
        <div class="max-w-screen-xl mx-auto">
            <p class="mt-4 px-4 text-2xl font-bold" id="1">Recomendaciones y tendencias de compras</p>

            <!-- muestra productos que cumplenm con la condicion de búqueda    -->

            @if ($productos->count())

                <div
                    class="mt-4 text-black grid gap-x-2 gap-y-4 md:gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 px-4">

                    @foreach ($productos as $producto)
                        <div
                            class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">
                            <div class="flex h-[50%] items-start ">
                                <a href="{{ route('detalproducto', $producto->id) }}">
                                    <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt=""
                                        title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                                </a>
                            </div>

                            <div class="w-full p-4 font-bold text-xl ">
                                <a href="{{ route('detalproducto', $producto->id) }}">
                                    <p class="text-ellipsis line-clamp-1">{{ $producto->nombre }}</p>
                                    <p class="text-sm font-normal text-ellipsis line-clamp-1">
                                        {{ $producto->descripcion }}
                                    </p>
                                </a>
                                <p class="mt-2 flex items-start text-sm font-bold">{{ $producto->stock }}+ <strong
                                        class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">existencias</strong>
                                </p>
                                <div class="flex items-start mt-4">
                                    <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                                    <span class="text-3xl font-semibold">
                                        {{ intval($producto->precio) }}</strong></span>
                                    @php
                                        $decimal = substr($producto->precio, -2);
                                    @endphp
                                    @if ($decimal != 0)
                                        <span
                                            class="mt-0.5 ml-0.5 text-sm font-normal">{{ substr($producto->precio, -2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="bg-white text-orange-700 text-base font-semibold sm:px-10 mx-4 px-4 py-2 shadow">
                    <span>Sin Stock </span> " </span>
                </div>
            @endif

            @if ($productos->hasPages())
                <div class="mx-4 px-4 py-2 border border-gray-300 rounded-md text-center my-10">
                    {{ $productos->onEachSide(0)->links() }}
                </div>
            @endif

        </div>
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

    <!-- MOSTRAR MENSAJE POR 3 SEGUNDOS -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".mensaje").fadeOut(1500);
            }, 2000);
        });
    </script>

</body>

</html>
