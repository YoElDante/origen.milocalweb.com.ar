<?php
/**
 * Cabecera de la landing page del cliente.
 *
 * Incluye metadatos, Open Graph, favicon, inyección de colores
 * del cliente, fuentes y la barra de navegación sticky.
 *
 * @package MiLocalWeb\Clientes
 */

// Helpers para WhatsApp
$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full   = $wa_link . '?text=' . $wa_msg;

$cs          = $cliente['colors'] ?? [];
$site_base   = catalog_site_url($cliente);
$site_url    = $site_base . '/';
$currentPage = $page ?? 'home';
$currentUrl  = $pageConfig['url'] ?? catalog_page_url($cliente, $currentPage);
$og_image    = $cliente['seo_og_image'] ?? $cliente['logo_img'] ?? '';
$og_desc     = $pageConfig['descripcion'] ?? $cliente['og_descripcion'] ?? $cliente['hero_descripcion'] ?? $cliente['slogan'];
$meta_desc   = $og_desc;
$pageTitle   = $pageConfig['titulo'] ?? ($cliente['nombre'] . ' — ' . $cliente['slogan']);
$schemaGraph = [];

$schemaGraph[] = [
    '@type' => 'Store',
    '@id'   => $site_url . '#store',
    'name'  => $cliente['nombre'],
    'description' => $cliente['rubro'],
    'url'   => $site_url,
    'telephone' => '+54' . ltrim($wa_number, '54'),
    'email' => $cliente['email'] ?: null,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Ejército de los Andes 129',
        'addressLocality' => 'Río Tercero',
        'postalCode' => 'X5850',
        'addressRegion' => 'Córdoba',
        'addressCountry' => 'AR',
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => $cliente['seo_lat'] ?? '-32.1838792',
        'longitude' => $cliente['seo_long'] ?? '-64.1177626',
    ],
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '09:00',
            'closes' => '20:00',
        ],
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => 'Saturday',
            'opens' => '09:00',
            'closes' => '12:00',
        ],
    ],
    'sameAs' => array_values(array_filter([
        $cliente['redes']['instagram'] ?? '',
    ])),
];

$schemaGraph[] = [
    '@type' => 'WebSite',
    '@id' => $site_url . '#website',
    'url' => $site_url,
    'name' => $cliente['nombre'],
    'inLanguage' => 'es-AR',
];

if ($currentPage !== 'home') {
    $schemaGraph[] = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Inicio',
                'item' => $site_url,
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $pageConfig['h1'] ?? $pageTitle,
                'item' => $currentUrl,
            ],
        ],
    ];
}

if (!empty($pageProducts)) {
    $schemaGraph[] = [
        '@type' => 'ItemList',
        'name' => $pageConfig['h1'] ?? 'Catálogo',
        'itemListElement' => array_map(function ($product, $index) use ($cliente) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'item' => catalog_product_schema($cliente, $product),
            ];
        }, $pageProducts, array_keys($pageProducts)),
    ];
}

$structured_data = [
    '@context' => 'https://schema.org',
    '@graph'   => $schemaGraph,
];

$json_ld = json_encode($structured_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
    <meta name="robots" content="<?= !empty($pageConfig['is_not_found']) ? 'noindex, follow' : 'index, follow' ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($og_desc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_AR">
    <meta property="og:url" content="<?= htmlspecialchars($currentUrl) ?>">
    <?php if (!empty($og_image)): ?>
    <meta property="og:image" content="<?= htmlspecialchars((strpos($og_image, 'http') === 0) ? $og_image : $site_url . ltrim($og_image, '/')) ?>">
    <?php endif; ?>

    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link rel="canonical" href="<?= htmlspecialchars($currentUrl) ?>">

    <!-- Favicon -->
    <?php if (!empty($cliente['favicon'])): ?>
    <link rel="icon" type="image/x-icon" href="<?= htmlspecialchars($cliente['favicon']) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= htmlspecialchars($cliente['favicon']) ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="<?= $css ?>styles.css<?= CSS_VERSION ?>">

    <!-- Colores del cliente -->
    <?php if (!empty($cs)): ?>
    <style>
        :root {
            <?php foreach ($cs as $var => $val): ?>
            --<?= $var ?>: <?= $val ?>;
            <?php endforeach; ?>
            --tipografia: <?= $cliente['tipografia'] ?? '"Open Sans", system-ui, sans-serif' ?>;
        }
    </style>
    <?php endif; ?>

    <!-- JSON-LD -->
    <script type="application/ld+json">
<?= $json_ld ?>
    </script>
</head>
<body>
    <header class="site-header">
        <nav class="navbar" role="navigation" aria-label="Navegación principal">
            <div class="navbar-brand">
                <a href="/" class="brand-link">
                    <?php if (!empty($cliente['logo_img'])): ?>
                    <img src="<?= htmlspecialchars($cliente['logo_img']) ?>"
                         alt="<?= htmlspecialchars($cliente['nombre']) ?>"
                         class="brand-logo"
                         width="44"
                         height="44"
                         loading="eager">
                    <?php endif; ?>
                    <span class="brand-name"><?= htmlspecialchars($cliente['nombre']) ?></span>
                </a>
            </div>

            <button class="navbar-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="navbar-menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="navbar-menu" id="navbar-menu">
                <li><a href="/" class="<?= $currentPage === 'home' ? 'is-active' : '' ?>">Inicio</a></li>
                <li><a href="/productos" class="<?= $currentPage === 'productos' ? 'is-active' : '' ?>">Productos</a></li>
                <li><a href="/accesorios" class="<?= $currentPage === 'accesorios' ? 'is-active' : '' ?>">Accesorios</a></li>
                <li><a href="/#nosotros">Quiénes Somos</a></li>
                <li><a href="/#ubicacion">Ubicación</a></li>
                <li><a href="/carrito" class="nav-cart-link <?= $currentPage === 'carrito' ? 'is-active' : '' ?>">Mi pedido <span class="cart-count" data-cart-count hidden>0</span></a></li>
                <li><a href="<?= $wa_full ?>" target="_blank" rel="noopener noreferrer" class="nav-cta">Contactanos</a></li>
            </ul>
        </nav>
    </header>
    <main class="site-main">
