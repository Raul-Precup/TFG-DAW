<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-8']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-5 py-6 sm:p-7 bg-hueso border border-linea rounded-tapa shadow-[0_6px_18px_-10px_rgba(31,58,51,.35)]">
            {{ $content }}
        </div>
    </div>
</div>