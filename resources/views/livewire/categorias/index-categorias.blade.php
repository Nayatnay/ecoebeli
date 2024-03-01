@section('title', 'Categorías | Ebeli')
<div>
    <div class="bg-white shadow">
        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías
            </h2>
            @livewire('categorias.crear-categoria')
        </div>
    </div>

    <div class="p-4 max-w-screen-xl mx-auto">

        <!-- formulario de busqueda -->

        <div class="w-full mt-4 ">
            <form action="{{ route('admincat') }}"
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

        @if ($categorias->count())

            <div class="my-12 grid gap-x-8 md:gap-x-16 gap-y-4 md:gap-y-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

                @foreach ($categorias as $categoria)
                    <div class="flex flex-col items-center justify-between border border-gray-200 rounded-lg bg-white">
                        <div class="w-full">
                            <a href="{{ route('productosporcategoria', $categoria->slug) }}">
                                <img src="{{ asset('/storage/categorias/' . $categoria->imagen) }}" alt=""
                                    title="" class="w-full rounded-tl-lg rounded-tr-lg" width="">
                            </a>
                        </div>

                        <div class="w-full">
                            <div class="w-full p-4 ">
                                <p class="text-ellipsis line-clamp-1 font-bold text-xl xl:text-2xl">
                                    {{ $categoria->nombre }}</p>
                                <p class="text-base font-normal text-ellipsis line-clamp-1">
                                    {{ $categoria->descripcion }}</p>
                            </div>
                            <div class="w-full p-4 flex items-center justify-between border-t border-gray-200">
                                <a href="#" title="Eliminar" class="px-2"
                                    wire:click="delete({{ $categoria->id }})">
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
                                <a href="#" wire:click="edit({{ $categoria }})" title="Editar"
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

        @if ($categorias->hasPages())
            <div class="px-4 py-2 text-center mt-10">
                {{ $categorias->onEachSide(0)->links() }}
            </div>
        @endif
    </div>

    <!--Modal edit -->

    <x-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b">Actualizar categoría</p>
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



            <div class=" mb-4">
                <x-label for="descripcion" value="{{ __('descripcion') }}" class="text-zinc-800" />
                <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                    wire:model="descripcion" required autofocus />
                <x-input-error for="descripcion" />
            </div>

            <p class="text-zinc-800">Imagen de la Categoría</p>

            <div class="flex justify-between items-end mt-4">
                @if ($imagenva)
                    <img src="{{ $imagenva->temporaryUrl() }}" class="p-4 border border-zinc-500 rounded"
                        width="240">
                @else
                    <img src="{{ asset('../storage/categorias/' . $imagen) }}" alt="" title=""
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

    <!--Modal delete -->

    <x-confirmation-modal wire:model="open_delete">

        <x-slot name="title">
            Esta acción no podrá ser reversada
        </x-slot>

        <x-slot name="content">
            ¿Está seguro de proceder con la eliminación de la categoría?
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
                text: 'Categoría creada satisfactoriamente.',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Categoría Eliminada con éxito',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('actualizado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Categoría Actualizada con éxito',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

</div>
