<?php
/**
 * Sección Quiénes Somos / Nosotros.
 *
 * Muestra el texto de la marca a la izquierda y un video de identidad
 * a la derecha en desktop. Incluye redes sociales.
 *
 * @package MiLocalWeb\Clientes
 */

$redes_vivas = array_filter($cliente['redes'] ?? [], function ($url) {
    return !empty($url);
});
$video       = $cliente['nosotros_video'] ?? '';
$poster      = $cliente['nosotros_video_poster'] ?? '';
$video_titulo = $cliente['nosotros_video_titulo'] ?? 'Video sobre ' . ($cliente['nombre'] ?? 'nosotros');
?>
<section id="nosotros" class="section section-nosotros" aria-label="Quiénes somos">
    <div class="section-container">
        <h2 class="section-title">Quiénes Somos</h2>

        <div class="nosotros-layout">
            <div class="nosotros-content">
                <?php if (!empty($cliente['nosotros_texto'])): ?>
                <p class="nosotros-texto"><?= nl2br(htmlspecialchars($cliente['nosotros_texto'])) ?></p>
                <?php endif; ?>

                <p class="nosotros-quote font-mono"><?= htmlspecialchars($cliente['slogan']) ?></p>

                <!-- Redes sociales -->
                <?php if (!empty($cliente['redes']['instagram'])): ?>
                <div class="nosotros-redes">
                    <h3>Seguinos en Instagram</h3>
                    <a href="<?= htmlspecialchars($cliente['redes']['instagram']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn btn-instagram">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        Seguinos en Instagram
                    </a>
                </div>
                <?php endif; ?>

                <!-- Logo de la marca -->
                <?php if (!empty($cliente['logo_img'])): ?>
                <div class="nosotros-logo">
                    <img src="<?= htmlspecialchars($cliente['logo_img']) ?>"
                         alt="Logo <?= htmlspecialchars($cliente['nombre']) ?>"
                         width="180"
                         height="180"
                         loading="lazy">
                </div>
                <?php endif; ?>
            </div>

            <!-- Video de identidad -->
            <?php if (!empty($video)): ?>
            <div class="nosotros-media">
                <video
                    class="nosotros-video"
                    src="<?= htmlspecialchars($video) ?>"
                    <?php if (!empty($poster)): ?>poster="<?= htmlspecialchars($poster) ?>"<?php endif; ?>
                    preload="metadata"
                    autoplay
                    loop
                    muted
                    playsinline
                    aria-label="<?= htmlspecialchars($video_titulo) ?>">
                    <p>Tu navegador no soporta videos. <a href="<?= htmlspecialchars($video) ?>">Descargar video</a>.</p>
                </video>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
