<?php
/**
 * Sección Indumentaria y accesorios.
 *
 * Muestra la indumentaria del local (foto grande + mostrador de lentes),
 * el video de la línea de lentes de montaña y un CTA hacia los accesorios.
 *
 * @package MiLocalWeb\Clientes
 */

$sec = $cliente['seccion_indumentaria'] ?? [];
if (empty($sec)) {
    return;
}
?>
<section id="indumentaria" class="section section-indumentaria" aria-label="Indumentaria y accesorios">
    <div class="indumentaria-divider" aria-hidden="true">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60 L120 20 L240 46 L360 12 L480 42 L600 18 L720 48 L840 24 L960 44 L1080 14 L1200 40 L1320 22 L1440 46 L1440 60 Z" fill="#8eaaaf" opacity="0.55"/>
            <path d="M0 60 L80 34 L180 50 L280 22 L380 48 L470 26 L560 50 L660 30 L760 48 L860 24 L960 46 L1060 28 L1160 50 L1260 32 L1360 48 L1440 40 L1440 60 Z" fill="#5c7c8a"/>
        </svg>
    </div>
    <div class="section-container">
        <h2 class="section-title"><?= htmlspecialchars($sec['titulo'] ?? 'Indumentaria y accesorios') ?></h2>
        <p class="section-subtitle"><?= htmlspecialchars($sec['mensaje'] ?? '') ?></p>

        <!-- Fotos: indumentaria (grande) + mostrador de lentes (alta y angosta) -->
        <div class="indumentaria-fotos">
            <figure class="indumentaria-foto-principal">
                <img src="<?= htmlspecialchars($sec['intro_img'] ?? '') ?>"
                     alt="<?= htmlspecialchars($sec['intro_alt'] ?? 'Indumentaria Origen8.8') ?>"
                     width="768"
                     height="1020"
                     loading="lazy">
            </figure>
            <figure class="indumentaria-foto-secundaria">
                <img src="<?= htmlspecialchars($sec['mostrador_img'] ?? '') ?>"
                     alt="<?= htmlspecialchars($sec['mostrador_alt'] ?? 'Mostrador Origen8.8') ?>"
                     width="900"
                     height="1820"
                     loading="lazy">
            </figure>
        </div>

        <!-- Línea de lentes: video + texto + botón -->
        <div class="indumentaria-lentes">
            <div class="indumentaria-lentes-media">
                <video class="indumentaria-video"
                       src="<?= htmlspecialchars($sec['lentes_video'] ?? '') ?>"
                       <?php if (!empty($sec['lentes_poster'])): ?>poster="<?= htmlspecialchars($sec['lentes_poster']) ?>"<?php endif; ?>
                       preload="metadata"
                       muted
                       loop
                       playsinline
                       data-autoplay
                       aria-label="<?= htmlspecialchars($sec['lentes_titulo'] ?? 'Lentes de montaña') ?>">
                    <p>Tu navegador no soporta videos. <a href="<?= htmlspecialchars($sec['lentes_video'] ?? '') ?>">Descargar video</a>.</p>
                </video>
            </div>
            <div class="indumentaria-lentes-body">
                <h3><?= htmlspecialchars($sec['lentes_titulo'] ?? '') ?></h3>
                <p><?= htmlspecialchars($sec['lentes_texto'] ?? '') ?></p>
                <a href="<?= htmlspecialchars($sec['accesorios_link'] ?? '/accesorios') ?>" class="btn-ver-productos">
                    <?= htmlspecialchars($sec['accesorios_cta'] ?? 'Pasa a ver todos nuestros accesorios') ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
