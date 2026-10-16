@extends('precaps.admin')

@section('titulo', 'Responder por correo')
@section('ceja', 'Mensajes')

@section('contenido')
  <!-- ===== INICIO Correo ===== -->
  <form class="formulario formulario--panel" action="{{ url('mail', $data->id) }}" method="POST" data-reveal>
    @csrf
    <p class="caja__nota">Para: <strong>{{ $data->name }}</strong> · {{ $data->email }}</p>
    <div class="campo">
      <label for="m-saludo">Saludo</label>
      <input id="m-saludo" type="text" name="greeting" placeholder="Hola, {{ $data->name }}:">
    </div>
    <div class="campo">
      <label for="m-cuerpo">Mensaje</label>
      <textarea id="m-cuerpo" name="body" rows="6"></textarea>
    </div>
    <div class="formulario__fila">
      <div class="campo">
        <label for="m-boton">Texto del botón</label>
        <input id="m-boton" type="text" name="action_text" placeholder="Ver habitaciones">
      </div>
      <div class="campo">
        <label for="m-url">Enlace del botón</label>
        <input id="m-url" type="url" name="action_url" placeholder="{{ url('our_rooms') }}">
      </div>
    </div>
    <div class="campo">
      <label for="m-despedida">Despedida</label>
      <input id="m-despedida" type="text" name="endline" placeholder="Un saludo, la recepción de Precap's Book">
    </div>
    <div class="hab__acciones">
      <button class="btn btn--cta" type="submit">Enviar correo</button>
      <a class="btn btn--ghost" href="{{ url('all_messages') }}">Cancelar</a>
    </div>
  </form>
  <!-- ===== FIN Correo ===== -->
@endsection
