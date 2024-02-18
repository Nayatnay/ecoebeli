@section('title', 'SubCategorías | Ebeli')
<div>
    <div class="bg-white shadow">
        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sub-Categorías
            </h2>
            @livewire('subcategorias.crear-subcategoria')
        </div>
    </div>

    <div class="p-4 max-w-screen-xl mx-auto">

        <!-- formulario de busqueda -->

        <div class="w-full mt-4 ">
            <form action="{{ route('adminsubcat') }}"
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

        @if ($subcategorias->count())

            <div class="w-full my-12 p-4 border  min-h-0 overflow-auto rounded-lg text-base">

                <table
                    class="table-fixed bg-white w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                    <tbody class="text-left text-base">

                        @foreach ($subcategorias as $subcategoria)
                            <tr class="h-14 hover:bg-gray-100">
                                <td class="pl-4 w-48">{{ $subcategoria->nombre }}</td>

                                <td class="w-[32px]">
                                    <img src="{{ asset('/storage/categorias/' . $subcategoria->categoria->imagen) }}"
                                        alt="" title="" class="bg-red-100 rounded w-full">

                                </td>
                                <td class="pl-2 w-96 min-w-96 text-gray-600">{{ $subcategoria->categoria->nombre }}</td>
                                <td class="w-20">
                                    <a href="#" title="Eliminar" wire:click="delete({{ $subcategoria->id }})">
                                        <i class="fa-solid fa-trash text-orange-600"></i>
                                    </a>
                                </td>
                                <td class="w-20">
                                    <a href="#" wire:click="edit({{ $subcategoria->id }})" title="Editar"
                                        class="group text-center">
                                        <span
                                            class="h-1 w-1 bg-lime-600 rounded-full inline-block group-hover:bg-orange-600"></span>
                                        <span
                                            class="h-1 w-1 bg-lime-600 rounded-full inline-block group-hover:bg-orange-600"></span>
                                        <span
                                            class="h-1 w-1 bg-lime-600 rounded-full inline-block group-hover:bg-orange-600"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="mt-4 bg-white text-base font-semibold sm:px-10 px-5 py-2 shadow">
                    <span>0 resultados para </span> <span class="text-orange-700"> "{{ $buscar }}" </span>
                </div>
        @endif

        @if ($subcategorias->hasPages())
            <div class="px-4 py-2 border-2 rounded-lg text-center mt-10">
                {{ $subcategorias->onEachSide(0)->links() }}
            </div>
        @endif

    </div>

    <!--Modal edit -->

    <x-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            <p class="font-bold text-left pb-4 border-b">Actualizar Subcategoría</p>
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
                <x-label for="id_categoria" value="{{ __('Categoría') }}" class="text-zinc-800" />
                <select name="id_categoria" wire:model="id_categoria"
                    class="w-full px-2 py-3 text-sm rounded-md border border-gray-200 focus:border-gray-300 focus:ring-0 text-zinc-800">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categ as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="id_categoria" />
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
            ¿Está seguro de proceder con la eliminación de la Subcategoría?
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
                text: 'Sub-Categoría creada satisfactoriamente.',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Sub-Categoría Eliminada con éxito',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('actualizado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Sub-Categoría Actualizada con éxito',
                confirmButtonColor: '#65a30d',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

</div>
