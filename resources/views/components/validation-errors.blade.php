@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'rounded-lg border border-[#E4B2A8] bg-[#FBEFEC] px-4 py-3 text-[#7A2A1D]']) }} role="alert">
        <div class="font-bold">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif