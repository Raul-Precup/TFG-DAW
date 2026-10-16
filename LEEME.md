# Precap's Book · Rediseño «Marcapáginas»

Rediseño completo de la parte visual de la app de reservas (TFG de DAW). **El backend no se ha tocado**: rutas, controladores, modelos y migraciones siguen igual. Solo cambian las vistas Blade, los estilos, el JavaScript de la interfaz, los textos (traducidos al español) y los datos de demostración.

Fecha: 16 de octubre de 2026.

## 1. Estructura

```text
resources/views/precaps/layout.blade.php     Layout de la web pública (cabeza, menú, pie, barra móvil, scripts)
resources/views/precaps/admin.blade.php      Layout del panel de administración
resources/views/precaps/partials/            Menú, pie, logo, sello, tarjeta de habitación, cabecera,
                                             avisos, contacto, galería y formulario de habitación
resources/views/home/*.blade.php             Inicio, habitaciones, ficha, galería, contacto y mis reservas
resources/views/admin/*.blade.php            Resumen, habitaciones, crear/editar, reservas, galería, mensajes, correo
resources/views/layouts/guest|app.blade.php  Login, registro y perfil (Jetstream) con la marca
resources/views/components/*.blade.php       Componentes de Jetstream restilados
public/css/precaps.css                       Sistema visual (tokens, secciones, formularios, pie)
public/css/precaps-admin.css                 Panel de administración
public/js/precaps.js                         Animaciones e interacción
public/vendor/precaps/                       GSAP 3.13.0 (ScrollTrigger, SplitText) y Lenis 1.3.11
public/fonts/precaps/                        Libre Caslon Display, Libre Caslon Text (cursiva) y Manrope
public/img/precaps/                          Fotos de portada, hotel, cierre y la imagen para compartir
public/room/precaps-*.webp, public/gallery/precaps-*.webp   Fotos de las habitaciones y la galería de demo
lang/es.json, lang/es/*.php                  Textos en español (mensajes del backend, login, perfil, validación)
diseno/direccion-de-arte.html                Hoja de muestra aprobada (no se publica)
```

## 2. Dirección de arte aprobada

**Idea:** un hotel que se lee como un buen libro. Cada sección es un capítulo y reservar es marcar la página.

### Colores (tokens en `:root` de `precaps.css`)

| Token | HEX | Uso |
|---|---|---|
| `--brand` | #1F3A33 | Verde de encuadernación: títulos, menú, secciones oscuras, pie |
| `--cta` / `--cta-hover` | #A8412F / #8E3526 | Lacre: solo botones de reservar y marcapáginas |
| `--gold` | #B8913A | Oro de lomo: líneas, iconos y adornos (no para texto) |
| `--gold-ink` | #7F6120 | Oro para texto sobre fondos claros |
| `--gold-on-dark` | #CDAE5E | Oro para texto sobre el verde |
| `--ink` | #16201D | Textos |
| `--bg` / `--bg-deep` | #F5F0E6 / #ECE4D4 | Papel y papel hondo (fondos) |
| `--surface` | #FFFDF8 | Tarjetas y formularios |
| `--line` | #DDD3C1 | Bordes |
| `--muted` | #5E6661 | Texto secundario |

Contrastes comprobados: tinta sobre papel 14.69 · gris sobre papel 5.21 · gris sobre papel hondo 4.68 · verde sobre papel 10.8 · blanco sobre lacre 6.07 (hover 7.81) · papel sobre verde 10.8 · verde claro sobre verde 7.71 · oro de texto sobre papel 5.09 · oro claro sobre verde 5.73. El oro original sobre papel da 2.59: por eso solo se usa en adornos.

### Letras

- Títulos: **Libre Caslon Display** 400 (la letra clásica de los libros).
- Palabra de acento (solo en la portada y en la imagen para compartir): **Libre Caslon Text** cursiva 400.
- Textos, menús y formularios: **Manrope** variable 400–700.
- Archivos propios en `public/fonts/precaps/` (subconjunto latino, con ñ, acentos, ¿ y ¡).

### Movimiento (objeto `M` en `precaps.js` y variables CSS)

| | GSAP | CSS |
|---|---|---|
| Entradas | `power4.out` | `--ease: cubic-bezier(.22,1,.36,1)` |
| Tapas, lomo, menú | `power3.inOut` | `--ease-io: cubic-bezier(.76,0,.24,1)` |
| Sello y marcapáginas | `back.out(1.3)` | `--ease-pop: cubic-bezier(.34,1.4,.64,1)` |
| Duración base | 1.25 s | `--dur: 1.25s` |
| Recorrido | 28 px | `--dist: 28px` |
| Escalonado | 0.11 s | |
| Inercia del scroll (Lenis) | 0.08 | |

**Firma «el libro se abre»** (unos 2.6 s, se salta con un toque, tecla o rueda): el lomo dorado se dibuja (0–0.55 s), las tapas se abren hacia los lados (0.5–1.65 s) y la foto se asienta, el titular sube por líneas (1.0 s), la frase y el buscador aparecen (1.2 s), el marcapáginas cae hasta el botón «Reservar» (1.45 s) y el sello se estampa (1.95 s). Rima: el logo del pie se abre igual y el marcapáginas del cierre cae hasta su botón.

**Al bajar:** títulos por líneas desde su ranura, fotos que se abren desde el centro, capítulos con su línea dorada, iconos que se dibujan, precios que caen como marcapáginas, espacios del hotel que pasan como páginas, foto del cierre con desplazamiento lento (solo en pantallas grandes) y contadores del panel.

**Con «Reducir movimiento» o sin JavaScript** todo se ve completo y quieto, y el menú, los formularios y la barra fija funcionan igual.

## 3. Qué editar fácil

| Quiero cambiar | Dónde |
|---|---|
| Colores | Variables al inicio de `public/css/precaps.css` y `tailwind.config.js` (login y perfil; luego `npm run build`) |
| Velocidad o carácter del movimiento | Objeto `M` al inicio de `public/js/precaps.js` y variables `--ease`, `--dur`, `--dist` |
| Textos de la portada y de las secciones | `resources/views/home/index.blade.php` |
| Datos de contacto | `resources/views/precaps/partials/contacto.blade.php` y `pie.blade.php` |
| Opiniones | `resources/views/home/index.blade.php`, sección Opiniones |
| Mensajes del backend, login y perfil en español | `lang/es.json` y `lang/es/validation.php` |
| Habitaciones y galería de la demo | `database/seeders/DatabaseSeeder.php` |

Cada cambio de CSS o JS lleva un `?v=` nuevo (variable `$v` en `precaps/layout.blade.php` y `precaps/admin.blade.php`).

## 4. De dónde sale cada dato

- Habitaciones, galería, reservas y mensajes: base de datos de la app (en la demo, `DatabaseSeeder`).
- Opiniones: **de ejemplo**, escritas para la demo y marcadas así en la página (16/10/2026).
- Contacto (Paseo de las Páginas, 1 · +34 600 000 000 · reservas@precapsbook.test · horario de recepción): **de ejemplo**, marcados «(demo)».
- Espacios del hotel (spa, desayuno, piscina, recepción): contenido de demostración.
- Fotos: Unsplash (licencia de Unsplash, uso comercial permitido), descargadas el 16/10/2026 y optimizadas en WebP. IDs: portada 1774280954999-9758f11f3d41, lectura 1666813721996-42956e40788e, cierre 1445019980597-93fa8acb246c, habitaciones 1761757821641, 1791444057939, 1776763018821, 1761039265583, 1791535766190, 1776763018970, galería 1742844552193, 1758448500688, 1762254923872, 1783162919371, 1641924675534, 1704283735270, 1773924093206, 1507652313519, 1445019980597, 1790774885419.

## 5. Por validar (decisiones tomadas por Claude)

1. Logo provisional: libro abierto con marcapáginas y apóstrofo en lacre. Conviene pulirlo con un diseñador.
2. Toda la web en español, incluidos los mensajes del backend (traducidos desde las vistas con `lang/es.json`).
3. Precios en euros por noche.
4. Textos de portada, secciones, ventajas y botones escritos por Claude.
5. Orden de secciones del inicio: portada, ventajas, habitaciones, el hotel, galería, opiniones, cierre, contacto y pie.
6. Opiniones de ejemplo, marcadas en la página como de demostración (el método Ruva no permite reseñas inventadas en negocios reales).
7. Datos de contacto de demostración, marcados «(demo)».
8. El botón de contacto es verde («Enviar mensaje») para reservar el rojo solo a «Reservar».
9. Los totales del resumen del panel se calculan en la propia vista, sin tocar el controlador.
10. Tipos de habitación mostrados como Clásica (regular), Premium y Deluxe.
11. El buscador de la portada lleva a la ficha de la habitación elegida con las fechas ya puestas.
12. El menú del perfil (Jetstream) se sustituye por el menú de la web.

## 6. Pendientes

- **Logo definitivo.**
- **Seguridad del backend (no se ha tocado):** las rutas del panel (`/create_room`, `/view_room`, `/bookings`, etc.) no exigen iniciar sesión ni ser administrador. Conviene protegerlas con un middleware.
- **Fotos subidas desde el panel:** en Vercel el disco es de solo lectura, así que no se guardan. Para producción hace falta un almacenamiento externo (por ejemplo, Vercel Blob o S3).
- **Base de datos de la demo:** SQLite en `/tmp`, se reinicia con cada arranque en frío. Para datos permanentes, una base de datos externa.
- **Imágenes de prueba de la plantilla** en `public/room` y `public/gallery` (excluidas del despliegue con `.vercelignore`): conviene borrarlas del repositorio.
- **Correo:** en la demo `MAIL_MAILER=log`, las respuestas a mensajes no se envían de verdad.

## 7. Publicar

El proyecto se despliega en Vercel desde la rama `main` (ver README). Las vistas no necesitan compilarse; si cambias Tailwind (login o perfil), ejecuta `npm run build` y sube `public/build`.
