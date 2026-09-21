# AGENTS.md — MiLocalWeb Catalogo con Pedido Asistido

> Instrucciones para asistentes de codigo. Leer antes de tocar este proyecto.
> Este archivo es la guia canonica del proyecto Origen y de la variante reusable para sitios MiLocalWeb de catalogo liviano.

---

## 1. Contexto del Negocio

MiLocalWeb crea sitios para negocios locales que necesitan presencia en Google, catalogo claro y contacto directo.

Este proyecto ya no debe tratarse como landing simple. Es un **catalogo con pedido asistido**:

- Muestra productos, ofertas y accesorios.
- Permite armar un pedido en un carrito local.
- No cobra online.
- No registra usuarios.
- Deriva el cierre comercial al negocio por WhatsApp y, si existe email configurado, por correo.

Esto NO es un e-commerce completo. No agregar login, base de datos, panel admin, pasarela de pago ni stock automatico salvo pedido explicito.

---

## 2. Principio Fundamental

`config.php` es la fuente unica de verdad.

Todo dato del cliente, producto, ruta, precio, descuento, SEO y contacto debe salir de `config.php` o de helpers que lean `config.php`.

Se pueden agregar claves nuevas. No quitar claves existentes si pueden estar siendo usadas por la landing actual.

---

## 3. Arquitectura Esperada

```text
origen.milocalweb.com.ar/
├── index.php
├── config.php
├── .htaccess
├── robots.txt
├── sitemap.xml
├── assets/
│   ├── css/styles.css
│   ├── js/main.js
│   ├── js/cart.js
│   └── img/cliente/
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── catalogo.php
│   ├── seo.php
│   ├── sections/
│   ├── pages/
│   │   ├── home.php
│   │   ├── productos.php
│   │   ├── ofertas.php
│   │   ├── accesorios.php
│   │   └── carrito.php
│   └── components/
│       ├── product-card.php
│       └── breadcrumb.php
└── docs/
```

La implementacion puede evolucionar por fases. Si una carpeta todavia no existe, crearla solo cuando haga falta.

---

## 4. Modelo de Producto

Los productos deben vivir en una clave `catalogo` dentro de `config.php`.

Cada producto debe poder definir:

- En que rutas aparece: `productos`, `ofertas`, `accesorios`.
- Si muestra precio.
- Si tiene descuento.
- Porcentaje o etiqueta del descuento.
- Precio anterior si corresponde.
- Disponibilidad.
- Si es destacado.

Ejemplo de referencia:

```php
[
    'id' => 'short-con-calza',
    'nombre' => 'Short con calza interna',
    'slug' => 'short-con-calza',
    'descripcion' => 'Doble capa: short + calza. Ajuste seguro, tela respirable, liviana y fresca.',
    'imagen' => '/assets/img/cliente/productos/short-con-calza.webp',
    'alt' => 'Short con calza interna Origen Run & Bike',

    'rutas' => ['productos', 'ofertas'],
    'categoria' => 'indumentaria',
    'tags' => ['running', 'gym'],

    'mostrar_precio' => true,
    'precio' => 85000,
    'moneda' => 'ARS',

    'tiene_descuento' => true,
    'descuento_porcentaje' => 15,
    'precio_anterior' => 100000,
    'etiqueta_descuento' => '15% OFF',

    'disponible' => true,
    'destacado' => false,
]
```

---

## 5. Reglas del Catalogo

- Un producto puede aparecer en varias paginas mediante `rutas`.
- `/ofertas` puede listar productos con ruta `ofertas` o con `tiene_descuento=true`.
- Si `mostrar_precio=false`, mostrar “Consultar precio”.
- Si `tiene_descuento=true`, mostrar badge CSS sobre la card.
- No calcular descuentos si el precio final no esta cargado. Usar `precio` como precio final visible.
- No duplicar el mismo producto en varios arrays cuando se puede filtrar por `rutas`.

---

## 6. Carrito

El carrito debe ser client-side con `localStorage`.

Reglas:

- Storage key sugerida: `origen_carrito`.
- No guardar datos sensibles.
- Guardar solo `id`, `nombre`, `precio`, `mostrar_precio`, `cantidad` e imagen si hace falta.
- Debe persistir al recargar.
- Debe poder vaciarse.
- Debe permitir productos con precio y productos “a consultar”.
- El subtotal solo debe calcularse con productos que muestran precio.

El cierre real de stock, precio y pago lo hace el negocio fuera del sitio.

---

## 7. Checkout

WhatsApp es el canal principal.

El mensaje debe incluir productos, cantidades, precios visibles y aclaracion comercial:

```text
Quedo a la espera de confirmacion de stock y precio final.
```

Email es secundario. Si `config.php` tiene `email` vacio, no mostrar boton de email.

No implementar envio server-side de emails en la primera version.

---

## 8. SEO

Cada pagina publica debe tener:

- `title` unico.
- `meta description` unica.
- `canonical` absoluto.
- Open Graph coherente.
- Un solo `h1`.
- Breadcrumb si es pagina interna.
- JSON-LD adecuado.

Schemas permitidos:

- `Store` o `LocalBusiness`.
- `WebSite`.
- `BreadcrumbList`.
- `ItemList`.
- `Product`.
- `Offer` solo cuando hay precio real visible.

No emitir `Offer.price` para productos que muestran “Consultar precio”.

`robots.txt` y `sitemap.xml` deben incluir las rutas reales del proyecto.

---

## 9. Elementos MiLocalWeb Obligatorios

No eliminar:

- Footer MiLocalWeb.
- Aside publicitario o bloque equivalente discreto.
- WhatsApp float.
- Links comerciales de MiLocalWeb cuando correspondan.

Estos elementos son parte del modelo comercial de MiLocalWeb.

---

## 10. Convenciones Tecnicas

- PHP plano, compatible PHP 7.4+.
- Sin framework.
- Sin jQuery.
- Sin Bootstrap.
- Sin Tailwind.
- Vanilla JS para interacciones esenciales.
- CSS mobile-first.
- Usar variables CSS para colores de marca.
- Usar `htmlspecialchars()` para datos del cliente.
- Assets nuevos en kebab-case, sin espacios ni acentos.
- Preferir WebP en imagenes nuevas.
- Usar `loading="lazy"` salvo imagen critica del hero.

---

## 11. Documentos de Referencia

Leer antes de implementar catalogo/carrito:

- `docs/plan-template-php-catalogo-carrito.md` — guia reusable para otros clientes.
- `docs/plan-desarrollo-origen-catalogo-carrito.md` — plan especifico de Origen.
- `docs/informe_estilo_origen.md` — identidad visual.
- `docs/ficha-cliente.md` — datos del cliente, con cuidado porque puede tener placeholders.

El plan historico `docs/plan-desarrollo-origen.md` contiene decisiones utiles de identidad, pero algunas partes estan desactualizadas respecto del estado real del repo.

---

## 12. Checklist Antes de Cerrar Cambios

- [ ] No se agrego DB, login, admin ni pagos online.
- [ ] `config.php` sigue siendo fuente unica de verdad.
- [ ] Productos nuevos tienen `id`, `slug`, `rutas`, `nombre`, `descripcion`, `imagen`.
- [ ] Productos sin precio no emiten `Offer.price`.
- [ ] Descuentos se ven con CSS, no como imagen.
- [ ] `/productos`, `/ofertas`, `/accesorios`, `/carrito` funcionan.
- [ ] Carrito persiste tras recargar.
- [ ] WhatsApp arma un pedido claro.
- [ ] Email se oculta si `email` esta vacio.
- [ ] `robots.txt` y `sitemap.xml` estan alineados con las rutas.
- [ ] Mobile revisado antes que desktop.
- [ ] No hay placeholders inventados ni lorem ipsum.

---

## 13. Regla de Oro

Si una solucion requiere explicar mucho para justificar por que no es un e-commerce completo, probablemente esta sobredisenada.

El objetivo es vender mejor, no construir una plataforma.
