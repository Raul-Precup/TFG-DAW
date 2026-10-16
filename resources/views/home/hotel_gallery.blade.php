@extends('precaps.layout')

@section('titulo', "Galería · Precap's Book")
@section('descripcion', 'Fotos de las habitaciones y los espacios de Precap’s Book.')

@section('contenido')
  @include('precaps.partials.cabecera', [
    'num' => 'III',
    'etiqueta' => 'Galería',
    'titulo' => 'El hotel, página a página.',
    'intro' => 'Habitaciones, rincones y momentos del hotel. Toca una foto para verla en grande.',
  ])

  <!-- ===== INICIO Galería completa ===== -->
  <section class="seccion" style="padding-top:0">
    <div class="wrap">
      @if ($gallery->count())
        @include('precaps.partials.galeria', ['fotos' => $gallery])
      @else
        <p class="intro">Todavía no hay fotos en la galería.</p>
      @endif
    </div>
  </section>
  <!-- ===== FIN Galería completa ===== -->
@endsection
