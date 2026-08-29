<?php
/**
 * Sección "Nuestros Clientes" de MiLocalWeb.
 *
 * Muestra logos de otros clientes del portfolio como vitrina discreta.
 * Solo logos en escala de grises, sin textos llamativos. Funciona como
 * prueba social para potenciales nuevos clientes que vean la landing.
 *
 * @package MiLocalWeb\Clientes
 */

$clientes_mostrar = $cliente['clientes_mostrar'] ?? $cliente['mostrar_clientes'] ?? true;
if (!$clientes_mostrar) {
    return;
}

$lista_clientes = $cliente['clientes'] ?? [];
if (empty($lista_clientes)) {
    return;
}
?>
<section class="section section-clientes" aria-label="Otros clientes de MiLocalWeb">
    <div class="section-container">
        <p class="clientes-titulo">
            <?= htmlspecialchars($cliente['clientes_encabezado'] ?? 'Otros negocios que confían en MiLocalWeb') ?>
        </p>
        <div class="clientes-grid">
            <?php foreach ($lista_clientes as $c): ?>
            <a href="<?= htmlspecialchars($c['url'] ?? 'https://milocalweb.com.ar') ?>"
               target="_blank" rel="noopener noreferrer"
               class="cliente-logo-link"
               title="<?= htmlspecialchars($c['nombre'] ?? '') ?>">
                <img src="<?= htmlspecialchars($c['logo'] ?? '') ?>"
                     alt="<?= htmlspecialchars($c['nombre'] ?? '') ?>"
                     class="cliente-logo"
                     loading="lazy"
                     width="<?= $c['ancho'] ?? 120 ?>"
                     height="<?= $c['alto'] ?? 60 ?>">
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
