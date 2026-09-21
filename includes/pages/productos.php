<?php
/**
 * Pagina de productos.
 *
 * Agrupa el catalogo por secciones (Ropa, Indumentaria, Accesorios),
 * cada una con una foto del local y su grilla de productos.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Productos'],
];

$secciones = [
    ['categoria' => 'Ropa', 'foto' => '/assets/img/cliente/local/interior/indumentaria.webp', 'alt' => 'Ropa en Origen 8.8'],
    ['categoria' => 'Indumentaria', 'foto' => '/assets/img/cliente/local/interior/sox.webp', 'alt' => 'Indumentaria en Origen 8.8'],
    ['categoria' => 'Accesorios', 'foto' => '/assets/img/cliente/local/interior/mostrador-lentes.webp', 'alt' => 'Accesorios en Origen 8.8'],
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

        <?php foreach ($secciones as $seccion): ?>
        <?php
            $seccionProducts = array_filter($pageProducts, function ($product) use ($seccion) {
                return ($product['categoria'] ?? '') === $seccion['categoria'];
            });
            if (empty($seccionProducts)) {
                continue;
            }
        ?>
        <section class="catalog-section">
            <header class="catalog-section__header">
                <img src="<?= htmlspecialchars($seccion['foto']) ?>"
                     alt="<?= htmlspecialchars($seccion['alt']) ?>"
                     class="catalog-section__photo"
                     width="400"
                     height="300"
                     loading="lazy">
                <h2 class="catalog-section__title"><?= htmlspecialchars($seccion['categoria']) ?></h2>
            </header>

            <div class="catalog-grid">
                <?php foreach ($seccionProducts as $product): ?>
                <?php require __DIR__ . '/../components/product-card.php'; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </div>
</section>
