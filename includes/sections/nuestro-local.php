<?php
/**
 * Sección "Nuestro Local".
 *
 * Invita a pasar a conocer el local y muestra fotos representativas
 * del frente.
 *
 * @package MiLocalWeb\Clientes
 */

$local    = $cliente['seccion_local'] ?? [];
$exterior = $local['exterior'] ?? [];
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

        <?php if (!empty($exterior)): ?>
        <div class="local-grid">
            <?php foreach ($exterior as $foto): ?>
            <figure class="local-foto">
                <img src="<?= htmlspecialchars($foto['imagen'] ?? '') ?>"
                     alt="<?= htmlspecialchars($foto['alt'] ?? 'Local Origen 8.8') ?>"
                     width="800"
                     height="600"
                     loading="lazy">
            </figure>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
