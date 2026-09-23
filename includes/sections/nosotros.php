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
$video_origen = '/assets/vid/reels/volver-al-origen.mp4';
$poster_origen = '/assets/vid/reels/volver-al-origen.jpg';
$watermark_logo = '/assets/img/cliente/logos/logo-origen88.webp';
?>
<section id="nosotros" class="section section-nosotros" aria-label="Quiénes somos">
    <div class="section-container">
        <div class="nosotros-layout">
            <div class="nosotros-content" style="--nosotros-watermark: url('<?= htmlspecialchars($watermark_logo) ?>');">
                <h2 class="section-title">Quiénes Somos</h2>

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

            </div>

            <?php if (!empty($video) || is_file(__DIR__ . '/../../' . ltrim($video_origen, '/'))): ?>
            <div class="nosotros-media-grid">
                <?php if (!empty($video)): ?>
                <div class="nosotros-media">
                    <video
                        class="nosotros-video"
                        src="<?= htmlspecialchars($video) ?>"
                        <?php if (!empty($poster)): ?>poster="<?= htmlspecialchars($poster) ?>"<?php endif; ?>
                        preload="none"
                        loop
                        muted
                        playsinline
                        data-exclusive-video
                        data-autoplay
                        data-stop-when-hidden
                        data-click-to-play
                        data-unmute-on-click
                        aria-label="<?= htmlspecialchars($video_titulo) ?>">
                        <p>Tu navegador no soporta videos. <a href="<?= htmlspecialchars($video) ?>">Descargar video</a>.</p>
                    </video>
                </div>
                <?php endif; ?>

                <?php if (is_file(__DIR__ . '/../../' . ltrim($video_origen, '/'))): ?>
                <div class="nosotros-media nosotros-media-secundario">
                <video
                    class="nosotros-video"
                    src="<?= htmlspecialchars($video_origen) ?>"
                    poster="<?= htmlspecialchars($poster_origen) ?>"
                    preload="none"
                    controls
                    playsinline
                    data-exclusive-video
                    data-stop-when-hidden
                    data-unmute-on-interaction
                    data-unmute-on-play
                    aria-label="Qué significa volver al origen">
                    <p>Tu navegador no soporta videos. <a href="<?= htmlspecialchars($video_origen) ?>">Descargar video</a>.</p>
                </video>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
