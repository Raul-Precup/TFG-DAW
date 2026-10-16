@php($v = '20261016d')
<!doctype html>
<html lang="es" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('titulo', "Precap's Book · Hotel y reservas en línea")</title>
  <meta name="description" content="@yield('descripcion', 'Precap’s Book: elige habitación, marca tus fechas y reserva en línea. Sigue el estado de tu reserva desde tu cuenta.')">
  <meta name="theme-color" content="#1F3A33">

  <meta property="og:type" content="website">
  <meta property="og:locale" content="es_ES">
  <meta property="og:site_name" content="Precap's Book">
  <meta property="og:title" content="@yield('titulo', "Precap's Book · Hotel y reservas en línea")">
  <meta property="og:description" content="Tu próxima historia empieza aquí. Elige habitación, marca tus fechas y reserva en línea.">
  <meta property="og:image" content="{{ asset('img/precaps/og-imagen.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" href="{{ asset('favicon-precaps.svg') }}" type="image/svg+xml">
  <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon-precaps.png') }}">

  <link rel="preload" href="{{ asset('fonts/precaps/libre-caslon-display-normal-400.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="{{ asset('fonts/precaps/manrope-normal-400-700.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="stylesheet" href="{{ asset('css/precaps.css') }}?v={{ $v }}">
  <script>document.documentElement.className=document.documentElement.className.replace('no-js','js');</script>
  @stack('head')
</head>
<body class="@yield('clase-body')">
  <a class="saltar" href="#contenido">Saltar al contenido</a>

  @include('precaps.partials.nav')

  <main id="contenido">
    @yield('contenido')
  </main>

  @include('precaps.partials.pie')

  @hasSection('sin-barra')
  @else
    <div class="barra-reserva is-oculta" data-barra>
      <a class="btn btn--cta" href="@yield('barra-href', url('our_rooms'))">Reservar
        <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  @endif

  <script src="{{ asset('vendor/precaps/gsap.min.js') }}" defer></script>
  <script src="{{ asset('vendor/precaps/ScrollTrigger.min.js') }}" defer></script>
  <script src="{{ asset('vendor/precaps/SplitText.min.js') }}" defer></script>
  <script src="{{ asset('vendor/precaps/lenis.min.js') }}" defer></script>
  <script src="{{ asset('js/precaps.js') }}?v={{ $v }}" defer></script>
  @stack('scripts')
</body>
</html>
