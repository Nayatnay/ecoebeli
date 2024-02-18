@section('title', 'Productos | Ebeli')
<div class="min-h-screen">
    <div class="bg-white shadow">
        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Productos') }}
            </h2>
            @livewire('productos.crear-producto')
        </div>
    </div>

    <div class="p-4 max-w-screen-xl mx-auto">

        <!-- formulario de busqueda -->

        <div class="w-full mt-4 ">
            <form action="{{ route('adminpro') }}"
                class="flex items-center justify-center border rounded md:w-[50%] bg-lime-500">
                @if ($buscar == '')
                    <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar"
                        value="{{ $buscar }}" class="text-xs w-full bg-white px-2 py-3 border-none focus:ring-0">
                @else
                    <input type="search" placeholder="Buscar en Ebeli" name="buscar" id="buscar" value=""
                        class="text-xs w-full bg-white px-2 py-3 border-none focus:ring-0">
                @endif

                <button type="submit" class="p-2 bg-lime-500  border-none focus:ring-0">
                    <img src="{{ asset('img/buscar.png') }}" alt="Buscar" title="Buscar" width="24"
                        height="24">
                </button>
            </form>
        </div>

        @if ($productos->count())

            <div class="my-12 grid gap-x-8 md:gap-x-16 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

                @foreach ($productos as $producto)
                    <div class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-white">
                        <div class="w-full">
                            <img src="{{ asset('/storage/productos/' . $producto->imagen) }}" alt=""
                                title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                        </div>

                        <div class="w-full">
                            <div class="w-full p-4">
                                <p class="text-ellipsis line-clamp-1 font-bold text-xl xl:text-2xl">
                                    {{ $producto->nombre }}</p>
                                <p class="text-base text-gray-500 text-ellipsis line-clamp-1">
                                    {{ $producto->descripcion }}
                                </p>
                                <p class="mt-2 flex items-start text-sm font-bold">{{ $producto->stock }}+ <strong
                                        class="ml-1 bg-lime-600 px-2 pb-0.5 rounded-lg text-xs text-white font-bold uppercase">existencias</strong>
                                </p>
                                </p>
                                <div class="flex items-start mt-2">
                                    <span class="text-base mt-0.5 mr-0.5">US$</span>
                                    <span class="text-3xl "> {{ intval($producto->precio) }}</strong></span>
                                    @php
                                        $decimal = substr($producto->precio, -2);
                                    @endphp

                                    <span class="mt-0.5 ml-0.5 text-base font-light">{{ substr($producto->precio, -2) }}</span>

                                </div>
                            </div>

                            <div class="w-full p-4 flex items-center justify-between border-t border-gray-200">
                                <a href="#" title="Eliminar" class="px-2"
                                    wire:click="delete({{ $producto }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            svg {
                                                fill: #7d7d7d
                                            }
                                        </style>
                                        <path
                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </a>
                                <a href="#" wire:click="edit({{$producto}})" title="Editar"
                                    class="group text-center px-2">
                                    <span
                                        class="h-2 w-2 bg-lime-600 rounded-full inline-block group-hover:bg-orange-600"></span>
                                    <span
                                        class="h-2 w-2 bg-lime-600 rounded-full inline-block group-hover:bg-orange-600"></span>
                                    <span
                                        class="h-2 w-2 bg-lime-600 rounded-full inline-block group-hover:bg-orange-600"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                <span>0 resultados para </span> <span class="text-orange-700"> "{{ $buscar }}" </span>
            </div>

        @endif

        @if ($productos->hasPages())
            <div class="px-4 py-2 border-2 rounded-lg text-center mt-10">
                {{ $productos->onEachSide(0)->links() }}
            </div>
        @endif

    </div>

    <!--Modal delete -->

    <x-confirmation-modal wire:model="open_delete">

        <x-slot name="title">
            Esta acción no podrá ser reversada
        </x-slot>

        <x-slot name="content">
            ¿Está seguro de proceder con la eliminación del producto?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open_delete', false)" class="mr-2">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="destroy" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                Aceptar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <!--Modal edit -->

    <x-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b">Actualizar producto</p>
        </x-slot>

        <x-slot name="content">

            <div class=" mb-4">
                <x-label for="nombre" value="{{ __('Nombre') }}" class="text-zinc-800" />
                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" wire:model="nombre"
                    required autofocus />
                <x-input-error for="nombre" />
            </div>
            <div class="hidden">
                <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" wire:model="slug"
                    required autofocus />    
            </div>
            <div class="flex">
                <div class=" mb-4">
                    <x-label for="marca" value="{{ __('Marca') }}" class="text-zinc-800" />
                    <x-input id="marca" class="block mt-1 w-full" type="text" name="marca" wire:model="marca"
                        required autofocus />
                    <x-input-error for="marca" />
                </div>
                <div class=" mb-4 mx-2">
                    <x-label for="color" value="{{ __('Color') }}" class="text-zinc-800" />
                    <x-input id="color" class="block mt-1 w-full" type="text" name="color" wire:model="color"
                        required autofocus />
                    <x-input-error for="color" />
                </div>
                <div class=" mb-4">
                    <x-label for="talla" value="{{ __('Talla') }} (Si aplica)" class="text-zinc-800" />
                    <x-input id="talla" class="block mt-1 w-full" type="text" name="talla" wire:model="talla"
                        required autofocus />
                    <x-input-error for="talla" />
                </div>
            </div>
            <div class=" mb-4">
                <x-label for="descripcion" value="{{ __('descripcion') }}" class="text-zinc-800" />
                <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                    wire:model="descripcion" required autofocus />
                <x-input-error for="descripcion" />
            </div>
            
            <div class=" mb-4">
                <x-label for="id_subcategoria" value="{{ __('Categoría') }}" class="text-zinc-800" />
                <select name="id_subcategoria" wire:model="id_subcategoria"
                    class="w-full px-2 py-3 text-sm rounded-md border border-gray-200 focus:border-gray-300 focus:ring-0 text-zinc-800">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="id_subcategoria" />
            </div>
            <div class="flex flex-col sm:flex-row items-start justify-between w-full">
                <div class="basis-1/2 mb-4 w-full mr-4">
                    <div class="mb-4">
                        <x-label for="codigo" value="{{ __('Código') }}" class="text-zinc-800" />
                        <x-input id="codigo" class="block mt-1" type="text" name="codigo"
                            wire:model="codigo" required autofocus />
                        <x-input-error for="codigo" />
                    </div>
                    <div class="mb-4">
                        <x-label for="stock" value="{{ __('Existencias') }}" class="text-zinc-800" />
                        <x-input id="stock"
                            class="block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            type="number" step="any" name="stock" wire:model="stock" required autofocus />
                        <x-input-error for="stock" />
                    </div>
                    <div class="mb-4">
                        <x-label for="precio" value="{{ __('Precio') }}" class="text-zinc-800" />
                        <x-input id="precio"
                            class="block mt-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            type="number" step="any" name="precio" wire:model="precio" required autofocus />
                        <x-input-error for="precio" />
                    </div>
                </div>
                <div class="basis-1/2 w-full">
                    <p class="text-zinc-800">Imagen de la Categoría</p>

                    <div class="flex justify-between items-end mt-4">
                        @if ($imagenva)
                            <img src="{{ $imagenva->temporaryUrl() }}" class="p-4 border border-zinc-500 rounded"
                                width="240">
                        @else
                            <img src="{{ asset('../storage/productos/' . $imagen) }}" alt="" title=""
                                class="p-4 border border-zinc-500 rounded" width="240">
                        @endif
                    </div>

                    <div class="text-zinc-800 text-xs text-left lg:text-sm ">
                        <label for="{{ $identificador }}" class="cursor-pointer hover:underline">Seleccionar nueva
                            Imagen</label>
                        <input id="{{ $identificador }}" type="file" style="visibility:hidden;" name="imagenva"
                            wire:model="imagenva" required />
                        <x-input-error for="imagenva" />
                    </div>

                    <div wire:loading wire:target="imagenva" class="w-full text-xs font-semibold">
                        <p>¡Cargando imagen!...</p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex">
                <x-secondary-button wire:click="$set('open_edit', false)" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Aceptar
                </x-button>
            </div>
        </x-slot>

    </x-dialog-modal>

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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('creado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Producto creado satisfactoriamente.',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Producto Eliminado con éxito',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('actualizado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Producto Actualizado con éxito',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

</div>
