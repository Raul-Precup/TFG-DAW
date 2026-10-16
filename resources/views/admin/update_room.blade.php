@extends('precaps.admin')

@section('titulo', 'Editar habitación')
@section('ceja', 'Catálogo')

@section('contenido')
  @include('precaps.partials.form-habitacion', ['hab' => $data, 'accion' => url('edit_room', $data->id), 'boton' => 'Guardar cambios'])
@endsection
