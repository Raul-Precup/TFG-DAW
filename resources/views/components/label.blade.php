@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-bold uppercase tracking-[.12em] text-gris']) }}>
    {{ $value ?? $slot }}
</label>