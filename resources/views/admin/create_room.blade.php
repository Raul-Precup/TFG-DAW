@extends('precaps.admin')

@section('titulo', 'Añadir habitación')
@section('ceja', 'Catálogo')

@section('contenido')
  @include('precaps.partials.form-habitacion', ['hab' => null, 'accion' => url('add_room'), 'boton' => 'Publicar habitación'])
@endsection
