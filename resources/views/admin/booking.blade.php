@extends('precaps.admin')

@php($estados = ['waiting' => 'Pendiente', 'approve' => 'Aprobada', 'rejected' => 'Rechazada'])

@section('titulo', 'Reservas')
@section('ceja', 'Recepción')

@section('contenido')
  <!-- ===== INICIO Lista de reservas ===== -->
  <section class="caja">
    <div class="caja__cabeza">
      <h2>{{ $data->count() }} reservas</h2>
      <p class="caja__nota">Aprueba o rechaza cada petición. El cliente lo ve en «Mis reservas».</p>
    </div>
    @forelse ($data as $item)
      @php($estado = $item->status ?: 'waiting')
      <article class="reserva-panel" data-reveal>
        <div class="reserva-panel__hab">
          @if ($item->room && $item->room->image)
            <img src="{{ asset('room/'.$item->room->image) }}" alt="" loading="lazy">
          @endif
          <div>
            <strong>{{ $item->room->room_title ?? 'Habitación retirada' }}</strong>
            <span>{{ $item->start_date }} → {{ $item->end_date }}@if ($item->room && $item->room->price) · {{ $item->room->price }} €/noche @endif</span>
          </div>
        </div>
        <div class="reserva-panel__cliente">
          <strong>{{ $item->name }}</strong>
          <span>{{ $item->email }}</span>
          <span>{{ $item->phone }}</span>
        </div>
        <span class="estado estado--{{ $estado }}">{{ $estados[$estado] ?? $estado }}</span>
        <div class="reserva-panel__acciones">
          <a class="btn btn--oscuro btn--sm" href="{{ url('approve_book', $item->id) }}">Aprobar</a>
          <a class="btn btn--ghost btn--sm" href="{{ url('reject_book', $item->id) }}">Rechazar</a>
          <a class="btn btn--peligro btn--sm" href="{{ url('delete_booking', $item->id) }}" onclick="return confirm('¿Seguro que quieres eliminar esta reserva?');">Eliminar</a>
        </div>
      </article>
    @empty
      <p class="caja__vacio">Todavía no hay reservas.</p>
    @endforelse
  </section>
  <!-- ===== FIN Lista de reservas ===== -->
@endsection
