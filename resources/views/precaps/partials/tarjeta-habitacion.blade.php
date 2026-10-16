@php($tipos = ['regular' => 'Clásica', 'premium' => 'Premium', 'deluxe' => 'Deluxe'])
<div data-reveal data-cinta-trigger>
  <a class="tarjeta" href="{{ url('room_details', $r->id) }}">
    <div class="tarjeta__foto">
      @if ($r->image)
        <img src="{{ asset('room/'.$r->image) }}" alt="{{ $r->room_title }}" width="1000" height="750" loading="lazy" decoding="async">
      @endif
      @if ($r->price)
        <span class="tarjeta__precio" data-cinta>{{ $r->price }} €<small>/ noche</small></span>
      @endif
    </div>
    <div class="tarjeta__cuerpo">
      <h3 class="tarjeta__titulo">{{ $r->room_title }}</h3>
      <p class="tarjeta__meta">
        <span>{{ $tipos[$r->room_type] ?? ucfirst((string) $r->room_type) }}</span>
        @if ($r->wifi === 'yes')<span>Wi-Fi incluido</span>@endif
      </p>
      @if ($r->description)
        <p class="tarjeta__desc">{{ Str::limit(strip_tags($r->description), 110) }}</p>
      @endif
      <span class="tarjeta__mas">Ver habitación
        <svg class="btn__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </span>
    </div>
  </a>
</div>
