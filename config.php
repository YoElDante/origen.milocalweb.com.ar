<?php
/**
 * Configuración del cliente — Landing Page Origen Run & Bike.
 *
 * Este archivo es la ÚNICA fuente de datos del sitio.
 *
 * @package MiLocalWeb\Clientes
 */

return [

    // ─── Datos básicos ───────────────────────────────────────────────

    'nombre'    => 'Origen Run & Bike',
    'slogan'    => 'Sabemos dónde empieza, no dónde termina',
    'rubro'     => 'Ropa e indumentaria deportiva — Running · Trekking · Bikes',
    'whatsapp'  => '5493571329870',
    'email'     => '', // Pendiente con el cliente
    'whatsapp_mensaje' => 'Hola! Vi tu web y quisiera más info',
    'whatsapp_mensaje_ofertas' => 'Hola! Estoy en la web y me gustaría ver oportunidades en ropa de invierno y camperas',

    // ─── Branding assets ─────────────────────────────────────────────

    'logo_img'  => '/assets/img/cliente/logos/logo-800x788.webp',
    'favicon'   => '/assets/img/cliente/iconos/favicon.ico',

    // ─── Hero Section ────────────────────────────────────────────────

    'hero_layout'      => 'split', // img-right | img-left | stacked
    'hero_descripcion' => "Algo más que un local de indumentaria. Running, trekking y bikes: ropa, calzado y accesorios para volver a lo esencial.",
    'hero_boton'       => 'Escribinos por WhatsApp',
    'hero_img'         => '/assets/img/cliente/identidad/origen-bolsa-paisaje.jpg',

    // ─── Identidad Visual ────────────────────────────────────────────

    'colors' => [
        'color-primary'       => '#000000',
        'color-primary-hover' => '#2b2b2b',
        'color-accent'        => '#00bbaa',
        'color-accent-hover'  => '#2accb8',
        'color-text'          => '#2b2b2b',
        'color-muted'         => '#5c7c8a',
        'color-bg'            => '#ffffff',
        'color-bg-alt'        => '#e5e5e5',
        'color-card-bg'       => '#dfd3ca',
        'color-slate-blue'    => '#5c7c8a',
        'color-soft-aqua'     => '#8eaaaf',
        'color-verano-fem'    => '#dfd3ca',
        'color-verano-fem-dark' => '#d4c5bb',
        'texture-stone'       => "url('/assets/img/cliente/identidad/textura-fondo-piedra.webp')",
    ],
    'tipografia' => '"Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',

    // ─── Productos Destacados ────────────────────────────────────────

    'productos' => [
        [
            'nombre'      => 'Short con calza interna',
            'descripcion' => 'Doble capa: short + calza. Ajuste seguro, tela respirable, liviana y fresca. Ideal running, gym y entrenamientos intensos.',
            'imagen'      => '/assets/img/cliente/productos/short-con-calza.webp',
        ],
        [
            'nombre'      => 'Short sin calza interna',
            'descripcion' => 'Corte clásico y versátil, secado rápido, cintura regulable. Perfecto para running, ciclismo o uso diario.',
            'imagen'      => '/assets/img/cliente/productos/short-sin-calza.webp',
        ],
        [
            'nombre'      => 'Tops',
            'descripcion' => 'Comodidad, hermosura y calidad. Diseños que acompañan cada entrenamiento.',
            'imagen'      => '/assets/img/cliente/productos/tops.webp',
        ],
    ],

    // ─── Ofertas de la temporada que se va ───────────────────────────

    'seccion_ofertas' => [
        'titulo'    => 'Ofertas de la temporada que se va',
        'subtitulo' => 'Últimas prendas de otoño-invierno con precios especiales.',
        'cta_texto' => 'Pedir catálogo de oportunidades',
        'ofertas' => [
            [
                'nombre'      => 'Outdoor que se adapta a tu ritmo',
                'descripcion' => 'Aire fresco, más movimiento y prendas que acompañan. El otoño se vive mejor afuera.',
                'imagen'      => '/assets/img/cliente/ofertas/outdoor.jpg',
            ],
            [
                'nombre'      => 'Comfort en tonos neutros',
                'descripcion' => 'No importa si salís a entrenar, a caminar o a resolver el día: prendas pensadas para moverse con vos.',
                'imagen'      => '/assets/img/cliente/ofertas/outdoor-colorcrema.jpg',
            ],
            [
                'nombre'      => 'Camperas outdoor',
                'descripcion' => 'Que llueva, que corra viento… telas impermeables que te mantienen seca y cómoda.',
                'imagen'      => '/assets/img/cliente/ofertas/outdoor-campera.jpg',
            ],
        ],
    ],

    // ─── Lo indispensable ────────────────────────────────────────────

    'seccion_indispensables' => [
        'titulo'    => 'Lo indispensable',
        'subtitulo' => 'Más que ropa deportiva: identidad, energía y la transición al calorcito.',
        'identidad' => [
            'titulo'      => 'Renovando energías',
            'descripcion' => 'Septiembre es un mes para abrir espacio a lo nuevo. Al renovarnos, también nos volvemos indispensables: más movimiento, más energía y más confianza en cada paso.',
            'imagen'      => '/assets/img/cliente/identidad/renovando.jpg',
        ],
        'items' => [
            [
                'nombre'      => 'Indispensables ella',
                'descripcion' => 'Calzas, camisetas técnicas e indumentaria para cada deporte. Entrenar bien empieza con estar bien equipada.',
                'imagen'      => '/assets/img/cliente/indispensables/indispensable ella.jpg',
            ],
            [
                'nombre'      => 'Indispensables él',
                'descripcion' => 'Kilómetros que se sienten livianos. Ropa funcional para correr, pedalear y salir a la montaña.',
                'imagen'      => '/assets/img/cliente/indispensables/indispensable el.jpg',
            ],
        ],
    ],

    // ─── Lo que se viene ─────────────────────────────────────────────

    'seccion_campania_verano' => [
        'titulo'    => 'Lo que se viene',
        'subtitulo' => 'Una campaña de verano con colores cálidos, telas frescas y diseños que acompañan cada paso.',
        'cta_texto' => 'Seguinos en Instagram',
        'imagenes' => [
            [
                'alt'   => 'Nueva Colección Verano — Origen Run & Bike',
                'imagen'=> '/assets/img/cliente/campañas/verano fem.jpg',
            ],
            [
                'alt'   => 'Nueva Colección Verano — calidad y asesoramiento',
                'imagen'=> '/assets/img/cliente/campañas/verano fem 2.jpg',
            ],
        ],
    ],

    // ─── Ubicación ───────────────────────────────────────────────────

    'direccion'    => "Ejército de los Andes 129\nX5850\nRío Tercero\nCórdoba, Argentina",
    'gmaps_embed'  => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1500!2d-64.1177626!3d-32.18387920000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cd6f33c8d75d99%3A0xea6f9f9ecb87cfe0!2sorigen%20run%20%26%20bike!5e0!3m2!1ses!2sar!4v1787875054834!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
    'gmaps_link'   => 'https://maps.app.goo.gl/HUvBH4WQ8sBVuuQMA',
    'mostrar_estrellas' => false,
    'estrellas'    => 5,
    'total_resenas'=> 1,
    'horario'      => 'Lunes a Viernes 9:00-20:00 | Sábados 9:00-12:00 | Domingo Cerrado',

    // ─── Redes Sociales ──────────────────────────────────────────────

    'redes' => [
        'instagram' => 'https://www.instagram.com/origen8.8/',
        'facebook'  => '',
        'tiktok'    => '',
        'web'       => 'https://origen.milocalweb.com.ar/',
    ],

    // ─── Quiénes Somos ───────────────────────────────────────────────

    'nosotros_texto' => "Volver al Origen es volver a lo que te hace bien. Es escuchar al cuerpo y moverse con él, no contra él. Es perderse en la montaña y encontrarse. Así nació Origen: de la necesidad de reconectar. Hoy Origen son clientes amigos que eligen moverse, sentirse vivos y volver a lo esencial.",
    'nosotros_galeria' => [
        '/assets/img/cliente/local/local-1.webp',
        '/assets/img/cliente/local/local-2.webp',
    ],

    // ─── Aside Publicitario ──────────────────────────────────────────

    'aside_visible'  => true,
    'aside_titulo'   => '¿Querés potenciar tu negocio?',
    'aside_texto'    => 'Te armamos una web profesional sin cargo y la optimizamos para Google.',
    'aside_cta'      => 'Quiero la mía',
    'aside_link'     => 'https://milocalweb.com.ar#contacto',

    // ─── Otros Clientes ──────────────────────────────────────────────

    'mostrar_clientes'   => true,
    'clientes_encabezado' => 'Otros negocios que confían en MiLocalWeb',
    'clientes' => [
        // Logos de terceros a agregar cuando estén disponibles.
    ],

    // ─── SEO / Datos estructurados ───────────────────────────────────

    'seo_keywords_primarias' => 'Indumentaria Deportiva',
    'seo_localidad'  => 'Río Tercero',
    'seo_provincia'  => 'Córdoba',
    'seo_zona_influencia' => 'Valle de Calamuchita, Almafuerte, Tancacha, Santa Rosa de Calamuchita, Embalse, Villa General Belgrano',
    'seo_lat' => '-32.1838792',
    'seo_long' => '-64.1177626',
    'seo_og_image' => '/assets/img/cliente/logos/logo-1024-transp.png',
    'og_descripcion' => 'Indumentaria deportiva en Río Tercero. Running, trekking y bikes. Calzas, shorts, tops y accesorios. ¡Escribinos por WhatsApp!',
    'seo_categorias' => ['Running', 'Trekking', 'Bikes', 'Calzas', 'Shorts', 'Tops', 'Camperas outdoor', 'Hidratación', 'Lentes deportivos'],
    'seo_marcas' => ['Navajo', 'Kaizen'], // Confirmar con el cliente

];
