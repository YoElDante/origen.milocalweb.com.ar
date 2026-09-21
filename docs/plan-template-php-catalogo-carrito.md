# Plan Template — Sitios PHP de Catalogo con Carrito Liviano

> Guia reutilizable para construir sitios MiLocalWeb de nivel catalogo: paginas SEO, productos configurables, carrito local y cierre comercial por WhatsApp/email.

## Decision Base

Este tipo de proyecto NO debe tratarse como e-commerce completo. Es un catalogo comercial con pedido asistido.

El sitio muestra productos, permite armar un pedido en el navegador y deriva el cierre de venta al negocio por WhatsApp y, si existe email configurado, por correo.

## Alcance

- Paginas publicas: `/`, `/productos`, `/ofertas`, `/accesorios`, `/carrito`.
- Sin login.
- Sin base de datos.
- Sin panel administrativo.
- Sin pasarela de pago.
- Carrito en `localStorage`.
- Checkout por WhatsApp como canal principal.
- Checkout por email como canal secundario si el cliente provee una casilla.
- SEO tecnico por pagina.
- Producto configurable desde `config.php`.

## Principios

| Principio | Decision |
|---|---|
| Fuente de verdad | `config.php` |
| Tecnologia | PHP plano, vanilla CSS, vanilla JS |
| Persistencia | Solo navegador (`localStorage`) |
| Venta | Pedido asistido por WhatsApp/email |
| SEO | Server-rendered HTML, no catalogo renderizado solo por JS |
| Reuso | Cambiar config, assets y estilo; no reescribir logica |

## Arquitectura Recomendada

```text
cliente.milocalweb.com.ar/
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

La estructura puede adaptarse a proyectos existentes. Lo importante es conservar los limites: datos en `config.php`, templates PHP simples, carrito en JS y SEO server-side.

## Router Liviano

Usar un router minimo en `index.php`:

```php
$page = $_GET['p'] ?? trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$page = $page === '' ? 'home' : $page;

$allowedPages = ['home', 'productos', 'ofertas', 'accesorios', 'carrito'];
if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    $page = 'home';
}
```

En Apache, `.htaccess` debe mapear URLs limpias a `index.php?p=...`. En local, `php -S` debe seguir funcionando con query string o `REQUEST_URI`.

## Modelo de Producto

Cada producto debe poder decidir donde aparece, si muestra precio y si tiene descuento.

```php
'catalogo' => [
    [
        'id' => 'short-con-calza',
        'nombre' => 'Short con calza interna',
        'slug' => 'short-con-calza',
        'descripcion' => 'Short liviano para running y entrenamiento.',
        'imagen' => '/assets/img/cliente/productos/short-con-calza.webp',
        'alt' => 'Short con calza interna para running',

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
    ],
],
```

## Reglas del Modelo

- `id` debe ser estable porque el carrito lo usa como clave.
- `slug` debe ser kebab-case.
- `rutas` define en que paginas aparece el producto.
- `mostrar_precio=false` muestra “Consultar precio”.
- `tiene_descuento=true` habilita badge visual y precio anterior si existe.
- `disponible=false` mantiene el producto visible solo si conviene mostrarlo como “Sin stock” o “Consultar”.
- Nunca hardcodear productos en templates si pueden vivir en `config.php`.

## Render de Producto

Un producto debe mostrar:

- Imagen optimizada.
- Nombre.
- Descripcion corta.
- Precio o “Consultar precio”.
- Badge CSS de descuento si aplica.
- Boton “Agregar al carrito” si esta disponible.
- CTA de WhatsApp como fallback.

El badge de descuento debe ser CSS, no imagen.

```html
<span class="product-badge product-badge--discount">15% OFF</span>
```

## Carrito

El carrito vive en el navegador.

| Tema | Decision |
|---|---|
| Storage key | `{cliente}_carrito` o `milocalweb_cart_{slug}` |
| Datos guardados | `id`, `nombre`, `precio`, `mostrar_precio`, `cantidad`, `imagen` |
| Duracion | Hasta que el navegador borre datos locales |
| Validacion real | La hace el negocio por WhatsApp/email |

El carrito debe soportar:

- Agregar producto.
- Cambiar cantidad.
- Eliminar producto.
- Vaciar carrito.
- Mostrar subtotal solo para productos con precio.
- Separar productos “a consultar” cuando no tienen precio visible.
- Armar mensaje de pedido.

## Checkout

WhatsApp es el canal principal.

El mensaje debe incluir:

- Nombre del negocio.
- Lista de productos.
- Cantidades.
- Precio unitario si esta visible.
- Subtotal si corresponde.
- Productos sin precio como “consultar precio”.
- Aclaracion: “Pedido sujeto a confirmacion de stock y precio final”.

Email es secundario. Si `email` esta vacio, no se muestra boton de email.

## SEO Requerido

Cada pagina debe tener:

- `title` unico.
- `meta description` unica.
- `canonical` absoluto.
- `og:title`, `og:description`, `og:url`, `og:image`.
- Un solo `h1`.
- Jerarquia `h2`/`h3` coherente.
- Breadcrumb visual y `BreadcrumbList` JSON-LD.

Schemas recomendados:

- `LocalBusiness` o `Store` para el negocio.
- `WebSite` para el sitio.
- `BreadcrumbList` para paginas internas.
- `ItemList` para listados de productos.
- `Product` para productos con datos suficientes.
- `Offer` solo si hay precio real y moneda.

No emitir `Offer.price` si el producto no muestra precio. Google castiga mas un dato estructurado falso que un dato ausente.

## Sitemap y Robots

`robots.txt` minimo:

```text
User-agent: *
Allow: /
Disallow: /includes/
Disallow: /tools/

Sitemap: https://cliente.milocalweb.com.ar/sitemap.xml
```

`sitemap.xml` debe incluir:

- `/`
- `/productos`
- `/ofertas`
- `/accesorios`
- `/carrito`

`/carrito` puede indexarse si tiene contenido util, pero no debe prometer productos que no existen server-side.

## Carga Semi-Automatica de Productos

No crear panel admin al inicio.

Recomendacion:

1. Subir imagenes a `assets/img/cliente/productos/`, `ofertas/` o `accesorios/`.
2. Usar nombres kebab-case.
3. Opcional: agregar `.txt` junto a cada imagen con descripcion corta.
4. Ejecutar una herramienta local `tools/sync-catalogo.php`.
5. La herramienta genera un bloque PHP base para pegar/revisar en `config.php`.

La herramienta ayuda, pero el humano confirma precios, rutas, descuentos y copy. Esa es la parte que conviene mantener manual para evitar errores comerciales.

## Checklist de Implementacion

- [ ] `config.php` tiene `catalogo` completo.
- [ ] Cada producto tiene `id`, `slug`, `rutas`, `nombre`, `descripcion`, `imagen`.
- [ ] Los productos con precio tienen moneda.
- [ ] Los productos sin precio no emiten `Offer.price`.
- [ ] Las rutas `/productos`, `/ofertas`, `/accesorios`, `/carrito` funcionan.
- [ ] El carrito persiste al recargar.
- [ ] El pedido de WhatsApp incluye cantidades y aclaracion comercial.
- [ ] El boton de email se oculta si no hay email.
- [ ] `robots.txt` y `sitemap.xml` estan actualizados.
- [ ] JSON-LD valida sin datos falsos.
- [ ] Mobile funciona bien antes de desktop.

## Fuera de Alcance Inicial

- Base de datos.
- Panel administrativo.
- Usuarios/clientes registrados.
- Pago online.
- Stock automatico.
- Facturacion.
- Sincronizacion con Instagram o Google Merchant.

Estas cosas pueden venir despues, pero si se agregan antes de validar el flujo comercial, el proyecto se vuelve mas caro y mas fragil sin necesidad.
