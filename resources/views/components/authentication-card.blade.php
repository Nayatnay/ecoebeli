<div class="min-h-screen flex flex-col sm:justify-start items-center pt-6 sm:pt-0 bg-zinc-900 text-white">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-zinc-800 border border-zinc-500 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
