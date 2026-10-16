@extends('precaps.admin')

@php($tipos = ['regular' => 'Clásica', 'premium' => 'Premium', 'deluxe' => 'Deluxe'])

@section('titulo', 'Habitaciones')
@section('ceja', 'Catálogo')

@section('contenido')
  <div class="caja__cabeza" style="margin-bottom:20px">
    <p class="caja__nota">{{ $data->count() }} habitaciones publicadas</p>
    <a class="btn btn--cta btn--sm" href="{{ url('create_room') }}">Añadir habitación</a>
  </div>

  <!-- ===== INICIO Lista de habitaciones ===== -->
  <div class="rejilla-panel">
    @forelse ($data as $item)
      <article class="hab" data-reveal>
        <div class="hab__foto">
          @if ($item->image)
            <img src="{{ asset('room/'.$item->image) }}" alt="{{ $item->room_title }}" loading="lazy">
          @endif
          @if ($item->price)<span class="tarjeta__precio">{{ $item->price }} €<small>/ noche</small></span>@endif
        </div>
        <div class="hab__cuerpo">
          <h2>{{ $item->room_title }}</h2>
          <p class="hab__meta">{{ $tipos[$item->room_type] ?? $item->room_type }} · {{ $item->wifi === 'yes' ? 'Wi-Fi' : 'Sin Wi-Fi' }}</p>
          <p class="hab__desc">{{ Str::limit(strip_tags((string) $item->description), 120) }}</p>
          <div class="hab__acciones">
            <a class="btn btn--oscuro btn--sm" href="{{ url('room_update', $item->id) }}">Editar</a>
            <a class="btn btn--peligro btn--sm" href="{{ url('room_delete', $item->id) }}" onclick="return confirm('¿Seguro que quieres eliminar esta habitación?');">Eliminar</a>
          </div>
        </div>
      </article>
    @empty
      <p class="caja__vacio">Todavía no hay habitaciones. Añade la primera.</p>
    @endforelse
  </div>
  <!-- ===== FIN Lista de habitaciones ===== -->
@endsection
