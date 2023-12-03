@section('title', 'Crear cuenta | Ebeli')
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-3xl mt-4 mb-8">
            Crear cuenta
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <x-button class="mt-4">
                Continuar
            </x-button>

            <div class="mt-4 text-sm font-light text-gray-300">
                Al crear una cuenta, aceptas las <a href="{{ route('condiciones') }}" target="_blank" class="text-lime-600 hover:underline">Condiciones de uso</a>
                y las <a href="{{ route('politicas') }}" target="_blank" class="text-lime-600 hover:underline mr-1">Políticas de privacidad</a>de Ebeli.com
            </div>

            <div class="mt-4 border-t border-gray-600 pt-4">
                <a class="text-sm text-lime-600 hover:underline" href="{{ route('login') }}">
                    ¿Ya tienes una cuenta?
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>