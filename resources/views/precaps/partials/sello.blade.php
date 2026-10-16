{{-- Sello ex libris. $id debe ser único en la página. --}}
<div class="sello {{ $clase ?? '' }}" aria-hidden="true">
  <svg viewBox="0 0 120 120" focusable="false">
    <defs><path id="aro-{{ $id }}" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0"/></defs>
    <g class="sello__aro"><text font-size="9.2" fill="currentColor"><textPath href="#aro-{{ $id }}" textLength="289" lengthAdjust="spacing">PRECAP’S BOOK · HOTEL &amp; RESERVAS · </textPath></text></g>
    <circle cx="60" cy="60" r="33" fill="none" stroke="currentColor" stroke-width=".8" opacity=".55"/>
    <g transform="translate(42 41) scale(.75)">
      <path fill="currentColor" d="M23.2 13.2C18 9.6 10.6 9.1 4.5 11v27.4c6.1-1.8 13.5-1.3 18.7 2.3z"/>
      <path fill="currentColor" d="M24.8 13.2c5.2-3.6 12.6-4.1 18.7-2.2v27.4c-6.1-1.8-13.5-1.3-18.7 2.3z"/>
      <path fill="{{ $cinta ?? '#A8412F' }}" d="M31 9.5h5v34l-2.5-2.9-2.5 2.9z"/>
    </g>
  </svg>
</div>
