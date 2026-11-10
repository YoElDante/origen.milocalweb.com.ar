<?php
/**
 * Redes sociales y texto de Quiénes Somos.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
    // ─── Redes Sociales ──────────────────────────────────────────────

    'redes' => [
        'instagram' => 'https://www.instagram.com/origen8.8/',
        'facebook'  => '',
        'tiktok'    => '',
        'youtube'   => '',
        'web'       => 'https://origen.milocalweb.com.ar/',
    ],

    // ─── Quiénes Somos ───────────────────────────────────────────────

    'nosotros_texto' => "En Origen8.8 no buscamos solo ventas: buscamos personas, vínculos y buena onda. Cada charla, cada risa y cada recomendación hacen que este lugar tenga sentido. Por eso elegimos ropa y accesorios para que tu tiempo libre se viva en movimiento y con la mejor energía. Gracias por estar del otro lado y por hacer de Origen8.8 mucho más que un local.",
    'nosotros_video' => '/assets/vid/identidad/videoviral/video-viral.mp4',
    'nosotros_video_poster' => '',
    'nosotros_video_titulo' => 'Origen8.8 — Gracias por ser parte',

];
