<?php
/**
 * Metadatos SEO y datos estructurados.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
    // ─── SEO / Datos estructurados ───────────────────────────────────

    'seo_keywords_primarias' => 'Indumentaria Deportiva',
    'seo_localidad'  => 'Río Tercero',
    'seo_provincia'  => 'Córdoba',
    'seo_zona_influencia' => 'Valle de Calamuchita, Almafuerte, Tancacha, Santa Rosa de Calamuchita, Embalse, Villa General Belgrano',
    'seo_lat' => '-32.1838792',
    'seo_long' => '-64.1177626',
    'seo_store' => [
        'address' => $storeAddress,
        'opening_hours' => $storeOpeningHours,
        'google_business_profile' => $googleBusinessProfile,
    ],
    'seo_og_image' => '/assets/img/cliente/logos/og-origen-88-1200x630.jpg',
    'seo_og_image_width' => 1200,
    'seo_og_image_height' => 630,
    'seo_og_image_alt' => 'Origen8.8 — Indumentaria y accesorios para disfrutar al aire libre',
    'og_descripcion' => 'Indumentaria deportiva en Río Tercero. Running, trekking y bikes. Calzas, shorts, tops y accesorios. ¡Escribinos por WhatsApp!',
    'seo_categorias' => ['Running', 'Trekking', 'Bikes', 'Calzas', 'Shorts', 'Tops', 'Camperas outdoor', 'Hidratación', 'Lentes deportivos'],
    'seo_marcas' => ['Navajo', 'Kaizen', 'SOX', 'I-Run'],

];
