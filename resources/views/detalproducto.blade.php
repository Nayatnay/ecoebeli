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

    @if (session('info'))
        <div class="bg-yellow-300 text-sm w-full text-center font-medium p-2">
            Producto Agregado: {{ $producto->nombre }}
        </div>
    @endif

    <div class="bg-transparent text-sm sm:text-base font-semibold py-2 shadow">

        <div class="max-w-screen-xl md:mx-auto flex items-center md:justify-between px-6">

            <div class="flex items-center">
                <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt="" title=""
                    width="56px" class="hidden md:block rounded w-[60px]">
                <p class="md:hidden text-xs font-medium mr-4 pl-1 md:pl-0 text-ellipsis line-clamp-2">
                    {{ $producto->nombre }}</p>
                <p class="hidden md:block text-xs font-medium mx-4 text-ellipsis line-clamp-2">
                    {{ $producto->descripcion }}</p>

            </div>
            <div class="flex items-center md:justify-end w-[30%]">

                <p class="text-sm font-normal mr-6"><i class="fa-solid fa-store text-yellow-300 md:text-lime-400"></i>
                    {{ $producto->stock }}+
                </p>

                <div class="hidden md:flex items-start text-orange-600">
                    <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                    <span class="text-2xl font-semibold"> {{ intval($producto->precio) }}</strong></span>
                    @php
                        $decimal = substr($producto->precio, -2);
                    @endphp
                    @if ($decimal != 0)
                        <span class="mt-0.5 ml-0.5 text-sm font-light">{{ substr($producto->precio, -2) }}</span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div
        class="my-4 md:max-w-screen-xl md:mx-auto flex flex-col md:flex-row items-center md:items-start md:justify-between px-4 md:px-6">

        <div class="min-w-[100px] xl:min-w-[512px]">
            <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt="" title=""
                width="" class="rounded w-full">
        </div>

        <div class="w-full mx-4">
            <p class="hidden md:block text-xl lg:text-3xl mx-4">{{ $producto->descripcion }}</p>
            <p class="hidden md:block mt-5 md:mt-10 ml-4 pb-2 border-b text-sm font-normal mr-6"><i
                    class="fa-solid fa-store text-yellow-300"></i>
                {{ $producto->stock }}+ existencias
            </p>
            <div class="flex items-start text-orange-600 ml-2 md:ml-4 pt-2">
                <span class="text-base text-gray-800 font-normal mr-2">Precio:</span>
                <span class="text-xl font-semibold">US$</span>
                <span class="text-xl font-semibold"> {{ $producto->precio }}</strong></span>
            </div>
            <div class="mx-2 mt-4 font-medium">
                <p>Detalles del Producto</p>
            </div>
            <div class="mx-2 pt-2 text-sm md:text-base">
                <p>▪ Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur reprehenderit sapiente harum
                    delectus deleniti quasi quo consequatur recusandae cupiditate corrupti soluta impedit, ea cum enim
                    quia, repellat ullam ad eius.</p>
                <p>▪ Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur reprehenderit sapiente harum
                    delectus deleniti quasi quo consequatur recusandae cupiditate corrupti soluta impedit, ea cum enim
                    quia, repellat ullam ad eius.</p>
                <p>▪ Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur reprehenderit sapiente harum
                    delectus deleniti quasi quo consequatur recusandae cupiditate corrupti soluta impedit, ea cum enim
                    quia, repellat ullam ad eius.</p>
            </div>
        </div>

        <div class="mt-0 md:ml-4 w-full md:w-[520px] h-full">
            @auth
                <div class="mt-6 md:mt-0 rounded-lg md:border border-gray-300 w-full text-center text-sm md:p-6 pb-4">
                    <p>Enviar a <strong>{{ ucwords(Auth::user()->name) }}</strong></p>
                    <p class="mt-2 text-xs text-gray-600"><i
                            class="fa-solid fa-location-dot mr-1 text-sm"></i>{{ Auth::user()->pais }}
                        -{{ Auth::user()->estado }}-{{ Auth::user()->ciudad }}-{{ Auth::user()->direccion }} <br>
                        CP.{{ Auth::user()->cp }}</p>
                    <div class="mt-8 w-full">
                        <form action="{{ route('add') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $producto->id }}">
                            <input type="submit" value="Agregar al carrito"
                                class="w-full block text-xs font-medium px-4 py-2 border rounded-full bg-yellow-300 hover:bg-yellow-400">
                        </form>
                    </div>
                    <div class="mt-4 w-full">
                        <a href="#"
                            class="block text-xs font-medium px-4 py-2 border rounded-full bg-lime-600 hover:bg-lime-700 text-white">Comprar
                            ahora</a>
                    </div>
                </div>
            @else
                <div class="rounded-lg md:border border-gray-300 w-full text-center text-sm md:p-6 pb-4">
                    <p class="mt-6 md:mt-0 text-base text-gray-600"><i class="fa-solid fa-location-dot mr-1"></i></p>
                    <p id="bloque"></p>

                    <div class="mt-8 w-full">
                        <form action="{{ route('add') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $producto->id }}">
                            <input type="submit" value="Agregar al carrito"
                                class="w-full block text-xs font-medium px-4 py-2 border rounded-full bg-yellow-300 hover:bg-yellow-400">
                        </form>
                    </div>
                </div>
            @endauth
        </div>

    </div>


    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <x-Identificate></x-Identificate>

    <!--            pie de pagina FOOTER               -->

    <x-footer></x-footer>


    <script type="text/javascript">
        var bloc = document.getElementById("bloque");
        navigator.geolocation.getCurrentPosition(showPosition);

        function showPosition(position) {
            bloc.innerHTML = "Latitud: " + position.coords.latitude +
                "<br>Longitud: " + position.coords.longitude;
        }
    </script>

</body>

</html>