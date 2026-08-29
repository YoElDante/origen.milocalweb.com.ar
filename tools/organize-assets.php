<?php
/**
 * Script de organización inicial de assets para Origen.
 *
 * Crea la estructura destino y copia/renombra los assets crudos.
 * No elimina archivos originales.
 */

$root = dirname(__DIR__);

$map = [
    // Logos
    'assets/img/logos/origen logo limpio 600x600 transp.webp' => 'assets/img/cliente/logos/logo-600x600-transp.webp',
    'assets/img/logos/origen logo hd transp 1024x1008.png'    => 'assets/img/cliente/logos/logo-1024-transp.png',

    // Favicon
    'assets/icons/origen icono.ico' => 'assets/img/cliente/iconos/favicon.ico',

    // Identidad
    'assets/img/texturas/textura fondo piedra.webp' => 'assets/img/cliente/identidad/textura-fondo-piedra.webp',
    'assets/img/identidad/origen bolsa paisaje.jpg' => 'assets/img/cliente/identidad/origen-bolsa-paisaje.jpg',
    'assets/img/identidad/renovando.jpg'             => 'assets/img/cliente/identidad/renovando.jpg',

    // Productos
    'assets/img/productos/shortMasculino1.webp' => 'assets/img/cliente/productos/short-con-calza.webp',
    'assets/img/productos/shortMasculino2.webp' => 'assets/img/cliente/productos/short-sin-calza.webp',
    'assets/img/productos/tops.webp'            => 'assets/img/cliente/productos/tops.webp',

    // Campañas
    'assets/img/campañas/verano fem.jpg'     => 'assets/img/cliente/campanas/verano-fem-1.jpg',
    'assets/img/campañas/verano fem 2.jpg'   => 'assets/img/cliente/campanas/verano-fem-2.jpg',
    'assets/img/indispensables/indispensable el.jpg'    => 'assets/img/cliente/campanas/indispensable-el.jpg',
    'assets/img/indispensables/indispensable ella.jpg'  => 'assets/img/cliente/campanas/indispensable-ella.jpg',
    'assets/img/ofertas/outdoor-campera.jpg' => 'assets/img/cliente/campanas/outdoor-campera.jpg',

    // Local
    'assets/img/interior del local/interiorLocal1.webp' => 'assets/img/cliente/local/local-1.webp',
    'assets/img/interior del local/interiorLocal2.webp' => 'assets/img/cliente/local/local-2.webp',

    // Reels
    'assets/vid/identidad/Que significa volver al Origen .mp4'         => 'assets/vid/reels/volver-al-origen.mp4',
    'assets/vid/identidad/Que significa volver al Origen - Caratula.jpg' => 'assets/vid/reels/volver-al-origen.jpg',
    'assets/vid/productos/video pantalones.mp4'                         => 'assets/vid/reels/pantalones-cargo-tecnicos.mp4',
    'assets/vid/productos/video pantalones caratula.jpg'                => 'assets/vid/reels/pantalones-cargo-tecnicos.jpg',
    'assets/vid/productos/Lentes deportivos.mp4'                        => 'assets/vid/reels/lentes-deportivos.mp4',
    'assets/vid/productos/lentes deportivos caratula.jpg'               => 'assets/vid/reels/lentes-deportivos.jpg',
];

foreach ($map as $src => $dst) {
    $srcPath = $root . DIRECTORY_SEPARATOR . $src;
    $dstPath = $root . DIRECTORY_SEPARATOR . $dst;

    if (!is_file($srcPath)) {
        echo "[SKIP] No existe origen: {$src}\n";
        continue;
    }

    $dir = dirname($dstPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    if (copy($srcPath, $dstPath)) {
        echo "[OK] {$src} -> {$dst}\n";
    } else {
        echo "[ERR] No se pudo copiar {$src}\n";
    }
}

echo "\nListo. Verificá la carpeta assets/img/cliente/ y assets/vid/reels/.\n";
