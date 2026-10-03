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
$categoryIndex = [];
foreach ($secciones as $sectionIndex => $seccion) {
    foreach ($seccion['grupos'] as $groupIndex => $grupo) {
        $categoryIndex[] = [
            'section' => $seccion['titulo'],
            'label' => $grupo['titulo'],
            'url' => '#catalog-group-' . ($sectionIndex + 1) . '-' . ($groupIndex + 1),
        ];
    }
}
$productIndex = [];
?>
<section class="catalog-page catalog-page--productos">
    <div class="section-container">
        <div class="catalog-topline">
            <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

            <?php if (!empty($categoryIndex)): ?>
            <details class="catalog-category-menu">
                <summary class="catalog-category-menu__summary">
                    <span>/ Categorías</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                </summary>
                <div class="catalog-category-menu__panel">
                    <?php foreach ($categoryIndex as $category): ?>
                    <a href="<?= htmlspecialchars($category['url']) ?>">
                        <strong><?= htmlspecialchars($category['label']) ?></strong>
                        <span><?= htmlspecialchars($category['section']) ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </details>
            <?php endif; ?>
        </div>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">Origen8.8</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Productos') ?></h1>
            <p><?= htmlspecialchars($pageConfig['subtitulo'] ?? '') ?></p>
        </header>

        <div class="catalog-search" role="search">
            <label class="catalog-search__label" for="catalog-search-input">¿Qué estás buscando?</label>
            <div class="catalog-search__control">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input id="catalog-search-input"
                       type="search"
                       class="catalog-search__input"
                       placeholder="Buscar remeras, bolsos, lentes..."
                       autocomplete="off"
                       data-catalog-search>
                <button type="button" class="catalog-search__clear" data-catalog-search-clear hidden>Limpiar</button>
            </div>
            <p class="catalog-search__status" data-catalog-search-status aria-live="polite"></p>
        </div>

        <?php foreach ($secciones as $sectionIndex => $seccion): ?>
        <?php $sectionAnchor = 'catalog-section-' . ($sectionIndex + 1); ?>
        <section class="catalog-section" id="<?= htmlspecialchars($sectionAnchor) ?>">
            <header class="catalog-section__header">
                <img src="<?= htmlspecialchars($seccion['foto']) ?>"
                     alt="<?= htmlspecialchars($seccion['alt']) ?>"
                     class="catalog-section__photo"
                     width="400"
                     height="300"
                     loading="lazy">
                <div class="catalog-section__heading">
                    <h2 class="catalog-section__title"><?= htmlspecialchars($seccion['titulo']) ?></h2>
                    <p class="catalog-section__hint">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/></svg>
                        Deslizá para ver más productos
                    </p>
                </div>
            </header>

            <?php foreach ($seccion['grupos'] as $groupIndex => $grupo): ?>
            <?php
                $grupoProducts = array_filter($pageProducts, function ($product) use ($grupo, $productMatches) {
                    return $productMatches($product, $grupo['tags'], $grupo['exclude'] ?? []);
                });
                $grupoVideos = array_values(array_filter($grupoProducts, function ($product) {
                    return !empty($product['video']);
                }));
                $groupAnchor = 'catalog-group-' . ($sectionIndex + 1) . '-' . ($groupIndex + 1);
                $indexProducts = [];
            ?>
            <section class="catalog-subsection" id="<?= htmlspecialchars($groupAnchor) ?>">
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
                            $productAnchorId = 'producto-' . ($product['id'] ?? '') . '-' . ($sectionIndex + 1) . '-' . ($groupIndex + 1);
                            $indexProducts[] = [
                                'label' => $product['nombre'] ?? 'Producto',
                                'url' => '#' . $productAnchorId,
                            ];
                            require __DIR__ . '/../components/product-card.php';
                            unset($productAnchorId);
                        ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button type="button" class="catalog-rail__button catalog-rail__button--next" data-catalog-scroll="next" aria-label="Ver más productos">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </section>
            <?php
                if (!empty($indexProducts)) {
                    $productIndex[] = [
                        'section' => $seccion['titulo'],
                        'group' => $grupo['titulo'],
                        'url' => '#' . $groupAnchor,
                        'products' => $indexProducts,
                    ];
                }
            ?>
            <?php endforeach; ?>
        </section>
        <?php endforeach; ?>

        <?php if (!empty($productIndex)): ?>
        <details class="catalog-index">
            <summary class="catalog-index__summary">Ver índice de productos</summary>
            <div class="catalog-index__content">
                <?php foreach ($productIndex as $entry): ?>
                <section class="catalog-index__group">
                    <a href="<?= htmlspecialchars($entry['url']) ?>" class="catalog-index__group-link"><?= htmlspecialchars($entry['group']) ?></a>
                    <p><?= htmlspecialchars($entry['section']) ?></p>
                    <ul>
                        <?php foreach ($entry['products'] as $indexedProduct): ?>
                        <li><a href="<?= htmlspecialchars($indexedProduct['url']) ?>"><?= htmlspecialchars($indexedProduct['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <?php endforeach; ?>
            </div>
        </details>
        <?php endif; ?>
    </div>
</section>
