@section('title', 'Tienda | Ebeli')
<div>
    <div class="bg-gray-200 text-sm sm:text-base font-semibold shadow">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between ">
            <div class="font-light">
                <span class="pl-4">Total de artículos en la tienda {{ $productos->total() }} </span>
            </div>
            <div class="text-sm font-medium m-2 border border-gray-500 rounded-lg">
                <select name="filtro" id="filtro" wire:change="order" wire:model="filtro"
                    class="font-normal rounded-lg text-sm border-none focus:ring-0 focus:outline-none hover:cursor-pointer 
                     bg-transparent">
                    <option value="0">Ordenar por</option>
                    <option value="1">Precio de menor a mayor</option>
                    <option value="2">Precio de mayor a menor</option>
                </select>
            </div>
        </div>

    </div>

    <!-- muestra productos que cumplen con la condicion de búqueda    -->
    <div class="max-w-screen-xl mx-auto py-8 flex min-h-screen">

        <div class="border m-4 min-w-[240px] rounded-lg bg-gray-100">
            <div class="bg-zinc-700 text-white p-2 rounded-t-lg">
                ¿Qué buscas?
            </div>
            <div class="p-4">
                <!-- Filtro Categorías -->
                <div class="mb-4">
                    <select name="subcategoria" id="subcategoria" wire:change="order"
                        wire:model="filters.id_subcategoria"
                        class="w-full rounded-lg font-normal text-sm border-none focus:ring-0 focus:outline-none 
                    hover:cursor-pointer bg-white">
                        <option value="0">Todas las categorías</option>
                        @foreach ($subcateg as $subcat)
                            <option value="{{ $subcat->id }}"class="bg-white">{{ $subcat->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filtro marcas -->
                <div class="mb-4">
                    <select name="marca" id="marca" wire:change="order" wire:model="filters.marca"
                        class="w-full rounded-lg font-normal text-sm border-none focus:ring-0 focus:outline-none 
                    hover:cursor-pointer bg-white">
                        <option value="0">Todas las marcas</option>
                        @foreach ($marcas as $marc)
                            <option value="{{ $marc->marca }}"class="bg-white">{{ $marc->marca }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filtro color -->
                <div class="mb-4">
                    <select name="color" id="color" wire:change="order" wire:model="filters.color"
                        class="w-full rounded-lg font-normal text-sm border-none focus:ring-0 focus:outline-none 
                    hover:cursor-pointer bg-white">
                        <option value="0">Todos los colores</option>
                        @foreach ($colores as $color)
                            <option value="{{ $color->color }}"class="bg-white">{{ $color->color }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filtro tallas -->
                <div class="mb-4">
                    <select name="talla" id="talla" wire:change="order" wire:model="filters.talla"
                        class="w-full rounded-lg font-normal text-sm border-none focus:ring-0 focus:outline-none 
                    hover:cursor-pointer bg-white">
                        <option value="0">Todas las tallas</option>
                        @foreach ($tallas as $talla)
                            <option value="{{ $talla->talla }}"class="bg-white">{{ $talla->talla }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filtro precios -->
                <div class="mt-4 p-3 text-sm bg-white rounded-t-lg border-b">
                    Rango de precios
                </div>
                <div class="mb-4 text-sm bg-white py-4 px-3">
                    <div class="flex items-center mb-4">
                        <input type="radio" id="25" name="fav_language" value="25"
                            wire:model="filters.precio" wire:click="order" class="mr-2">
                        <label for="25">Menos de $25</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="50" name="fav_language" value="50"
                            wire:model="filters.precio" wire:click="order" class="mr-2">
                        <label for="50">De $25 a $50</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="100" name="fav_language" value="100"
                            wire:model="filters.precio" wire:click="order" class="mr-2">
                        <label for="100">De $50 a $100</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="200" name="fav_language" value="200"
                            wire:model="filters.precio" wire:click="order" class="mr-2">
                        <label for="200">De $100 a $200</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" id="201" name="fav_language" value="201"
                            wire:model="filters.precio" wire:click="order" class="mr-2">
                        <label for="201">$200 y más</label>
                    </div>
                </div>
                <!-- Limpiar todos los Filtros -->
                <div class="mt-8 bg-zinc-700 hover:bg-zinc-600 text-white text-sm font-normal text-center rounded-lg p-2 cursor-pointer"
                    wire:click="clear">
                    <span>Limpiar los filtros</span>
                </div>
            </div>

        </div>

        <div class="w-full">
            @if ($productos->count())

                <div
                    class="text-black grid gap-x-4 gap-y-4 md:gap-y-8 grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 px-6 py-4">

                    @foreach ($productos as $producto)
                        <div
                            class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">

                            <div class="flex h-[50%] items-start">
                                <a href="{{ route('detalproducto', $producto->id) }}">
                                    <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt=""
                                        title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                                </a>
                            </div>

                            <div class="w-full p-4 font-bold text-lg">
                                <a href="{{ route('detalproducto', $producto->id) }} ">
                                    <p class="text-ellipsis line-clamp-1">{{ $producto->nombre }}</p>
                                    <p class="text-sm font-normal text-ellipsis line-clamp-1">
                                        {{ $producto->descripcion }}
                                    </p>
                                </a>
                                <p class="mt-2 flex items-start text-sm font-bold">{{ $producto->stock }}+ <strong
                                        class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">stock</strong>
                                </p>
                                <div class="flex items-start mt-2">
                                    <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                                    <span class="text-3xl font-semibold">
                                        {{ intval($producto->precio) }}</strong></span>
                                    @php
                                        $decimal = substr($producto->precio, -2);
                                    @endphp
                                    @if ($decimal != 0)
                                        <span
                                            class="mt-0.5 ml-0.5 text-sm font-light">{{ substr($producto->precio, -2) }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
                @if ($productos->hasPages())
                    <div class="mx-4 md:mx-8 px-4 py-2 border border-gray-300 rounded-md text-center my-10">
                        {{ $productos->onEachSide(0)->links() }}
                    </div>
                @endif
            @else
                <div class="w-full pt-6 pb-2 pl-6 border-b text-orange-600 font-medium">
                    <p>Lo sentimos, no existen productos con el filtro seleccionado</p>
                </div>

            @endif
        </div>

    </div>

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

</div>
