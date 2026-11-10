<?php
/**
 * Campañas y secciones editoriales de la home.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
    // ─── Ofertas de la temporada que se va ───────────────────────────

    'seccion_ofertas' => [
        'titulo'    => 'Ofertas de la temporada que se va',
        'subtitulo' => 'Últimas prendas de otoño-invierno con precios especiales.',
        'cta_texto' => 'Pedir catálogo de oportunidades',
        'ofertas' => [
            [
                'nombre'      => 'Abrigos',
                'subtitulo'   => 'Outdoor que se adapta a tu ritmo',
                'descripcion' => 'Aire fresco, más movimiento y prendas que acompañan. El otoño se vive mejor afuera.',
                'imagen'      => '/assets/img/cliente/ofertas/outdoor.jpg',
            ],
            [
                'nombre'      => 'Chalecos',
                'subtitulo'   => 'Comfort en tonos neutros',
                'descripcion' => 'No importa si salís a entrenar, a caminar o a resolver el día: prendas pensadas para moverse con vos.',
                'imagen'      => '/assets/img/cliente/ofertas/outdoor-colorcrema.jpg',
            ],
            [
                'nombre'      => 'Camperas',
                'subtitulo'   => 'Camperas outdoor',
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
                'alt'   => 'Nueva Colección Verano — Origen8.8',
                'imagen'=> '/assets/img/cliente/campañas/verano fem.jpg',
            ],
            [
                'alt'   => 'Nueva Colección Verano — calidad y asesoramiento',
                'imagen'=> '/assets/img/cliente/campañas/verano fem 2.jpg',
            ],
        ],
    ],

];
