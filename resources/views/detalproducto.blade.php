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

    <div class="bg-transparent text-sm sm:text-base font-semibold py-2 shadow">

        <div class="max-w-screen-xl md:mx-auto flex items-center md:justify-between px-6">

            <div class="flex items-center">
                <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt="" title=""
                    width="56px" class="hidden md:block rounded w-[60px]">
                <p class="md:hidden text-xs font-medium mr-4 text-ellipsis line-clamp-2">{{ $producto->nombre }}</p>
                <p class="hidden md:block text-xs font-medium mx-4 text-ellipsis line-clamp-2">
                    {{ $producto->descripcion }}</p>

            </div>
            <div class="flex items-center md:justify-end w-[30%]">

                <p class="text-sm font-normal mr-6"><i class="fa-solid fa-store text-lime-400"></i>
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

    <div class="my-4 md:max-w-screen-xl md:mx-auto flex flex-col md:flex-row items-center md:items-start md:justify-between px-4 md:px-6">

        <div class="min-w-[100px] xl:min-w-[512px]">
            <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt="" title=""
                width="" class="rounded w-full">
        </div>

        <div class="w-full mx-4">
            <p class="hidden md:block text-3xl mx-4">{{ $producto->descripcion }}</p>
            <p class="mt-5 md:mt-10 ml-4 pb-2 border-b text-sm font-normal mr-6"><i
                    class="fa-solid fa-store text-yellow-300"></i>
                {{ $producto->stock }}+ existencias
            </p>
            <div class="hidden md:flex items-start text-orange-600 ml-4 pt-2">
                <span class="text-base text-gray-800 font-normal mr-2">Precio:</span>
                <span class="text-xl font-semibold">US$</span>
                <span class="text-xl font-semibold"> {{ $producto->precio }}</strong></span>
            </div>
            <div class="mx-2 mt-4 font-medium">
                <p>Detalles del Producto</p>
            </div>
            <div class="mx-2 pt-2">
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

        <div class="mt-4 md:mt-0 md:ml-4 w-full md:w-[520px] h-full">
            <div class="rounded-lg border border-gray-300 w-full text-center text-sm p-6">
                
                @auth
                <p>Enviar a <strong>{{ucwords(Auth::user()->name)}}</strong></p>
                <p class="mt-2 text-xs text-gray-600"><i class="fa-solid fa-location-dot mr-1"></i>Guatire - Miranda - Venezuela</p>
                @endauth

                <div class="mt-8">
                    <a href="#" class="text-xs px-4 py-2 border rounded-full bg-yellow-300">Agregar al carrito</a>
                </div>
                
            </div>
        </div>






    </div>


    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <x-Identificate></x-Identificate>

    <!--            pie de pagina FOOTER               -->

    <x-footer></x-footer>

</body>

</html>
