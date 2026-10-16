@extends('precaps.admin')

@section('titulo', 'Galería')
@section('ceja', 'Fotos del hotel')

@section('contenido')
  <!-- ===== INICIO Subir foto ===== -->
  <form class="formulario formulario--panel subida" action="{{ url('upload_gallery') }}" method="POST" enctype="multipart/form-data" data-reveal>
    @csrf
    <div class="campo">
      <label for="g-imagen">Añadir una foto a la galería</label>
      <input id="g-imagen" type="file" name="image" accept="image/*" required>
    </div>
    <button class="btn btn--cta" type="submit">Subir foto</button>
    <p class="formulario__nota">En la demo publicada, las fotos que subas no se guardan de forma permanente.</p>
  </form>
  <!-- ===== FIN Subir foto ===== -->

  <!-- ===== INICIO Fotos ===== -->
  <div class="galeria-panel">
    @forelse ($gallery as $item)
      <figure class="galeria-panel__foto" data-reveal>
        <img src="{{ asset('gallery/'.$item->image) }}" alt="Foto {{ $loop->iteration }} de la galería" loading="lazy">
        <figcaption>
          <a class="btn btn--peligro btn--sm" href="{{ url('delete_gallery', $item->id) }}" onclick="return confirm('¿Seguro que quieres quitar esta foto?');">Quitar</a>
        </figcaption>
      </figure>
    @empty
      <p class="caja__vacio">La galería está vacía.</p>
    @endforelse
  </div>
  <!-- ===== FIN Fotos ===== -->
@endsection
