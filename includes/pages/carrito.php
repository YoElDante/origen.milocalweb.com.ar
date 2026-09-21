<?php
/**
 * Pagina de carrito.
 *
 * Renderiza el contenedor del carrito local y los canales de checkout.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = [
    ['label' => 'Inicio', 'url' => '/'],
    ['label' => 'Carrito'],
];

$waNumber = preg_replace('/[^0-9]/', '', $cliente['whatsapp'] ?? '');
$businessEmail = trim($cliente['email'] ?? '');
?>
<section class="catalog-page catalog-page--carrito">
    <div class="section-container">
        <?php require __DIR__ . '/../components/breadcrumb.php'; ?>

        <header class="catalog-page__header">
            <p class="catalog-page__eyebrow">Pedido asistido</p>
            <h1><?= htmlspecialchars($pageConfig['h1'] ?? 'Carrito') ?></h1>
            <p><?= htmlspecialchars($pageConfig['subtitulo'] ?? '') ?></p>
        </header>

        <div class="cart-panel"
             data-cart-root
             data-business-name="<?= htmlspecialchars($cliente['nombre'] ?? 'Origen 8.8') ?>"
             data-whatsapp-number="<?= htmlspecialchars($waNumber) ?>"
             data-business-email="<?= htmlspecialchars($businessEmail) ?>">
            <div class="cart-empty" data-cart-empty>
                <h2>Tu carrito está vacío</h2>
                <p>Elegí productos del catálogo y prepará tu consulta para enviarla por WhatsApp.</p>
                <a href="/productos" class="btn btn-primary">Ver productos</a>
            </div>

            <div class="cart-content" data-cart-content hidden>
                <div class="cart-items" data-cart-items></div>

                <aside class="cart-summary" aria-label="Resumen del pedido">
                    <h2>Resumen</h2>
                    <p class="cart-summary__note">El pedido queda sujeto a confirmación de stock y precio final.</p>
                    <p class="cart-summary__subtotal" data-cart-subtotal hidden></p>

                    <div class="cart-actions">
                        <a href="#" class="btn btn-whatsapp" data-cart-whatsapp target="_blank" rel="noopener noreferrer">Enviar por WhatsApp</a>
                        <?php if ($businessEmail !== ''): ?>
                        <a href="#" class="btn btn-outline" data-cart-email>Enviar por email</a>
                        <?php endif; ?>
                        <button type="button" class="btn btn-outline" data-cart-clear>Vaciar carrito</button>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
