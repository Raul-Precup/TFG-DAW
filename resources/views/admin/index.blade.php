@extends('precaps.admin')

@php
  // Totales de lectura para el resumen (sin tocar el controlador)
  $totalHabitaciones = \App\Models\Room::count();
  $pendientes = \App\Models\Booking::where('status', 'waiting')->count();
  $aprobadas = \App\Models\Booking::where('status', 'approve')->count();
  $mensajes = \App\Models\Contact::count();
  $ultimas = \App\Models\Booking::with('room')->latest()->take(5)->get();
  $estados = ['waiting' => 'Pendiente', 'approve' => 'Aprobada', 'rejected' => 'Rechazada'];
@endphp

@section('titulo', 'Resumen')
@section('ceja', 'Hola, '.(Auth::user()->name ?? 'equipo'))

@section('contenido')
  <!-- ===== INICIO Totales ===== -->
  <section class="totales">
    <article class="total" data-reveal>
      <p class="total__num" data-contador>{{ $totalHabitaciones }}</p>
      <p class="total__txt">Habitaciones publicadas</p>
      <a class="enlace" href="{{ url('view_room') }}">Gestionar</a>
    </article>
    <article class="total total--cta" data-reveal>
      <p class="total__num" data-contador>{{ $pendientes }}</p>
      <p class="total__txt">Reservas por confirmar</p>
      <a class="enlace" href="{{ url('bookings') }}">Revisar</a>
    </article>
    <article class="total" data-reveal>
      <p class="total__num" data-contador>{{ $aprobadas }}</p>
      <p class="total__txt">Reservas aprobadas</p>
      <a class="enlace" href="{{ url('bookings') }}">Ver todas</a>
    </article>
    <article class="total" data-reveal>
      <p class="total__num" data-contador>{{ $mensajes }}</p>
      <p class="total__txt">Mensajes recibidos</p>
      <a class="enlace" href="{{ url('all_messages') }}">Leer</a>
    </article>
  </section>
  <!-- ===== FIN Totales ===== -->

  <!-- ===== INICIO Últimas reservas ===== -->
  <section class="caja" data-reveal>
    <div class="caja__cabeza">
      <h2>Últimas reservas</h2>
      <a class="enlace" href="{{ url('bookings') }}">Ver todas</a>
    </div>
    @forelse ($ultimas as $b)
      @php($estado = $b->status ?: 'waiting')
      <div class="fila">
        <div>
          <strong>{{ $b->name }}</strong>
          <span>{{ $b->room->room_title ?? 'Habitación retirada' }}</span>
        </div>
        <span>{{ $b->start_date }} → {{ $b->end_date }}</span>
        <span class="estado estado--{{ $estado }}">{{ $estados[$estado] ?? $estado }}</span>
      </div>
    @empty
      <p class="caja__vacio">Todavía no hay reservas.</p>
    @endforelse
  </section>
  <!-- ===== FIN Últimas reservas ===== -->

  <!-- ===== INICIO Accesos rápidos ===== -->
  <section class="accesos" data-reveal>
    <a class="btn btn--cta" href="{{ url('create_room') }}">Añadir habitación</a>
    <a class="btn btn--ghost" href="{{ url('view_gallery') }}">Subir fotos a la galería</a>
  </section>
  <!-- ===== FIN Accesos rápidos ===== -->
@endsection
