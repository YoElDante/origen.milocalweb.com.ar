    /**
     * Formatea un número como precio en pesos argentinos.
     *
     * @param {number|string} value Monto a formatear.
     * @returns {string}
     */
    function formatPrice(value) {
        return new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
            maximumFractionDigits: 0,
        }).format(Number(value || 0));
    }

    /**
     * Actualiza todos los contadores del carrito en navbar y flotante.
     *
     * @param {Array<Object>} cart Ítems del carrito.
     * @returns {void}
     */
    function updateCartCount(cart) {
        const total = cart.reduce(function (sum, item) {
            return sum + Number(item.cantidad || 0);
        }, 0);

        document.querySelectorAll('[data-cart-count]').forEach(function (node) {
            node.textContent = String(total);
            node.hidden = total === 0;
        });
    }

    /**
     * Cambia la etiqueta del botón "sumar" preservando su ícono.
     *
     * @param {HTMLElement} button Botón de agregar.
     * @param {string}      text   Nueva etiqueta.
     * @returns {void}
     */
    function setAddButtonLabel(button, text) {
        const label = button.querySelector('.catalog-card__add-text');
        if (label) {
            label.textContent = text;
        } else {
            button.textContent = text;
        }
    }

