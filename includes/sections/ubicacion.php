<?php
/**
 * Sección "¿Cómo llegar?".
 *
 * Muestra el mapa embebido, la dirección y el botón "Llevame allí".
 * Debajo, un saludo "Te esperamos" con fotos del interior del local.
 *
 * @package MiLocalWeb\Clientes
 */

$llegar   = $cliente['seccion_como_llegar'] ?? [];
$interior = $llegar['interior'] ?? [];
?>
<section id="ubicacion" class="section section-ubicacion" aria-label="Cómo llegar">
    <div class="section-container">
        <h2 class="section-title"><?= htmlspecialchars($llegar['titulo'] ?? '¿Cómo llegar?') ?></h2>

        <div class="ubicacion-grid">
            <div class="ubicacion-mapa">
                <?= $cliente['gmaps_embed'] ?? '' ?>
            </div>

            <div class="ubicacion-info">
                <div class="ubicacion-direccion">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary, #000000)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <div>
                        <h3>Dirección</h3>
                        <p><?= nl2br(htmlspecialchars($cliente['direccion'] ?? '')) ?></p>
                    </div>
                </div>

                <?php if (!empty($cliente['gmaps_link'])): ?>
                <a href="<?= htmlspecialchars($cliente['gmaps_link']) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="btn-maps">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Llevame allí
                </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($interior)): ?>
        <div class="local-saludo">
            <h3 class="local-saludo-titulo"><?= htmlspecialchars($llegar['saludo'] ?? 'Te esperamos') ?></h3>
            <div class="local-grid">
                <?php foreach ($interior as $foto): ?>
                <figure class="local-foto">
                    <img src="<?= htmlspecialchars($foto['imagen'] ?? '') ?>"
                         alt="<?= htmlspecialchars($foto['alt'] ?? 'Local Origen 8.8') ?>"
                         width="800"
                         height="600"
                         loading="lazy">
                </figure>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
