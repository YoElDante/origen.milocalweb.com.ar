<?php
/**
 * Sitio catalogo — Origen8.8.
 *
 * Router liviano para landing, catalogo y carrito de pedido asistido.
 *
 * @package MiLocalWeb\Clientes
 */

if (php_sapi_name() === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $requestedFile = __DIR__ . $requestPath;

    if (preg_match('#^/(config\.php|includes/|tools/)#i', $requestPath) === 1) {
        http_response_code(403);
        return true;
    }

    if ($requestPath !== '/' && is_file($requestedFile) && strtolower(basename($requestPath)) !== 'index.php') {
        return false;
    }
}

$cliente = require __DIR__ . '/config.php';
require_once __DIR__ . '/includes/catalogo.php';

$requestPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');
$queryPage = isset($_GET['p']) ? trim((string) $_GET['p'], '/') : '';
$page = in_array(strtolower($requestPath), ['', 'index.php'], true) ? $queryPage : $requestPath;
$page = trim((string) $page, '/');
$page = $page === '' ? 'home' : $page;

$allowedPages = ['home', 'productos', 'ofertas', 'accesorios', 'carrito'];
$isNotFound = !in_array($page, $allowedPages, true);

if ($isNotFound) {
    http_response_code(404);
    $page = 'not-found';
}

$pageConfig = catalog_page_config($cliente, $page, $isNotFound);
if ($isNotFound) {
    $pageConfig['url'] = catalog_site_url($cliente) . '/' . $requestPath;
}
$pageProducts = catalog_products_for_page($cliente, $page);

// ─── Rutas a assets ──────────────────────────────────────────────
$esLocal = (php_sapi_name() === 'cli-server')
    || in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true);

$base    = $esLocal ? '' : 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
$assets  = $base . '/assets';
$css     = $assets . '/css/';
$js      = $assets . '/js/';
$img     = $assets . '/img/';
$svg     = __DIR__ . '/assets/img/svg/';

// Cache busting
$cssFile    = __DIR__ . '/assets/css/styles.css';
$jsFile     = __DIR__ . '/assets/js/main.js';
$cartJsFile = __DIR__ . '/assets/js/cart.js';
$cssVersion = is_file($cssFile) ? '?v=' . filemtime($cssFile) : '';
$jsVersion  = is_file($jsFile)  ? '?v=' . filemtime($jsFile)  : '';
$cartJsVersion = is_file($cartJsFile) ? '?v=' . filemtime($cartJsFile) : '';
define('CSS_VERSION', $cssVersion);
define('JS_VERSION', $jsVersion);
define('CART_JS_VERSION', $cartJsVersion);

require_once __DIR__ . '/includes/header.php';
?>

<?php require_once __DIR__ . '/includes/pages/' . $page . '.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
