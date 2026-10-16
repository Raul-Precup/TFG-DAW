<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center min-h-[44px] px-5 bg-transparent border border-brand rounded-full font-bold text-sm text-brand hover:bg-brand hover:text-papel focus:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>