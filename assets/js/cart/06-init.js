    // Wiring inicial: delegación por botón, vaciado con confirmación y
    // primer render para restaurar el carrito persistido al recargar.
    document.querySelectorAll('[data-cart-add]').forEach(function (button) {
        button.addEventListener('click', function (event) {
            addProduct(button, event);
        });
    });

    document.querySelectorAll('[data-cart-clear]').forEach(function (button) {
        button.addEventListener('click', clearCart);
    });

    updateCartCount(readCart());
    renderCart();
