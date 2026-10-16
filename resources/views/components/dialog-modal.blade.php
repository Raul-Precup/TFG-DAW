@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-5 bg-hueso">
        <div class="font-display text-2xl text-brand">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gris">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end gap-3 px-6 py-4 bg-papel-hondo text-end">
        {{ $footer }}
    </div>
</x-modal>