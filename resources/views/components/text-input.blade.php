@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-zinc-700 bg-zinc-950 text-white placeholder-zinc-500 focus:border-white focus:ring-white rounded-xl shadow-sm px-4 py-3']) }}>
