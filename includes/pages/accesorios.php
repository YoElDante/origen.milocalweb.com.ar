<?php
/**
 * Pagina de accesorios.
 *
 * Renderiza productos configurados para la ruta `accesorios`.
 * El filtro real lo resuelve catalog_products_for_page() en index.php.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Accesorios'],
];
?>
<section class="catalog-page catalog-page--accesorios">
    <div class="section-container">
        <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">Equipamiento liviano</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Accesorios') ?></h1>
            <p><?= htmlspecialchars($pageConfig['subtitulo'] ?? '') ?></p>
        </header>

        <?php if (empty($pageProducts)): ?>
        <p class="catalog-empty">Todavía no hay accesorios publicados. Consultanos por WhatsApp para recibir asesoramiento.</p>
        <?php else: ?>
        <div class="catalog-grid">
            <?php foreach ($pageProducts as $product): ?>
            <?php
                // La categoría visible se fuerza a Accesorios y se omiten
                // videos para priorizar la grilla compacta de esta página.
                $product = array_merge($product, ['categoria' => 'Accesorios']);
                $product['video'] = '';
            ?>
            <?php require __DIR__ . '/../components/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
