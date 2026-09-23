# Plan de Desarrollo — Origen Catalogo con Carrito Liviano

> Proyecto especifico para transformar `origen.milocalweb.com.ar` de landing page a sitio catalogo con pedido asistido.

## Objetivo

Convertir Origen8.8 en un sitio con paginas de catalogo reales, carrito local y cierre de pedido por WhatsApp/email, manteniendo PHP plano, SEO local y configuracion simple desde `config.php`.

## Resultado Esperado

- `/` mantiene la landing institucional.
- `/productos` lista productos generales.
- `/ofertas` lista productos o colecciones con descuento.
- `/accesorios` lista accesorios.
- `/carrito` muestra el pedido armado en el navegador.
- El usuario puede enviar el pedido por WhatsApp.
- El usuario puede enviar el pedido por email solo si Origen configura una casilla.
- Los productos pueden aparecer en una o varias rutas segun configuracion.
- Cada producto puede mostrar precio, ocultarlo, mostrar descuento y definir el porcentaje/etiqueta.

## Estado Actual

| Area | Estado |
|---|---|
| Tecnologia | PHP plano, sin framework |
| Entrada | `index.php` single-page |
| Datos | `config.php` |
| Productos | Arrays separados: `productos`, `seccion_ofertas`, `seccion_indispensables`, `seccion_campania_verano` |
| Carrito | No existe |
| Email | Vacio en `config.php` |
| SEO | Meta/OG/JSON-LD basico en `includes/header.php` |
| Robots | Existe, minimo |
| Sitemap | Existe, homepage-only |
| CSS | `assets/css/styles.css` unico |
| JS | `assets/js/main.js` unico |

## Decision de Arquitectura

Usar el proyecto actual como base, sin migrarlo a framework ni CMS.

| Tema | Decision |
|---|---|
| Router | Liviano en `index.php` |
| Datos | Ampliar `config.php` con `catalogo` |
| Pages | `includes/pages/*.php` |
| Cards | Componente reutilizable `includes/components/product-card.php` |
| Carrito | `assets/js/cart.js` con `localStorage` |
| SEO | Per-page metadata + JSON-LD dinamico |
| Estilos | Mantener `styles.css` por ahora, secciones claramente marcadas |

No adoptar CSS modular ni build en esta fase. El repo real de Origen hoy trabaja con un solo `styles.css`; cambiar eso ahora mezcla dos migraciones y mete ruido. Primero resolvemos catalogo/carrito bien.

## Modelo de Catalogo para Origen

Agregar una clave nueva en `config.php`:

```php
'catalogo' => [
    [
        'id' => 'short-con-calza',
        'nombre' => 'Short con calza interna',
        'slug' => 'short-con-calza',
        'descripcion' => 'Doble capa: short + calza. Ajuste seguro, tela respirable, liviana y fresca.',
        'imagen' => '/assets/img/cliente/productos/short-con-calza.webp',
        'alt' => 'Short con calza interna Origen8.8',

        'rutas' => ['productos'],
        'categoria' => 'indumentaria',
        'tags' => ['running', 'gym'],

        'mostrar_precio' => false,
        'precio' => null,
        'moneda' => 'ARS',

        'tiene_descuento' => false,
        'descuento_porcentaje' => null,
        'precio_anterior' => null,
        'etiqueta_descuento' => '',

        'disponible' => true,
        'destacado' => true,
    ],
],
```

Los arrays actuales pueden mantenerse durante la migracion, pero el objetivo es que las paginas nuevas lean `catalogo`.

## Rutas de Producto

| Ruta | Regla |
|---|---|
| `/productos` | Productos con `rutas` que incluya `productos` |
| `/ofertas` | Productos con `rutas` que incluya `ofertas` o `tiene_descuento=true` |
| `/accesorios` | Productos con `rutas` que incluya `accesorios` |
| `/carrito` | Lee el carrito del navegador, no del servidor |

Un producto puede aparecer en varias rutas:

```php
'rutas' => ['productos', 'ofertas', 'accesorios'],
```

## Descuentos

Si `tiene_descuento=true`, la card muestra un cartel CSS sobre la imagen.

Reglas:

- Usar `etiqueta_descuento` si existe.
- Si no existe, construir desde `descuento_porcentaje`.
- Mostrar `precio_anterior` solo si `mostrar_precio=true` y el dato existe.
- No calcular precios finales automaticamente en v1 salvo que el precio final este cargado como `precio`.

Ejemplo visual:

```html
<span class="product-card__badge">15% OFF</span>
```

## Carrito Origen

Storage key sugerida:

```text
origen_carrito
```

El carrito debe guardar solo lo necesario:

```json
{
  "id": "short-con-calza",
  "nombre": "Short con calza interna",
  "precio": null,
  "mostrar_precio": false,
  "cantidad": 1
}
```

El carrito debe funcionar aunque algunos productos no tengan precio. En ese caso, el pedido se arma como consulta comercial.

## Mensaje de WhatsApp

Formato sugerido:

```text
Hola Origen8.8! Quiero consultar por este pedido:

1. Short con calza interna x1 — consultar precio
2. Lentes deportivos x2 — $45000 c/u

Subtotal visible: $90000

Quedo a la espera de confirmacion de stock y precio final. Gracias!
```

Si todos los productos son sin precio, no mostrar subtotal.

## Email

`config.php` hoy tiene:

```php
'email' => '',
```

Mientras este vacio, `/carrito` no debe mostrar boton de email.

Si se configura email, usar `mailto:`. No implementar envio server-side en v1.

## SEO para Origen

Actualizar `includes/header.php` para recibir contexto por pagina.

| Pagina | Title sugerido | Description sugerida |
|---|---|---|
| `/` | `Origen8.8 — Indumentaria Deportiva en Rio Tercero` | `Running, trekking y bikes en Rio Tercero. Ropa, calzado y accesorios para volver a lo esencial.` |
| `/productos` | `Productos — Origen8.8` | `Catalogo de indumentaria deportiva Origen en Rio Tercero: shorts, tops, calzas, calzado y prendas outdoor.` |
| `/ofertas` | `Ofertas — Origen8.8` | `Ofertas y oportunidades en indumentaria deportiva, outdoor y accesorios en Origen8.8.` |
| `/accesorios` | `Accesorios — Origen8.8` | `Accesorios para running, trekking y bikes: hidratacion, lentes deportivos y equipamiento liviano.` |
| `/carrito` | `Carrito — Origen8.8` | `Revisa tu pedido y envialo a Origen8.8 por WhatsApp para confirmar stock y precio final.` |

Schemas:

- Home: `Store`, `WebSite`.
- Listados: `Store`, `BreadcrumbList`, `ItemList`.
- Productos con precio: `Product` + `Offer`.
- Productos sin precio: `Product` sin `Offer.price`.
- Carrito: no emitir `Product` desde JS; mantener pagina limpia con `WebPage`/breadcrumb si se implementa.

## Sitemap

Actualizar `sitemap.xml` con:

```text
https://origen.milocalweb.com.ar/
https://origen.milocalweb.com.ar/productos
https://origen.milocalweb.com.ar/ofertas
https://origen.milocalweb.com.ar/accesorios
https://origen.milocalweb.com.ar/carrito
```

## Robots

Mantener indexacion general y bloquear carpetas internas:

```text
User-agent: *
Allow: /
Disallow: /includes/
Disallow: /tools/

Sitemap: https://origen.milocalweb.com.ar/sitemap.xml
```

## Plan SDD

### Fase 1 — Proposal

- [ ] Definir alcance como catalogo con pedido asistido.
- [ ] Confirmar que no hay login, DB, admin ni pago online.
- [ ] Confirmar paginas: `/productos`, `/ofertas`, `/accesorios`, `/carrito`.
- [ ] Confirmar que `config.php` sera fuente unica de datos.

### Fase 2 — Spec

- [ ] Especificar visibilidad por `rutas`.
- [ ] Especificar precio visible/opcional.
- [ ] Especificar descuento visible/opcional.
- [ ] Especificar carrito local.
- [ ] Especificar checkout WhatsApp/email.
- [ ] Especificar SEO por pagina.

### Fase 3 — Design

- [ ] Definir router liviano.
- [ ] Definir estructura `includes/pages` y `includes/components`.
- [ ] Definir helpers de catalogo.
- [ ] Definir API de datos para `cart.js`.
- [ ] Definir estrategia JSON-LD.

### Fase 4 — Tasks

- [x] Crear router y paginas.
- [x] Ampliar `config.php` con `catalogo`.
- [x] Crear componente de card.
- [x] Crear listado filtrado por ruta.
- [x] Crear estilos de catalogo, precio y descuento.
- [x] Crear `cart.js`.
- [x] Crear base visual de pagina `/carrito`.
- [x] Crear checkout WhatsApp/email.
- [x] Actualizar SEO, robots y sitemap.
- [x] Actualizar documentacion.

### Fase 5 — Verify

- [x] Probar `/`, `/productos`, `/ofertas`, `/accesorios`, `/carrito`.
- [ ] Probar producto con precio.
- [x] Probar producto sin precio.
- [x] Probar producto con descuento.
- [x] Probar producto filtrado por ruta y por descuento.
- [x] Probar persistencia base del carrito y saneamiento de `localStorage` corrupto.
- [x] Probar armado de WhatsApp con mensaje correcto.
- [x] Probar ocultamiento de email si esta vacio.
- [x] Validar que no haya errores PHP.
- [ ] Revisar mobile primero.
- [x] Validar sitemap/robots/schema base.

## Datos Pendientes

- [ ] Email comercial de Origen.
- [ ] Lista final de productos.
- [ ] Precios visibles o productos a consultar.
- [ ] Descuentos reales.
- [ ] Categorias definitivas.
- [ ] Imagenes finales en WebP y nombres kebab-case.

## Criterio de Exito

El desarrollo esta terminado cuando una persona puede entrar desde mobile, navegar productos/ofertas/accesorios, agregar items al carrito, recargar sin perderlos y enviar un pedido claro por WhatsApp sin crear cuenta ni pasar por pago online.

## Lo Que No Se Debe Hacer

- No agregar base de datos.
- No agregar login.
- No agregar checkout de pago.
- No renderizar el catalogo solo con JavaScript.
- No duplicar productos en varios arrays si pueden filtrarse por `rutas`.
- No emitir schema de precio si el precio no se muestra.
- No convertir este proyecto en un CMS casero.
