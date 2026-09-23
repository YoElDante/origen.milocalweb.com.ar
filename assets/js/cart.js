/**
 * Origen8.8 — Carrito local de pedido asistido.
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

    function addProduct(button, event) {
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
        animateToBox(button, event);
        setAddButtonLabel(button, 'Agregado a tu pedido');
        button.classList.add('is-added');

        window.setTimeout(function () {
            setAddButtonLabel(button, 'Sumar a tu pedido');
            button.classList.remove('is-added');
        }, 1200);
    }

    function animateToBox(button, event) {
        const box = document.querySelector('[data-cart-float]');
        const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (!box || prefersReducedMotion) return;

        const source = button.getBoundingClientRect();
        const target = box.getBoundingClientRect();
        const startX = event && Number.isFinite(event.clientX) ? event.clientX : source.left + (source.width / 2);
        const startY = event && Number.isFinite(event.clientY) ? event.clientY : source.top + (source.height / 2);
        const endX = target.left + (target.width / 2);
        const endY = target.top + (target.height / 2);
        const distance = Math.hypot(endX - startX, endY - startY);
        const arc = Math.max(54, Math.min(120, distance * 0.18));
        const dot = document.createElement('span');

        box.classList.add('is-open');
        dot.className = 'cart-fly-dot';
        dot.style.left = startX + 'px';
        dot.style.top = startY + 'px';
        dot.style.setProperty('--cart-fly-x', (endX - startX) + 'px');
        dot.style.setProperty('--cart-fly-y', (endY - startY) + 'px');
        dot.style.setProperty('--cart-fly-arc', arc + 'px');
        document.body.appendChild(dot);

        if (typeof dot.animate === 'function') {
            const keyframes = [];
            const steps = 18;

            for (let step = 0; step <= steps; step += 1) {
                const progress = step / steps;
                const x = (endX - startX) * progress;
                const y = ((endY - startY) * progress) - (arc * 4 * progress * (1 - progress));
                const scale = 0.35 + (0.65 * Math.sin(Math.PI * progress)) - (0.17 * progress);

                keyframes.push({
                    opacity: progress < 0.08 ? progress / 0.08 : 1 - Math.max(0, progress - 0.9) / 0.1,
                    transform: 'translate3d(' + x + 'px, ' + y + 'px, 0) scale(' + Math.max(0.18, scale).toFixed(3) + ')',
                    offset: progress,
                });
            }

            dot.style.animation = 'none';
            dot.animate(keyframes, {
                duration: 780,
                easing: 'cubic-bezier(0.22, 0.72, 0.22, 1)',
                fill: 'forwards',
            }).addEventListener('finish', function () {
                dot.remove();
                box.classList.add('is-catching');
                window.setTimeout(function () {
                    box.classList.remove('is-catching');
                    box.classList.remove('is-open');
                }, 320);
            }, { once: true });
            return;
        }

        dot.addEventListener('animationend', function () {
            dot.remove();
            box.classList.add('is-catching');
            window.setTimeout(function () {
                box.classList.remove('is-catching');
                box.classList.remove('is-open');
            }, 320);
        }, { once: true });
    }

    function animateClearBox(quantity) {
        const box = document.querySelector('[data-cart-float]');
        const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (!box || prefersReducedMotion) return;

        const target = box.getBoundingClientRect();
        const startX = target.left + (target.width / 2);
        const startY = target.top + (target.height / 2) - 2;
        const dots = Math.max(3, Math.min(9, Number(quantity || 0)));
        const colors = ['#00bbaa', '#dfd3ca', '#5c7c8a', '#25d366', '#f77737'];

        box.classList.add('is-open', 'is-emptying');

        for (let index = 0; index < dots; index += 1) {
            const dot = document.createElement('span');
            const drift = ((index % 3) - 1) * 3;
            const lift = 82 + (index % 4) * 10;

            dot.className = 'cart-empty-dot';
            dot.style.left = startX + 'px';
            dot.style.top = startY + 'px';
            dot.style.backgroundColor = colors[index % colors.length];
            dot.style.setProperty('--cart-empty-x', drift + 'px');
            dot.style.setProperty('--cart-empty-y', (-lift) + 'px');
            dot.style.animationDelay = (index * 0.12) + 's';
            document.body.appendChild(dot);
            dot.addEventListener('animationend', function () { dot.remove(); }, { once: true });
        }

        window.setTimeout(function () {
            box.classList.remove('is-emptying');
            box.classList.remove('is-open');
        }, 1400);
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
        price.textContent = item.mostrar_precio && item.precio !== null
            ? formatPrice(item.precio) + ' c/u'
            : 'Precio a confirmar';

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
        button.addEventListener('click', function (event) {
            addProduct(button, event);
        });
    });

    document.querySelectorAll('[data-cart-clear]').forEach(function (button) {
        button.addEventListener('click', clearCart);
    });

    updateCartCount(readCart());
    renderCart();
})();
