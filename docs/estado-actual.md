# Estado actual — Origen8.8

Origen8.8 es un catálogo con pedido asistido para un local de indumentaria deportiva y accesorios outdoor en Río Tercero (Córdoba). Corre sobre PHP plano 8.4.6, HTML5, CSS y JS vanilla, sin framework ni base de datos. La auditoría del 2026-11-09 lo marcó **NO LISTO**: 37/76 ítems aplicables (48,7 %), sin P0 y con 10 P1 abiertos.

> **Nota sobre referencias:** los números de línea son orientativos. La auditoría se hizo antes de la división de archivos y de los comentarios; si un archivo cambió, verificá por selector, meta tag o nombre de función.

## Actualización 2026-11-10 — fixes aplicados

- `#ubicacion` ahora apunta al bloque de local/mapa (`nuestro-local.php`).
- `/ofertas` vacía quedó `noindex` y fuera del sitemap.
- Se agregaron las 5 fuentes woff2 locales y se separó Space Mono 400/700.
- `docs/`, `AGENTS.md`, `README.md`, `.gitignore`, `.git` y `.atl` quedaron bloqueados.
- Detalle completo: [Resumen de fixes](../../../docs/resumen-fixes-2026-11-10.md).

> El veredicto y el puntaje de abajo son el corte de la auditoría 2026-11-09; no se recalcularon.

## Veredicto

| Campo | Valor |
|---|---|
| Estado | **NO LISTO** |
| Cumplimiento | 37/76 ítems aplicables (48,7 %) |
| Fecha | 2026-11-09 |
| Alcance | Auditoría de solo lectura + documentación. No se corrigió producto. |

- **P1-01 — bloqueo principal:** el navbar apunta a `/#ubicacion` (`includes/header.php:272`), pero la home no tiene `id="ubicacion"`; el mapa y la dirección existen dentro de `#nuestro-local` (`includes/sections/nuestro-local.php:39-62`) y `includes/sections/ubicacion.php:14` quedó sin incluir en `includes/pages/home.php:15-25`. El ítem “Ubicación” no navega a ningún lado.
- **P1-02:** `/ofertas` responde 200 y está en el sitemap con prioridad 0.9 (`sitemap.xml:15-20`), pero no tiene productos: el catálogo no define `rutas => ['ofertas']` ni `tiene_descuento` y la página muestra el estado vacío (`includes/pages/ofertas.php:27-28`).
- **P1-03:** `@font-face` referencia 4 woff2 inexistentes (`assets/css/src/01-base.css:10-48`); `assets/fonts/` no existe y los 4 archivos responden 404. El sitio cae a las fuentes de fallback.
- **P1-04 a P1-10:** faltan CSP y `frame-ancestors` (`.htaccess:6-10`), el `Store` JSON-LD está incompleto y sin `founder`, no hay geo tags, las categorías SEO no se emiten como `Product`, faltan skip-link y `:focus-visible` global, el 404 propio no se sirve en Apache productivo y `docs/ficha-cliente.md` sigue siendo plantilla con placeholders.
- **Núcleo funcional sano:** las 5 rutas públicas responden 200, `/no-existe` responde 404, `config.php` e `includes/` responden 403, los 36 PHP pasan `php -l`, el JSON-LD parsea en las 6 páginas y el test de carrito devuelve `Cart JS behavior OK`. El veredicto negativo es contra el checklist canónico de entrega, no contra la operación actual del sitio.

## Ficha técnica

| Campo | Valor |
|---|---|
| Ruta | `C:\workspace\MiLocalWeb-WorkSpace\ProyectosWebs\landingpages.clientes\origen.milocalweb.com.ar` |
| Dominio previsto | `https://origen.milocalweb.com.ar` (`config/datos-basicos.php:16`) |
| Stack | PHP plano 8.4.6 (probado), HTML5, CSS vanilla, JS vanilla. Sin framework ni Composer; Node solo se usa para tests (`tools/test-cart-js.js`). |
| Entry point | `index.php` (router + composición de página) (`index.php:18-88`) |
| Fuente de datos | `config.php` + `config/*.php` (10 parciales, 61 claves); helpers en `includes/catalogo.php` |
| Build CSS | `php tools/build-css.php` → `assets/css/styles.css` (17 parciales; bundle de 64.394 bytes) |
| Build JS | `php tools/build-js.php` → `assets/js/cart.js` (8 parciales); `assets/js/main.js` no tiene build |
| Git | Rama `main`; último commit `639dfab feat(seo): optimize local search metadata` (2026-10-19); working tree con cambios sin commit del refactor y de esta documentación |

## Cumplimiento de especificaciones

> Base: `landingpages.clientes/template/docs/checklist-verificacion.md` y `guia-seo-implementacion.md`.
> `PASS` = cumple; `PARCIAL` = cumple con observaciones; `FAIL` = no cumple; `N/A` = no aplica.
> **Vigencia:** esta tabla reproduce el corte de auditoría del 2026-11-09. El refactor posterior resolvió S01 y S02 (CSS modular y build), pero el puntaje 37/76 no se recalculó. Ver “Resuelto después de la auditoría”.

### Datos y configuración

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| D01 | `config.php` existe, retorna array y es fuente única | PASS | `index.php:32`; `config.php:74-91` |
| D02 | Config completo, sin placeholders | PARCIAL | `config/datos-basicos.php:22` (`email` vacío); `config/aside-clientes.php:25-27` (`clientes` vacío) |
| D03 | `founder_name` y `founder_title` en config | FAIL | No existen claves `founder*`; `includes/header.php:73-119` no emite `founder` |
| D04 | Colores completos + tipografía con fallback | PASS | `config/datos-basicos.php:40-56` |
| D05 | Variables CSS derivadas `--color-primary-glow`, `--color-section-dark` | FAIL | 0 coincidencias en `assets/css/src/` |
| D06 | Keywords, localidad, provincia, zona, lat/long, OG image | PASS | `config/seo.php:15-30` |
| D07 | `seo_categorias` y `seo_marcas` completos | PASS | `config/seo.php:31-32` (9 categorías, 4 marcas) |
| D08 | `seo_categorias_imagenes` con fallback | FAIL | Clave ausente en `config/seo.php` |
| D09 | `hero_descripcion` y `nosotros_texto` con keywords + marcas + ubicación | FAIL | `config/datos-basicos.php:34` no menciona marcas ni “Río Tercero”; `config/redes-nosotros.php:25` no menciona marcas |
| D10 | Modelo de catálogo con `id`, `slug`, `rutas`, precio/descuento | PASS | `config/productos-paginas.php:70-73`; 33 productos, 0 errores de campos/duplicados |

### Assets

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| A01 | Convención kebab-case, sin espacios/mayúsculas/acentos | FAIL | `config/secciones-campanas.php:74,78`; `assets/img/cliente/campañas/verano fem.jpg`; `assets/icons/origen icono.ico` |
| A02 | Sin archivos `.txt` en `assets/` | FAIL | 13 `.txt` versionados, p. ej. `assets/img/cliente/ofertas/outdoor.txt` |
| A03 | Imágenes WebP prioritarias (excepto favicon/texturas) | PARCIAL | Hay WebP, pero también JPG de contenido: `config/secciones-campanas.php:24,30,36` |
| A04 | Estructura de carpetas de assets esperada | PARCIAL | Existe `assets/img/cliente/{identidad,logos,productos,local,ofertas}`; sobra `assets/icons/`; falta `assets/fonts/`; no hay `terceros/` |
| A05 | OG image 1200×630 existente | PASS | `config/seo.php:26-28`; `getimagesize()` = 1200×630; HTTP 200 |
| A06 | Fuentes auto-hosteadas woff2 | FAIL | `assets/css/src/01-base.css:10-48`; `assets/fonts/` no existe; los 4 archivos responden 404 |
| A07 | Sin CDNs, jQuery, Bootstrap, Tailwind | PASS | `includes/header.php:225` solo carga el CSS local; JS vanilla |

### CSS y JS

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| S01 | CSS modular por componentes | FAIL | Corte de auditoría: `assets/css/styles.css` era un monolito de 3765 líneas. **Resuelto después:** 17 parciales en `assets/css/src/` |
| S02 | Build script `tools/build-css.php` | FAIL | Corte de auditoría: no existía. **Resuelto después:** `tools/build-css.php:23-41` |
| S03 | Critical CSS inline en `header.php` | FAIL | `includes/header.php:225` solo carga `styles.css`; no hay `critical.css` |
| S04 | Cache busting CSS con `filemtime()` | PASS | `index.php:73-81`; `includes/header.php:225` |
| S05 | JS vanilla sin dependencias | PASS | `assets/js/main.js`; `assets/js/cart.js`; `node --check` OK |
| S06 | Los 4 JS con `defer` | FAIL | Solo hay 2 JS y se cargan sin `defer` al final del body: `includes/footer.php:116-117` |
| S07 | Cache busting JS con `filemtime()` | PASS | `index.php:73-81`; `includes/footer.php:116-117` |
| S08 | Navbar mobile, smooth scroll y back-to-top | PASS | `assets/js/main.js:23-80`; `assets/css/src/02-navbar.css` |
| S09 | Videos con lazy loading | PARCIAL | `includes/components/product-card.php:45` usa `preload="none"`; `includes/pages/productos.php:197,212` usan `preload="metadata"`; un video de `nosotros` queda sin poster (`config/redes-nosotros.php:27`) |

### SEO técnico

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| E01 | Title y meta description únicos | PASS | `includes/header.php:181,213`; `config/productos-paginas.php:38-65`; longitudes 48-50 / 140-150 en páginas públicas |
| E02 | Canonical absoluto correcto | PASS | `includes/header.php:215-217`; `/` → `https://origen.milocalweb.com.ar/`; `/productos` → `.../productos` |
| E03 | `robots` meta y `lang="es"` | PASS | `includes/header.php:177,182`; carrito y 404 emiten `noindex, follow` |
| E04 | Geo tags (`geo.region`, `geo.placename`, `geo.position`, `ICBM`) | FAIL | No aparecen en `includes/header.php:176-243`; 0 coincidencias de `geo.` |
| E05 | Open Graph + Twitter completos y coherentes | PARCIAL | `includes/header.php:184-202`: home OK 1200×630; en `/productos` y `/accesorios` el OG image se reemplaza por la primera foto de producto (`includes/header.php:40-53`), sin `imagen_ancho`/`imagen_alto` en el catálogo |
| E06 | JSON-LD válido | PASS | `json_decode()` sin error en las 6 páginas; `includes/header.php:240-242` |
| E07 | `Store` con todos los campos | FAIL | `includes/header.php:73-119`: faltan `slogan`, `image`, `logo`, `currenciesAccepted`, `paymentAccepted`, `priceRange`, `areaServed`, `hasMap`, `makesOffer`, `founder` |
| E08 | `Product` + `Offer` según precio visible | PASS | `includes/catalogo.php:217-248`; `Offer` solo si `catalog_product_has_price()` (`:151-154`) |
| E09 | Categorías, marcas como Organization, founder y author | FAIL | `includes/header.php:153-165` solo emite `ItemList` de productos de la página; no recorre `seo_categorias`; marcas como `Brand` dentro de `Store` (`:105-110`); `WebSite` sin `author` (`:122-128`) |
| E10 | BreadcrumbList en páginas internas | PASS | `includes/header.php:131-149`; se emite en `/productos`, `/ofertas`, `/accesorios`, `/carrito` |
| E11 | `robots.txt` permite, bloquea internos y declara sitemap | PARCIAL | `robots.txt:1-7` bloquea `includes/`, `tools/`, `assets/vid/`; no bloquea `config.php`, `config/` ni `docs/` |
| E12 | `sitemap.xml` con imágenes, geo y lastmod | PARCIAL | `sitemap.xml:1-27`: XML válido, 4 URLs; sin `image:image`, sin `geo:geo`; `lastmod` fijo 2026-10-19 |
| E13 | `.htaccess` con CSP, frame-ancestors y media-src | FAIL | `.htaccess:6-10` no define `Content-Security-Policy`; solo `X-Frame-Options` |
| E14 | Jerarquía de headings | PARCIAL | Un solo `h1` por página; en `/productos` hay `h3` de subsección (`includes/pages/productos.php:178`) seguido de `h2` de producto (`includes/components/product-card.php:62`); footer usa `h4` (`includes/footer.php:42,53`) |
| E15 | Alt text en todas las imágenes con nombre + localidad | PARCIAL | Todas las `<img>` tienen `alt`, pero el logo es solo “Origen8.8” (`includes/header.php:250-255`; `includes/footer.php:30-35`) y varios alt no incluyen “en Río Tercero” |
| E16 | Links internos sin roturas | FAIL | `includes/header.php:272` apunta a `/#ubicacion`; la home no tiene `id="ubicacion"` porque `includes/pages/home.php:15-25` no incluye `includes/sections/ubicacion.php` |
| E17 | 404 personalizado | PARCIAL | Funciona con el router embebido (`index.php:18-30`); `.htaccess:28-45` no tiene `ErrorDocument` ni rewrite de desconocidos, por lo que en Apache productivo el 404 propio no se sirve |
| E18 | Favicon existente | PASS | `config/datos-basicos.php:29`; `assets/img/cliente/iconos/favicon.ico`; HTTP 200 |

### Secciones y documentación

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| X01 | Hero con H1 = keywords + localidad, sin slogan | PASS | `includes/sections/hero.php:49`; H1 renderizado “Indumentaria Deportiva en Río Tercero” |
| X02 | Productos destacados (1-3) con imagen, texto y CTA | PASS | `config/productos-paginas.php:15-34`; `includes/sections/productos.php:20-53` |
| X03 | Sección Ubicación incluida | FAIL | `includes/pages/home.php:15-25` no requiere `ubicacion.php`; `includes/sections/ubicacion.php:14` existe pero está muerto. El mapa/dirección sí están en `nuestro-local.php:39-62` |
| X04 | `nosotros.php` incluido | PASS | `includes/pages/home.php:19`; `includes/sections/nosotros.php:22` |
| X05 | Aside publicitario presente | PASS | `includes/pages/home.php:20`; `includes/sections/aside.php` |
| X06 | Footer MiLocalWeb + WhatsApp float | PASS | `includes/footer.php:25-113`; WhatsApp en `:105-113` |
| X07 | Sección “Otros Clientes” | N/A | `config/aside-clientes.php:23-27`: `mostrar_clientes=true` pero array vacío; `includes/sections/clientes.php` retorna sin renderizar |
| X08 | `AGENTS.md` y `README.md` presentes | PASS | `AGENTS.md` (251 líneas); `README.md` (93 líneas) |
| X09 | `docs/ficha-cliente.md` completo | FAIL | `docs/ficha-cliente.md:1` título con `[NOMBRE DEL NEGOCIO]`; `:38` `hero.jpg`; `:53,63,68,106-107` rutas absolutas `C:\workspace\...` |
| X10 | `guia-relevamiento.md` y `{cliente}.cliente.md` archivados | FAIL | `docs/guia-relevamiento.md` y `docs/origen.cliente.md` no existen |
| X11 | Documentación actualizada y veraz | FAIL | `README.md:23` dice “Google Fonts (Open Sans)”; `README.md:50` lista `reels.php` inexistente; `README.md:84` atribuye “index, follow” a `robots.txt`, que no contiene esa directiva |

### Accesibilidad

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| U01 | Skip-link al contenido principal | FAIL | `includes/header.php:245-276` no tiene skip-link; 0 coincidencias de `skip` en el CSS |
| U02 | `:focus-visible` global con outline visible | FAIL | Solo hay reglas puntuales: `assets/css/src/01-base.css:134,314,322`; `02-navbar.css:92`; `13-catalogo-layout.css:330`; `14-catalogo-cards.css:141,167`; `16-carrito.css:205`; no hay regla global |
| U03 | Roles ARIA: navigation, contentinfo, labels | PASS | `includes/header.php:246` (`role="navigation"`, `aria-label`); `includes/footer.php:25` (`role="contentinfo"`); secciones con `aria-label` |
| U04 | `aria-expanded` en menú hamburguesa | PASS | `includes/header.php:261`; `assets/js/main.js:32-45` |
| U05 | `title` en iframes de Google Maps | FAIL | `config/ubicacion.php:22` no incluye `title`; el iframe renderizado tampoco lo tiene |
| U06 | Sin `h4` en footer; jerarquía h1→h2→h3 | FAIL | `includes/footer.php:42,53` usan `<h4>` |
| U07 | Imágenes con `width`/`height` para evitar CLS | PARCIAL | La mayoría tiene dimensiones; la imagen del hero `stacked` no las tiene (`includes/sections/hero.php:33-37`) |

### Performance, seguridad, funcionalidad y mobile

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| P01 | Preload del hero con `fetchpriority="high"` | FAIL | `includes/sections/hero.php:37` tiene `fetchpriority="high"`, pero no hay `<link rel="preload">` en `includes/header.php:176-243` |
| P02 | `loading="lazy"` y `decoding="async"` en no críticas | PARCIAL | `loading="lazy"` es frecuente (`includes/components/product-card.php:56`); `decoding="async"` solo en footer/aside (`includes/footer.php:69`); el hero no tiene `decoding` |
| P03 | `config.php`, `includes/` y `tools/` bloqueados | PASS | `.htaccess:32`; `index.php:22`; HTTP 403 comprobado |
| P04 | Documentación interna no expuesta | FAIL | `.htaccess:32` solo bloquea config/includes/tools; HTTP 200 en `/AGENTS.md`, `/README.md`, `/docs/ficha-cliente.md`, `/.gitignore`; `robots.txt:1-7` no desautoriza `docs/` |
| P05 | `htmlspecialchars()` en datos del cliente | PASS | 164 usos en `includes/`; salidas raw solo de `gmaps_embed` y `tipografia` configurables (`includes/header.php:234`, `config/ubicacion.php:22`) |
| P06 | `rel="noopener noreferrer"` en links externos | PASS | 21 ocurrencias de `rel="noopener` (18 con `noreferrer`); p. ej. `includes/footer.php:54,107`, `includes/sections/hero.php:55` |
| P07 | Rutas y assets responden | PASS | `/`, `/productos`, `/ofertas`, `/accesorios`, `/carrito` = 200; `/no-existe` = 404; `/config.php` = 403; CSS/JS = 200 |
| P08 | Carrito localStorage persiste y normaliza | PASS | `assets/js/cart/01-storage.js:10-28`; `node tools/test-cart-js.js` → `Cart JS behavior OK` |
| P09 | Subtotal solo con productos con precio; “a consultar” sin `Offer` | PASS | `includes/catalogo.php:151-154,217-248`; `node tools/test-cart-js.js` OK |
| P10 | Email oculto si `email` vacío | PASS | `config/datos-basicos.php:22`; `includes/pages/carrito.php:65-67` |
| P11 | Sin imágenes rotas | PASS | Verificación de las 6 páginas: 0 imágenes faltantes |
| P12 | Viewport mobile correcto | PASS | `includes/header.php:180` |
| P13 | Menú hamburguesa funcional | PASS | `assets/js/main.js:32-45`; `assets/css/src/02-navbar.css` |
| P14 | Grids responsive | PASS | 28 `@media` en `assets/css/src/`; grids de productos a 1/2/3/4 columnas (`assets/css/src/05-productos.css`, `assets/css/src/13-catalogo-layout.css:109`) |
| P15 | Touch targets ≥ 44×44 px | PARCIAL | No verificable con navegador; hay botones pequeños (`cart-item__controls`) y el CSS no fija mínimos globales |
| P16 | Sin scroll horizontal | N/A | Requiere navegador real; NO VERIFICABLE en esta auditoría |
| P17 | Lighthouse / contraste WCAG | N/A | No se ejecutó Lighthouse ni medición de contraste; NO VERIFICABLE |

**Totales de auditoría:** 37 PASS, 13 PARCIAL, 26 FAIL, 3 N/A. Aplicables: 76. Puntaje estricto: **37/76 = 48,7 %**. Ponderado (`PARCIAL`=0,5): **43,5/76 = 57,2 %**.

> **Nota de vigencia:** la tabla es el corte del 2026-11-09. Después de ese corte se dividió el CSS y se agregó `tools/build-css.php` (ver [resumen-documentacion.md](resumen-documentacion.md)); S01 y S02 quedaron resueltos, pero el puntaje no se recalculó y los P1 de producto siguen abiertos.

## SEO implementado

| Elemento | Estado | Valor encontrado | Evidencia |
|---|---|---|---|
| Title | PASS | Home: `Origen8.8 — Indumentaria Deportiva en Río Tercero`; internas con `\| Origen8.8` | `includes/header.php:213`; `config/productos-paginas.php:38-65`; curl |
| Meta description | PASS | Única por página, 140-150 caracteres, sin `mb_strtolower` | `includes/header.php:181`; `config/productos-paginas.php:39,44,50,56,62` |
| Canonical | PASS | Absoluto y autorreferente; ausente en 404 | `includes/header.php:215-217`; `/` → `https://origen.milocalweb.com.ar/` |
| Robots meta | PASS | `index, follow` en públicas; `noindex, follow` en `/carrito` y 404 | `includes/header.php:182`; `includes/header.php:26-28` |
| `lang` | PASS | `<html lang="es">` | `includes/header.php:177` |
| Geo tags | FAIL | No existen `geo.region`, `geo.placename`, `geo.position` ni `ICBM` | `includes/header.php:176-243`; 0 coincidencias de `geo.` |
| Open Graph | PARCIAL | Home completo 1200×630; internas de catálogo reemplazan imagen por foto de producto y omiten dimensiones porque el catálogo no tiene `imagen_ancho`/`imagen_alto` | `includes/header.php:40-53,184-202`; `config/seo.php:26-28` |
| Twitter Card | PASS | `summary_large_image`, title, description, image y alt | `includes/header.php:204-211` |
| JSON-LD validez | PASS | 6/6 páginas parsean con `json_last_error() === 0` | `includes/header.php:240-242` |
| JSON-LD tipos | PARCIAL | `Store`, `WebSite`, `BreadcrumbList`, `ItemList`, `Product`, `Offer` condicional | `includes/header.php:73-165`; `includes/catalogo.php:217-248` |
| JSON-LD `Store` | FAIL | Faltan 10 campos obligatorios de la guía | `includes/header.php:73-119` |
| JSON-LD categorías | FAIL | No se emiten `Product` por cada `seo_categorias`; no hay `seo_categorias_imagenes` | `config/seo.php:31`; `includes/header.php:153-165` |
| JSON-LD marcas/founder/author | FAIL | Marcas solo como `Brand` dentro de `Store`; sin `founder`; `WebSite` sin `author` | `includes/header.php:105-110,122-128`; ausencia de `founder_name` |
| H1/H2/H3 | PARCIAL | 1 `h1` por página; en `/productos` hay `h3` antes de `h2` de producto; footer con `h4` | `includes/pages/productos.php:178`; `includes/components/product-card.php:62`; `includes/footer.php:42,53` |
| Alt text | PARCIAL | Todas las imágenes tienen `alt`; no todas siguen `{NOMBRE} — {descripción} en {LOCALIDAD}` | `includes/header.php:250-255`; `includes/footer.php:30-35`; `includes/sections/productos.php` |
| `robots.txt` | PARCIAL | Permite todo, bloquea `includes/`, `tools/`, `assets/vid/`; declara sitemap; no bloquea `config.php`, `config/` ni `docs/` | `robots.txt:1-7` |
| `sitemap.xml` | PARCIAL | XML válido, 4 URLs (`/`, `/productos`, `/ofertas`, `/accesorios`); sin imágenes ni geo; `lastmod` fijo | `sitemap.xml:1-27`; XML OK, 4 nodos |
| `.htaccess` | FAIL | HTTPS forzado y cache OK; sin CSP, sin `frame-ancestors`, sin `media-src` | `.htaccess:6-10,34-36` |
| Enlaces internos | FAIL | `/#ubicacion` sin destino; `/ofertas` no está en el navbar; el resto resuelve | `includes/header.php:267-275`; IDs de la home: `inicio`, `productos`, `nosotros`, `nuestro-local`, `indumentaria`, `ofertas`, `conoce-productos` |
| Imagen OG | PASS | `og-origen-88-1200x630.jpg`, 1200×630, existe | `config/seo.php:26-28`; HTTP 200; `getimagesize()` |
| Favicon | PASS | `/assets/img/cliente/iconos/favicon.ico` | `config/datos-basicos.php:29`; HTTP 200 |
| `hreflang` | N/A | Sitio monolingüe (`lang="es"`); no aplica | `includes/header.php:177` |

## Deuda y riesgos

> **No corregido en esta sesión.** El alcance fue documental. Ordenado por impacto. Los P1 y P2 provienen de la auditoría del 2026-11-09; P2-19 es un hallazgo nuevo del refactor.

**P0:** no se identificaron hallazgos.

| Prioridad | Problema | Impacto | Evidencia | Recomendación |
|---|---|---|---|---|
| P1-01 | El navbar apunta a `/#ubicacion`, pero la home no tiene `id="ubicacion"`; `ubicacion.php` no se incluye | El ítem “Ubicación” no navega; el ancla existe pero está muerta | `includes/header.php:272`; `includes/pages/home.php:15-25`; `includes/sections/ubicacion.php:14`; mapa/dirección en `includes/sections/nuestro-local.php:39-62` | Anclar `id="ubicacion"` en `nuestro-local.php` o cambiar el navbar a `/#nuestro-local`; si se incluye `ubicacion.php`, consolidar antes para no duplicar mapa/dirección |
| P1-02 | `/ofertas` es indexable y está en el sitemap, pero no tiene productos | Página vacía para usuarios y crawlers; desperdicia una URL prioritaria 0.9 | `includes/pages/ofertas.php:27-28`; `includes/catalogo.php:101-116`; `sitemap.xml:15-20`; 0 productos con ruta `ofertas` o `tiene_descuento` | Cargar ofertas reales con `rutas => ['ofertas']` o `tiene_descuento => true`; mientras tanto, `noindex` y quitarla del sitemap |
| P1-03 | `@font-face` referencia 4 woff2 inexistentes; `assets/fonts/` no existe | 4 requests 404 y pérdida de la tipografía de marca; el sitio cae a fallbacks | `assets/css/src/01-base.css:10-48`; `assets/fonts/` ausente; HTTP 404 de los 4 archivos; `README.md:23` contradice el estado real | Agregar los woff2 y un `fonts.css`, o eliminar `@font-face` y usar system-ui; actualizar README |
| P1-04 | `.htaccess` no define CSP ni `frame-ancestors`/`media-src` | Incumple el requisito de seguridad; no hay mitigación de XSS/inline scripts | `.htaccess:6-10`; solo `X-Frame-Options` | Agregar `Content-Security-Policy` con `frame-src https://www.google.com`, `frame-ancestors 'self'`, `media-src 'self'`; probar el mapa |
| P1-05 | `Store` JSON-LD incompleto y sin `founder` | Menor elegibilidad para rich results y para motores de IA; incumple checklist | `includes/header.php:73-119`; `config/seo.php` sin `founder_name`/`founder_title` | Agregar `founder_name`/`founder_title` y completar `Store` (`slogan`, `image`, `logo`, `currenciesAccepted`, `paymentAccepted`, `priceRange`, `areaServed`, `hasMap`, `makesOffer`, `founder`); completar `WebSite.author` |
| P1-06 | No hay geo meta tags | Pérdida de señales locales (`geo.region`, `geo.placename`, `geo.position`, `ICBM`) | `includes/header.php:176-243`; `config/seo.php:19-20` tiene lat/long sin usar en meta | Emitir `geo.region=AR-X` (Córdoba; la guía del template dice `AR-C` por error), placename, position e ICBM desde config |
| P1-07 | Categorías SEO no se emiten como `Product`; falta `seo_categorias_imagenes` | Se pierden keywords de categoría y el fallback exigido por la guía | `config/seo.php:31`; `includes/header.php:153-165` solo lista productos de la página | Recorrer `seo_categorias`, asignar imagen/fallback y emitir `Product` por categoría; agregar el mapeo al config |
| P1-08 | Faltan skip-link y `:focus-visible` global | Afecta navegación por teclado y lectores de pantalla; incumple accesibilidad obligatoria | `includes/header.php:245-276`; `assets/css/src/02-navbar.css:92` y reglas puntuales; `<main>` sin `id` | Agregar `<a class="skip-link" href="#main-content">`, `id="main-content"` en `<main>` y un `:focus-visible` global con outline visible |
| P1-09 | El 404 personalizado no se sirve en Apache productivo | En producción, `/no-existe` cae en el 404 por defecto, no en `not-found.php` | `index.php:18-30` (router solo `cli-server`); `.htaccess:28-45` sin `ErrorDocument` ni rewrite de desconocidos | Agregar `ErrorDocument 404 /index.php?p=no-existe` o una regla de rewrite controlada; probar en Apache |
| P1-10 | `docs/ficha-cliente.md` sigue siendo plantilla con placeholders y rutas absolutas | La documentación canónica no es confiable para mantenimiento ni para IA | `docs/ficha-cliente.md:1,38,53,63,68,106-107` | Completar la ficha con datos reales, quitar rutas `C:\workspace\...` y marcar/archivar el relevamiento crudo |
| P2-02 | JS sin `defer` | Aunque está al final del body, incumple checklist y bloquea parsing si se mueve al head | `includes/footer.php:116-117` | Agregar `defer` o documentar la excepción |
| P2-03 | Sin critical CSS inline y CSS síncrono | Render-blocking del bundle; incumple la entrega de performance del template | `includes/header.php:225`; no hay `critical.css` | Extraer above-the-fold a `critical.css` inline y cargar el bundle async |
| P2-04 | OG image de páginas de catálogo no es 1200×630 | La vista previa social puede recortarse o perder calidad | `includes/header.php:40-53`; `/productos` usa la primera foto de producto y no hay `imagen_ancho`/`imagen_alto` en el catálogo | Mantener la OG 1200×630 por página o generar miniaturas 1200×630 |
| P2-05 | Jerarquía de headings inconsistente | `h2` de producto dentro de `h3` de subsección en `/productos`; `h4` en footer | `includes/pages/productos.php:178`; `includes/components/product-card.php:62`; `includes/footer.php:42,53` | Cambiar títulos de producto a `h3`/`h4` según contexto y footer a `h2`/`h3` |
| P2-06 | iframe de Google Maps sin `title` | Falla accesibilidad del mapa | `config/ubicacion.php:22` | Agregar `title="Mapa de ubicación de Origen8.8 en Río Tercero"` |
| P2-07 | Hero `stacked` sin `width`/`height` y sin preload | Riesgo de CLS y LCP; el `fetchpriority` solo no alcanza | `includes/sections/hero.php:33-37`; no hay `<link rel="preload">` en `header.php` | Declarar dimensiones reales (2055×765) y preload condicional del hero |
| P2-08 | Alt text no estandarizado | Menor relevancia local y accesibilidad | `includes/header.php:250-255`; `includes/footer.php:30-35` | Unificar formato `{NOMBRE} — {descripción} en {LOCALIDAD}` |
| P2-09 | Nombres de assets con espacios/mayúsculas/acentos; 13 `.txt`; duplicados | Rompe convención, complica URLs y el deploy en Linux | `config/secciones-campanas.php:74,78`; `assets/icons/origen icono.ico`; `assets/img/cliente/logos/_archivo/`; 13 `.txt` | Renombrar a kebab-case, eliminar `.txt` y `_archivo/`, conservar una sola variante |
| P2-10 | Sitemap sin imágenes/geo y `lastmod` fijo | Menos señales para Google Imágenes y para SEO local | `sitemap.xml:1-27` | Agregar `xmlns:image`, `image:image`, `geo:geo` y `lastmod` dinámico |
| P2-11 | `robots.txt` no bloquea `config.php`, `config/` ni `docs/` | Mayor superficie de crawl para archivos internos | `robots.txt:1-7` | Agregar `Disallow: /config.php`, `Disallow: /config/` y `Disallow: /docs/` |
| P2-12 | Documentación interna accesible por HTTP | Expone instrucciones, fichas y rutas internas | `.htaccess:32`; HTTP 200 en `/AGENTS.md`, `/README.md`, `/docs/ficha-cliente.md`, `/.gitignore` | Bloquear `docs/`, `AGENTS.md`, `README.md` y dotfiles, o moverlos fuera del webroot |
| P2-13 | README y guías desactualizados | Confunde a quien mantiene el sitio | `README.md:23` (Google Fonts), `README.md:50` (`reels.php`), `README.md:84` (robots) | Actualizar README y `docs/guia-seo-pendientes.md` al estado real |
| P2-14 | Config con secciones muertas y template sin usar | Datos que nunca se renderizan y un archivo que puede confundir | `config/secciones-campanas.php:43-81` (`seccion_indispensables`, `seccion_campania_verano`); `includes/sections/ubicacion.php` sin include | Eliminar o renderizar esas secciones; decidir si `ubicacion.php` se usa o se borra |
| P2-15 | Colores hardcodeados en CSS | Dificulta theming y contradice “usar variables” | 184 coincidencias de hex en `assets/css/src/*.css`; no hay `--color-primary-glow` ni `--color-section-dark` | Reemplazar por `var(--color-*)` y agregar variables derivadas |
| P2-16 | Canonical en página `noindex`; breadcrumb en 404 | Señales contradictorias menores | `includes/header.php:215-217` (canonical en `/carrito`); `includes/pages/not-found.php:18` (breadcrumb en 404) | Omitir canonical en `noindex` y breadcrumb en 404 |
| P2-17 | Config incompleta: email pendiente y clientes vacío | Funcionalidad de email oculta y sección de portfolio no renderiza | `config/datos-basicos.php:22`; `config/aside-clientes.php:25-27`; `includes/pages/carrito.php:65-67` | Completar email si el cliente lo provee; quitar `mostrar_clientes` o cargar logos |
| P2-18 | Videos pesados y sin poster en un caso; `decoding` escaso | Costo de datos y posibles CLS; especialmente en mobile | `assets/vid/productos/catalogo/bolso-irun-negro.mp4` 8,9 MB; `config/redes-nosotros.php:27` poster vacío; `includes/sections/nosotros.php:52-67` | Comprimir/segmentar videos, generar posters WebP y agregar `decoding="async"` donde corresponda |
| P2-19 | `config/` no está bloqueado por `.htaccess` ni por el router | Los parciales de datos quedan servibles por HTTP (hoy devuelven 200 vacío) y la superficie interna crece | `.htaccess:32` solo bloquea `config.php`, `includes/` y `tools/`; `index.php:22` usa el mismo patrón; `/config/datos-basicos.php` → 200 | Agregar `config/` al `RewriteRule` de `.htaccess` y al guard de `index.php`; añadirlo a `robots.txt` |

## Resuelto después de la auditoría

> Estos cambios son de estructura y documentación. **No** corrigen los P1 de producto ni se re-auditaron.

| Ítem | Estado en la auditoría | Estado actual | Evidencia |
|---|---|---|---|
| S01 — CSS modular | FAIL | PASS | `assets/css/src/` con 17 parciales; `tools/build-css.php:23-41` |
| S02 — build CSS | FAIL | PASS | `tools/build-css.php` |
| P2-01 — CSS monolítico sin build | Abierto | Resuelto | `assets/css/styles.css` generado (64.394 bytes) desde `assets/css/src/` |
| `config.php` monolítico | Deuda §9.3 | Resuelto | `config.php` de 91 líneas + 10 parciales en `config/` |
| `cart.js` monolítico | Deuda §9.4 | Resuelto | 8 parciales en `assets/js/cart/`; `tools/build-js.php` |

## Checklist para considerarlo terminado

- [x] P0: no se identificaron hallazgos abiertos.
- [ ] Todos los P1 resueltos o aceptados por escrito.
- [ ] Checklist de `template/docs/checklist-verificacion.md` al 100 %.
- [ ] Sitemap subido a Search Console.
- [ ] Lighthouse móvil: Performance ≥ 85, Accesibilidad ≥ 95, SEO 100.
- [ ] Sin errores PHP ni enlaces/imágenes rotas.
- [ ] `/ofertas` con productos reales, o `noindex` y fuera del sitemap.
- [ ] Los 4 woff2 servidos, o `@font-face` eliminado y README actualizado.
- [ ] CSP y `ErrorDocument 404` configurados y probados en Apache.
- [ ] `docs/ficha-cliente.md` completa, sin placeholders ni rutas absolutas.

## Verificación reproducible

```bash
# Lint de todos los PHP (PowerShell)
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }

# Servidor local con router (necesario para rutas limpias)
php -S 127.0.0.1:8000 -t . index.php

# Códigos HTTP esperados
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/productos
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/ofertas
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/accesorios
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/carrito
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/no-existe
curl -s -o NUL -w "%{http_code}\n" http://127.0.0.1:8000/config.php

# Builds y tests
php tools/build-css.php
php tools/build-js.php
node --check assets/js/main.js
node --check assets/js/cart.js
node tools/test-cart-js.js

# Smoke test de rutas (levanta su propio servidor en 8099)
powershell -File tools/smoke-routes.ps1

# Hash del array resuelto de config (esperado: 62a269b3...)
php -r '$c = require "config.php"; echo hash("sha256", var_export($c, true)), PHP_EOL;'
```

## Documentos relacionados

- [Arquitectura](arquitectura.md)
- [Mapa del sitio](mapa-sitio.md)
- [Resumen de documentación](resumen-documentacion.md)
- [Guía de SEO pendiente](guia-seo-pendientes.md)
- [SEO — tareas pendientes](seo-tareas-pendientes.md)
- [Ficha del cliente](ficha-cliente.md)
