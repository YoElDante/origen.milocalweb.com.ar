<?php
/**
 * Build script — CSS bundle de Origen8.8.
 *
 * Concatena los parciales de `assets/css/src/` en un único
 * `assets/css/styles.css` y aplica una minificación conservadora.
 *
 * El orden de `$sourceFiles` reproduce exactamente el orden del antiguo
 * `styles.css` monolítico. NO reordenar sin revisar la cascada.
 *
 * Uso:
 *   php tools/build-css.php
 *
 * @package MiLocalWeb\Clientes
 */

$baseDir = __DIR__ . '/..';
$cssDir  = $baseDir . '/assets/css';
$outFile = $cssDir . '/styles.css';

// Orden contractual de la cascada: no reordenar sin revisar styles.css.
// Los comentarios de los parciales se eliminan en el bundle final.
$sourceFiles = [
    'src/01-base.css',
    'src/02-navbar.css',
    'src/03-hero.css',
    'src/04-estrella.css',
    'src/05-productos.css',
    'src/06-nosotros.css',
    'src/07-aside.css',
    'src/08-ubicacion-local.css',
    'src/09-indumentaria.css',
    'src/10-footer-clientes.css',
    'src/11-campanas.css',
    'src/12-flotantes.css',
    'src/13-catalogo-layout.css',
    'src/14-catalogo-cards.css',
    'src/15-catalogo-card.css',
    'src/16-carrito.css',
    'src/17-utilidades.css',
];

$css = [];
foreach ($sourceFiles as $file) {
    $path = $cssDir . '/' . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Advertencia: no se encontró {$path}\n");
        continue;
    }
    $css[] = "/* === {$file} === */";
    $css[] = file_get_contents($path);
}

$bundle = implode("\n", $css);

// Minificación conservadora: elimina comentarios /* */ y espacios redundantes.
// No toca comentarios dentro de strings/comillas porque en CSS estándar no se usan.
// Se mantiene deliberadamente simple para no romper valores ni selectores.
$bundle = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!s', '', $bundle);
$bundle = preg_replace('/\s+/', ' ', $bundle);
$bundle = trim($bundle);

if (file_put_contents($outFile, $bundle) === false) {
    fwrite(STDERR, "Error: no se pudo escribir {$outFile}\n");
    exit(1);
}

$size = filesize($outFile);
echo "✓ Bundle generado: assets/css/styles.css (" . number_format($size) . " bytes)\n";
echo "  Versión/cache-bust: ?v=" . filemtime($outFile) . "\n";
