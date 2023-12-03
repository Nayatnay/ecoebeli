<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Home') }}
            </h2>

            <a href="{{ route('carrito') }}" class="flex items-end font-light border border-transparent rounded-sm hover:border-white">
                <img src="{{asset('img/car.png')}}" alt="Compras" width="20">
                <p class="hidden lg:block ml-2 text-sm">Carrito</p>
            </a>

        </div>


    </x-slot>

    <div class="px-4 py-12">
        <div class="max-w-7xl mx-auto">
            @livewire('principal.index-principal')
        </div>
    </div>
</x-app-layout>