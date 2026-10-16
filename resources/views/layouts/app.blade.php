<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#1F3A33">

        <title>{{ $title ?? "Tu cuenta · Precap's Book" }}</title>
        <link rel="icon" href="{{ asset('favicon-precaps.svg') }}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon-precaps.png') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/precaps.css') }}?v=20261016d">
        <script>document.documentElement.className=document.documentElement.className.replace('no-js','js');</script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased text-tinta">
        <x-banner />

        @include('precaps.partials.nav')

        @if (isset($header))
            <header class="cabecera">
                <div class="wrap">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main id="contenido">
            {{ $slot }}
        </main>

        @include('precaps.partials.pie')

        @stack('modals')

        @livewireScripts
        <script src="{{ asset('js/precaps.js') }}?v=20261016d" defer></script>
    </body>
</html>
