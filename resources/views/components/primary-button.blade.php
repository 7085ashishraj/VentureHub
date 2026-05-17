<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-zinc-200 active:bg-zinc-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-zinc-950 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
