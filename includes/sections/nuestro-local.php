<?php
/**
 * Sección "Nuestro Local".
 *
 * Invita a pasar a conocer el local y muestra fotos representativas
 * del frente.
 *
 * @package MiLocalWeb\Clientes
 */

$local       = $cliente['seccion_local'] ?? [];
$llegar      = $cliente['seccion_como_llegar'] ?? [];
$exterior    = $local['exterior'] ?? [];
$interior    = $llegar['interior'] ?? [];
$frente      = $exterior[0] ?? [];
$carousel    = array_values(array_filter(array_merge(array_slice($exterior, 1), $interior)));
if (empty($local)) {
    return;
}
?>
<section id="nuestro-local" class="section section-local" aria-label="Nuestro Local">
    <div class="section-container">
        <h2 class="section-title"><?= htmlspecialchars($local['titulo'] ?? 'Nuestro Local') ?></h2>
        <?php if (!empty($local['invitacion'])): ?>
        <p class="section-subtitle"><?= htmlspecialchars($local['invitacion']) ?></p>
        <?php endif; ?>

        <?php if (!empty($frente)): ?>
        <figure class="local-frente">
            <img src="<?= htmlspecialchars($frente['imagen'] ?? '') ?>"
                 alt="<?= htmlspecialchars($frente['alt'] ?? 'Frente del local Origen8.8') ?>"
                 width="1200"
                 height="800"
                 loading="lazy">
        </figure>
        <?php endif; ?>

        <div class="local-ubicacion-row">
            <div class="ubicacion-mapa local-mapa">
                <?= $cliente['gmaps_embed'] ?? '' ?>
            </div>

            <div class="ubicacion-info local-info">
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

        <?php if (!empty($carousel)): ?>
        <div class="local-carousel" aria-label="Fotos del local">
            <div class="local-carousel-track">
                <?php foreach (array_merge($carousel, $carousel) as $foto): ?>
                <figure class="local-carousel-item">
                    <img src="<?= htmlspecialchars($foto['imagen'] ?? '') ?>"
                         alt="<?= htmlspecialchars($foto['alt'] ?? 'Local Origen8.8') ?>"
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
