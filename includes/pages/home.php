<?php
/**
 * Pagina de inicio.
 *
 * Conserva la landing institucional actual como home del sitio catalogo.
 *
 * El orden de las secciones es el orden visual de la home; cada parcial
 * hace su propio return temprano si falta la configuración.
 *
 * @package MiLocalWeb\Clientes
 */
?>

<?php // Hero institucional y CTA de entrada al catálogo. ?>
<?php require __DIR__ . '/../sections/hero.php'; ?>
<?php require __DIR__ . '/../sections/cta-productos.php'; ?>
<?php // Bloque comercial principal: destacados, identidad y prueba social. ?>
<?php require __DIR__ . '/../sections/productos.php'; ?>
<?php require __DIR__ . '/../sections/nosotros.php'; ?>
<?php require __DIR__ . '/../sections/aside.php'; ?>
<?php // Local físico, indumentaria y cierre con ofertas de temporada. ?>
<?php require __DIR__ . '/../sections/nuestro-local.php'; ?>
<?php require __DIR__ . '/../sections/indumentaria.php'; ?>
<?php require __DIR__ . '/../sections/clientes.php'; ?>
<?php require __DIR__ . '/../sections/estrella.php'; ?>
