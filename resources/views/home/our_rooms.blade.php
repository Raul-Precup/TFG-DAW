@extends('precaps.layout')

@section('titulo', "Habitaciones · Precap's Book")
@section('descripcion', 'Todas las habitaciones de Precap’s Book con su precio por noche. Elige la tuya y reserva en línea.')

@section('contenido')
  @include('precaps.partials.cabecera', [
    'num' => 'I',
    'etiqueta' => 'Habitaciones',
    'titulo' => 'Elige dónde quieres quedarte.',
    'intro' => 'Cada habitación tiene su ficha con fotos, descripción y precio por noche. Abre la que te guste, marca tus fechas y reserva.',
  ])

  <!-- ===== INICIO Lista de habitaciones ===== -->
  <section class="seccion" style="padding-top:0">
    <div class="wrap">
      <div class="rejilla">
        @forelse ($room as $r)
          @include('precaps.partials.tarjeta-habitacion', ['r' => $r])
        @empty
          <p class="intro">Todavía no hay habitaciones publicadas.</p>
        @endforelse
      </div>
    </div>
  </section>
  <!-- ===== FIN Lista de habitaciones ===== -->
@endsection
