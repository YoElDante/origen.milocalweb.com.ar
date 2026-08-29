<?php
/**
 * Aside publicitario de MiLocalWeb.
 *
 * Espacio reservado para publicidad de terceros o autopromoción de
 * los servicios de MiLocalWeb. No debe ser invasivo.
 *
 * Desktop: sidebar lateral con ancho fijo.
 * Mobile: banner horizontal entre secciones.
 *
 * @package MiLocalWeb\Clientes
 */

$aside_visibilidad = $cliente['aside'] ?? $cliente['aside_visible'] ?? true;
if (!$aside_visibilidad) {
    return;
}
?>
<aside class="publicidad-aside" aria-label="Publicidad">
    <div class="aside-container">
        <?php if (!empty($cliente['aside_titulo'])): ?>
        <span class="aside-title"><?= htmlspecialchars($cliente['aside_titulo']) ?></span>
        <?php else: ?>
        <span class="aside-title">¿Querés potenciar tu negocio?</span>
        <?php endif; ?>

        <?php if (!empty($cliente['aside_texto'])): ?>
        <p class="aside-text"><?= htmlspecialchars($cliente['aside_texto']) ?></p>
        <?php else: ?>
        <p class="aside-text">Te armamos una web profesional sin cargo y la optimizamos para Google.</p>
        <?php endif; ?>

        <a href="<?= htmlspecialchars($cliente['aside_link'] ?? 'https://milocalweb.com.ar#contacto') ?>"
           target="_blank" rel="noopener noreferrer"
           class="aside-cta">
            <?= htmlspecialchars($cliente['aside_cta'] ?? 'Quiero la mía') ?>
        </a>
    </div>
</aside>
