<div>
    <nav class="bg-zinc-900 text-white border-b border-gray-600">
        
        <div class="max-w-screen-xl flex flex-wrap md:flex-nowrap items-center justify-between mx-auto px-4 py-2">
            <a href="{{ route('/') }}"
                class="min-w-[112px] flex items-center rounded-sm border border-transparent hover:border-white py-3">
                <img src="{{ asset('img/logoc.png') }}" alt="Logo" title="Logo" width="32">
                <h1 class="text-2xl font-semibold mr-2 whitespace-nowrap">Ebeli&trade;</h1>
            </a>
            <div class="flex items-center">
                <a href="{{ route('buscar') }}">
                    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                        aria-expanded="false"
                        class="md:hidden text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm p-2.5 me-1">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </a>
                <div class="flex items-center px-2">
                    <button type="button"
                        class="flex items-center justify-center text-xl font-medium w-10 h-10 hover:border-2 border-gray-200 text-lime-500 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom" title="Bienvenido {{ ucwords(Auth::user()->name) }}">
                        <span class="sr-only">Open user menu</span>
                        <i class="fa-solid fa-user"></i>
                    </button>

                    <!-- Dropdown menu -->
                    <div class="z-50 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span
                                class="block text-sm text-gray-900 dark:text-white">{{ ucwords(Auth::user()->name) }}</span>
                            <span
                                class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('/') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                    <i class="fa-solid fa-home"></i>
                                    <span class="ml-2">Home</span></a>
                            </li>
                            <li>
                                <a href="{{ route('profile.show') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="ml-2">Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admincom') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                    <i class="fa-solid fa-credit-card"></i>
                                    <span class="ml-2">Mis Compras</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admincat') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <span class="ml-2">Categorías</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('adminpro') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                    <i class="fa-solid fa-store"></i>
                                    <span class="ml-2">Productos</span>
                                </a>
                            </li>
                            <li class="mt-3 border-t">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                        <span class="ml-2">Cerrar sesión</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <a href="{{ route('carro') }}"
                            class="w-10 h-10 text-xl flex items-center justify-center hover:border-2 border-gray-200 font-medium text-white focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <p class="ml-0.5 mb-4 text-lime-500 text-[10px] text-center font-bold">{{\Cart::getTotalQuantity()}}</p>    
                        </a>

                
            </div>
        </div>
    </nav>
</div>
