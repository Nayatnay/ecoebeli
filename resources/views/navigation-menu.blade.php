<nav x-data="{ open: false }" class="bg-zinc-900">
    <!-- Primary Navigation Menu -->
    <!-- Settings Dropdown -->
    <div class="relative flex items-center">
        <x-dropdown width="full">
            <x-slot name="trigger">

                <div class="flex">
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-2 py-3 rounded border border-transparent text-sm leading-4 font-semibold text-white hover:border-gray-400 focus:border-gray-400 transition ease-in-out duration-150">
                            {{ Auth::user()->name }}

                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </span>

                </div>

            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-sm font-bold text-zinc-900 border-b">
                    Hola {{ Auth::user()->name }}
                    <p class="font-semibold text-gray-400">{{ Auth::user()->email }}</p>
                </div>

                <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Perfil') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('categorias') }}">
                    {{ __('Categorías') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('productos') }}">
                    {{ __('Productos') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('buscar') }}" class="sm:hidden block">
                    {{ __('Buscar') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('carro') }}"  class="sm:hidden block">
                    {{ __('Carrito') }}
                </x-dropdown-link>

                <div class="border-t border-gray-200"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        Cerrar sesión
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    </div>

</nav>