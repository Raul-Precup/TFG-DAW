<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="font-display text-2xl leading-tight text-brand">{{ $title }}</h3>

        <p class="mt-2 text-sm text-gris">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>