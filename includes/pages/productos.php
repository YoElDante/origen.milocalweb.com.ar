<?php
/**
 * Pagina de productos.
 *
 * Renderiza productos configurados para la ruta `productos`.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Productos'],
];
?>
<section class="catalog-page catalog-page--productos">
    <div class="section-container">
        <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">Origen 8.8</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Productos') ?></h1>
            <p><?= htmlspecialchars($pageConfig['subtitulo'] ?? '') ?></p>
        </header>

        <div class="catalog-grid">
            <?php foreach ($pageProducts as $product): ?>
            <?php require __DIR__ . '/../components/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
