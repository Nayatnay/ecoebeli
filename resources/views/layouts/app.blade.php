<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ebeli&trade;</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="flex items-center justify-between bg-zinc-900 shadow text-white sm:px-10 px-2 py-1 w-full">

        <div class="sm:mr-4 min-w-[140px]">
            <a href="{{route('/')}}" class="flex items-center rounded-sm border border-transparent hover:border-white py-2">
                <img src="{{asset('img/logoc.png')}}" alt="Logo" title="Logo" width="40">
                <h1 class="text-3xl font-semibold mr-2">ebeli&trade;</h1>
            </a>
        </div>

        @if (Route::has('login'))
        <div class="">
            @auth
            <div class="flex items-center justify-end text-sm ml-4">
                <a href="{{ route('buscar') }}" class="hidden lg:hidden sm:block p-2 mr-2 rounded border border-transparent hover:border-gray-400">
                    <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="auto">
                </a>
                <a href="{{ route('carro') }}" class="hidden lg:w-28 sm:flex items-center justify-center font-semibold border border-transparent rounded hover:border-gray-400 px-2 py-2"><img src="{{asset('img/carw.png')}}" alt="Compras" title="Compras" width="24" class="mr-2 ">
                    <p class="hidden lg:block text-sm">Carrito</p>
                </a>
                @livewire('navigation-menu')
            </div>
            @else
            <div class="flex items-center justify-end text-sm ml-4">
                <a href="{{ route('buscar') }}" class="lg:hidden block p-2  rounded border border-transparent hover:border-gray-400">
                    <img src="{{asset('img/buscar.png')}}" alt="Buscar" title="Buscar" width="24" height="auto">
                </a>
                <a href="{{ route('carro') }}" class="lg:w-28 flex items-end justify-center font-semibold border border-transparent rounded hover:border-gray-400 px-2 py-2"><img src="{{asset('img/carw.png')}}" alt="Compras" title="Compras" width="24">
                    <p class="hidden lg:block ml-2 text-sm">Carrito</p>
                </a>
                <a href="{{ route('login') }}" class="lg:min-w-[120px] inline-flex items-end font-semibold mr-1 p-2 border border-transparent rounded hover:border-gray-400">
                    <img src="{{asset('img/userw.png')}}" alt="Iniciar sesión" title="Iniciar sesión" width="24">
                    <p class="hidden lg:block ml-2 text-sm">Tu Cuenta</p>
                </a>
            </div>
            @endauth
        </div>
        @endif

    </div>
    <div>
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

</body>

</html>