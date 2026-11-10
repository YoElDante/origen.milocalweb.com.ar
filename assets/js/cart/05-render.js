    /**
     * Crea el nodo DOM de un ítem del carrito.
     *
     * Se construye con createElement/textContent (no innerHTML con datos)
     * para evitar inyección. Los controles incluyen etiquetas ARIA.
     *
     * @param {Object} item Ítem normalizado.
     * @returns {HTMLElement}
     */
    function createItemNode(item) {
        const row = document.createElement('article');
        row.className = 'cart-item';

        const image = document.createElement('img');
        image.className = 'cart-item__image';
        image.src = item.imagen || '/assets/img/cliente/logos/logo-origen88.webp';
        image.alt = item.nombre;
        image.loading = 'lazy';
        image.width = 96;
        image.height = 96;

        const body = document.createElement('div');
        body.className = 'cart-item__body';

        const title = document.createElement('h2');
        title.textContent = item.nombre;

        const price = document.createElement('p');
        price.className = 'cart-item__price';
        if (item.mostrar_precio && item.precio !== null) {
            price.textContent = formatPrice(item.precio) + ' c/u';
        } else if (item.descripcion) {
            price.textContent = item.descripcion;
            price.classList.add('cart-item__description');
        } else {
            price.textContent = 'Precio a confirmar';
        }

        const controls = document.createElement('div');
        controls.className = 'cart-item__controls';

        const minus = document.createElement('button');
        minus.type = 'button';
        minus.textContent = '-';
        minus.setAttribute('aria-label', 'Restar unidad');
        minus.disabled = Number(item.cantidad || 1) <= 1;
        minus.addEventListener('click', function () { updateQuantity(item.id, -1); });

        const qty = document.createElement('span');
        qty.textContent = String(item.cantidad || 1);

        const plus = document.createElement('button');
        plus.type = 'button';
        plus.textContent = '+';
        plus.setAttribute('aria-label', 'Sumar unidad');
        plus.addEventListener('click', function () { updateQuantity(item.id, 1); });

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'cart-item__remove';
        remove.setAttribute('aria-label', 'Quitar producto');
        remove.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg><span>Quitar</span>';
        remove.addEventListener('click', function () { removeItem(item.id); });

        controls.append(minus, qty, plus, remove);
        body.append(title, price, controls);
        row.append(image, body);

        return row;
    }

    /**
     * Renderiza la página del carrito y actualiza los enlaces de checkout.
     *
     * Si la página actual no tiene `[data-cart-root]`, sale sin hacer nada.
     * También recalcula el subtotal visible y los href de WhatsApp/email.
     *
     * @returns {void}
     */
    function renderCart() {
        const root = document.querySelector('[data-cart-root]');
        if (!root) return;

        const cart = readCart();
        const empty = root.querySelector('[data-cart-empty]');
        const content = root.querySelector('[data-cart-content]');
        const list = root.querySelector('[data-cart-items]');
        const subtotalNode = root.querySelector('[data-cart-subtotal]');
        const whatsapp = root.querySelector('[data-cart-whatsapp]');
        const email = root.querySelector('[data-cart-email]');

        if (!list || !empty || !content) return;

        empty.hidden = cart.length > 0;
        content.hidden = cart.length === 0;
        list.replaceChildren();

        cart.forEach(function (item) {
            list.appendChild(createItemNode(item));
        });

        const subtotal = cart.reduce(function (sum, item) {
            if (!item.mostrar_precio || item.precio === null) return sum;
            return sum + (Number(item.precio) * Number(item.cantidad || 1));
        }, 0);

        if (subtotalNode) {
            subtotalNode.hidden = subtotal <= 0;
            subtotalNode.textContent = subtotal > 0 ? 'Subtotal visible: ' + formatPrice(subtotal) : '';
        }

        if (whatsapp) {
            const message = buildOrderMessage(root, cart);
            whatsapp.href = 'https://wa.me/' + (root.dataset.whatsappNumber || '') + '?text=' + encodeURIComponent(message);
        }

        if (email) {
            const subject = encodeURIComponent('Pedido desde la web');
            const body = encodeURIComponent(buildOrderMessage(root, cart));
            email.href = 'mailto:' + root.dataset.businessEmail + '?subject=' + subject + '&body=' + body;
        }
    }

