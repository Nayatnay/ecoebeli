<div>
    @if (Route::has('login'))
        @auth
            <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-sm font-semibold">
                <p class="px-10 py-2 border-b border-gray-400 mb-1 uppercase font-semibold text-lg">{{ucwords(Auth::user()->name)}}</p>
                
                <div class="text-center px-4 py-2 font-light">
                    <p>Una manera sencilla de navegar en tu tienda. <a href="{{ route('tienda') }}" class="text-orange-600 font-normal hover:underline">Visualiza aquí.</a></p>
                </div>
            </div>
        @else
            <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-xs font-semibold">
                <a href="{{ route('login') }}" class="rounded-md px-20 py-2 bg-lime-500 mb-1">Identifícate</a>
                <div class="text-xs">
                    <span>¿Eres un cliente nuevo?</span>
                    <a href="{{ route('register') }}" class="text-orange-600 hover:underline">Empieza aquí.</a>
                </div>
            </div>
        @endauth
    @endif
</div>