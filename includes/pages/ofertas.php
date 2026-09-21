<?php
/**
 * Pagina de ofertas.
 *
 * Renderiza productos marcados como ofertas o con descuento.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Ofertas'],
];
?>
<section class="catalog-page catalog-page--ofertas">
    <div class="section-container">
        <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">Oportunidades</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Ofertas') ?></h1>
            <p><?= htmlspecialchars($pageConfig['subtitulo'] ?? '') ?></p>
        </header>

        <?php if (empty($pageProducts)): ?>
        <p class="catalog-empty">Todavía no hay ofertas publicadas. Consultanos por WhatsApp para conocer oportunidades vigentes.</p>
        <?php else: ?>
        <div class="catalog-grid">
            <?php foreach ($pageProducts as $product): ?>
            <?php require __DIR__ . '/../components/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
