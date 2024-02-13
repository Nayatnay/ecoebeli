@section('title', 'Tienda | Ebeli')
<div>
    <div class="bg-gray-200 text-sm sm:text-base font-semibold py-4 shadow">
        <div class="max-w-screen-xl mx-auto px-6 font-light">
            <span class="pl-4">{{ $productos->total() }} artículos en la tienda </span>
        </div>
    </div>

    <!-- muestra productos que cumplen con la condicion de búqueda    -->
    <div class="max-w-screen-xl mx-auto py-8">
        @if ($productos->count())

            <div class="text-sm font-medium p-2 flex items-center justify-end">
                <p class="">Ordenar por</p>
                
                    <select name="filtro" id="filtro" wire:change="order('precio')" wire:model="filtro"
                        class="font-normal text-sm border-none focus:ring-0 focus:outline-none hover:cursor-pointer 
                        hover:text-orange-600 bg-transparent">
                        <option value="0">Listado</option>
                        <option value="1">Menor precio</option>
                        <option value="2">Mayor precio</option>
                    </select>
                
            </div>
            <div
                class="text-black grid gap-x-2 gap-y-4 md:gap-y-8 grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 px-6 py-4">

                @foreach ($productos as $producto)
                    <div
                        class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-gray-100">

                        <div class="flex h-[50%] items-start">
                            <a href="{{ route('detalproducto', $producto->id) }}">
                                <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt=""
                                    title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                            </a>
                        </div>

                        <div class="w-full p-4 font-bold text-xl">
                            <a href="{{ route('detalproducto', $producto->id) }} ">
                                <p class="text-ellipsis line-clamp-1">{{ $producto->nombre }}</p>
                                <p class="text-sm font-normal text-ellipsis line-clamp-1">{{ $producto->descripcion }}
                                </p>
                            </a>
                            <p class="mt-2 flex items-start text-sm font-bold">{{ $producto->stock }}+ <strong
                                    class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">existencias</strong>
                            </p>
                            <div class="flex items-start mt-2">
                                <span class="text-sm font-normal mt-0.5 mr-0.5">US$</span>
                                <span class="text-3xl font-semibold"> {{ intval($producto->precio) }}</strong></span>
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
        @endif



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
