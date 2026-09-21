/**
 * Origen 8.8 — Carrito local de pedido asistido.
 * Vanilla JS. Sin backend, sin login y sin pasarela de pago.
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'origen_carrito';

    function readCart() {
        try {
            const parsed = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            if (!Array.isArray(parsed)) {
                localStorage.removeItem(STORAGE_KEY);
                return [];
            }

            const normalized = parsed.map(normalizeItem).filter(Boolean);
            if (normalized.length !== parsed.length || JSON.stringify(normalized) !== JSON.stringify(parsed)) {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(normalized));
            }

            return normalized;
        } catch (error) {
            localStorage.removeItem(STORAGE_KEY);
            return [];
        }
    }

    function normalizeItem(item) {
        if (!item || typeof item !== 'object') return null;

        const id = String(item.id || '').trim();
        if (!id) return null;

        const hasRawPrice = item.precio !== null && item.precio !== '' && typeof item.precio !== 'undefined';
        const price = Number(item.precio);
        const hasPrice = item.mostrar_precio === true && hasRawPrice && Number.isFinite(price);
        const quantity = Math.max(1, Number.parseInt(item.cantidad, 10) || 1);

        return {
            id: id,
            nombre: String(item.nombre || 'Producto'),
            precio: hasPrice ? price : null,
            mostrar_precio: hasPrice,
            cantidad: quantity,
            imagen: String(item.imagen || ''),
        };
    }

    function writeCart(cart) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
        updateCartCount(cart);
        renderCart();
    }

    function formatPrice(value) {
        return new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
            maximumFractionDigits: 0,
        }).format(Number(value || 0));
    }

    function updateCartCount(cart) {
        const total = cart.reduce(function (sum, item) {
            return sum + Number(item.cantidad || 0);
        }, 0);

        document.querySelectorAll('[data-cart-count]').forEach(function (node) {
            node.textContent = String(total);
            node.hidden = total === 0;
        });
    }

    function setAddButtonLabel(button, text) {
        const label = button.querySelector('.catalog-card__add-text');
        if (label) {
            label.textContent = text;
        } else {
            button.textContent = text;
        }
    }

    function addProduct(button) {
        const id = button.dataset.productId || '';
        if (!id) return;

        const cart = readCart();
        const existing = cart.find(function (item) {
            return item.id === id;
        });

        if (existing) {
            existing.cantidad = Number(existing.cantidad || 0) + 1;
        } else {
            cart.push({
                id: id,
                nombre: button.dataset.productName || 'Producto',
                precio: button.dataset.productPrice ? Number(button.dataset.productPrice) : null,
                mostrar_precio: button.dataset.productShowPrice === '1',
                cantidad: 1,
                imagen: button.dataset.productImage || '',
            });
        }

        writeCart(cart);
        setAddButtonLabel(button, 'Agregado');
        button.classList.add('is-added');

        window.setTimeout(function () {
            setAddButtonLabel(button, 'Agregar al carrito');
            button.classList.remove('is-added');
        }, 1200);
    }

    function updateQuantity(id, delta) {
        const cart = readCart().map(function (item) {
            if (item.id === id) {
                item.cantidad = Math.max(1, Number(item.cantidad || 1) + delta);
            }
            return item;
        });

        writeCart(cart);
    }

    function removeItem(id) {
        writeCart(readCart().filter(function (item) {
            return item.id !== id;
        }));
    }

    function clearCart() {
        writeCart([]);
    }

    function buildOrderMessage(root, cart) {
        const businessName = root.dataset.businessName || 'Origen 8.8';
        const lines = [
            'Hola ' + businessName + '! Quiero consultar por este pedido:',
            '',
        ];

        cart.forEach(function (item, index) {
            const price = item.mostrar_precio && item.precio !== null
                ? formatPrice(item.precio) + ' c/u'
                : 'consultar precio';

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

    function createItemNode(item) {
        const row = document.createElement('article');
        row.className = 'cart-item';

        const image = document.createElement('img');
        image.className = 'cart-item__image';
        image.src = item.imagen || '/assets/img/cliente/logos/logo-600x600-transp.webp';
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
        price.textContent = item.mostrar_precio && item.precio !== null
            ? formatPrice(item.precio) + ' c/u'
            : 'Consultar precio';

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
        remove.textContent = 'Quitar';
        remove.className = 'cart-item__remove';
        remove.addEventListener('click', function () { removeItem(item.id); });

        controls.append(minus, qty, plus, remove);
        body.append(title, price, controls);
        row.append(image, body);

        return row;
    }

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

    document.querySelectorAll('[data-cart-add]').forEach(function (button) {
        button.addEventListener('click', function () {
            addProduct(button);
        });
    });

    document.querySelectorAll('[data-cart-clear]').forEach(function (button) {
        button.addEventListener('click', clearCart);
    });

    updateCartCount(readCart());
    renderCart();
})();
