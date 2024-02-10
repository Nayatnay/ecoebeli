@section('title', 'Iniciar sesion | Ebeli')
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-3xl mt-4 mb-8">
            Iniciar sesión
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-lime-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" >
            @csrf
            
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-300">Recuérdame</span>
                </label>
            </div>

            <div class="mt-4">


                <x-button class="">
                    Continuar
                </x-button>
            </div>
        </form>

        <div class="mt-2 text-sm font-light text-gray-300">
            Al continuar aceptas las <a href="{{ route('condiciones') }}" target="_blank" class="text-lime-600 hover:underline">Condiciones de uso</a>
            y las <a href="{{ route('politicas') }}" target="_blank" class="text-lime-600 hover:underline mr-2">Políticas de privacidad</a>
        </div>

        <div class="mt-5">
            @if (Route::has('password.request'))
            <a class="text-sm text-lime-600 hover:underline" href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
            @endif
        </div>

        <div class="mt-6 border-t border-gray-600 py-2 text-center text-sm font-light">
            <p class="mb-2 text-xs text-gray-400">¿Eres nuevo en Ebeli?</p>
            <a class="text-sm hover:underline bg-zinc-500 text-gray-100 border border-gray-500 rounded block w-full p-2 ring-zinc-500 focus:ring"
             href="{{ route('register') }}">
                Crea tu cuenta de Ebeli
            </a>
        </div>


    </x-authentication-card>
</x-guest-layout>