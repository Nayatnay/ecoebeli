<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebeli&trade; | Tu tienda online</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialised">
    <div class="flex items-center justify-between bg-zinc-900 shadow text-white sm:px-10 px-2 py-1 w-full">

        <div class="sm:mr-4 min-w-[140px]">
            <a href="{{route('/')}}" class="flex items-center rounded-sm border border-transparent hover:border-white py-2">
                <img src="{{asset('img/logoc.png')}}" alt="Logo" title="Logo" width="40">
                <h1 class="text-3xl font-semibold mr-2">ebeli&trade;</h1>
            </a>
        </div>

        <form action="{{ route('/')}}" class="hidden lg:flex items-center justify-center rounded border border-white w-full bg-lime-500">
            @if($buscar == null)
            <select name="categoria" id="categoria" onchange="ShowSelected();" class="text-sm bg-white px-4 py-2 rounded-tl rounded-bl border-none focus:ring-0 text-black">
                <option value="">Todas las Categorías</option>
                @foreach ($categ as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value="{{ $buscar }}" class="text-sm w-full bg-zinc-900 px-4 py-2 border-none focus:ring-0">
            @else
            <select name="categoria" id="categoria" onchange="ShowSelected();" class="text-sm bg-white px-4 py-2 rounded-tl rounded-bl border-none focus:ring-0 text-black">
                <option value="$buscar">{{$buscar}}</option>
                <option value="">Todas las Categorías</option>
                @foreach ($categ as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value="" class="text-sm w-full bg-zinc-900 px-4 py-2 border-none focus:ring-0">
            @endif
            <button type="submit" class="p-2 bg-lime-500  border-none focus:ring-0">
                <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="24">
            </button>
        </form>

        @if (Route::has('login'))
        <div class="">
            @auth
            <div class="flex items-center justify-end text-sm ml-4">
                <a href="{{ route('buscar') }}" class="hidden lg:hidden sm:block p-2 mr-2 rounded border border-transparent hover:border-gray-400">
                    <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="auto">
                </a>
                <a href="{{ route('carro') }}" class="hidden lg:w-28 sm:flex items-center justify-center font-semibold border border-transparent rounded hover:border-gray-400 px-2 py-2"><img src="{{asset('img/carw.png')}}" alt="Compras" title="Compras" width="24" class="mr-2 ">
                    <p class="hidden lg:block text-sm">Carrito</p>
                </a>
                @livewire('navigation-menu')
            </div>
            @else
            <div class="flex items-center justify-end text-sm ml-4">
                <a href="{{ route('buscar') }}" class="lg:hidden block p-2  rounded border border-transparent hover:border-gray-400">
                    <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="auto">
                </a>
                <a href="{{ route('carro') }}" class="lg:w-28 flex items-end justify-center font-semibold border border-transparent rounded hover:border-gray-400 px-2 py-2"><img src="{{asset('img/carw.png')}}" alt="Compras" title="Compras" width="24">
                    <p class="hidden lg:block ml-2 text-sm">Carrito</p>
                </a>
                <a href="{{ route('login') }}" class="lg:min-w-[120px] inline-flex items-end font-semibold mr-1 p-2 border border-transparent rounded hover:border-gray-400">
                    <img src="{{asset('img/userw.png')}}" alt="Iniciar sesión" title="Iniciar sesión" width="24">
                    <p class="hidden lg:block ml-2 text-sm">Tu Cuenta</p>
                </a>
            </div>
            @endauth
        </div>
        @endif

    </div>

    <!-- video presentacion en mp4
    <div class="w-full mx-auto">
    <video width="1024" height="768" controls>
    <source src="{{asset('img/Ebelipres.mp4')}}" type="video/mp4">
    </video>
    </div>
    -->

    <!-- This is an example component -->

    <div class="w-full">
        <div id="default-carousel" class="relative" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="overflow-hidden relative h-48 sm:h-64 xl:h-80 2xl:h-96">
                <!-- Item 1 -->
                <div class="hidden animation ease-in-out duration-700" data-carousel-item="active">
                    <img src="{{asset('img/a1.jpg')}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden animation ease-in-out duration-700" data-carousel-item>
                    <img src="{{asset('img/a2.jpg')}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden animation ease-in-out duration-700" data-carousel-item>
                    <img src="{{asset('img/a3.jpg')}}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="hidden">Previous</span>
                </span>
            </button>
            <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="hidden">Next</span>
                </span>
            </button>
        </div>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <!-- muestra de categorias -->

    @if ($categorias->count())

    <div class="grid gap-x-4 gap-y-8 grid-cols-1 md:grid-cols-3 lg:grid-cols-5 px-4 py-8 md:p-12">

        @foreach ($categorias as $categoria)

        <div class="flex flex-col items-center justify-between border bg-gray-100">
            <div class="w-full p-4 font-bold text-xl">
                <p class="text-ellipsis line-clamp-1">{{$categoria->nombre}}</p>
                <p class="text-sm font-normal text-ellipsis line-clamp-1">{{$categoria->descripcion}}</p>
            </div>
            <a href="{{route('verproductos', $categoria->nombre)}}" class="w-full text-orange-600 bg-gray-100 text-sm font-semibold duration-75 hover:underline">
                <div>
                    <img src="{{asset('/storage/categorias/'.$categoria->imagen)}}" alt="" title="" class="w-full">
                </div>
                <div class="w-full p-4">
                    Ver más
                </div>
            </a>
        </div>

        @endforeach

    </div>

    @else
    <div class="bg-white text-base font-semibold sm:px-10 px-2 py-2 shadow">
        <span>0 resultados para </span> <span class="text-orange-700"> "{{$buscar}}" </span>
    </div>
    @endif


    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-xs font-semibold">
        <a href="{{ route('login') }}" class="rounded-md px-20 py-2 bg-lime-500 mb-1">Identifícate</a>
        <div class="text-xs">
            <span>¿Eres un cliente nuevo?</span>
            <a href="{{ route('register') }}" class="text-orange-600 hover:underline">Empieza aquí.</a>
        </div>
    </div>

    <footer class="bg-zinc-900 text-white text-xs p-8 text-center">
        <p class="mb-2 text-sm font-semibold">Síguenos</p>
        <div class="mb-10 text-white font-normal flex justify-center">

            <a href="https://www.facebook.com/ospnetsistemas-106305848174358" , target="blank" class="flex items-end font-light hover:font-normal">
                <img src="{{asset('img/facebook.png')}}" width="24" height="auto" title="" alt="facebook">
                <p class="w-20 text-left ml-2 text-sm">Facebook</p>
            </a>
            <a href="https://www.facebook.com/ospnetsistemas-106305848174358" , target="blank" class="flex items-end font-light hover:font-normal">
                <img src="{{asset('img/instagram.png')}}" width="24" height="auto" title="" alt="instagram">
                <p class="w-20 text-left ml-2 text-sm">Instagram</p>
            </a>
        </div>

        <div class="text-center font-semibold ">
            <a href="{{ route('condiciones') }}" target="_blank" class="hover:underline mr-2">Condiciones de uso</a>
            <a href="{{ route('politicas') }}" target="_blank" class="hover:underline mr-2">Políticas de privacidad</a>
            <a href="{{ route('condiciones') }}" target="_blank" class="hover:underline  ">Aviso legal </a>
            <p class="font-light">&copy; 2023 Ebeli™ - Todos los derechos reservados.</p>
        </div>

    </footer>

    <!-- volver a la misma posicion al recargar la pagina -->

    <script>
        window.onload = function() {
            var pos = window.name || 0;
            window.scrollTo(0, pos);
        }
        window.onunload = function() {
            window.name = self.pageYOffset || (document.documentElement.scrollTop + document.body.scrollTop);
        }
    </script>

    <!-- Resize del select 
    <script src="https://unpkg.com/auto-resize-custom-select"></script>
    <script>
    customSelect();
    </script>
-->

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

