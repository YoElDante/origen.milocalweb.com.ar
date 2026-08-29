<?php
/**
 * Sección de Ubicación.
 *
 * Muestra la dirección del negocio, un mapa embebido de Google Maps,
 * estrellas de reputación (opcional), horario de atención y un botón
 * "Llevame allí" que abre Google Maps.
 *
 * @package MiLocalWeb\Clientes
 */

$mostrar_estrellas = $cliente['mostrar_estrellas'] ?? true;
$estrellas_val     = floatval($cliente['estrellas'] ?? 0);
?>
<section id="ubicacion" class="section section-ubicacion" aria-label="Ubicación y horarios">
    <div class="section-container">
        <h2 class="section-title">Dónde Estamos</h2>

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

                <?php if ($mostrar_estrellas && $estrellas_val > 0): ?>
                <div class="ubicacion-estrellas">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="var(--color-accent, #00bbaa)" stroke="var(--color-accent, #00bbaa)" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <div>
                        <h3>Reputación</h3>
                        <p class="estrellas-valor">
                            <strong><?= number_format($estrellas_val, 1) ?></strong>
                            <span class="estrellas-estrellas">
                                <?php
                                $full  = floor($estrellas_val);
                                $half  = ($estrellas_val - $full) >= 0.5;
                                $empty = 5 - $full - ($half ? 1 : 0);
                                for ($s = 0; $s < $full; $s++) {
                                    echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="var(--color-accent, #00bbaa)" stroke="var(--color-accent, #00bbaa)" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
                                }
                                if ($half) {
                                    echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="var(--color-accent, #00bbaa)" stroke="var(--color-accent, #00bbaa)" stroke-width="1" style="opacity:0.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
                                }
                                for ($s = 0; $s < $empty; $s++) {
                                    echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-muted, #5c7c8a)" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
                                }
                                ?>
                            </span>
                        </p>
                        <?php if (!empty($cliente['total_resenas'])): ?>
                        <p class="estrellas-resenas">Basado en <?= (int)$cliente['total_resenas'] ?> reseñas de Google</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($cliente['horario'])): ?>
                <div class="ubicacion-horario">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary, #000000)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <div>
                        <h3>Horarios</h3>
                        <p><?= nl2br(htmlspecialchars($cliente['horario'])) ?></p>
                    </div>
                </div>
                <?php endif; ?>

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
    </div>
</section>
