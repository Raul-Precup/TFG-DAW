@php
  $enlaces = [
    ['Inicio', url('/'), request()->is('/') || request()->is('home')],
    ['Habitaciones', url('our_rooms'), request()->is('our_rooms') || request()->is('room_details/*')],
    ['Galería', url('hotel_gallery'), request()->is('hotel_gallery')],
    ['Contacto', url('contact_us'), request()->is('contact_us')],
    ['Mis reservas', url('my_bookings'), request()->is('my_bookings')],
  ];
  $reservarHref = request()->is('/') ? '#reservar' : url('our_rooms');
  $usuario = Auth::user();
  $iniciales = $usuario ? collect(preg_split('/\s+/', trim($usuario->name)))->filter()->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->take(2)->join('') : '';
@endphp
<!-- ===== INICIO Navegación ===== -->
<header class="nav" data-nav>
  <div class="wrap nav__inner">
    @include('precaps.partials.logo')

    <nav aria-label="Principal">
      <ul class="nav__links">
        @foreach ($enlaces as [$texto, $href, $activo])
          <li><a href="{{ $href }}" @if ($activo) aria-current="page" @endif>{{ $texto }}</a></li>
        @endforeach
      </ul>
    </nav>

    <div class="nav__actions">
      @auth
        <div class="usuario" data-usuario>
          <button class="usuario__boton" type="button" aria-expanded="false" aria-controls="menu-usuario" aria-label="Tu cuenta: {{ $usuario->name }}">{{ $iniciales }}</button>
          <div class="usuario__menu" id="menu-usuario" hidden>
            <p class="usuario__quien"><strong>{{ $usuario->name }}</strong>{{ $usuario->email }}</p>
            @if ($usuario->usertype === 'admin')
              <a href="{{ url('home') }}">Panel de administración</a>
            @endif
            <a href="{{ url('my_bookings') }}">Mis reservas</a>
            <a href="{{ route('profile.show') }}">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit">Cerrar sesión</button>
            </form>
          </div>
        </div>
      @else
        <a class="nav__entrar" href="{{ route('login') }}">Entrar</a>
      @endauth
      <a class="btn btn--cta btn--sm" href="{{ $reservarHref }}">Reservar</a>
      <button class="nav__toggle" type="button" aria-expanded="false" aria-controls="menu-movil" data-menu-toggle><span class="visually-hidden">Abrir menú</span><span aria-hidden="true"></span></button>
    </div>
  </div>

  <div class="menu-movil" id="menu-movil" hidden data-menu>
    <button class="menu-movil__cerrar" type="button" data-menu-cerrar><span aria-hidden="true">×</span><span class="visually-hidden">Cerrar menú</span></button>
    <ul class="menu-movil__links">
      @foreach ($enlaces as $i => [$texto, $href, $activo])
        <li><a href="{{ $href }}" @if ($activo) aria-current="page" @endif><span>{{ ['I', 'II', 'III', 'IV', 'V'][$i] }}</span>{{ $texto }}</a></li>
      @endforeach
    </ul>
    <a class="btn btn--cta" href="{{ $reservarHref }}">Reservar</a>
    <div class="menu-movil__cuenta">
      @auth
        <span>{{ $usuario->name }}</span>
        @if ($usuario->usertype === 'admin')
          <a href="{{ url('home') }}">Panel de administración</a>
        @endif
        <a href="{{ route('profile.show') }}">Mi perfil</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">Cerrar sesión</button>
        </form>
      @else
        <a href="{{ route('login') }}">Entrar</a>
        <a href="{{ route('register') }}">Crear cuenta</a>
      @endauth
    </div>
  </div>
</header>
<!-- ===== FIN Navegación ===== -->
