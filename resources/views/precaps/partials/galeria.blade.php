<div class="galeria">
  @foreach ($fotos as $foto)
    <a class="galeria__foto" href="{{ asset('gallery/'.$foto->image) }}" data-libro>
      <img src="{{ asset('gallery/'.$foto->image) }}" alt="Foto del hotel {{ $loop->iteration }}" loading="lazy" decoding="async">
    </a>
  @endforeach
</div>
