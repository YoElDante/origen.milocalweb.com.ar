<?php
/**
 * Productos destacados, páginas del catálogo y catálogo completo.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
    // ─── Productos Destacados ────────────────────────────────────────

    'productos' => [
        [
            'nombre'      => 'Biker I-Run',
            'marca'       => 'I-Run',
            'descripcion' => 'Calza biker de tela elastizada, talle S al 2XL. Ideal para running, gym y uso diario.',
            'imagen'      => '/assets/img/cliente/productos/catalogo/biker-irun-mujer.webp',
        ],
        [
            'nombre'      => 'Top Deportivo I-Run Dama',
            'marca'       => 'I-Run',
            'descripcion' => 'Top con taza fija, soporte y comodidad para entrenar. Talle S al 2XL.',
            'imagen'      => '/assets/img/cliente/productos/catalogo/top-deportivo-irun-dama.webp',
        ],
        [
            'nombre'      => 'Remera Cuello en V Microperforada',
            'marca'       => 'I-Run',
            'descripcion' => 'Remera microperforada cuello en V, liviana y transpirable.',
            'imagen'      => '/assets/img/cliente/productos/catalogo/remera-cuello-v-microperforada.webp',
        ],
    ],

    'paginas' => [
        'home' => [
            'titulo' => 'Origen8.8 — Indumentaria Deportiva en Río Tercero',
            'descripcion' => 'Encontrá indumentaria deportiva, calzado y accesorios para running, trekking y bikes en Origen8.8, Río Tercero. Consultá stock y precios por WhatsApp.',
            'h1' => 'Indumentaria Deportiva en Río Tercero',
        ],
        'productos' => [
            'titulo' => 'Indumentaria deportiva en Río Tercero | Origen8.8',
            'descripcion' => 'Explorá el catálogo de indumentaria deportiva Origen8.8 en Río Tercero: shorts, tops, calzas, calzado y prendas para actividades al aire libre.',
            'h1' => 'Indumentaria deportiva',
            'subtitulo' => 'Productos para running, trekking, gym y movimiento diario en Río Tercero.',
        ],
        'ofertas' => [
            'titulo' => 'Ofertas de indumentaria en Río Tercero | Origen8.8',
            'descripcion' => 'Consultá ofertas y oportunidades en indumentaria deportiva, prendas outdoor y accesorios en Origen8.8, Río Tercero. Pedí detalles por WhatsApp.',
            'h1' => 'Ofertas de indumentaria deportiva',
            'subtitulo' => 'Oportunidades seleccionadas en Río Tercero para consultar por WhatsApp.',
        ],
        'accesorios' => [
            'titulo' => 'Accesorios deportivos en Río Tercero | Origen8.8',
            'descripcion' => 'Descubrí accesorios para running, trekking y bikes en Origen8.8, Río Tercero: hidratación, lentes deportivos, bolsos y equipamiento liviano.',
            'h1' => 'Accesorios deportivos',
            'subtitulo' => 'Complementos para entrenar, salir a la montaña o pedalear desde Río Tercero.',
        ],
        'carrito' => [
            'titulo' => 'Mi pedido — Origen8.8',
            'descripcion' => 'Prepará tu pedido para consultar stock y precio final con Origen8.8 por WhatsApp.',
            'h1' => 'Mi pedido',
            'subtitulo' => 'Enviaremos tu pedido por WhatsApp con todos los detalles para que el negocio confirme precio final y disponibilidad.',
        ],
    ],

    // ─── Catálogo con pedido asistido ────────────────────────────────
    // Dividido en dos parciales para mantener cada archivo legible.
    'catalogo' => array_merge(
        require __DIR__ . '/catalogo-parte-1.php',
        require __DIR__ . '/catalogo-parte-2.php',
    ),

];
