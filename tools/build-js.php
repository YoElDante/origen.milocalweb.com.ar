<?php
/**
 * Build script — JS bundle del carrito de Origen8.8.
 *
 * Concatena los parciales de `assets/js/cart/` en `assets/js/cart.js`.
 * No minifica: el bundle conserva el código original para facilitar el
 * diagnóstico en producción. El orden de `$sourceFiles` es el orden de
 * ejecución dentro del IIFE y NO debe alterarse.
 *
 * Uso:
 *   php tools/build-js.php
 *
 * @package MiLocalWeb\Clientes
 */

$baseDir = __DIR__ . '/..';
$jsDir   = $baseDir . '/assets/js';
$outFile = $jsDir . '/cart.js';

// Orden contractual: header abre el IIFE, footer lo cierra y los parciales
// intermedios comparten el mismo scope. No reordenar ni insertar archivos
// fuera de esta secuencia.
$sourceFiles = [
    'cart/00-header.js',
    'cart/01-storage.js',
    'cart/02-format-ui.js',
    'cart/03-add.js',
    'cart/04-actions.js',
    'cart/05-render.js',
    'cart/06-init.js',
    'cart/99-footer.js',
];

$js = [];
foreach ($sourceFiles as $file) {
    $path = $jsDir . '/' . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Advertencia: no se encontró {$path}\n");
        continue;
    }
    $js[] = file_get_contents($path);
}

// Sin separador adicional: los parciales ya están cortados para concatenarse
// tal cual y conservar el IIFE válido.
$bundle = implode('', $js);

if (file_put_contents($outFile, $bundle) === false) {
    fwrite(STDERR, "Error: no se pudo escribir {$outFile}\n");
    exit(1);
}

$size = filesize($outFile);
echo "✓ Bundle generado: assets/js/cart.js (" . number_format($size) . " bytes)\n";
echo "  Versión/cache-bust: ?v=" . filemtime($outFile) . "\n";
