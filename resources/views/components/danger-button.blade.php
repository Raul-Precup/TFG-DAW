<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center min-h-[44px] px-5 bg-[#B3261E] border border-transparent rounded-full font-bold text-sm text-white hover:bg-[#8F1E18] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#B3261E] focus-visible:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>