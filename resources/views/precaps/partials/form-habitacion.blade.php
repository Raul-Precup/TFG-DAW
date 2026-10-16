{{-- Formulario de habitación: sirve para crear ($hab = null) y para editar. Los nombres de campo son los que espera el controlador. --}}
@php
  $tipo = old('type', $hab->room_type ?? 'regular');
  $wifi = old('wifi', $hab->wifi ?? 'yes');
@endphp
<form class="formulario formulario--panel" action="{{ $accion }}" method="POST" enctype="multipart/form-data" data-reveal>
  @csrf
  <div class="campo">
    <label for="h-titulo">Nombre de la habitación</label>
    <input id="h-titulo" type="text" name="title" value="{{ old('title', $hab->room_title ?? '') }}" required>
  </div>
  <div class="campo">
    <label for="h-desc">Descripción</label>
    <textarea id="h-desc" name="description" rows="5">{{ old('description', $hab->description ?? '') }}</textarea>
  </div>
  <div class="formulario__fila formulario__fila--3">
    <div class="campo">
      <label for="h-precio">Precio por noche (€)</label>
      <input id="h-precio" type="number" name="price" min="0" step="1" value="{{ old('price', $hab->price ?? '') }}" required>
    </div>
    <div class="campo">
      <label for="h-tipo">Tipo</label>
      <select id="h-tipo" name="type">
        <option value="regular" @selected($tipo === 'regular')>Clásica</option>
        <option value="premium" @selected($tipo === 'premium')>Premium</option>
        <option value="deluxe" @selected($tipo === 'deluxe')>Deluxe</option>
      </select>
    </div>
    <div class="campo">
      <label for="h-wifi">Wi-Fi</label>
      <select id="h-wifi" name="wifi">
        <option value="yes" @selected($wifi === 'yes')>Sí</option>
        <option value="no" @selected($wifi === 'no')>No</option>
      </select>
    </div>
  </div>
  <div class="campo">
    <label for="h-imagen">Foto</label>
    @if (!empty($hab) && $hab->image)
      <img class="campo__previa" src="{{ asset('room/'.$hab->image) }}" alt="Foto actual de {{ $hab->room_title }}">
      <small class="formulario__nota">Sube otra solo si quieres cambiarla.</small>
    @endif
    <input id="h-imagen" type="file" name="image" accept="image/*">
  </div>
  <p class="formulario__nota">En la demo publicada, las fotos que subas no se guardan de forma permanente.</p>
  <div class="hab__acciones">
    <button class="btn btn--cta" type="submit">{{ $boton }}</button>
    <a class="btn btn--ghost" href="{{ url('view_room') }}">Cancelar</a>
  </div>
</form>
