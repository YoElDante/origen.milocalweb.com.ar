<?php
/**
 * Sección Hero de la landing page.
 *
 * Soportes 3 layouts vía $cliente['hero_layout']:
 *   - img-right (default): imagen a la derecha, texto/logo a la izquierda
 *   - img-left: imagen a la izquierda, texto/logo a la derecha
 *   - stacked: imagen arriba ocupando todo el ancho, texto abajo centrado
 *
 * @package MiLocalWeb\Clientes
 */

$layout      = $cliente['hero_layout'] ?? 'split';
$hero_class  = 'hero hero--' . $layout;
$wa_number   = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link     = 'https://wa.me/' . $wa_number;
$wa_msg      = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full     = $wa_link . '?text=' . $wa_msg;
$hero_img    = $cliente['hero_img'] ?? '/assets/img/cliente/identidad/origen-bolsa-paisaje.jpg';
$logo_img    = $cliente['logo_img'] ?? '';
$instagram   = $cliente['redes']['instagram'] ?? '';
?>
<section id="inicio" class="<?= htmlspecialchars($hero_class) ?>" aria-label="Presentación">
    <div class="hero-effects" aria-hidden="true"></div>
    <div class="hero-container">

        <?php if ($layout === 'stacked'): ?>
            <!-- Layout STACKED: imagen arriba, texto abajo centrado -->
            <div class="hero-image-wrapper">
                <img src="<?= htmlspecialchars($hero_img) ?>"
                     alt="<?= htmlspecialchars($cliente['nombre']) ?> — <?= htmlspecialchars($cliente['rubro']) ?> en Río Tercero"
                     class="hero-image"
                     width="800"
                     height="600"
                     loading="eager"
                     fetchpriority="high">
            </div>
            <div class="hero-content hero-content--centered">
                <div class="hero-heading">
                    <?php if (!empty($logo_img)): ?>
                    <img src="<?= htmlspecialchars($logo_img) ?>"
                         alt="Logo <?= htmlspecialchars($cliente['nombre']) ?>"
                         class="hero-logo"
                         width="90"
                         height="90"
                         loading="eager">
                    <?php endif; ?>
                    <h1 class="hero-title">Indumentaria <em>Deportiva</em> en Río Tercero</h1>
                </div>
                <?php if (!empty($cliente['hero_descripcion'])): ?>
                <p class="hero-subtitle"><?= nl2br(htmlspecialchars($cliente['hero_descripcion'])) ?></p>
                <?php endif; ?>
                <div class="hero-actions">
                    <a href="<?= $wa_full ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn btn-whatsapp">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                        <?= htmlspecialchars($cliente['hero_boton'] ?? 'Escribinos por WhatsApp') ?>
                    </a>
                    <?php if (!empty($instagram)): ?>
                    <a href="<?= htmlspecialchars($instagram) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn btn-instagram">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        Conocenos en Instagram
                    </a>
                    <?php endif; ?>
                </div>
            </div>

        <?php else: ?>
            <!-- Layout SPLIT/IMG-RIGHT/IMG-LEFT: dos columnas -->
            <div class="hero-content">
                <div class="hero-heading">
                    <?php if (!empty($logo_img)): ?>
                    <img src="<?= htmlspecialchars($logo_img) ?>"
                         alt="Logo <?= htmlspecialchars($cliente['nombre']) ?>"
                         class="hero-logo"
                         width="90"
                         height="90"
                         loading="eager">
                    <?php endif; ?>
                    <h1 class="hero-title">Indumentaria <em>Deportiva</em> en Río Tercero</h1>
                </div>
                <?php if (!empty($cliente['hero_descripcion'])): ?>
                <p class="hero-subtitle"><?= nl2br(htmlspecialchars($cliente['hero_descripcion'])) ?></p>
                <?php endif; ?>
                <div class="hero-actions">
                    <a href="<?= $wa_full ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn btn-whatsapp">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                        <?= htmlspecialchars($cliente['hero_boton'] ?? 'Escribinos por WhatsApp') ?>
                    </a>
                    <?php if (!empty($instagram)): ?>
                    <a href="<?= htmlspecialchars($instagram) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn btn-instagram">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        Conocenos en Instagram
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-image-wrapper" style="background-image: url('<?= htmlspecialchars($hero_img) ?>')">
                <img src="<?= htmlspecialchars($hero_img) ?>"
                     alt="<?= htmlspecialchars($cliente['nombre']) ?> — <?= htmlspecialchars($cliente['rubro']) ?> en Río Tercero"
                     class="hero-image"
                     width="800"
                     height="600"
                     loading="eager"
                     fetchpriority="high">
            </div>
        <?php endif; ?>

    </div>
</section>
