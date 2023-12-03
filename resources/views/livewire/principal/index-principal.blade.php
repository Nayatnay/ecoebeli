<div>
    <!-- formulario de busqueda -->
    <div class="">
        <form action="{{ route('dashboard')}}" class="flex items-center justify-center border rounded w-full bg-lime-500">
            @if($buscar == "")
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
    </div>

    <!-- Categorias y productos -->

    @if ($categorias->count())

    <div class="text-gray-700 grid gap-x-5 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-8">

        @foreach ($categorias as $categoria)

        <div class="h-full flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">
            <div class="w-full p-4 font-bold text-xl xl:text-2xl">
                <p class="text-ellipsis line-clamp-1">{{$categoria->nombre}}</p>
                <p class="text-base font-normal text-ellipsis line-clamp-1">{{$categoria->descripcion}}</p>
            </div>

            <a href="#" class="w-full rounded-bl-lg rounded-br-lg bg-gray-100 text-lime-600 duration-75 hover:underline">
                <div class=" ">
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
    <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
        <span>0 resultados para </span> <span class="text-orange-700"> "{{$buscar}}" </span>
    </div>
    @endif

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