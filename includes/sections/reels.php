<?php
/**
 * Sección Reels / Videos.
 *
 * Muestra 3 videos verticales del cliente con poster y botón play.
 *
 * @package MiLocalWeb\Clientes
 */

$reels = [
    [
        'video'  => '/assets/vid/reels/pantalones-cargo-tecnicos.mp4',
        'poster' => '/assets/vid/reels/pantalones-cargo-tecnicos.jpg',
        'titulo' => 'Pantalones cargo técnicos',
        'desc'   => 'Impermeables, 8 bolsillos, corte recto o gaucha, talles M–4XL.',
    ],
    [
        'video'  => '/assets/vid/reels/lentes-deportivos.mp4',
        'poster' => '/assets/vid/reels/lentes-deportivos.jpg',
        'titulo' => 'Lentes deportivos',
        'desc'   => 'Lente panorámica espejada + UV400. Bici, trail y running.',
    ],
];

$instagram = $cliente['redes']['instagram'] ?? '';
?>
<section id="reels" class="section section-reels" aria-label="Videos de Origen">
    <div class="section-container">
        <h2 class="section-title">Reels</h2>
        <p class="section-subtitle">Conocé la marca y los productos en video</p>

        <div class="reels-grid">
            <?php foreach ($reels as $i => $reel): ?>
            <article class="reel-card">
                <div class="reel-media">
                    <video
                        class="reel-video"
                        src="<?= htmlspecialchars($reel['video']) ?>"
                        poster="<?= htmlspecialchars($reel['poster']) ?>"
                        preload="none"
                        playsinline
                        muted
                        controls
                        width="360"
                        height="640">
                        <p>Tu navegador no soporta videos. <a href="<?= htmlspecialchars($reel['video']) ?>">Descargar video</a>.</p>
                    </video>
                    <button class="reel-play" aria-label="Reproducir video <?= htmlspecialchars($reel['titulo']) ?>" data-reel="<?= $i ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
                <div class="reel-body">
                    <h3><?= htmlspecialchars($reel['titulo']) ?></h3>
                    <p><?= htmlspecialchars($reel['desc']) ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($instagram)): ?>
        <div class="reels-cta">
            <a href="<?= htmlspecialchars($instagram) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                Seguinos en Instagram
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>
