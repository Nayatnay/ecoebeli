<div class="min-h-screen">
    <!-- formulario de busqueda -->
    <div class="p-4 sm:p-12">
        <form action="{{ route('dashboard')}}" class="flex items-center justify-center border rounded w-full bg-lime-500">
            @if($buscar == null)
            <select name="categoria" id="categoria" onchange="ShowSelected();" class="hidden sm:block text-xs bg-gray-200 px-2 py-3 rounded-tl rounded-bl border-none focus:ring-0 text-black">
                <option value="">Todas las Categorías</option>
                @foreach ($categ as $categoria)
                <option value="$categoria->id">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value="{{ $buscar }}" class="text-xs w-full bg-white px-2 py-3 border-none focus:ring-0">
            @else
            <select name="categoria" id="categoria" onchange="ShowSelected();" class="hidden sm:block text-xs bg-gray-200 px-2 py-3 rounded-tl rounded-bl border-none focus:ring-0 text-black">
                <option value="$buscar">{{$buscar}}</option>
                <option value="">Todas las Categorías</option>
                @foreach ($categ as $categoria)
                <option value="$categoria->id">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value="" class="text-xs w-full bg-white px-2 py-3 border-none focus:ring-0">
            @endif
            <button type="submit" class="p-2 bg-lime-500  border-none focus:ring-0">
                <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="24">
            </button>
        </form>

        <!-- muestra de categorias -->

        @if ($categorias->count())

        <div class="my-12 text-gray-700 grid gap-x-5 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

            @foreach ($categorias as $categoria)

            <div class="flex flex-col items-center justify-between border rounded-lg bg-gray-100">
                <div class="w-full p-4 font-bold text-xl xl:text-2xl">
                    <p class="text-ellipsis line-clamp-1">{{$categoria->nombre}}</p>
                    <p class="text-base font-normal text-ellipsis line-clamp-1">{{$categoria->descripcion}}</p>
                </div>
                <a href="{{route('verproductos', $categoria->nombre)}}" class="w-full rounded-tl-lg rounded-tr-lg bg-gray-100 text-lime-600 duration-75 hover:underline">
                    <div>
                        <img src="{{asset('/storage/categorias/'.$categoria->imagen)}}" alt="" title="" class="w-full">
                    </div>
                    <div class="w-full p-4 font-bold">
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

</div>