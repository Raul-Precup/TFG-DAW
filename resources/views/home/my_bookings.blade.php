@extends('precaps.layout')

@php($estados = ['waiting' => 'Pendiente de confirmar', 'approve' => 'Aprobada', 'rejected' => 'Rechazada'])

@section('titulo', "Mis reservas · Precap's Book")

@section('contenido')
  @include('precaps.partials.cabecera', [
    'num' => '§',
    'etiqueta' => 'Tu cuenta',
    'titulo' => 'Mis reservas',
    'intro' => 'Aquí ves cada reserva hecha con tu email y si el hotel ya la ha confirmado.',
  ])

  <!-- ===== INICIO Lista de reservas ===== -->
  <section class="seccion" style="padding-top:0">
    <div class="wrap">
      @if ($bookings->isEmpty())
        <div class="vacio" data-reveal>
          <h2 style="font-size:1.8rem">Todavía no tienes reservas.</h2>
          <p class="intro">Elige una habitación, marca tus fechas y aparecerá aquí.</p>
          <a class="btn btn--cta" href="{{ url('our_rooms') }}">Reservar</a>
        </div>
      @else
        <div class="reservas">
          @foreach ($bookings as $booking)
            @php($estado = $booking->status ?: 'waiting')
            <article class="reserva-item" data-reveal>
              @if ($booking->room && $booking->room->image)
                <img src="{{ asset('room/'.$booking->room->image) }}" alt="{{ $booking->room->room_title }}" loading="lazy">
              @else
                <span aria-hidden="true"></span>
              @endif
              <div>
                <h3>{{ $booking->room->room_title ?? 'Habitación retirada' }}</h3>
                <p>
                  {{ \Carbon\Carbon::parse($booking->start_date)->locale('es')->translatedFormat('j M Y') }}
                  →
                  {{ \Carbon\Carbon::parse($booking->end_date)->locale('es')->translatedFormat('j M Y') }}
                  @if ($booking->room && $booking->room->price) · {{ $booking->room->price }} €/noche @endif
                </p>
                <span class="estado estado--{{ $estado }}">{{ $estados[$estado] ?? ucfirst($estado) }}</span>
              </div>
              @if ($booking->room)
                <a class="enlace" href="{{ url('room_details', $booking->room->id) }}">Ver habitación</a>
              @endif
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>
  <!-- ===== FIN Lista de reservas ===== -->
@endsection
