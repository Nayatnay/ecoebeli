<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Home') }}
            </h2>

        </div>

    </x-slot>

    <div class="">
        @livewire('principal.index-principal')
    </div>
    
</x-app-layout>