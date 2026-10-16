/* ==========================================================================
   Precap's Book — movimiento e interacción
   Firma: "el libro se abre". El lomo dorado se dibuja, las tapas se abren desde
   el centro, el titular sube por líneas y el marcapáginas cae hasta el botón
   de reservar. Todo lo que se anima se marca en el HTML con atributos data-.
   Sin GSAP o con "Reducir movimiento", la página se ve completa y funciona igual.
   ========================================================================== */
(() => {
  'use strict';

  // 1. Ayudantes, banderas y tokens de movimiento
  const d = document;
  const html = d.documentElement;
  const $ = (s, c = d) => c.querySelector(s);
  const $$ = (s, c = d) => [...c.querySelectorAll(s)];
  const RM = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const FINE = matchMedia('(hover: hover) and (pointer: fine)').matches;
  const ANCHO = matchMedia('(min-width: 860px)');
  const hasGSAP = typeof window.gsap !== 'undefined' && typeof window.ScrollTrigger !== 'undefined';
  const safe = (fn) => { try { return fn(); } catch (e) { console.warn('[precaps]', e); } };

  // Pareja de las variables --ease, --dur y --dist del CSS
  const M = {
    ease: 'power4.out',     // entradas: lentas al final, como una página que se asienta
    easeIO: 'power3.inOut', // tapas, lomo y menú
    pop: 'back.out(1.3)',   // solo el sello y los marcapáginas
    dur: 1.25,
    stagger: 0.11,
    dist: 28,
    lerp: 0.08,             // scroll pausado
  };

  if (!hasGSAP) html.classList.remove('js');
  else {
    gsap.registerPlugin(ScrollTrigger);
    if (window.SplitText) gsap.registerPlugin(SplitText);
    ScrollTrigger.config({ ignoreMobileResize: true });
  }

  const api = (window.Precaps = { M, RM, FINE, hasGSAP, safe, tl: null, lenis: null });

  // 2. Scroll suave
  let lenis = null;
  if (hasGSAP && !RM && window.Lenis && M.lerp) {
    lenis = new Lenis({ lerp: M.lerp, smoothWheel: true, wheelMultiplier: 1 });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((t) => lenis.raf(t * 1000));
    gsap.ticker.lagSmoothing(0);
    api.lenis = lenis;
  }
  const altoNav = () => { const n = $('[data-nav]'); return n ? n.offsetHeight + 12 : 12; };
  const irA = (el, inmediato) => {
    if (lenis) lenis.scrollTo(el, { offset: -altoNav(), duration: inmediato ? 0 : 1.4, immediate: !!inmediato });
    else window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - altoNav(), behavior: RM || inmediato ? 'auto' : 'smooth' });
  };
  const bloquear = (si) => {
    html.style.overflow = si ? 'hidden' : '';
    if (lenis) { if (si) lenis.stop(); else lenis.start(); }
  };

  // 3. Lo que funciona siempre, con o sin animación

  // Navegación: borde al bajar
  safe(() => {
    const nav = $('[data-nav]');
    if (!nav) return;
    const onScroll = () => nav.classList.toggle('is-scrolled', window.scrollY > 8);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  });

  // Enlaces internos suaves
  d.addEventListener('click', (e) => {
    const a = e.target.closest('a[href^="#"]');
    if (!a) return;
    const hash = a.getAttribute('href');
    const el = hash.length > 1 && d.getElementById(hash.slice(1));
    if (!el) return;
    e.preventDefault();
    irA(el);
    history.replaceState(null, '', hash);
  });

  // Menú móvil
  safe(() => {
    const boton = $('[data-menu-toggle]');
    const menu = $('[data-menu]');
    if (!boton || !menu) return;
    const abrir = () => {
      menu.hidden = false;
      boton.setAttribute('aria-expanded', 'true');
      bloquear(true);
      if (hasGSAP && !RM) gsap.fromTo($$('.menu-movil__links li, .menu-movil > .btn, .menu-movil__cuenta', menu),
        { y: 18, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: 0.6, stagger: 0.05, ease: M.ease });
      const primero = $('a', menu);
      if (primero) primero.focus();
    };
    const cerrar = (devolverFoco = true) => {
      menu.hidden = true;
      boton.setAttribute('aria-expanded', 'false');
      bloquear(false);
      if (devolverFoco) boton.focus();
    };
    boton.addEventListener('click', () => (menu.hidden ? abrir() : cerrar()));
    const x = $('[data-menu-cerrar]', menu);
    if (x) x.addEventListener('click', () => cerrar());
    menu.addEventListener('click', (e) => { if (e.target.closest('a')) cerrar(false); });
    d.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !menu.hidden) cerrar(); });
    ANCHO.addEventListener('change', () => { if (!menu.hidden) cerrar(false); });
  });

  // Menú de usuario (escritorio)
  safe(() => {
    $$('[data-usuario]').forEach((caja) => {
      const boton = $('button', caja);
      const menu = $('.usuario__menu', caja);
      const fijar = (abierto) => { menu.hidden = !abierto; boton.setAttribute('aria-expanded', String(abierto)); };
      boton.addEventListener('click', (e) => { e.stopPropagation(); fijar(menu.hidden); });
      d.addEventListener('click', (e) => { if (!caja.contains(e.target)) fijar(false); });
      d.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !menu.hidden) { fijar(false); boton.focus(); } });
    });
  });

  // Barra lateral del panel en el móvil
  safe(() => {
    const boton = $('[data-panel-toggle]');
    const lateral = $('[data-panel-menu]');
    if (!boton || !lateral) return;
    const velo = d.createElement('div');
    velo.className = 'panel__velo';
    velo.hidden = true;
    d.body.appendChild(velo);
    const fijar = (abierto) => {
      lateral.classList.toggle('is-abierto', abierto);
      velo.hidden = !abierto;
      boton.setAttribute('aria-expanded', String(abierto));
    };
    boton.addEventListener('click', () => fijar(!lateral.classList.contains('is-abierto')));
    velo.addEventListener('click', () => fijar(false));
    d.addEventListener('keydown', (e) => { if (e.key === 'Escape') fijar(false); });
  });

  // Reserva rápida: cada opción lleva la URL de su habitación; las fechas viajan en la URL
  safe(() => {
    $$('[data-reserva]').forEach((form) => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const sel = $('select', form);
        if (!sel || !sel.value) { if (sel) { sel.focus(); sel.reportValidity && sel.reportValidity(); } return; }
        const q = new URLSearchParams();
        const llegada = $('[name="llegada"]', form);
        const salida = $('[name="salida"]', form);
        if (llegada && llegada.value) q.set('llegada', llegada.value);
        if (salida && salida.value) q.set('salida', salida.value);
        window.location.href = sel.value + (q.toString() ? `?${q}` : '');
      });
    });
  });

  // Fechas: no se puede llegar en el pasado y la salida va después de la llegada
  safe(() => {
    const iso = (f) => new Date(f.getTime() - f.getTimezoneOffset() * 60000).toISOString().slice(0, 10);
    const hoy = new Date();
    $$('[data-fecha-llegada]').forEach((llegada) => {
      const form = llegada.form || llegada.closest('form');
      const salida = form && $('[data-fecha-salida]', form);
      llegada.min = iso(hoy);
      const ajustar = () => {
        if (!salida) return;
        const base = llegada.value ? new Date(`${llegada.value}T12:00:00`) : hoy;
        const min = new Date(base.getTime() + 86400000);
        salida.min = iso(min);
        if (salida.value && salida.value < salida.min) salida.value = '';
      };
      ajustar();
      llegada.addEventListener('change', ajustar);
    });
  });

  // Barra fija de reservar en el móvil: se esconde donde ya hay un formulario o al llegar al pie
  safe(() => {
    const barra = $('[data-barra]');
    if (!barra || !('IntersectionObserver' in window)) return;
    const visibles = new Set();
    const decidir = () => barra.classList.toggle('is-oculta', visibles.size > 0 || window.scrollY < window.innerHeight * 0.5);
    const io = new IntersectionObserver((entradas) => {
      entradas.forEach((en) => { if (en.isIntersecting) visibles.add(en.target); else visibles.delete(en.target); });
      decidir();
    }, { rootMargin: '0px 0px -10% 0px' });
    $$('[data-barra-ocultar], .pie').forEach((el) => io.observe(el));
    window.addEventListener('scroll', decidir, { passive: true });
    decidir();
  });

  // Los marcapáginas cuelgan del canto superior y terminan justo encima de su botón
  const colgarCintas = () => {
    $$('[data-cinta-contenedor]').forEach((caja) => {
      const cinta = $(':scope > .cinta', caja);
      const destino = caja.dataset.cintaContenedor;
      const boton = destino ? $(`${destino} [data-cinta-hasta]`) : $('[data-cinta-hasta]', caja);
      if (!cinta || !boton) return;
      const c = caja.getBoundingClientRect();
      const b = boton.getBoundingClientRect();
      const tarjeta = boton.closest('.reserva');
      const ancho = b.width > c.width * 0.6;
      const x = ancho ? c.width - 30 : b.left + b.width / 2 - c.left;
      const fin = tarjeta ? tarjeta.getBoundingClientRect().top - c.top + 6 : b.top - c.top - 14;
      caja.style.setProperty('--cinta-x', `${x}px`);
      caja.style.setProperty('--cinta-h', `${Math.max(60, fin)}px`);
    });
  };
  safe(colgarCintas);
  let anchoPrevio = window.innerWidth;
  window.addEventListener('resize', () => {
    if (window.innerWidth === anchoPrevio) return;
    anchoPrevio = window.innerWidth;
    safe(colgarCintas);
  });

  // Si llegó un aviso (mensaje enviado, reserva, errores) lejos de la vista, se lleva la vista hasta él
  safe(() => {
    const aviso = $('main .aviso');
    if (!aviso || $('.panel')) return;
    window.addEventListener('load', () => {
      if (aviso.getBoundingClientRect().top > window.innerHeight * 0.8) setTimeout(() => irA(aviso, RM), 300);
    });
  });

  if (!hasGSAP) return;
  if (RM) { $$('.sello').forEach((s) => s.classList.add('is-girando')); return; }

  // 4. Firma de la portada
  const firmaPortada = () => {
    const libro = $('[data-libro-portada]');
    if (!libro) return null;
    const tapas = $$('.portada__tapa', libro);
    const lomo = $('.portada__lomo', libro);
    const img = $('.portada__img', libro);
    const cinta = $(':scope > .cinta', libro);
    const sello = $('.sello', libro);
    safe(colgarCintas);
    // El CSS esconde las líneas con un porcentaje: GSAP lo toma como yPercent, no como píxeles
    gsap.set('.portada .linea-in', { yPercent: 130, y: 0 });

    const tl = gsap.timeline({
      defaults: { ease: M.ease },
      onStart: () => sello && sello.classList.remove('is-girando'),
    });
    tl.set([lomo, ...tapas], { autoAlpha: 1, rotateY: 0 }, 0)
      .fromTo(lomo, { scaleY: 0, transformOrigin: '50% 0%' }, { scaleY: 1, duration: 0.55, ease: M.easeIO }, 0)
      .to(tapas[0], { rotateY: -104, duration: 1.15, ease: M.easeIO }, 0.5)
      .to(tapas[1], { rotateY: 104, duration: 1.15, ease: M.easeIO }, 0.5)
      .fromTo(img, { scale: 1.16 }, { scale: 1, duration: 2 }, 0.5)
      .to(lomo, { autoAlpha: 0, duration: 0.35 }, 0.72)
      .set(tapas, { autoAlpha: 0 }, 1.66)
      .fromTo('.portada .linea-in', { yPercent: 130, y: 0 }, { yPercent: 0, y: 0, duration: M.dur, stagger: M.stagger }, 1.0)
      .fromTo('[data-hero-in]', { y: M.dist, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: M.dur, stagger: M.stagger }, 1.2)
      .fromTo(cinta, { clipPath: 'inset(0% 0% 100% 0%)', rotate: 5, autoAlpha: 1 },
        { clipPath: 'inset(0% 0% 0% 0%)', rotate: 0, autoAlpha: 1, duration: 1.1 }, 1.45)
      .fromTo(sello, { scale: 1.35, rotate: -35, autoAlpha: 0 },
        { scale: 1, rotate: 0, autoAlpha: 1, duration: 0.8, ease: M.pop }, 1.95);
    html.classList.add('gsap-ok');

    // Se salta con un toque, una tecla o la rueda
    const eventos = ['pointerdown', 'keydown', 'wheel', 'touchstart'];
    const quitar = () => eventos.forEach((ev) => window.removeEventListener(ev, saltar));
    function saltar() { if (tl.isActive()) tl.progress(1); quitar(); }
    eventos.forEach((ev) => window.addEventListener(ev, saltar, { passive: true, once: true }));
    tl.eventCallback('onComplete', () => { quitar(); if (sello) sello.classList.add('is-girando'); });
    return tl;
  };

  // 5. Efectos al bajar: un gesto por tipo de pieza
  const reveals = () => {
    // Textos, tarjetas y bloques: suben y aparecen en cascada
    safe(() => {
      gsap.set('[data-reveal]', { y: M.dist, autoAlpha: 0 });
      ScrollTrigger.batch('[data-reveal]', {
        start: 'top 92%',
        once: true,
        onEnter: (lote) => gsap.to(lote, { y: 0, autoAlpha: 1, duration: M.dur, ease: M.ease, stagger: Math.min(M.stagger, 0.6 / lote.length), overwrite: true }),
      });
    });

    // Fotos que se abren desde el lomo, como un libro
    safe(() => {
      $$('[data-libro]').forEach((el) => {
        const img = $('img', el);
        const tl = gsap.timeline({ scrollTrigger: { trigger: el, start: 'top 88%', once: true } });
        tl.fromTo(el, { clipPath: 'inset(0% 50% 0% 50%)' }, { clipPath: 'inset(0% 0% 0% 0%)', duration: M.dur * 1.1, ease: M.easeIO });
        if (img) tl.fromTo(img, { scale: 1.14 }, { scale: 1, duration: M.dur * 1.5, ease: M.ease }, 0);
      });
    });

    // Capítulos: el número sube y la línea dorada se dibuja
    safe(() => {
      $$('[data-capitulo]').forEach((el) => {
        const linea = $('.capitulo__linea', el);
        const num = $('.capitulo__num', el);
        const resto = $$(':scope > :not(.capitulo__num):not(.capitulo__linea)', el);
        const tl = gsap.timeline({ scrollTrigger: { trigger: el, start: 'top 92%', once: true } });
        if (num) tl.from(num, { yPercent: 60, autoAlpha: 0, duration: M.dur * 0.8, ease: M.ease });
        if (linea) tl.from(linea, { scaleX: 0, duration: M.dur * 0.9, ease: M.easeIO }, 0.1);
        if (resto.length) tl.from(resto, { autoAlpha: 0, x: -10, duration: M.dur * 0.8, ease: M.ease }, 0.25);
      });
    });

    // Precios en marcapáginas: caen y se asientan
    safe(() => {
      $$('[data-cinta]').forEach((el) => {
        gsap.fromTo(el, { clipPath: 'polygon(0 0,100% 0,100% 0%,50% 0%,0 0%)', rotate: 6 },
          { clipPath: 'polygon(0 0,100% 0,100% 100%,50% calc(100% - 9px),0 100%)', rotate: 0, duration: M.dur, ease: M.pop, delay: 0.35,
            scrollTrigger: { trigger: el.closest('[data-cinta-trigger]') || el, start: 'top 88%', once: true } });
      });
    });

    // Marcapáginas colgados fuera de la portada (cierre): caen hasta su botón
    safe(() => {
      $$('[data-cinta-contenedor]:not([data-libro-portada])').forEach((caja) => {
        const cinta = $(':scope > .cinta', caja);
        if (!cinta) return;
        gsap.fromTo(cinta, { clipPath: 'inset(0% 0% 100% 0%)', rotate: 5 },
          { clipPath: 'inset(0% 0% 0% 0%)', rotate: 0, duration: 1.2, ease: M.ease,
            scrollTrigger: { trigger: caja, start: 'top 65%', once: true } });
      });
    });

    // Trazos (iconos de línea) que se dibujan
    safe(() => {
      $$('[data-draw]').forEach((svg) => {
        const lines = $$('path, line, polyline, circle, rect', svg);
        lines.forEach((p) => { const L = p.getTotalLength(); gsap.set(p, { strokeDasharray: `${L} ${L + 4}`, strokeDashoffset: L + 4 }); });
        gsap.to(lines, { strokeDashoffset: 0, duration: M.dur * 1.4, stagger: M.stagger, ease: M.ease,
          scrollTrigger: { trigger: svg, start: 'top 92%', once: true } });
      });
    });

    // Espacios del hotel: entran como páginas que se pasan
    safe(() => {
      $$('[data-paginas]').forEach((caja) => {
        gsap.from([...caja.children], {
          rotateY: -78, transformOrigin: '0% 50%', autoAlpha: 0, duration: M.dur, stagger: M.stagger * 1.4, ease: M.ease,
          scrollTrigger: { trigger: caja, start: 'top 85%', once: true },
        });
      });
    });

    // Foto del cierre: se desplaza despacio con el scroll (solo en pantallas grandes)
    safe(() => {
      if (!ANCHO.matches) return;
      $$('[data-parallax]').forEach((img) => {
        gsap.fromTo(img, { yPercent: -5 }, { yPercent: 5, ease: 'none',
          scrollTrigger: { trigger: img.closest('section') || img, start: 'top bottom', end: 'bottom top', scrub: true } });
      });
    });

    // Logo del pie: el libro se abre y cae su marcapáginas (rima con la portada)
    safe(() => {
      $$('[data-logo-firma]').forEach((logo) => {
        const izq = $('.logo__pagina--izq', logo);
        const der = $('.logo__pagina--der', logo);
        const cinta = $('.logo__cinta', logo);
        const nombre = $('.logo__nombre', logo);
        const tl = gsap.timeline({ scrollTrigger: { trigger: logo, start: 'top 92%', once: true } });
        tl.from([izq, der], { scaleX: 0, duration: 1.1, ease: M.easeIO })
          .from(cinta, { clipPath: 'inset(0% 0% 100% 0%)', duration: 0.9, ease: M.ease }, 0.6)
          .from(nombre, { yPercent: 40, autoAlpha: 0, duration: M.dur, ease: M.ease }, 0.3);
      });
    });

    // Contadores del panel: cuentan desde cero hasta la cifra real
    safe(() => {
      $$('[data-contador]').forEach((el) => {
        const fin = parseInt(el.textContent, 10);
        if (!Number.isFinite(fin)) return;
        const obj = { v: 0 };
        el.textContent = '0';
        gsap.to(obj, { v: fin, duration: 1.4, ease: 'power2.out', snap: { v: 1 },
          onUpdate: () => { el.textContent = String(obj.v); },
          scrollTrigger: { trigger: el, start: 'top 95%', once: true } });
      });
    });
  };

  // Títulos por líneas, desde su ranura
  const titulos = () => safe(() => {
    const todos = $$('[data-split]');
    if (!window.SplitText) { todos.forEach((el) => { el.style.visibility = 'visible'; }); return; }
    todos.forEach((el) => {
      SplitText.create(el, {
        type: 'lines', mask: 'lines', linesClass: 'renglon', autoSplit: true,
        onSplit: (self) => {
          gsap.set(el, { visibility: 'visible' });
          return gsap.from(self.lines, {
            yPercent: 130, duration: M.dur, stagger: M.stagger, ease: M.ease,
            scrollTrigger: { trigger: el, start: 'top 92%', once: true },
          });
        },
      });
    });
  });

  api.firmaPortada = firmaPortada;
  api.reveals = reveals;

  // 6. Arranque: cuando estén las fuentes (con tope de tiempo)
  Promise.race([d.fonts ? d.fonts.ready : Promise.resolve(), new Promise((r) => setTimeout(r, 1200))])
    .then(() => {
      safe(colgarCintas);
      safe(() => { api.tl = firmaPortada(); });
      titulos();
      reveals();
      ScrollTrigger.refresh();
    });
})();
