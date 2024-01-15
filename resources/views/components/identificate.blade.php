<div>
    @if (Route::has('login'))
        @auth
            <div class="mb-8 border-y border-zinc-300  py-10 flex flex-col items-center text-xs font-semibold">
                <p class="px-10 py-2 border-b border-gray-400 mb-1">Cliente autenticado: <span class="uppercase font-normal text-sm">{{ucwords(Auth::user()->name)}}</span></p>
                
                <div class="text-xs">
                    
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <span>¿Deseas cerrar tu sesión?</span>
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                        class="text-orange-600 hover:underline">Hazlo aquí.
                        </a>
                    </form>
                    
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