@extends('precaps.admin')

@section('titulo', 'Mensajes')
@section('ceja', 'Recepción')

@section('contenido')
  <!-- ===== INICIO Mensajes ===== -->
  <section class="mensajes">
    @forelse ($data as $item)
      <article class="mensaje" data-reveal>
        <div class="mensaje__quien">
          <span class="opinion__inicial" aria-hidden="true">{{ mb_strtoupper(mb_substr($item->name ?? '?', 0, 1)) }}</span>
          <div>
            <strong>{{ $item->name }}</strong>
            <span>{{ $item->email }} · {{ $item->phone }}</span>
          </div>
        </div>
        <p class="mensaje__texto">{{ $item->message }}</p>
        <a class="btn btn--oscuro btn--sm" href="{{ url('send_mail', $item->id) }}">Responder por correo</a>
      </article>
    @empty
      <p class="caja__vacio">No hay mensajes nuevos.</p>
    @endforelse
  </section>
  <!-- ===== FIN Mensajes ===== -->
@endsection
