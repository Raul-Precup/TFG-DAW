<!-- ===== INICIO Pie ===== -->
<footer class="pie">
  <div class="wrap">
    <div class="pie__marca">
      @include('precaps.partials.logo', ['clase' => 'pie__logo', 'firma' => true])
      <p class="pie__lema">Habitaciones tranquilas, reserva en línea y la confirmación del hotel en tu cuenta. Tu próxima historia empieza aquí.</p>
    </div>

    <div class="pie__cols">
      <div>
        <h2>Explora</h2>
        <ul>
          <li><a href="{{ url('/') }}">Inicio</a></li>
          <li><a href="{{ url('our_rooms') }}">Habitaciones</a></li>
          <li><a href="{{ url('hotel_gallery') }}">Galería</a></li>
          <li><a href="{{ url('contact_us') }}">Contacto</a></li>
        </ul>
      </div>
      <div>
        <h2>Tu cuenta</h2>
        <ul>
          @auth
            <li><a href="{{ url('my_bookings') }}">Mis reservas</a></li>
            <li><a href="{{ route('profile.show') }}">Mi perfil</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
              </form>
            </li>
          @else
            <li><a href="{{ route('login') }}">Entrar</a></li>
            <li><a href="{{ route('register') }}">Crear cuenta</a></li>
            <li><a href="{{ url('my_bookings') }}">Mis reservas</a></li>
          @endauth
        </ul>
      </div>
      <div>
        <h2>Contacto</h2>
        <ul>
          <li>Paseo de las Páginas, 1 · Ciudad Demo <span class="demo">(demo)</span></li>
          <li>+34 600 000 000 <span class="demo">(demo)</span></li>
          <li>reservas@precapsbook.test <span class="demo">(demo)</span></li>
        </ul>
      </div>
      <div>
        <h2>Reserva</h2>
        <ul>
          <li>Elige habitación y fechas, y el hotel confirma tu reserva desde su panel.</li>
          <li><a href="{{ url('our_rooms') }}">Reservar</a></li>
        </ul>
      </div>
    </div>

    <div class="pie__legal">
      <p>© {{ date('Y') }} Precap’s Book. Hotel de demostración creado para un Trabajo de Fin de Grado de Desarrollo de Aplicaciones Web. Las opiniones y los datos de contacto son de ejemplo.</p>
      <p>Fotografías: Unsplash.</p>
    </div>
  </div>
</footer>
<!-- ===== FIN Pie ===== -->
