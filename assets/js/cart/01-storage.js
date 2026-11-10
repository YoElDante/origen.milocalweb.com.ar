    /**
     * Lee y normaliza el carrito desde localStorage.
     *
     * Si el JSON es inválido o no es un array, limpia la clave y devuelve
     * un carrito vacío. Si detecta ítems fuera de esquema, reescribe el
     * storage con la versión normalizada.
     *
     * @returns {Array<Object>} Ítems válidos del carrito.
     */
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

    /**
     * Corrige rutas de imagen heredadas de variantes con miniaturas.
     *
     * @param {string} url Ruta original.
     * @returns {string} Ruta normalizada.
     */
    function normalizeImageUrl(url) {
        if (!url || typeof url !== 'string') return '';
        return url
            .replace(/\/miniatura\//g, '/')
            .replace(/-miniatura(\.[^.]+)$/i, '$1');
    }

    /**
     * Normaliza un ítem del carrito al esquema mínimo permitido.
     *
     * Solo conserva id, nombre, descripción, precio visible, cantidad e
     * imagen. El precio se anula si el producto es "a consultar".
     *
     * @param {Object} item Ítem crudo de localStorage.
     * @returns {Object|null} Ítem normalizado o null si no tiene id.
     */
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
            descripcion: String(item.descripcion || ''),
            precio: hasPrice ? price : null,
            mostrar_precio: hasPrice,
            cantidad: quantity,
            imagen: normalizeImageUrl(String(item.imagen || '')),
        };
    }

    /**
     * Persiste el carrito y refresca contador y vista del carrito.
     *
     * @param {Array<Object>} cart Ítems a guardar.
     * @returns {void}
     */
    function writeCart(cart) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
        updateCartCount(cart);
        renderCart();
    }

