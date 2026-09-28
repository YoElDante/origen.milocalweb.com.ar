<?php
/**
 * Pagina de productos.
 *
 * Agrupa el catalogo por familias comerciales y subcategorias.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Productos'],
];

$showProductWhatsapp = false;

$productMatches = function (array $product, array $requiredTags, array $excludedTags = []): bool {
    $tags = array_map('strtolower', $product['tags'] ?? []);

    foreach ($excludedTags as $tag) {
        if (in_array(strtolower($tag), $tags, true)) {
            return false;
        }
    }

    foreach ($requiredTags as $tag) {
        if (in_array(strtolower($tag), $tags, true)) {
            return true;
        }
    }

    return false;
};

$secciones = [
    [
        'titulo' => 'Ropa deportiva',
        'foto' => '/assets/img/cliente/local/interior/indumentaria.webp',
        'alt' => 'Ropa deportiva en Origen8.8',
        'grupos' => [
            ['titulo' => 'Remeras y musculosas', 'tags' => ['remeras']],
            ['titulo' => 'Tops', 'tags' => ['tops']],
            ['titulo' => 'Calzas y bikers', 'tags' => ['calzas', 'biker']],
            ['titulo' => 'Shorts', 'tags' => ['shorts']],
            ['titulo' => 'Pantalones', 'tags' => ['pantalones']],
            ['titulo' => 'Buzos y camperas', 'tags' => ['buzos', 'camperas']],
        ],
    ],
    [
        'titulo' => 'Medias SOX',
        'foto' => '/assets/img/cliente/local/interior/sox.webp',
        'alt' => 'Stand de medias SOX en Origen8.8',
        'grupos' => [
            ['titulo' => 'Medias SOX', 'tags' => ['medias']],
        ],
    ],
    [
        'titulo' => 'Accesorios deportivos',
        'foto' => '/assets/img/cliente/local/interior/mostrador-lentes.webp',
        'alt' => 'Accesorios deportivos en Origen8.8',
        'grupos' => [
            ['titulo' => 'Lentes', 'tags' => ['lentes']],
            ['titulo' => 'Gorras', 'tags' => ['gorras']],
            ['titulo' => 'Bolsos', 'tags' => ['bolsos']],
            ['titulo' => 'Botellas', 'tags' => ['botellas']],
            ['titulo' => 'Hidratación', 'tags' => ['hidratación'], 'exclude' => ['botellas']],
        ],
    ],
];
?>
<section class="catalog-page catalog-page--productos">
    <div class="section-container">
        <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">Origen8.8</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Productos') ?></h1>
            <p><?= htmlspecialchars($pageConfig['subtitulo'] ?? '') ?></p>
        </header>

        <?php foreach ($secciones as $seccion): ?>
        <section class="catalog-section">
            <header class="catalog-section__header">
                <img src="<?= htmlspecialchars($seccion['foto']) ?>"
                     alt="<?= htmlspecialchars($seccion['alt']) ?>"
                     class="catalog-section__photo"
                     width="400"
                     height="300"
                     loading="lazy">
                <div class="catalog-section__heading">
                    <h2 class="catalog-section__title"><?= htmlspecialchars($seccion['titulo']) ?></h2>
                    <p class="catalog-section__hint">Deslizá para ver más productos</p>
                </div>
            </header>

            <?php foreach ($seccion['grupos'] as $grupo): ?>
            <?php
                $grupoProducts = array_filter($pageProducts, function ($product) use ($grupo, $productMatches) {
                    return $productMatches($product, $grupo['tags'], $grupo['exclude'] ?? []);
                });
                $grupoVideos = array_values(array_filter($grupoProducts, function ($product) {
                    return !empty($product['video']);
                }));
            ?>
            <section class="catalog-subsection">
                <h3 class="catalog-subsection__title"><?= htmlspecialchars($grupo['titulo']) ?></h3>
                <div class="catalog-rail" data-catalog-rail>
                    <button type="button" class="catalog-rail__button catalog-rail__button--prev" data-catalog-scroll="prev" aria-label="Ver productos anteriores" hidden>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>

                    <div class="catalog-grid" tabindex="0" aria-label="<?= htmlspecialchars($grupo['titulo']) ?>">
                        <?php if (empty($grupoProducts)): ?>
                        <article class="catalog-placeholder" aria-label="<?= htmlspecialchars($grupo['titulo']) ?> pendiente">
                            <p class="catalog-placeholder__eyebrow">Próximamente</p>
                            <h4><?= htmlspecialchars($grupo['titulo']) ?></h4>
                            <p>Estamos preparando productos para esta categoría.</p>
                        </article>
                        <?php else: ?>
                        <?php foreach ($grupoVideos as $videoProduct): ?>
                        <article class="catalog-video-card" aria-label="Video de <?= htmlspecialchars($grupo['titulo']) ?>">
                            <video class="catalog-video-card__media"
                                   src="<?= htmlspecialchars($videoProduct['video']) ?>"
                                   poster="<?= htmlspecialchars($videoProduct['imagen'] ?? '') ?>"
                                   preload="metadata"
                                   controls
                                   playsinline
                                   muted
                                   aria-label="Video ilustrativo de <?= htmlspecialchars($grupo['titulo']) ?>"></video>
                            <div class="catalog-video-card__body">
                                <p class="catalog-video-card__eyebrow">Video</p>
                                <h4><?= htmlspecialchars($grupo['titulo']) ?></h4>
                            </div>
                        </article>
                        <?php endforeach; ?>
                        <?php foreach ($grupoProducts as $product): ?>
                        <?php
                            $product = array_merge($product, ['categoria' => $grupo['titulo']]);
                            $product['video'] = '';
                            require __DIR__ . '/../components/product-card.php';
                        ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button type="button" class="catalog-rail__button catalog-rail__button--next" data-catalog-scroll="next" aria-label="Ver más productos">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </section>
            <?php endforeach; ?>
        </section>
        <?php endforeach; ?>
    </div>
</section>
