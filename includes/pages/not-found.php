<?php
/**
 * Pagina 404.
 *
 * Muestra una respuesta visible para rutas no permitidas.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Página no encontrada'],
];
?>
<section class="catalog-page catalog-page--not-found">
    <div class="section-container">
        <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">404</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Página no encontrada') ?></h1>
            <p><?= htmlspecialchars($pageConfig['descripcion'] ?? 'La página solicitada no existe.') ?></p>
        </header>

        <div class="cart-foundation">
            <p>Podés volver al inicio o explorar el catálogo de Origen 8.8.</p>
            <a href="/" class="btn btn-primary">Volver al inicio</a>
            <a href="/productos" class="btn btn-outline">Ver productos</a>
        </div>
    </div>
</section>
