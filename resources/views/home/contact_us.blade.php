@extends('precaps.layout')

@section('titulo', "Contacto · Precap's Book")
@section('descripcion', 'Escribe a la recepción de Precap’s Book. Te respondemos por correo.')

@section('contenido')
  @include('precaps.partials.cabecera', [
    'num' => 'V',
    'etiqueta' => 'Contacto',
    'titulo' => '¿Dudas antes de reservar? Escríbenos.',
    'intro' => 'Cuéntanos qué necesitas. El mensaje llega a la recepción y te respondemos por correo.',
  ])

  @include('precaps.partials.contacto', ['sinCabeza' => true])
@endsection
