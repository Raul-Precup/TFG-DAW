@php
  $v = '20261016d';
  $menu = [
    ['Resumen', url('home'), request()->is('home'), 'M4 13h6V4H4zM14 20h6v-9h-6zM4 20h6v-4H4zM14 7h6V4h-6z'],
    ['Habitaciones', url('view_room'), request()->is('view_room') || request()->is('room_update/*'), 'M3 18v-6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v6M3 18h18M3 18v2M21 18v2M6 9V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3'],
    ['Añadir habitación', url('create_room'), request()->is('create_room'), 'M12 5v14M5 12h14'],
    ['Reservas', url('bookings'), request()->is('bookings'), 'M4 6h16v14H4zM4 10h16M9 3v4M15 3v4'],
    ['Galería', url('view_gallery'), request()->is('view_gallery'), 'M4 5h16v14H4zM4 15l5-5 4 4 3-3 4 4'],
    ['Mensajes', url('all_messages'), request()->is('all_messages') || request()->is('send_mail/*'), 'M4 6h16v12H4zM4 8l8 6 8-6'],
  ];
  $usuario = Auth::user();
@endphp
<!doctype html>
<html lang="es" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="robots" content="noindex">
  <title>@yield('titulo', 'Panel') · Precap's Book</title>
  <link rel="icon" href="{{ asset('favicon-precaps.svg') }}" type="image/svg+xml">
  <link rel="preload" href="{{ asset('fonts/precaps/libre-caslon-display-normal-400.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="{{ asset('fonts/precaps/manrope-normal-400-700.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="stylesheet" href="{{ asset('css/precaps.css') }}?v={{ $v }}">
  <link rel="stylesheet" href="{{ asset('css/precaps-admin.css') }}?v={{ $v }}">
  <script>document.documentElement.className=document.documentElement.className.replace('no-js','js');</script>
</head>
<body class="panel">
  <a class="saltar" href="#contenido">Saltar al contenido</a>

  <!-- ===== INICIO Barra lateral ===== -->
  <aside class="panel__lateral" id="panel-menu" data-panel-menu>
    @include('precaps.partials.logo', ['clase' => 'panel__logo', 'href' => url('home')])
    <p class="panel__rol">Panel del hotel</p>
    <nav aria-label="Panel">
      <ul class="panel__menu">
        @foreach ($menu as [$texto, $href, $activo, $icono])
          <li>
            <a href="{{ $href }}" @if ($activo) aria-current="page" @endif>
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="{{ $icono }}"/></svg>
              {{ $texto }}
            </a>
          </li>
        @endforeach
      </ul>
    </nav>
    <a class="panel__web" href="{{ url('/') }}">Ver la web
      <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </aside>
  <!-- ===== FIN Barra lateral ===== -->

  <div class="panel__cuerpo">
    <!-- ===== INICIO Barra superior ===== -->
    <header class="panel__arriba">
      <button class="panel__toggle" type="button" aria-expanded="false" aria-controls="panel-menu" data-panel-toggle>
        <span aria-hidden="true"></span><span class="visually-hidden">Abrir menú del panel</span>
      </button>
      <div class="panel__titulo">
        <p class="panel__ceja">@yield('ceja', 'Panel')</p>
        <h1>@yield('titulo', 'Panel')</h1>
      </div>
      <div class="panel__usuario">
        @if ($usuario)
          <span class="panel__nombre">{{ $usuario->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn--ghost btn--sm" type="submit">Cerrar sesión</button>
          </form>
        @else
          <a class="btn btn--ghost btn--sm" href="{{ route('login') }}">Entrar</a>
        @endif
      </div>
    </header>
    <!-- ===== FIN Barra superior ===== -->

    <main class="panel__contenido" id="contenido">
      @include('precaps.partials.aviso')
      @yield('contenido')
    </main>
  </div>

  <script src="{{ asset('vendor/precaps/gsap.min.js') }}" defer></script>
  <script src="{{ asset('vendor/precaps/ScrollTrigger.min.js') }}" defer></script>
  <script src="{{ asset('js/precaps.js') }}?v={{ $v }}" defer></script>
</body>
</html>
