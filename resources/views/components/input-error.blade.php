@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-[#B3261E]']) }}>{{ $message }}</p>
@enderror