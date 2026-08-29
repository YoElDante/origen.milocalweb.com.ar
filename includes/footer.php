<?php
/**
 * Pie de página de la landing page del cliente.
 *
 * Incluye logo del cliente, enlaces a redes sociales, botón volver arriba,
 * badge publicitario de MiLocalWeb y el botón flotante de WhatsApp.
 *
 * @package MiLocalWeb\Clientes
 */

$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full   = $wa_link . '?text=' . $wa_msg;

$redes_vivas = array_filter($cliente['redes'] ?? [], function ($url) {
    return !empty($url);
});
?>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="footer-content">
            <div class="footer-brand">
                <?php if (!empty($cliente['logo_img'])): ?>
                <img src="<?= htmlspecialchars($cliente['logo_img']) ?>"
                     alt="<?= htmlspecialchars($cliente['nombre']) ?>"
                     class="footer-logo"
                     width="80"
                     height="80"
                     loading="lazy">
                <?php endif; ?>
                <p class="footer-slogan"><?= htmlspecialchars($cliente['slogan']) ?></p>
            </div>

            <?php if (!empty($redes_vivas)): ?>
            <div class="footer-social">
                <h4>Seguinos</h4>
                <div class="social-links">
                    <?php if (!empty($cliente['redes']['instagram'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['instagram']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($cliente['redes']['facebook'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['facebook']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($cliente['redes']['tiktok'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['tiktok']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="TikTok">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($cliente['redes']['web'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['web']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="Sitio Web">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="footer-actions">
                <h4>Contacto</h4>
                <a href="<?= $wa_full ?>" target="_blank" rel="noopener noreferrer" class="footer-wa-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    Escribinos por WhatsApp
                </a>
            </div>
        </div>

        <!-- Badge MiLocalWeb -->
        <div class="footer-badge">
            <p>
                Hecho con <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--color-accent, #00bbaa)" style="display:inline;vertical-align:middle;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                por
                <a href="https://milocalweb.com.ar#contacto" target="_blank" rel="noopener" class="mlw-link">
                    <strong>MiLocalWeb.com.ar</strong>
                </a>
            </p>
            <p class="footer-badge-cta">
                ¿Te gustó esta web?
                <a href="https://wa.me/5493513783473?text=Hola!%20Quiero%20una%20web%20como%20la%20de%20<?= urlencode($cliente['nombre']) ?>%20para%20mi%20negocio"
                   target="_blank" rel="noopener noreferrer">
                    Pedí la tuya sin cargo
                </a>
            </p>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($cliente['nombre']) ?>. Todos los derechos reservados.</p>
        </div>

        <!-- Botón volver arriba -->
        <button class="back-to-top" aria-label="Volver arriba" title="Volver arriba">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
        </button>
    </footer>

    <!-- Botón flotante de WhatsApp -->
    <a href="<?= $wa_full ?>"
       target="_blank"
       rel="noopener noreferrer"
       class="whatsapp-float"
       aria-label="Chatear por WhatsApp">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
    </a>

    <script src="<?= $js ?>main.js<?= JS_VERSION ?>"></script>
</body>
</html>
