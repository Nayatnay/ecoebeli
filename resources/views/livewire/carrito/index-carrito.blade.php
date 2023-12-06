<div class="min-h-screen">

    <div class="flex items-center sm:px-12 p-4 bg-white shadow">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-4">{{ __('Carrito') }}</h2>
        <!-- formulario de busqueda -->

        <form action="{{ route('carrito')}}" class="flex items-center justify-center border rounded w-full bg-lime-500">
            @if($buscar == null)
            <select name="categoria" id="categoria" onchange="ShowSelected();" class="hidden sm:block text-xs bg-gray-300 px-2 py-3 rounded-tl rounded-bl border-none focus:ring-0 text-black">
                <option value="">Todas las Categorías</option>
                @foreach ($categ as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value="{{ $buscar }}" class="text-xs w-full bg-gray-100 px-2 py-3 border-none focus:ring-0">
            @else
            <select name="categoria" id="categoria" onchange="ShowSelected();" class="hidden sm:block text-xs bg-gray-300 px-2 py-3 rounded-tl rounded-bl border-none focus:ring-0 text-black">
                <option value="$buscar">{{$buscar}}</option>
                <option value="">Todas las Categorías</option>
                @foreach ($categ as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value="" class="text-xs w-full bg-gray-100 px-2 py-3 border-none focus:ring-0">
            @endif
            <button type="submit" class="p-2 bg-lime-500  border-none focus:ring-0">
                <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="24">
            </button>
        </form>

    </div>

    <div class="flex flex-col items-center sm:flex-row sm:items-start bg-white rounded shadow mx-4 mt-6 sm:mt-12 sm:mx-12 sm:p-12 p-4 ">
        <div>
            <img src="{{asset('img/carg.png')}}" alt="Compras" title="Compras" width="200" class="p-4">
        </div>
        <div class="sm:ml-8">
            <h2 class="text-center sm:texl-left text-3xl font-semibold px-6 mb-4">Tu carrito de Ebeli está vacío</h2>
            <a href="#" class="block text-center sm:texl-lef mx-6 text-sm sm:text-lg font-bold bg-lime-500 hover:bg-lime-400 px-4 py-2 rounded-md">Compra las ofertas del día</a>
        </div>
    </div>

    <div class="p-4 sm:px-12">

        <div class="mt-4 text-xs font-semibold text-gray-700">
            <p>El precio y la disponibilidad de los productos de Ebeli.com están sujetos a cambio.
                En el carrito de compras puedes dejar temporalmente los productos que quieras.
                Aparecerá el precio más reciente de cada producto.
            </p>
        </div>

        <div class="mt-10 p-4 bg-white">

            <p class="mt-4 text-2xl font-bold">Recomendaciones y tendencias de compras</p>

            <!-- muestra productos que cumplenm con la condicion de búqueda    -->


            @if ($productos->count())

            <div class="mt-4 text-black grid gap-x-2 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-3 lg:grid-cols-6">

                @foreach ($productos as $producto)

                <div class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">
                    <div class="flex h-[70%] items-start ">
                        <img src="{{asset('/storage/productos/'.$producto->imagen)}}" alt="" title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                    </div>

                    <div class="w-full p-4 font-bold text-xl ">
                        <p class="text-ellipsis line-clamp-1">{{$producto->nombre}}</p>
                        <p class="text-sm font-normal text-ellipsis line-clamp-1">{{$producto->descripcion}}</p>
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
    </div>
    <!--            IDENTIFICACION Y/O REGISTRO DEL CLIENTE               -->

    <div class="mt-6 py-10 flex flex-col items-center text-xs font-semibold bg-white">
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