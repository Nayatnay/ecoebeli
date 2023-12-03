<div>
    <x-slot name="header">
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Carrito') }}
            </h2>
        </div>
    </x-slot>

    <div class="px-4 py-12">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col sm:flex-row items-start bg-white rounded shadow p-4 sm:p-8 ">
                <img src="{{asset('img/car.png')}}" alt="Compras" title="Compras" width="200" class="p-4">
                <div class="sm:text-2xl font-black px-6">
                    <h2 class="mb-4">Tu carrito de Ebeli está vacío</h2>
                    <a href="#" class="text-sm sm:text-lg font-bold bg-lime-500 hover:bg-lime-400 px-4 py-2 rounded-md">Compra las ofertas del día</a>
                </div>
            </div>

            <!-- Categorias y productos -->

            <div class="mt-8 bg-white">

                <p class="text-2xl px-8 py-4 font-bold">Tendencias de compras</p>


                @if ($categorias->count())

                <div class="text-gray-700 grid gap-x-5 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 p-4 bg-gray-200">

                    @foreach ($categorias as $categoria)

                    <div class="flex flex-col items-center justify-between border rounded-lg bg-gray-100">
                        <div class="w-full p-4 font-bold text-xl xl:text-2xl">
                            <p class="text-ellipsis line-clamp-1">{{$categoria->nombre}}</p>
                            <p class="text-base font-normal text-ellipsis line-clamp-1">{{$categoria->descripcion}}</p>
                        </div>
                        <a href="#" class="w-full rounded-tl-lg rounded-tr-lg bg-gray-100 text-lime-600 duration-75 hover:underline">
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
                <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                    <p>0 resultados en el stock </p>
                </div>
                @endif

            </div>
        </div>
    </div>

</div>