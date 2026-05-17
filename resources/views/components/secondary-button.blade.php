<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-zinc-900 border border-zinc-700 rounded-md font-semibold text-xs text-zinc-200 uppercase tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-zinc-950 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
