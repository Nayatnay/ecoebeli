<div>
    @if (Route::has('login'))
        @auth
            <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-sm font-semibold">

                <div class="flex items-center text-xs md:text-sm font-normal">
                    @php
                        $partes = explode(' ', ucwords(Auth::user()->name));
                    @endphp
                    <p class="bg-zinc-900 py-2 px-4 text-white rounded-tl-md rounded-bl-md"><i
                            class="fa-solid fa-toggle-on mr-2"></i>Cta Ebeli de</p>
                    <p class="bg-lime-600 font-semibold text-white uppercase py-2 px-4 rounded-tr-md rounded-br-md">
                        {{ $partes[0] }}
                    </p>
                </div>

                <div class="flex justify-center flex-wrap mt-4 px-4 font-normal text-xs">
                    <p class="text-gray-700 mb-2">Una manera sencilla de navegar en tu tienda</p>
                    <p>
                        <a href="{{ route('admintienda') }}" class="ml-1 text-lime-600 font-medium hover:underline">Visualiza
                            aquí</a>
                    </p>
                </div>
            </div>
        @else
            <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-sm">
                <div class="flex items-center text-sm font-normal text-white">
                    <a href="{{ route('login') }}" class="flex items-center rounded-md bg-lime-600 hover:bg-lime-500">
                        <p class="bg-zinc-900 py-2 px-4 rounded-tl-md rounded-bl-md"><i class="fa-solid fa-user"></i></p>
                        <p class="text-black rounded-tr-md rounded-br-md px-8 py-2">Identifícate</p>
                    </a>
                </div>
                <div class="text-center text-xs font-medium mt-4">
                    <span class="text-gray-800 mb-2">¿Eres un cliente nuevo?</span>
                    <span><a href="{{ route('register') }}" class="text-lime-600 hover:underline">Empieza aquí.</a></span>
                </div>
            </div>
        @endauth
    @endif
</div>
