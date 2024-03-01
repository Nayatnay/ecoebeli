<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebeli&trade; | Tu tienda online</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-zinc-100 text-black">
    
    @livewire('cabecera.nav-cabeza')

    <div id="default-carousel" class="relative" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="overflow-hidden relative h-48 sm:h-64 xl:h-80 2xl:h-96">
            <!-- Item 1 -->
            <div class="hidden animation ease-in-out duration-700" data-carousel-item="active">
                <img src="{{ asset('img/a1.jpg') }}"
                    class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden animation ease-in-out duration-700" data-carousel-item>
                <img src="{{ asset('img/a2.jpg') }}"
                    class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden animation ease-in-out duration-700" data-carousel-item>
                <img src="{{ asset('img/a3.jpg') }}"
                    class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                    </path>
                </svg>
                <span class="hidden">Previous</span>
            </span>
        </button>
        <button type="button"
            class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
                <span class="hidden">Next</span>
            </span>
        </button>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <!-- muestra de categorias -->
    <div class="max-w-screen-xl mx-auto">
        
        @if ($categorias->count())

            <div class="grid gap-x-4 gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 px-4 py-8 ">

                @foreach ($categorias as $categoria)
                    <div class="flex flex-col items-center justify-between border border-gray-300 bg-gray-100">
                        <div class="w-full p-4 font-bold text-xl">
                            <p class="text-ellipsis line-clamp-1">{{ $categoria->nombre }}</p>
                            <p class="text-sm font-normal text-ellipsis line-clamp-1">{{ $categoria->descripcion }}</p>
                        </div>
                        <a href="{{ route('productosporcategoria', $categoria->slug) }}"
                            class="w-full text-orange-600 bg-gray-100 text-sm font-semibold duration-75 hover:underline">
                            <div>
                                <img src="{{ asset('/storage/categorias/' . $categoria->imagen) }}" alt=""
                                    title="" class="w-full">
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
                <span>0 resultados para </span> <span class="text-orange-700"> "{{ $buscar }}" </span>
            </div>
        @endif

        @if ($categorias->hasPages())
            <div class="mx-4 md:mx-8 px-4 py-2 text-center my-10">
                {{ $categorias->onEachSide(0)->links() }}
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
