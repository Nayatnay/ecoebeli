<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full items-center px-4 py-3 bg-zinc-700 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-zinc-700 focus:bg-zinc-700 active:bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
