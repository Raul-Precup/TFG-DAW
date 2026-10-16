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
        <link rel="stylesheet" href="{{ asset('css/precaps.css') }}?v=20261016c">
        <script>document.documentElement.className=document.documentElement.className.replace('no-js','js');</script>

        @livewireStyles
    </head>
    <body class="font-sans text-tinta antialiased">
        <div class="acceso">
            <aside class="acceso__foto" aria-hidden="true">
                <img src="{{ asset('img/precaps/portada-800.webp') }}" alt="">
                <div class="acceso__foto-texto">
                    @include('precaps.partials.logo', ['clase' => 'acceso__logo-claro'])
                    <p>Tu próxima <span class="acento">historia</span> empieza aquí.</p>
                </div>
            </aside>
            <main class="acceso__panel">
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
    </body>
</html>
