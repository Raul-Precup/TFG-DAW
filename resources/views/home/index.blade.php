@extends('precaps.layout')

@section('barra-href', '#reservar')

@section('contenido')

<!-- ===== INICIO Portada ===== -->
<section class="portada" data-portada>
  <div class="portada__libro" data-libro-portada data-cinta-contenedor="#reservar">
    <picture>
      <source media="(min-width: 700px)" srcset="{{ asset('img/precaps/portada-1440.webp') }}">
      <img class="portada__img" src="{{ asset('img/precaps/portada-800.webp') }}" width="1440" height="960" alt="Habitación del hotel con cama de matrimonio y un gran ventanal abierto a la vegetación" fetchpriority="high">
    </picture>
    <span class="portada__tapa portada__tapa--izq" aria-hidden="true"></span>
    <span class="portada__tapa portada__tapa--der" aria-hidden="true"></span>
    <span class="portada__lomo" aria-hidden="true"></span>

    @include('precaps.partials.sello', ['id' => 'portada', 'cinta' => '#C8573F'])

    <div class="cinta" aria-hidden="true"><span class="cinta__tela"></span></div>

    <div class="portada__texto">
      <p class="portada__ceja" data-hero-in>Hotel y reservas en línea</p>
      <h1 class="portada__titulo">
        <span class="linea"><span class="linea-in">Tu próxima</span></span>
        <span class="linea"><span class="linea-in"><span class="acento">historia</span></span></span>
        <span class="linea"><span class="linea-in">empieza aquí.</span></span>
      </h1>
      <p class="portada__sub" data-hero-in>Elige fechas, reserva tu habitación en un minuto y sigue desde tu cuenta cuándo la confirma el hotel.</p>
    </div>
  </div>

  <form class="reserva" id="reservar" data-reserva data-hero-in data-barra-ocultar>
    <div class="reserva__campo">
      <label for="llegada">Llegada</label>
      <input id="llegada" name="llegada" type="date" data-fecha-llegada>
    </div>
    <div class="reserva__campo">
      <label for="salida">Salida</label>
      <input id="salida" name="salida" type="date" data-fecha-salida>
    </div>
    <div class="reserva__campo reserva__campo--hab">
      <label for="habitacion">Habitación</label>
      <select id="habitacion" name="habitacion" required>
        <option value="">Elige una habitación</option>
        @foreach ($room as $r)
          <option value="{{ url('room_details', $r->id) }}">{{ $r->room_title }}@if ($r->price) · {{ $r->price }} €/noche @endif</option>
        @endforeach
      </select>
    </div>
    <button class="btn btn--cta" type="submit" data-cinta-hasta>
      Reservar
      <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
  </form>
</section>
<!-- ===== FIN Portada ===== -->

<!-- ===== INICIO Ventajas ===== -->
<section class="ventajas" aria-label="Ventajas de reservar en Precap's Book">
  <div class="wrap">
    <ul class="ventajas__lista">
      <li class="ventaja" data-reveal>
        <svg viewBox="0 0 32 32" aria-hidden="true" data-draw><rect x="4" y="6" width="24" height="22" rx="3"/><path d="M4 12h24M10 3v5M22 3v5"/><path d="M14 16h4v8l-2-2-2 2z"/></svg>
        <div><h3>Reserva en un minuto</h3><p>Eliges habitación y fechas, y listo.</p></div>
      </li>
      <li class="ventaja" data-reveal>
        <svg viewBox="0 0 32 32" aria-hidden="true" data-draw><circle cx="16" cy="16" r="12"/><polyline points="10,16.5 14.5,21 22,12"/></svg>
        <div><h3>Confirmación del hotel</h3><p>La recepción revisa y aprueba tu reserva.</p></div>
      </li>
      <li class="ventaja" data-reveal>
        <svg viewBox="0 0 32 32" aria-hidden="true" data-draw><path d="M5 13a16 16 0 0 1 22 0"/><path d="M9 17.5a10 10 0 0 1 14 0"/><path d="M13 22a4 4 0 0 1 6 0"/><circle cx="16" cy="26" r="1"/></svg>
        <div><h3>Wi-Fi incluido</h3><p>Lo verás en la ficha de cada habitación.</p></div>
      </li>
      <li class="ventaja" data-reveal>
        <svg viewBox="0 0 32 32" aria-hidden="true" data-draw><path d="M16 9c-3-2-8-2.5-12-1.5v17c4-1 9-.5 12 1.5 3-2 8-2.5 12-1.5v-17c-4-1-9-.5-12 1.5z"/><path d="M16 9v17"/></svg>
        <div><h3>Tus reservas a mano</h3><p>Consulta su estado en «Mis reservas».</p></div>
      </li>
      <li class="ventaja" data-reveal>
        <svg viewBox="0 0 32 32" aria-hidden="true" data-draw><rect x="4" y="8" width="24" height="17" rx="2"/><polyline points="4,10 16,18 28,10"/></svg>
        <div><h3>Contacto directo</h3><p>Escríbenos y te responde la recepción.</p></div>
      </li>
    </ul>
  </div>
</section>
<!-- ===== FIN Ventajas ===== -->

<!-- ===== INICIO Habitaciones ===== -->
<section class="seccion" id="habitaciones">
  <div class="wrap">
    <div class="seccion__cabeza seccion__cabeza--fila">
      <div>
        <p class="capitulo" data-capitulo><span class="capitulo__num">I</span><span class="capitulo__linea"></span><span>Habitaciones</span></p>
        <h2 class="titulo" data-split>Habitaciones para quedarse un día más.</h2>
        <p class="intro" data-reveal style="margin-top:16px">Desde una individual tranquila hasta la suite presidencial. Todas con su precio por noche y reserva en línea.</p>
      </div>
      <a class="enlace" href="{{ url('our_rooms') }}" data-reveal>Ver todas las habitaciones
        <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
    <div class="rejilla">
      @forelse ($room->take(6) as $r)
        @include('precaps.partials.tarjeta-habitacion', ['r' => $r])
      @empty
        <p class="intro">Todavía no hay habitaciones publicadas.</p>
      @endforelse
    </div>
  </div>
</section>
<!-- ===== FIN Habitaciones ===== -->

<!-- ===== INICIO El hotel ===== -->
<section class="seccion seccion--hondo" id="hotel">
  <div class="wrap">
    <div class="historia">
      <div class="historia__foto" data-libro>
        <picture>
          <source media="(min-width: 700px)" srcset="{{ asset('img/precaps/lectura-1400.webp') }}">
          <img src="{{ asset('img/precaps/lectura-700.webp') }}" width="1400" height="1750" alt="Una persona lee tranquilamente en la cama de una habitación luminosa" loading="lazy" decoding="async">
        </picture>
      </div>
      <div class="historia__texto">
        <p class="capitulo" data-capitulo><span class="capitulo__num">II</span><span class="capitulo__linea"></span><span>El hotel</span></p>
        <h2 class="titulo" data-split>Un hotel que se lee despacio.</h2>
        <p class="intro" data-reveal>Habitaciones tranquilas, luz natural y tiempo para ti. Aquí no hay prisa: eliges tu habitación, marcas tus fechas y del resto nos ocupamos nosotros.</p>
        <p class="intro" data-reveal>Cuando reservas, la recepción revisa tu petición y la confirma. Tú lo ves en tu cuenta, sin llamadas ni esperas.</p>
        <a class="enlace" href="{{ url('hotel_gallery') }}" data-reveal>Ver la galería
          <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>

    <div class="espacios" data-paginas>
      <figure class="espacio">
        <div class="espacio__foto"><img src="{{ asset('img/precaps/spa-700.webp') }}" width="640" height="800" alt="Zona de spa con tumbonas junto a un gran ventanal" loading="lazy" decoding="async"></div>
        <figcaption>Spa <small>Descanso</small></figcaption>
      </figure>
      <figure class="espacio">
        <div class="espacio__foto"><img src="{{ asset('img/precaps/desayuno-700.webp') }}" width="640" height="800" alt="Café y cruasanes recién hechos" loading="lazy" decoding="async"></div>
        <figcaption>Desayuno <small>Mañanas</small></figcaption>
      </figure>
      <figure class="espacio">
        <div class="espacio__foto"><img src="{{ asset('img/precaps/piscina-700.webp') }}" width="640" height="800" alt="Piscina infinita al atardecer con palmeras" loading="lazy" decoding="async"></div>
        <figcaption>Piscina <small>Atardeceres</small></figcaption>
      </figure>
      <figure class="espacio">
        <div class="espacio__foto"><img src="{{ asset('img/precaps/vestibulo-700.webp') }}" width="640" height="800" alt="Recepción del hotel con mostrador de piedra y plantas" loading="lazy" decoding="async"></div>
        <figcaption>Recepción <small>Bienvenida</small></figcaption>
      </figure>
    </div>
  </div>
</section>
<!-- ===== FIN El hotel ===== -->

<!-- ===== INICIO Galería ===== -->
<section class="seccion" id="galeria">
  <div class="wrap">
    <div class="seccion__cabeza seccion__cabeza--fila">
      <div>
        <p class="capitulo" data-capitulo><span class="capitulo__num">III</span><span class="capitulo__linea"></span><span>Galería</span></p>
        <h2 class="titulo" data-split>El hotel, página a página.</h2>
      </div>
      <a class="enlace" href="{{ url('hotel_gallery') }}" data-reveal>Ver la galería completa
        <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
    @include('precaps.partials.galeria', ['fotos' => $gallery->take(9)])
  </div>
</section>
<!-- ===== FIN Galería ===== -->

<!-- ===== INICIO Opiniones ===== -->
<section class="seccion seccion--hondo" id="opiniones">
  <div class="wrap">
    <div class="seccion__cabeza seccion__cabeza--fila">
      <div>
        <p class="capitulo" data-capitulo><span class="capitulo__num">IV</span><span class="capitulo__linea"></span><span>Opiniones</span></p>
        <h2 class="titulo" data-split>Lo que se cuenta de una estancia aquí.</h2>
        <p class="etiqueta-demo" data-reveal style="margin-top:16px">Opiniones de ejemplo · hotel de demostración</p>
      </div>
      <div class="opiniones__sello" data-reveal>
        @include('precaps.partials.sello', ['id' => 'opiniones', 'clase' => 'is-girando'])
      </div>
    </div>
    <div class="opiniones">
      <figure class="opinion" data-reveal>
        <blockquote>Reservé en dos minutos y al día siguiente ya tenía la confirmación en mi cuenta.</blockquote>
        <figcaption><span class="opinion__inicial" aria-hidden="true">L</span><span><strong>Lucía M.</strong>Escapada de fin de semana</span></figcaption>
      </figure>
      <figure class="opinion" data-reveal>
        <blockquote>La Suite Junior es tal cual las fotos. Volveremos.</blockquote>
        <figcaption><span class="opinion__inicial" aria-hidden="true">C</span><span><strong>Carlos y Ana</strong>Aniversario</span></figcaption>
      </figure>
      <figure class="opinion" data-reveal>
        <blockquote>Me encantó ver el estado de la reserva sin tener que llamar.</blockquote>
        <figcaption><span class="opinion__inicial" aria-hidden="true">M</span><span><strong>Marta G.</strong>Viaje de trabajo</span></figcaption>
      </figure>
    </div>
  </div>
</section>
<!-- ===== FIN Opiniones ===== -->

<!-- ===== INICIO Cierre ===== -->
<section class="seccion" aria-labelledby="cierre-titulo">
  <div class="cierre" data-cinta-contenedor>
    <picture>
      <source media="(min-width: 700px)" srcset="{{ asset('img/precaps/cierre-1600.webp') }}">
      <img class="cierre__img" src="{{ asset('img/precaps/cierre-900.webp') }}" width="1600" height="1067" alt="" loading="lazy" decoding="async" data-parallax>
    </picture>
    <div class="cinta" aria-hidden="true"><span class="cinta__tela"></span></div>
    <div class="cierre__texto">
      <h2 class="cierre__titulo" id="cierre-titulo" data-split>Marca tus fechas. Nosotros guardamos tu habitación.</h2>
      <p data-reveal>Elige habitación, reserva en un minuto y sigue el estado desde tu cuenta.</p>
      <a class="btn btn--cta" href="#reservar" data-reveal data-cinta-hasta>Reservar
        <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </div>
</section>
<!-- ===== FIN Cierre ===== -->

@include('precaps.partials.contacto')

@endsection
