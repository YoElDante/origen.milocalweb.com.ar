<?php
/**
 * Configuración del cliente — Landing Page Origen 8.8.
 *
 * Este archivo es la ÚNICA fuente de datos del sitio.
 *
 * @package MiLocalWeb\Clientes
 */

return [

    // ─── Datos básicos ───────────────────────────────────────────────

    'nombre'    => 'Origen 8.8',
    'site_url'  => 'https://origen.milocalweb.com.ar',
    'slogan'    => 'Línea tiempo libre',
    'rubro'     => 'Indumentaria y accesorios para el tiempo libre',
    'whatsapp'  => '5493571329870',
    'email'     => '', // Pendiente con el cliente
    'whatsapp_mensaje' => 'Hola! Vi tu web y quisiera más info',
    'whatsapp_mensaje_ofertas' => 'Hola! Estoy en la web y me gustaría ver oportunidades en ropa de invierno y camperas',

    // ─── Branding assets ─────────────────────────────────────────────

    'logo_img'  => '/assets/img/cliente/logos/logo-origen88.webp',
    'favicon'   => '/assets/img/cliente/iconos/favicon.ico',

    // ─── Hero Section ────────────────────────────────────────────────

    'hero_layout'      => 'split', // img-right | img-left | stacked
    'hero_descripcion' => "Algo más que un local de indumentaria. Running, trekking y bikes: ropa, calzado y accesorios para todas tus actividades al Aire Libre!",
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
            'nombre'      => 'Biker I-Run',
            'descripcion' => 'Calza biker de tela elastizada, talle S al 2XL. Ideal para running, gym y uso diario. Variedad de talles y colores.',
            'imagen'      => '/assets/img/cliente/productos/biker-irun.webp',
        ],
        [
            'nombre'      => 'Top Deportivo I-Run Dama',
            'descripcion' => 'Top con taza fija, soporte y comodidad para entrenar. Talle S al 2XL. Variedad de talles y colores.',
            'imagen'      => '/assets/img/cliente/productos/top-deportivo-irun-dama.webp',
        ],
        [
            'nombre'      => 'Remera Cuello en V Microperforada',
            'descripcion' => 'Remera microperforada cuello en V, liviana y transpirable. Variedad de talles y colores.',
            'imagen'      => '/assets/img/cliente/productos/remera-cuello-v-microperforada.webp',
        ],
    ],

    // ─── Catálogo con pedido asistido ────────────────────────────────

    'paginas' => [
        'home' => [
            'titulo' => 'Origen 8.8 — Indumentaria Deportiva en Río Tercero',
            'descripcion' => 'Running, trekking y bikes en Río Tercero. Ropa, calzado y accesorios para volver a lo esencial.',
            'h1' => 'Indumentaria Deportiva en Río Tercero',
        ],
        'productos' => [
            'titulo' => 'Productos — Origen 8.8',
            'descripcion' => 'Catálogo de indumentaria deportiva Origen en Río Tercero: shorts, tops, calzas, calzado y prendas outdoor.',
            'h1' => 'Productos',
            'subtitulo' => 'Indumentaria deportiva para running, trekking, gym y movimiento diario.',
        ],
        'ofertas' => [
            'titulo' => 'Ofertas — Origen 8.8',
            'descripcion' => 'Ofertas y oportunidades en indumentaria deportiva, outdoor y accesorios en Origen 8.8.',
            'h1' => 'Ofertas',
            'subtitulo' => 'Oportunidades seleccionadas y productos con descuento para consultar por WhatsApp.',
        ],
        'accesorios' => [
            'titulo' => 'Accesorios — Origen 8.8',
            'descripcion' => 'Accesorios para running, trekking y bikes: hidratación, lentes deportivos y equipamiento liviano.',
            'h1' => 'Accesorios',
            'subtitulo' => 'Complementos para entrenar, salir a la montaña o pedalear con más comodidad.',
        ],
        'carrito' => [
            'titulo' => 'Carrito — Origen 8.8',
            'descripcion' => 'Prepará tu pedido para consultar stock y precio final con Origen 8.8 por WhatsApp.',
            'h1' => 'Carrito',
            'subtitulo' => 'Tu pedido se guarda en este navegador y se confirma directamente con el negocio.',
        ],
    ],

    'catalogo' => [
        [
            'id' => 'medias-tenis-blanca',
            'nombre' => 'Docena de Medias Tenis Blanca',
            'slug' => 'medias-tenis-blanca',
            'descripcion' => 'Docena de medias de tenis blancas, talle 35-39. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/medias-tenis-blanca.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/medias-tenis-blanca-miniatura.webp',
            'video' => '',
            'alt' => 'Docena de medias tenis blanca Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['medias', 'tenis', 'running'],
        ],
        [
            'id' => 'medias-tenis-colores',
            'nombre' => 'Docena de Medias Tenis Colores',
            'slug' => 'medias-tenis-colores',
            'descripcion' => 'Docena de medias de tenis en colores, talle 35-39. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/medias-tenis-colores.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/medias-tenis-colores-miniatura.webp',
            'video' => '',
            'alt' => 'Docena de medias tenis colores Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['medias', 'tenis', 'running'],
        ],
        [
            'id' => 'medias-tobilleras-irun',
            'nombre' => 'Medias Tobilleras I-Run Unisex',
            'slug' => 'medias-tobilleras-irun',
            'descripcion' => 'Medias tobilleras I-Run unisex, talle 39-44. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/medias-tobilleras-irun.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/medias-tobilleras-irun-miniatura.webp',
            'video' => '',
            'alt' => 'Medias tobilleras I-Run unisex Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['medias', 'running', 'unisex'],
        ],
        [
            'id' => 'medias-unisex-irun',
            'nombre' => 'Medias Unisex I-Run',
            'slug' => 'medias-unisex-irun',
            'descripcion' => 'Medias unisex I-Run, talle 39-44. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/medias-unisex-irun.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/medias-unisex-irun-miniatura.webp',
            'video' => '',
            'alt' => 'Medias unisex I-Run Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['medias', 'running', 'unisex'],
        ],
        [
            'id' => 'biker-irun-mujer',
            'nombre' => 'Biker I-Run Mujer',
            'slug' => 'biker-irun-mujer',
            'descripcion' => 'Biker I-Run mujer, talle S al 2XL. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/biker-irun-mujer.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/biker-irun-mujer-miniatura.webp',
            'video' => '',
            'alt' => 'Biker I-Run mujer Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['calzas', 'biker', 'running'],
        ],
        [
            'id' => 'biker-irun-negro',
            'nombre' => 'Biker I-Run Negro',
            'slug' => 'biker-irun-negro',
            'descripcion' => 'Biker I-Run color negro, talle S al 2XL. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/biker-irun-negro.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/biker-irun-negro-miniatura.webp',
            'video' => '',
            'alt' => 'Biker I-Run negro Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['calzas', 'biker', 'running'],
        ],
        [
            'id' => 'calza-running-cierres',
            'nombre' => 'Calza Running con Cierres',
            'slug' => 'calza-running-cierres',
            'descripcion' => 'Calza running con cierres, varios colores. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/calza-running-cierres.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/calza-running-cierres-miniatura.webp',
            'video' => '',
            'alt' => 'Calza running con cierres Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['calzas', 'running', 'gym'],
        ],
        [
            'id' => 'pantalon-dama',
            'nombre' => 'Pantalón Dama',
            'slug' => 'pantalon-dama',
            'descripcion' => 'Pantalón dama cómodo y versátil. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/pantalon-dama.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/pantalon-dama-miniatura.webp',
            'video' => '',
            'alt' => 'Pantalón dama Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['pantalones', 'running', 'dama'],
        ],
        [
            'id' => 'pantalon-desmontable',
            'nombre' => 'Pantalón Desmontable 2 en 1',
            'slug' => 'pantalon-desmontable',
            'descripcion' => 'Pantalón cargo técnico antidesgarro, 8 bolsillos, corte recto o gaucha. Talle S al 4XL.',
            'imagen' => '/assets/img/cliente/productos/catalogo/pantalon-desmontable.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/pantalon-desmontable-miniatura.webp',
            'video' => '/assets/vid/productos/catalogo/pantalon-desmontable.mp4',
            'alt' => 'Pantalón desmontable técnico Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['pantalones', 'outdoor', 'técnico'],
        ],
        [
            'id' => 'short-microfibra-irun',
            'nombre' => 'Short Microfibra Elastizada I-Run Dama',
            'slug' => 'short-microfibra-irun',
            'descripcion' => 'Short de microfibra elastizada I-Run dama, talle S al 2XL. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/short-microfibra-irun.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/short-microfibra-irun-miniatura.webp',
            'video' => '',
            'alt' => 'Short microfibra I-Run dama Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['shorts', 'running', 'dama'],
        ],
        [
            'id' => 'musculosa-deportiva',
            'nombre' => 'Musculosa Deportiva',
            'slug' => 'musculosa-deportiva',
            'descripcion' => 'Musculosa deportiva, varios talles. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/musculosa-deportiva.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/musculosa-deportiva-miniatura.webp',
            'video' => '',
            'alt' => 'Musculosa deportiva Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'gym', 'running'],
        ],
        [
            'id' => 'musculosa-dryfit-irun',
            'nombre' => 'Musculosa Dryfit I-Run',
            'slug' => 'musculosa-dryfit-irun',
            'descripcion' => 'Musculosa dryfit I-Run, talle S al 2XL. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/musculosa-dryfit-irun.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/musculosa-dryfit-irun-miniatura.webp',
            'video' => '',
            'alt' => 'Musculosa dryfit I-Run Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'dryfit', 'running'],
        ],
        [
            'id' => 'remera-corte-alto',
            'nombre' => 'Remera Corte Alto',
            'slug' => 'remera-corte-alto',
            'descripcion' => 'Remera corte alto, varios colores. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-corte-alto.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-corte-alto-miniatura.webp',
            'video' => '',
            'alt' => 'Remera corte alto Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'dama', 'gym'],
        ],
        [
            'id' => 'remera-cuello-v-microperforada',
            'nombre' => 'Remera Cuello en V Microperforada',
            'slug' => 'remera-cuello-v-microperforada',
            'descripcion' => 'Remera microperforada cuello en V, liviana y transpirable. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-cuello-v-microperforada.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-cuello-v-microperforada-miniatura.webp',
            'video' => '',
            'alt' => 'Remera cuello en V microperforada Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'running', 'transpirable'],
        ],
        [
            'id' => 'remera-cuello-v-talles',
            'nombre' => 'Remera Cuello en V Varios Talles',
            'slug' => 'remera-cuello-v-talles',
            'descripcion' => 'Remera cuello en V, varios talles. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-cuello-v-talles.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-cuello-v-talles-miniatura.webp',
            'video' => '',
            'alt' => 'Remera cuello en V varios talles Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'running', 'gym'],
        ],
        [
            'id' => 'remera-cuello-v-cintura',
            'nombre' => 'Remera Cuello V Detalle en Cintura',
            'slug' => 'remera-cuello-v-cintura',
            'descripcion' => 'Remera cuello en V con detalle en cintura. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-cuello-v-cintura.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-cuello-v-cintura-miniatura.webp',
            'video' => '',
            'alt' => 'Remera cuello V detalle en cintura Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'dama', 'gym'],
        ],
        [
            'id' => 'remera-hombre-cuello-redondo',
            'nombre' => 'Remera Hombre Cuello Redondo',
            'slug' => 'remera-hombre-cuello-redondo',
            'descripcion' => 'Remera hombre cuello redondo, varios colores. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-hombre-cuello-redondo.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-hombre-cuello-redondo-miniatura.webp',
            'video' => '',
            'alt' => 'Remera hombre cuello redondo Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'hombre', 'running'],
        ],
        [
            'id' => 'remera-irun-dama-espalda',
            'nombre' => 'Remera I-Run Dama Detalle Espalda',
            'slug' => 'remera-irun-dama-espalda',
            'descripcion' => 'Remera I-Run dama con detalle en espalda, talle S al 2XL. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-irun-dama-espalda.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-irun-dama-espalda-miniatura.webp',
            'video' => '',
            'alt' => 'Remera I-Run dama detalle espalda Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'dama', 'running'],
        ],
        [
            'id' => 'remera-irun-dama',
            'nombre' => 'Remera I-Run Dama',
            'slug' => 'remera-irun-dama',
            'descripcion' => 'Remera I-Run dama. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/remera-irun-dama.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/remera-irun-dama-miniatura.webp',
            'video' => '',
            'alt' => 'Remera I-Run dama Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['remeras', 'dama', 'running'],
        ],
        [
            'id' => 'top-deportivo-irun-dama',
            'nombre' => 'Top Deportivo I-Run Dama',
            'slug' => 'top-deportivo-irun-dama',
            'descripcion' => 'Top deportivo con taza fija, talle S al 2XL. Variedad de talles y colores.',
            'imagen' => '/assets/img/cliente/productos/catalogo/top-deportivo-irun-dama.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/top-deportivo-irun-dama-miniatura.webp',
            'video' => '',
            'alt' => 'Top deportivo I-Run dama Origen 8.8',
            'rutas' => ['productos'],
            'categoria' => 'indumentaria',
            'tags' => ['tops', 'dama', 'gym'],
        ],
        [
            'id' => 'bolso-irun-negro',
            'nombre' => 'Bolso I-RUN Negro',
            'slug' => 'bolso-irun-negro',
            'descripcion' => 'Bolso I-RUN deportivo color negro.',
            'imagen' => '/assets/img/cliente/productos/catalogo/bolso-irun-negro.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/bolso-irun-negro-miniatura.webp',
            'video' => '/assets/vid/productos/catalogo/bolso-irun-negro.mp4',
            'alt' => 'Bolso I-RUN negro Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['bolsos', 'running', 'gym'],
        ],
        [
            'id' => 'bolso-irun-47',
            'nombre' => 'Bolso I-RUN 47x20x28',
            'slug' => 'bolso-irun-47',
            'descripcion' => 'Bolso I-RUN de 47x20x28 cm.',
            'imagen' => '/assets/img/cliente/productos/catalogo/bolso-irun-47.webp',
            'miniatura' => '',
            'video' => '',
            'alt' => 'Bolso I-RUN 47x20x28 Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['bolsos', 'running', 'gym'],
        ],
        [
            'id' => 'botella-infantil',
            'nombre' => 'Botella Infantil',
            'slug' => 'botella-infantil',
            'descripcion' => 'Botella térmica infantil.',
            'imagen' => '/assets/img/cliente/productos/catalogo/botella-infantil.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/botella-infantil-miniatura.webp',
            'video' => '/assets/vid/productos/catalogo/botella-infantil.mp4',
            'alt' => 'Botella infantil Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['botellas', 'infantil', 'hidratación'],
        ],
        [
            'id' => 'botellas-termicas-infantiles',
            'nombre' => 'Botellas Térmicas Infantiles',
            'slug' => 'botellas-termicas-infantiles',
            'descripcion' => 'Botellas térmicas infantiles.',
            'imagen' => '/assets/img/cliente/productos/catalogo/botellas-termicas-infantiles.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/botellas-termicas-infantiles-miniatura.webp',
            'video' => '',
            'alt' => 'Botellas térmicas infantiles Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['botellas', 'infantil', 'hidratación'],
        ],
        [
            'id' => 'botellas-hidratacion',
            'nombre' => 'Botellas de Hidratación',
            'slug' => 'botellas-hidratacion',
            'descripcion' => 'Botellas de hidratación.',
            'imagen' => '/assets/img/cliente/productos/catalogo/botellas-hidratacion.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/botellas-hidratacion-miniatura.webp',
            'video' => '',
            'alt' => 'Botellas de hidratación Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['botellas', 'hidratación', 'running'],
        ],
        [
            'id' => 'botellas-metalicas',
            'nombre' => 'Botellas Metálicas',
            'slug' => 'botellas-metalicas',
            'descripcion' => 'Botellas metálicas.',
            'imagen' => '/assets/img/cliente/productos/catalogo/botellas-metalicas.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/botellas-metalicas-miniatura.webp',
            'video' => '',
            'alt' => 'Botellas metálicas Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['botellas', 'hidratación', 'térmica'],
        ],
        [
            'id' => 'gorras-gorros-sombreros',
            'nombre' => 'Gorras, Gorros y Sombreros',
            'slug' => 'gorras-gorros-sombreros',
            'descripcion' => 'Gorras, gorros y sombreros.',
            'imagen' => '/assets/img/cliente/productos/catalogo/gorras-gorros-sombreros.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/gorras-gorros-sombreros-miniatura.webp',
            'video' => '',
            'alt' => 'Gorras, gorros y sombreros Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['gorras', 'outdoor', 'running'],
        ],
        [
            'id' => 'lentes-deportivos',
            'nombre' => 'Lentes Deportivos',
            'slug' => 'lentes-deportivos',
            'descripcion' => 'Lentes deportivos con lente panorámica espejada + UV400. Bici, trail y running.',
            'imagen' => '/assets/img/cliente/productos/catalogo/lentes-deportivos.webp',
            'miniatura' => '/assets/img/cliente/productos/catalogo/lentes-deportivos-miniatura.webp',
            'video' => '/assets/vid/productos/catalogo/lentes-deportivos.mp4',
            'alt' => 'Lentes deportivos Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['lentes', 'running', 'bike'],
        ],
        [
            'id' => 'cinturon-hidratacion-navajo',
            'nombre' => 'Cinturón de Hidratación Navajo',
            'slug' => 'cinturon-hidratacion-navajo',
            'descripcion' => 'Cinturón de hidratación Navajo, liviano para running y trekking.',
            'imagen' => '/assets/img/cliente/productos/catalogo/cinturon-hidratacion-navajo.webp',
            'miniatura' => '',
            'video' => '',
            'alt' => 'Cinturón de hidratación Navajo Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['hidratación', 'running', 'trekking'],
        ],
        [
            'id' => 'chaleco-hidratacion-navajo',
            'nombre' => 'Chaleco de Hidratación Navajo 7L',
            'slug' => 'chaleco-hidratacion-navajo',
            'descripcion' => 'Chaleco Navajo Kaizen 7L con 8 bolsillos y 2 softflask de 500ml.',
            'imagen' => '/assets/img/cliente/productos/catalogo/chaleco-hidratacion-navajo.webp',
            'miniatura' => '',
            'video' => '/assets/vid/productos/catalogo/chaleco-hidratacion-navajo.mp4',
            'alt' => 'Chaleco de hidratación Navajo 7L Origen 8.8',
            'rutas' => ['productos', 'accesorios'],
            'categoria' => 'accesorios',
            'tags' => ['hidratación', 'trail', 'trekking'],
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
                'alt'   => 'Nueva Colección Verano — Origen 8.8',
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

    // ─── Nuestro Local ──────────────────────────────────────────────

    'seccion_local' => [
        'titulo'     => 'Nuestro Local',
        'invitacion' => 'Pasá a conocernos. Te esperamos con la mejor energía para que elijas tu próxima prenda o accesorio para el tiempo libre.',
        'exterior'   => [
            ['imagen' => '/assets/img/cliente/local/exterior/frente.webp',  'alt' => 'Frente del local Origen 8.8'],
            ['imagen' => '/assets/img/cliente/local/exterior/derecha.webp', 'alt' => 'Vista lateral del local Origen 8.8'],
        ],
    ],

    // ─── Cómo llegar ────────────────────────────────────────────────

    'seccion_como_llegar' => [
        'titulo'   => '¿Cómo llegar?',
        'saludo'   => 'Te esperamos',
        'interior' => [
            ['imagen' => '/assets/img/cliente/local/interior/interior.webp', 'alt' => 'Interior del local Origen 8.8'],
            ['imagen' => '/assets/img/cliente/local/interior/vidriera.webp', 'alt' => 'Vidriera del local Origen 8.8'],
        ],
    ],

    // ─── Indumentaria ───────────────────────────────────────────────

    'seccion_indumentaria' => [
        'titulo'    => 'Indumentaria y accesorios',
        'mensaje'   => '¡Tenemos todos los accesorios e indumentaria para tus salidas al aire libre!',
        'intro_img' => '/assets/img/cliente/local/interior/indumentaria.webp',
        'intro_alt' => 'Indumentaria deportiva en Origen 8.8',
        'mostrador_img' => '/assets/img/cliente/local/interior/mostrador-lentes.webp',
        'mostrador_alt' => 'Mostrador de lentes en Origen 8.8',
        'lentes_video'  => '/assets/vid/reels/lentes-deportivos.mp4',
        'lentes_poster' => '/assets/vid/reels/lentes-deportivos.jpg',
        'lentes_titulo' => 'Pasa a ver nuestra línea de Anteojos y Lentes de Montaña',
        'lentes_texto'  => 'Lentes con protección UV400, montura liviana y lente espejada pensada para bici, trail y running. Ideales para tus salidas al aire libre, con la comodidad y el estilo que buscás.',
        'accesorios_cta'  => 'Pasa a ver todos nuestros accesorios',
        'accesorios_link' => '/accesorios',
    ],

    // ─── Redes Sociales ──────────────────────────────────────────────

    'redes' => [
        'instagram' => 'https://www.instagram.com/origen8.8/',
        'facebook'  => '',
        'tiktok'    => '',
        'web'       => 'https://origen.milocalweb.com.ar/',
    ],

    // ─── Quiénes Somos ───────────────────────────────────────────────

    'nosotros_texto' => "En Origen 8.8 no buscamos solo ventas: buscamos personas, vínculos y buena onda. Cada charla, cada risa y cada recomendación hacen que este lugar tenga sentido. Por eso elegimos ropa y accesorios para que tu tiempo libre se viva en movimiento y con la mejor energía. Gracias por estar del otro lado y por hacer de Origen mucho más que un local.",
    'nosotros_video' => '/assets/vid/identidad/videoviral/video-viral.mp4',
    'nosotros_video_poster' => '',
    'nosotros_video_titulo' => 'Origen 8.8 — Gracias por ser parte',

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
    'seo_og_image' => '/assets/img/cliente/logos/logo-origen88.webp',
    'og_descripcion' => 'Indumentaria deportiva en Río Tercero. Running, trekking y bikes. Calzas, shorts, tops y accesorios. ¡Escribinos por WhatsApp!',
    'seo_categorias' => ['Running', 'Trekking', 'Bikes', 'Calzas', 'Shorts', 'Tops', 'Camperas outdoor', 'Hidratación', 'Lentes deportivos'],
    'seo_marcas' => ['Navajo', 'Kaizen'], // Confirmar con el cliente

];
