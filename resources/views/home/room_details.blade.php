@extends('precaps.layout')

@php($tipos = ['regular' => 'Clásica', 'premium' => 'Premium', 'deluxe' => 'Deluxe'])

@section('titulo', ($room->room_title ?? 'Habitación')." · Precap's Book")
@section('barra-href', '#reservar-habitacion')

@section('contenido')
@if (!$room)
  @include('precaps.partials.cabecera', [
    'num' => 'I',
    'etiqueta' => 'Habitaciones',
    'titulo' => 'Esta habitación ya no está disponible.',
    'intro' => 'Puede que se haya retirado. Elige otra entre todas las habitaciones del hotel.',
  ])
  <div class="wrap"><a class="btn btn--ghost" href="{{ url('our_rooms') }}">Ver habitaciones</a></div>
@else
  <!-- ===== INICIO Ficha de habitación ===== -->
  <section class="cabecera" style="padding-bottom:28px">
    <div class="wrap">
      <a class="enlace" href="{{ url('our_rooms') }}" style="margin-bottom:10px">
        <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true" style="rotate:180deg"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Todas las habitaciones
      </a>
      <p class="capitulo" data-capitulo><span class="capitulo__num">I</span><span class="capitulo__linea"></span><span>{{ $tipos[$room->room_type] ?? 'Habitación' }}</span></p>
      <h1 class="cabecera__titulo" data-split>{{ $room->room_title }}</h1>
    </div>
  </section>

  <div class="wrap ficha">
    <div>
      <div class="ficha__foto" data-libro>
        @if ($room->image)
          <img src="{{ asset('room/'.$room->image) }}" width="1000" height="750" alt="{{ $room->room_title }}" fetchpriority="high">
        @endif
        @if ($room->price)
          <span class="tarjeta__precio" data-cinta>{{ $room->price }} €<small>/ noche</small></span>
        @endif
      </div>
      <ul class="ficha__datos" data-reveal>
        <li>{{ $tipos[$room->room_type] ?? ucfirst((string) $room->room_type) }}</li>
        <li>{{ $room->wifi === 'yes' ? 'Wi-Fi incluido' : 'Sin Wi-Fi' }}</li>
        @if ($room->price)<li>{{ $room->price }} € por noche</li>@endif
      </ul>
      @if ($room->description)
        <p class="ficha__desc" data-reveal>{{ $room->description }}</p>
      @endif
    </div>

    <aside class="ficha__reserva" id="reservar-habitacion">
      <form class="formulario" action="{{ url('add_booking', $room->id) }}" method="POST" data-reveal data-barra-ocultar>
        @csrf
        <h2>Reserva esta habitación</h2>
        <p class="formulario__nota" style="margin-top:-6px">Marca tus fechas. El hotel revisa la reserva y la verás en «Mis reservas».</p>
        @include('precaps.partials.aviso')
        <div class="campo">
          <label for="r-nombre">Nombre</label>
          <input id="r-nombre" type="text" name="name" autocomplete="name" value="{{ old('name', Auth::user()->name ?? '') }}" required>
        </div>
        <div class="campo">
          <label for="r-email">Email</label>
          <input id="r-email" type="email" name="email" autocomplete="email" value="{{ old('email', Auth::user()->email ?? '') }}" required>
        </div>
        <div class="campo">
          <label for="r-telefono">Teléfono</label>
          <input id="r-telefono" type="tel" name="phone" inputmode="tel" autocomplete="tel" value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
        </div>
        <div class="formulario__fila">
          <div class="campo">
            <label for="r-llegada">Llegada</label>
            <input id="r-llegada" type="date" name="startDate" value="{{ old('startDate', request('llegada')) }}" required data-fecha-llegada>
          </div>
          <div class="campo">
            <label for="r-salida">Salida</label>
            <input id="r-salida" type="date" name="endDate" value="{{ old('endDate', request('salida')) }}" required data-fecha-salida>
          </div>
        </div>
        <button class="btn btn--cta" type="submit" style="width:100%">Reservar
          <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        @guest
          <p class="formulario__nota">Para seguir tu reserva en «Mis reservas», <a href="{{ route('login') }}">entra</a> o <a href="{{ route('register') }}">crea una cuenta</a> con el mismo email.</p>
        @endguest
      </form>
    </aside>
  </div>
  <!-- ===== FIN Ficha de habitación ===== -->
@endif
@endsection
