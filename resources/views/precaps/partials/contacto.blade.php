<!-- ===== INICIO Contacto ===== -->
<section class="seccion" id="contacto">
  <div class="wrap">
    @unless (!empty($sinCabeza))
      <div class="seccion__cabeza">
        <p class="capitulo" data-capitulo><span class="capitulo__num">V</span><span class="capitulo__linea"></span><span>Contacto</span></p>
        <h2 class="titulo" data-split>¿Dudas antes de reservar? Escríbenos.</h2>
        <p class="intro" data-reveal>Cuéntanos qué necesitas. El mensaje llega a la recepción y te respondemos por correo.</p>
      </div>
    @endunless

    <div class="contacto">
      <form class="formulario" action="{{ url('contact') }}" method="POST" data-reveal data-barra-ocultar>
        @csrf
        @include('precaps.partials.aviso')
        <div class="formulario__fila">
          <div class="campo">
            <label for="c-nombre">Nombre</label>
            <input id="c-nombre" type="text" name="name" autocomplete="name" required>
          </div>
          <div class="campo">
            <label for="c-telefono">Teléfono</label>
            <input id="c-telefono" type="tel" name="phone" inputmode="tel" autocomplete="tel" required>
          </div>
        </div>
        <div class="campo">
          <label for="c-email">Email</label>
          <input id="c-email" type="email" name="email" autocomplete="email" required>
        </div>
        <div class="campo">
          <label for="c-mensaje">Mensaje</label>
          <textarea id="c-mensaje" name="message" required placeholder="Fechas, número de personas, cualquier petición…"></textarea>
        </div>
        <button class="btn btn--oscuro" type="submit">Enviar mensaje</button>
        <p class="formulario__nota">Tus datos solo se usan para responder a tu mensaje.</p>
      </form>

      <div class="datos" data-reveal>
        <div class="dato">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg>
          <div><strong>Dirección</strong><span>Paseo de las Páginas, 1 · Ciudad Demo</span> <span class="demo">(demo)</span></div>
        </div>
        <div class="dato">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg>
          <div><strong>Teléfono</strong><span>+34 600 000 000</span> <span class="demo">(demo)</span></div>
        </div>
        <div class="dato">
          <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
          <div><strong>Email</strong><span>reservas@precapsbook.test</span> <span class="demo">(demo)</span></div>
        </div>
        <div class="dato">
          <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
          <div><strong>Recepción</strong><span>Todos los días, de 8:00 a 22:00</span> <span class="demo">(demo)</span></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ===== FIN Contacto ===== -->
