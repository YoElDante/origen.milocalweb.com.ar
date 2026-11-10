    /**
     * Suma o resta una unidad a un ítem, con mínimo de 1.
     *
     * @param {string} id    Identificador del producto.
     * @param {number} delta 1 para sumar, -1 para restar.
     * @returns {void}
     */
    function updateQuantity(id, delta) {
        const cart = readCart().map(function (item) {
            if (item.id === id) {
                item.cantidad = Math.max(1, Number(item.cantidad || 1) + delta);
            }
            return item;
        });

        writeCart(cart);
    }

    /**
     * Quita un producto del carrito por id.
     *
     * @param {string} id Identificador del producto.
     * @returns {void}
     */
    function removeItem(id) {
        writeCart(readCart().filter(function (item) {
            return item.id !== id;
        }));
    }

    /**
     * Vacía el carrito completo después de confirmación del usuario.
     *
     * @returns {void}
     */
    function clearCart() {
        const cart = readCart();
        if (cart.length === 0) return;

        const confirmed = window.confirm('¿Seguro que querés vaciar tu pedido?');
        if (!confirmed) return;

        const quantity = cart.reduce(function (sum, item) {
            return sum + Number(item.cantidad || 0);
        }, 0);

        writeCart([]);
        animateClearBox(quantity);
    }

    /**
     * Arma el texto del pedido para WhatsApp o email.
     *
     * El subtotal solo suma ítems con precio visible; los productos a
     * consultar se listan como "precio a confirmar". Cierra siempre con la
     * aclaración comercial de stock y precio final.
     *
     * @param {HTMLElement}   root Contenedor con data-business-name.
     * @param {Array<Object>} cart Ítems del carrito.
     * @returns {string} Mensaje multilínea listo para codificar.
     */
    function buildOrderMessage(root, cart) {
        const businessName = root.dataset.businessName || 'Origen8.8';
        const lines = [
            'Hola ' + businessName + '! Quiero consultar por este pedido:',
            '',
        ];

        cart.forEach(function (item, index) {
            const price = item.mostrar_precio && item.precio !== null
                ? formatPrice(item.precio) + ' c/u'
                : 'precio a confirmar';

            lines.push((index + 1) + '. ' + item.nombre + ' x' + item.cantidad + ' — ' + price);
        });

        const subtotal = cart.reduce(function (sum, item) {
            if (!item.mostrar_precio || item.precio === null) return sum;
            return sum + (Number(item.precio) * Number(item.cantidad || 1));
        }, 0);

        if (subtotal > 0) {
            lines.push('', 'Subtotal visible: ' + formatPrice(subtotal));
        }

        lines.push('', 'Quedo a la espera de confirmacion de stock y precio final. Gracias!');

        return lines.join('\n');
    }

