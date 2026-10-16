{{-- Logo provisional: libro abierto con su marcapáginas. Cada pieza es un path propio para poder animarla. --}}
<a class="logo {{ $clase ?? '' }}" href="{{ $href ?? url('/') }}" aria-label="Precap's Book, inicio" @isset($firma) data-logo-firma @endisset>
  <svg class="logo__simbolo" viewBox="0 0 48 48" aria-hidden="true" focusable="false">
    <path class="logo__pagina logo__pagina--izq" d="M23.2 13.2C18 9.6 10.6 9.1 4.5 11v27.4c6.1-1.8 13.5-1.3 18.7 2.3z"/>
    <path class="logo__pagina logo__pagina--der" d="M24.8 13.2c5.2-3.6 12.6-4.1 18.7-2.2v27.4c-6.1-1.8-13.5-1.3-18.7 2.3z"/>
    <path class="logo__cinta" d="M31 9.5h5v34l-2.5-2.9-2.5 2.9z"/>
  </svg>
  <span class="logo__nombre">Precap<span class="logo__apos">’</span>s Book</span>
</a>
