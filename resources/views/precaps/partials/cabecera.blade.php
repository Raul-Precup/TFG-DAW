<!-- ===== INICIO Cabecera ===== -->
<section class="cabecera">
  <div class="wrap">
    <p class="capitulo" data-capitulo><span class="capitulo__num">{{ $num }}</span><span class="capitulo__linea"></span><span>{{ $etiqueta }}</span></p>
    <h1 class="cabecera__titulo" data-split>{{ $titulo }}</h1>
    @isset($intro)
      <p class="intro" data-reveal>{{ $intro }}</p>
    @endisset
  </div>
</section>
<!-- ===== FIN Cabecera ===== -->
