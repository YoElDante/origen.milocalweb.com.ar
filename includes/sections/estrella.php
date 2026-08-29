<?php
/**
 * Sección Destacados / Estrella — Colección Verano.
 *
 * Showcase hardcodeado de la colección Verano Fem.
 *
 * @package MiLocalWeb\Clientes
 */

$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode('Hola! Vi la colección verano en tu web y quisiera más info');
$wa_full   = $wa_link . '?text=' . $wa_msg;
?>
<section id="destacados" class="section section-estrella" aria-label="Destacados">
    <div class="section-container">
        <h2 class="section-title">Indispensables <em class="font-accent">verano</em></h2>
        <p class="section-subtitle">Nueva colección con telas frescas y diseños que acompañan cada paso.</p>

        <div class="estrella-grid">
            <article class="estrella-main">
                <img src="/assets/img/cliente/campanas/verano-fem-1.jpg"
                     alt="Nueva Colección Verano — Origen Run & Bike en Río Tercero"
                     width="800"
                     height="600"
                     loading="lazy">
                <div class="estrella-overlay">
                    <h3>Nueva Colección Verano</h3>
                    <p>Telas frescas y diseños que acompañan cada paso, dentro y fuera del entrenamiento.</p>
                </div>
            </article>

            <div class="estrella-cards">
                <article class="estrella-card">
                    <img src="/assets/img/cliente/campanas/indispensable-ella.jpg"
                         alt="Indispensables ella — Ropa deportiva femenina en Río Tercero"
                         width="400"
                         height="300"
                         loading="lazy">
                    <div class="estrella-overlay">
                        <h4>Indispensables ella</h4>
                        <p>Calzas y camisetas técnicas, accesorios de hidratación, indumentaria para cada deporte.</p>
                    </div>
                </article>

                <article class="estrella-card">
                    <img src="/assets/img/cliente/campanas/indispensable-el.jpg"
                         alt="Indispensables él — Running y trekking en Río Tercero"
                         width="400"
                         height="300"
                         loading="lazy">
                    <div class="estrella-overlay">
                        <h4>Indispensables él</h4>
                        <p>Kilómetros que se sienten livianos.</p>
                    </div>
                </article>

                <article class="estrella-card">
                    <img src="/assets/img/cliente/campanas/outdoor-campera.jpg"
                         alt="Outdoor real — Camperas impermeables en Río Tercero"
                         width="400"
                         height="300"
                         loading="lazy">
                    <div class="estrella-overlay">
                        <h4>Outdoor real</h4>
                        <p>Telas impermeables que te mantienen seco y cómodo en todo momento.</p>
                    </div>
                </article>
            </div>
        </div>

        <div class="estrella-cta">
            <a href="<?= $wa_full ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                Consultame por WhatsApp
            </a>
        </div>
    </div>
</section>
