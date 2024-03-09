@section('title', 'Categorías | Ebeli')
<div>
    <div class="bg-white shadow">
        <div class="p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reclamos
            </h2>
        </div>
    </div>

    <div class="p-4 max-w-screen-xl mx-auto">

        <div class="border-b border-gray-300 my-10 pb-20">

            <div class="pl-4">
                Casos pendientes
            </div>

            @if ($reclamosp->count())

                <div class="w-full mt-4 border border-zinc-800 min-h-0 overflow-auto rounded-lg text-base">

                    <table
                        class="rounded-lg table-fixed w-full font-light text-base md:text-lg text-left h-auto border-collapse">

                        <tbody class="text-left text-base">

                            @foreach ($reclamosp as $reclamo)
                                <tr class="h-10 odd:bg-gray-50">
                                    <td class="w-40 text-center">
                                        {{ date('d-m-Y H:i', strtotime($reclamo->created_at)) }}
                                    </td>
                                    <td class="w-20 text-center">{{ $reclamo->id_venta }}
                                    </td>
                                    <td class="pl-2 w-96">{{ $reclamo->mensaje }}</td>
                                    <td class="w-28 text-sm font-medium text-center">
                                        <a href="#" wire:click="marcar({{ $reclamo }})"
                                            title="Marcar como resuelto" class="hover:underline">
                                            Cerrar caso
                                        </a>
                                    </td>
                                    <td class="bg-zinc-800 text-white px-1 w-8 text-sm font-medium text-center">
                                        <a href="{{ route('venta', $reclamo->id_venta) }}" title="Detalles"
                                            class="hover:text-lime-400">
                                            <i class="fa-solid fa-ellipsis-vertical p-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-4 bg-white text-sm font-semibold sm:px-10 px-5 py-2 shadow">
                    <span>No hay reclamos pendientes </span>
                </div>
            @endif

            @if ($reclamosp->hasPages())
                <div class="mt-4 px-4 py-2 text-center ">
                    {{ $reclamosp->onEachSide(0)->links() }}
                </div>
            @endif
        </div>

        <!-- reclamos resueltos ---------------------->

        <div class="border-b border-gray-300 my-10 pb-20">

            <div class="pl-4">
                Casos Resueltos
            </div>

            @if ($reclamosr->count())

                <div class="w-full mt-4 border border-zinc-800 min-h-0 overflow-auto rounded-lg text-base">

                    <table
                        class="rounded-lg table-fixed w-full font-light text-base md:text-lg text-left h-auto border-collapse">
                        
                        <tbody class="text-left text-base">

                            @foreach ($reclamosr as $reclamr)
                                <tr class="h-10 odd:bg-gray-50">
                                    <td class="w-40 text-center">
                                        {{ date('d-m-Y H:i', strtotime($reclamr->created_at)) }}
                                    </td>
                                    <td class="w-40 text-center">
                                        {{ date('d-m-Y H:i', strtotime($reclamr->updated_at)) }}
                                    </td>
                                    <td class="w-20 text-center">{{ $reclamr->id_venta }}
                                    <td class="pl-2 w-72">{{ $reclamr->mensaje }}</td>
                                    <td class="text-lime-500 px-1 w-28 text-sm font-medium text-center">
                                        <a href="#" wire:click="marcar({{ $reclamr }})" title="Contactar"
                                            class="hover:text-lime-600">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </td>
                                    <td class="bg-zinc-800 text-white px-1 w-8 text-sm font-medium text-center">
                                        <a href="{{ route('venta', $reclamr->id_venta) }}" title="Detalles"
                                            class="hover:text-lime-400">
                                            <i class="fa-solid fa-ellipsis-vertical p-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-4 bg-white text-sm font-semibold sm:px-10 px-5 py-2 shadow">
                    <span>No hay reclamos resueltos </span>
                </div>
            @endif

            @if ($reclamosr->hasPages())
                <div class="mt-4 px-4 py-2 text-center ">
                    {{ $reclamosr->onEachSide(0)->links() }}
                </div>
            @endif
        </div>


    </div>

    <!--Modal conciliar -->

    <x-confirmation-modal wire:model="open">

        <x-slot name="title">
            Esta acción no podrá ser reversada
        </x-slot>

        <x-slot name="content">
            Marcar reclamo como resuelto
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancelar
            </x-secondary-button>

            <x-advert-button wire:click="resolver" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                Sí, Marcar como resuelto
            </x-advert-button>
        </x-slot>
    </x-confirmation-modal>

</div>
