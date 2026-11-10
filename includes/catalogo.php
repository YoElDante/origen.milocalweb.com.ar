<?php
/**
 * Helpers del catalogo con pedido asistido.
 *
 * Centraliza filtros, precios, descuentos y datos SEO de productos.
 *
 * @package MiLocalWeb\Clientes
 */

/**
 * Devuelve la URL base del sitio sin barra final.
 *
 * @param array $cliente Configuración completa del cliente.
 * @return string
 */
function catalog_site_url(array $cliente): string
{
    return rtrim($cliente['site_url'] ?? 'https://origen.milocalweb.com.ar', '/');
}

/**
 * Traduce una página lógica a su ruta pública.
 *
 * `home` se sirve en `/`; el resto de las páginas en `/{page}`.
 *
 * @param string $page Identificador de página.
 * @return string
 */
function catalog_page_path(string $page): string
{
    return $page === 'home' ? '/' : '/' . $page;
}

/**
 * Construye la URL absoluta de una página del sitio.
 *
 * @param array  $cliente Configuración completa del cliente.
 * @param string $page    Identificador de página.
 * @return string
 */
function catalog_page_url(array $cliente, string $page): string
{
    return catalog_site_url($cliente) . catalog_page_path($page);
}

/**
 * Resuelve la configuración SEO de una página.
 *
 * Toma la entrada de `paginas` o cae a `home`; en 404 sobrescribe título,
 * descripción y h1. Siempre agrega `page`, `url`, `path` e `is_not_found`.
 *
 * @param array  $cliente    Configuración completa del cliente.
 * @param string $page       Identificador de página.
 * @param bool   $isNotFound Si la ruta solicitada no existe.
 * @return array
 */
function catalog_page_config(array $cliente, string $page, bool $isNotFound = false): array
{
    $pages = $cliente['paginas'] ?? [];
    $config = $pages[$page] ?? $pages['home'] ?? [];

    if ($isNotFound) {
        $config['titulo'] = 'Página no encontrada — ' . ($cliente['nombre'] ?? 'Origen8.8');
        $config['descripcion'] = 'La página solicitada no existe. Volvé al inicio de Origen8.8.';
        $config['h1'] = 'Página no encontrada';
    }

    $config['page'] = $page;
    $config['url'] = catalog_page_url($cliente, $page);
    $config['path'] = catalog_page_path($page);
    $config['is_not_found'] = $isNotFound;

    return $config;
}

/**
 * Devuelve los productos válidos del catálogo.
 *
 * Descarta entradas que no sean arrays o que no tengan `id`.
 *
 * @param array $cliente Configuración completa del cliente.
 * @return array
 */
function catalog_all_products(array $cliente): array
{
    return array_values(array_filter($cliente['catalogo'] ?? [], function ($product) {
        return is_array($product) && !empty($product['id']);
    }));
}

/**
 * Filtra el catálogo según la ruta solicitada.
 *
 * Solo acepta productos, ofertas y accesorios. En ofertas también incluye
 * cualquier producto con `tiene_descuento` aunque no declare esa ruta.
 *
 * @param array  $cliente Configuración completa del cliente.
 * @param string $page    Ruta solicitada.
 * @return array
 */
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

/**
 * Devuelve la etiqueta visible del badge de descuento.
 *
 * Prioriza `etiqueta_descuento`, luego el porcentaje y por último "Oferta".
 *
 * @param array $product Producto del catálogo.
 * @return string Etiqueta o cadena vacía si no hay descuento.
 */
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

/**
 * Indica si el producto debe mostrar precio.
 *
 * Requiere `mostrar_precio` activo y un `precio` numérico.
 *
 * @param array $product Producto del catálogo.
 * @return bool
 */
function catalog_product_has_price(array $product): bool
{
    return !empty($product['mostrar_precio']) && isset($product['precio']) && is_numeric($product['precio']);
}

/**
 * Formatea el precio visible del producto.
 *
 * @param array $product Producto del catálogo.
 * @return string Precio en formato ARS o "Consultar precio".
 */
function catalog_format_price(array $product): string
{
    if (!catalog_product_has_price($product)) {
        return 'Consultar precio';
    }

    return '$' . number_format((float) $product['precio'], 0, ',', '.');
}

/**
 * Arma el enlace de WhatsApp para consultar por un producto.
 *
 * @param array $cliente Configuración completa del cliente.
 * @param array $product Producto del catálogo.
 * @return string URL de wa.me con el mensaje prearmado.
 */
function catalog_product_whatsapp_url(array $cliente, array $product): string
{
    $waNumber = preg_replace('/[^0-9]/', '', $cliente['whatsapp'] ?? '');
    $name = $product['nombre'] ?? 'un producto';
    $message = 'Hola! Vi ' . $name . ' en tu web y quisiera más información';

    return 'https://wa.me/' . $waNumber . '?text=' . urlencode($message);
}

/**
 * Convierte una ruta de asset en URL absoluta.
 *
 * Respeta URLs ya absolutas y codifica cada segmento del path relativo.
 *
 * @param array  $cliente Configuración completa del cliente.
 * @param string $path    Ruta del asset.
 * @return string
 */
function catalog_absolute_asset_url(array $cliente, string $path): string
{
    if (strpos($path, 'http') === 0) {
        return $path;
    }

    $segments = array_map('rawurlencode', explode('/', ltrim($path, '/')));

    return catalog_site_url($cliente) . '/' . implode('/', $segments);
}

/**
 * Construye el fragmento Product de JSON-LD.
 *
 * `offers` solo se emite cuando hay precio visible, según la regla SEO del
 * proyecto: los productos a consultar no publican Offer.price.
 *
 * @param array $cliente Configuración completa del cliente.
 * @param array $product Producto del catálogo.
 * @return array Estructura lista para el @graph de schema.org.
 */
function catalog_product_schema(array $cliente, array $product): array
{
    $schema = [
        '@type' => 'Product',
        'name' => $product['nombre'] ?? '',
        'description' => $product['descripcion'] ?? '',
        'image' => catalog_absolute_asset_url($cliente, $product['imagen'] ?? ''),
        'category' => $product['categoria'] ?? ($cliente['seo_keywords_primarias'] ?? 'Indumentaria Deportiva'),
    ];

    if (!empty($product['marca'])) {
        $schema['brand'] = [
            '@type' => 'Brand',
            'name' => $product['marca'],
        ];
    }

    if (catalog_product_has_price($product)) {
        $schema['offers'] = [
            '@type' => 'Offer',
            'availability' => !empty($product['disponible']) ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            'priceCurrency' => $product['moneda'] ?? 'ARS',
            'price' => (string) $product['precio'],
            'seller' => [
                '@type' => 'Store',
                'name' => $cliente['nombre'] ?? 'Origen8.8',
            ],
        ];
    }

    return $schema;
}
