<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Ebeli&trade;</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialised">
    <div class="flex items-center justify-between bg-zinc-900 shadow text-white sm:px-10 px-2 py-1 w-full">

        <div class="mr-4 min-w-[140px]">
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

        <div class="flex items-center justify-end text-sm ml-4 lg:min-w-[220px]">
            <a href="{{ route('buscar') }}" class="lg:hidden block p-2 mr-2">
                <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="auto">
            </a>
            <a href="{{ route('login') }}" class="flex items-end font-semibold mr-2 px-2 py-2 border border-transparent rounded-sm hover:border-white"><img src="{{asset('img/userw.png')}}" alt="Iniciar sesión" title="Iniciar sesión" width="24">
                <p class="hidden lg:block ml-2 text-sm">Tu Cuenta</p>
            </a>
            <a href="{{ route('carro') }}" class="flex items-end font-semibold border border-transparent rounded-sm hover:border-white px-2 py-2"><img src="{{asset('img/carw.png')}}" alt="Compras" title="Compras" width="24">
                <p class="hidden lg:block ml-2 text-sm">Carrito</p>
            </a>
        </div>
    </div>

    <div class="bg-gray-200 text-base font-semibold sm:px-10 px-2 py-2 shadow">
        <span>Resultados para </span> <span class="text-orange-700"> "{{$buscar}}" </span>
    </div>

    <!-- muestra productos que cumplenm con la condicion de búqueda    -->


    @if ($productos->count())

    <div class="text-black grid gap-x-2 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-3 lg:grid-cols-6 p-4 md:p-8">

        @foreach ($productos as $producto)

        <div class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">
            <div class="flex h-[70%] items-start">
                <img src="{{asset('/storage/productos/'.$producto->imagen)}}" alt="" title="" class="w-full" width="">
            </div>

            <div class="w-full p-4 font-bold text-xl">
                <p class="text-ellipsis line-clamp-1">{{$producto->nombre}}</p>
                <p class="text-sm font-normal text-ellipsis line-clamp-1">{{$producto->descripcion}}</p>
                <p class="mt-2 flex items-start text-sm font-bold">{{$producto->stock}}+ <strong class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">existencias</strong></p>
                <div class="flex items-start mt-2">
                    <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                    <span class="text-3xl font-semibold"> {{intval($producto->precio);}}</strong></span>
                    @php
                    $decimal = substr($producto->precio, -2);
                    @endphp
                    @if ($decimal <> 0)
                        <span class="mt-0.5 ml-0.5 text-sm font-light">{{substr($producto->precio, -2);}}</span>
                        @endif
                </div>
            </div>
        </div>

        @endforeach

    </div>

    @else
    <div class="bg-white text-base font-semibold sm:px-10 px-2 py-2 shadow">
        <span>0 resultados para </span> <span class="text-orange-700"> "{{$buscar}}" </span>
    </div>
    @endif

    @if ($productos->hasPages())
    <div class="mx-4 md:mx-8 px-4 py-2 border border-gray-300 rounded-md text-center my-10">
        {{$productos->onEachSide(0)->links()}}
    </div>
    @endif

    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-xs font-semibold">
        <a href="{{ route('login') }}" class="rounded-md px-20 py-2 bg-lime-500 mb-1">Identifícate</a>
        <div>
            <span>¿Eres un cliente nuevo?</span>
            <a href="{{ route('register') }}" class="text-blue-700 hover:underline">Empieza aquí.</a>

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
<!--
    <script>
        window.onload = function() {
            var pos = window.name || 0;
            window.scrollTo(0, pos);
        }
        window.onunload = function() {
            window.name = self.pageYOffset || (document.documentElement.scrollTop + document.body.scrollTop);
        }
    </script>

     Resize del select 
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