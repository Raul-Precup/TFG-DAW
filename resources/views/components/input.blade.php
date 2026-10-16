@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'min-h-[48px] border-linea bg-papel rounded-md shadow-none text-tinta focus:border-brand focus:ring-[3px] focus:ring-brand-soft']) !!}>