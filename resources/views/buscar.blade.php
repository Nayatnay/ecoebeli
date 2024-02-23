<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsquedas | Ebeli&trade;</title>
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

    <!-- formulario de busqueda -->

    <div class="max-w-screen-xl mx-auto w-full px-4 mt-8 md:mt-16">
        <form action="{{ route('buscar') }}"
            class="flex items-center justify-center border rounded md:w-[40%] bg-lime-500">
            @if ($buscar == null)
                <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar"
                    value="{{ $buscar }}" class="text-xs w-full bg-white px-2 py-3 border-none focus:ring-0">
            @else
                <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value=""
                    class="text-xs w-full bg-white px-2 py-3 border-none focus:ring-0">
            @endif

            <button type="submit" class="p-2 bg-lime-500  border-none focus:ring-0">
                <img src="{{ asset('img/buscar.png') }}" alt="Buscar" title="Buscar" width="24" height="24">
            </button>
        </form>
    </div>
    <!-- Categorias y productos -->

    <div class="max-w-screen-xl mx-auto">

        @if ($categorias->count())

            <div
                class="mt-4 text-gray-700 grid gap-x-5 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 p-4">

                @foreach ($categorias as $categoria)
                    <div class="flex flex-col items-center justify-between border rounded-lg bg-gray-100">
                        <div class="w-full p-4 font-bold text-xl xl:text-2xl">
                            <p class="text-ellipsis line-clamp-1">{{ $categoria->nombre }}</p>
                            <p class="text-base font-normal text-ellipsis line-clamp-1">{{ $categoria->descripcion }}
                            </p>
                        </div>
                        <a href="{{ route('productosporcategoria', $categoria->slug) }}"
                            class="w-full rounded-tl-lg rounded-tr-lg bg-gray-100 text-lime-600 duration-75 hover:underline">
                            <div>
                                <img src="{{ asset('/storage/categorias/' . $categoria->imagen) }}" alt=""
                                    title="" class="w-full">
                            </div>
                            <div class="w-full p-4 font-bold">
                                Ver más
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        @else
            <div class="bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                <span>0 resultados para </span> <span class="text-orange-700"> "{{ $buscar }}" </span>
            </div>
        @endif

    </div>

    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <x-Identificate></x-Identificate>

    <!--            pie de pagina FOOTER               -->

    <x-footer></x-footer>

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
