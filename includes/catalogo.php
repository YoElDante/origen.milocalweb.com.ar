<?php
/**
 * Helpers del catalogo con pedido asistido.
 *
 * Centraliza filtros, precios, descuentos y datos SEO de productos.
 *
 * @package MiLocalWeb\Clientes
 */

function catalog_site_url(array $cliente): string
{
    return rtrim($cliente['site_url'] ?? 'https://origen.milocalweb.com.ar', '/');
}

function catalog_page_path(string $page): string
{
    return $page === 'home' ? '/' : '/' . $page;
}

function catalog_page_url(array $cliente, string $page): string
{
    return catalog_site_url($cliente) . catalog_page_path($page);
}

function catalog_page_config(array $cliente, string $page, bool $isNotFound = false): array
{
    $pages = $cliente['paginas'] ?? [];
    $config = $pages[$page] ?? $pages['home'] ?? [];

    if ($isNotFound) {
        $config['titulo'] = 'Página no encontrada — ' . ($cliente['nombre'] ?? 'Origen 8.8');
        $config['descripcion'] = 'La página solicitada no existe. Volvé al inicio de Origen 8.8.';
        $config['h1'] = 'Página no encontrada';
    }

    $config['page'] = $page;
    $config['url'] = catalog_page_url($cliente, $page);
    $config['path'] = catalog_page_path($page);
    $config['is_not_found'] = $isNotFound;

    return $config;
}

function catalog_all_products(array $cliente): array
{
    return array_values(array_filter($cliente['catalogo'] ?? [], function ($product) {
        return is_array($product) && !empty($product['id']);
    }));
}

function catalog_products_for_page(array $cliente, string $page): array
{
    if (!in_array($page, ['productos', 'ofertas', 'accesorios'], true)) {
        return [];
    }

    return array_values(array_filter(catalog_all_products($cliente), function ($product) use ($page) {
        $routes = $product['rutas'] ?? [];

        if ($page === 'ofertas' && !empty($product['tiene_descuento'])) {
            return true;
        }

        return in_array($page, $routes, true);
    }));
}

function catalog_discount_label(array $product): string
{
    if (empty($product['tiene_descuento'])) {
        return '';
    }

    if (!empty($product['etiqueta_descuento'])) {
        return (string) $product['etiqueta_descuento'];
    }

    if (!empty($product['descuento_porcentaje'])) {
        return (int) $product['descuento_porcentaje'] . '% OFF';
    }

    return 'Oferta';
}

function catalog_product_has_price(array $product): bool
{
    return !empty($product['mostrar_precio']) && isset($product['precio']) && is_numeric($product['precio']);
}

function catalog_format_price(array $product): string
{
    if (!catalog_product_has_price($product)) {
        return 'Consultar precio';
    }

    return '$' . number_format((float) $product['precio'], 0, ',', '.');
}

function catalog_product_whatsapp_url(array $cliente, array $product): string
{
    $waNumber = preg_replace('/[^0-9]/', '', $cliente['whatsapp'] ?? '');
    $name = $product['nombre'] ?? 'un producto';
    $message = 'Hola! Vi ' . $name . ' en tu web y quisiera más información';

    return 'https://wa.me/' . $waNumber . '?text=' . urlencode($message);
}

function catalog_absolute_asset_url(array $cliente, string $path): string
{
    if (strpos($path, 'http') === 0) {
        return $path;
    }

    $segments = array_map('rawurlencode', explode('/', ltrim($path, '/')));

    return catalog_site_url($cliente) . '/' . implode('/', $segments);
}

function catalog_product_schema(array $cliente, array $product): array
{
    $schema = [
        '@type' => 'Product',
        'name' => $product['nombre'] ?? '',
        'description' => $product['descripcion'] ?? '',
        'image' => catalog_absolute_asset_url($cliente, $product['imagen'] ?? ''),
        'category' => $product['categoria'] ?? ($cliente['seo_keywords_primarias'] ?? 'Indumentaria Deportiva'),
        'brand' => [
            '@type' => 'Brand',
            'name' => $cliente['nombre'] ?? 'Origen 8.8',
        ],
    ];

    if (catalog_product_has_price($product)) {
        $schema['offers'] = [
            '@type' => 'Offer',
            'availability' => !empty($product['disponible']) ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            'priceCurrency' => $product['moneda'] ?? 'ARS',
            'price' => (string) $product['precio'],
            'seller' => [
                '@type' => 'Store',
                'name' => $cliente['nombre'] ?? 'Origen 8.8',
            ],
        ];
    }

    return $schema;
}
