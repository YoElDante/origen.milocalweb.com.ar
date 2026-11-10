<?php
/**
 * Aside publicitario y vidriera de otros clientes.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
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

];
