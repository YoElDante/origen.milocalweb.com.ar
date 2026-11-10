    /**
     * Agrega un producto al carrito o incrementa su cantidad.
     *
     * Lee los datos desde los atributos data-* de la card y da feedback
     * visual temporal en el botón.
     *
     * @param {HTMLElement} button Botón con data-product-*.
     * @param {Event}       event  Evento de click para el origen de la animación.
     * @returns {void}
     */
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
                descripcion: button.dataset.productDescription || '',
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

    /**
     * Anima un punto desde el botón hasta el flotante del carrito.
     *
     * Usa Web Animations API cuando está disponible y cae a la animación
     * CSS con animationend. Se desactiva con prefers-reduced-motion.
     *
     * @param {HTMLElement} button Botón de origen.
     * @param {Event}       event  Click que aporta las coordenadas iniciales.
     * @returns {void}
     */
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
            // Curva parabólica: el arco sube y baja mientras avanza al destino.
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

    /**
     * Celebra el vaciado con puntos de color que salen del flotante.
     *
     * La cantidad de puntos se limita entre 3 y 9 para no saturar.
     *
     * @param {number} quantity Unidades que había en el carrito.
     * @returns {void}
     */
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

