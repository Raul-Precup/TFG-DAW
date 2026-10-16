@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-8']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="px-5 py-6 bg-hueso sm:p-7 border border-linea {{ isset($actions) ? 'rounded-t-[18px]' : 'rounded-tapa' }} shadow-[0_6px_18px_-10px_rgba(31,58,51,.35)]">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end gap-3 px-5 py-4 bg-papel-hondo text-end sm:px-7 border border-t-0 border-linea rounded-b-[18px]">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>