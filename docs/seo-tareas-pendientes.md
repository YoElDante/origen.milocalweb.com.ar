# SEO — Tareas Pendientes (origen.milocalweb.com.ar)

> Documento de trabajo para ejecución asistida por IA.
> Regla de oro del proyecto (AGENTS.md): `config.php` es la fuente única de verdad. No agregar DB, login, admin ni pagos online.

## Cómo se va a ejecutar

- **Automatizable:** el orquestador y sus subagentes implementan, revisan y verifican el código.
- **Acción humana:** solo queda lo que requiere acceso a cuentas, confirmación comercial o una pieza visual aprobada.
- Una tarea se marca `[x]` únicamente después de verificar su criterio de aceptación.

## Acciones humanas — fáciles y de alto impacto

Estas acciones ahorran trabajo innecesario a la IA y evitan que invente datos del negocio.

| Estado | Acción | Qué entregar o confirmar | Tiempo estimado | Desbloquea |
|---|---|---|---:|---|
| [x] | Crear o aprobar la imagen para compartir | Verificada: `og-origen-88-1200x630.jpg`, 1200x630 px y 172,9 KB. | 10–20 min | T2 |
| [x] | Confirmar marcas comercializadas | Confirmadas: `Navajo`, `Kaizen`, `SOX` e `I-Run`. | 2 min | T9 |
| [x] | Confirmar datos del local | Confirmados: Ejército de los Andes 129, Villa Zoila, Río Tercero, Córdoba, X5850; horarios lun–vie y sáb 10:00–12:45 y 17:15–20:30; teléfono 3571329870; WhatsApp responde mensajes todos los días. | 3 min | T9 |
| [x] | Localizar ficha pública | Verificada mediante el enlace corto existente: `Origen 8.8 - Linea Tiempo Libre`. | 3 min | T9 |
| [ ] | Google Search Console | Verificar el dominio y enviar `https://origen.milocalweb.com.ar/sitemap.xml` después del deploy. | 10 min | T10 |
| [ ] | Perfil de Negocio de Google | Actualizar la ficha: la búsqueda pública todavía muestra horarios viejos (lun–vie 9:00–20:00, sáb 9:00–12:00) y la categoría incorrecta `repair service`. Confirmar también dirección, teléfono y web. | 10 min | T10 |
| [ ] | Decidir analítica | Confirmar si se desea GA4. Si la respuesta es sí, pasar únicamente el ID público `G-XXXXXXXXXX`; nunca compartir contraseña. | 2 min | T10 |

> No hace falta esperar estas respuestas para avanzar: las tareas automatizables se ejecutan ahora. Las dependientes quedarán preparadas y explícitamente bloqueadas.

## Tablero de automatización

| Tarea | Responsable | Estado |
|---|---|---|
| T1 — noindex carrito + sitemap | IA | Completada y verificada |
| T2 — imagen Open Graph | Humano (imagen) + IA (integración) | Completada y verificada |
| T3 — OG site name + Twitter Card | IA | Completada y verificada |
| T4 — metadatos únicos | IA | Completada y verificada |
| T5 — `lastmod` del sitemap | IA | Completada y verificada |
| T6 — OG contextual | IA | Completada y verificada |
| T7 — robots para material interno | IA | Completada y verificada |
| T8 — SEO de 404 | IA | Completada y verificada |
| T9 — datos estructurados | IA + confirmación humana | Completada y verificada |
| T10 — plataformas externas | Humano | Pendiente de deploy |

## Estado actual (ya implementado, NO repetir)

- Metadatos por página: `title`, `meta description`, `canonical`, Open Graph, Twitter Card y `robots` (`noindex` en 404 y carrito). Fuente: `includes/header.php`.
- JSON-LD con `@graph`: `Store` (dirección, geo, horarios partidos, marcas y `sameAs`), `WebSite`, `BreadcrumbList` en páginas internas, `ItemList` con `Product`, `Offer` solo cuando hay precio real. Fuente: `includes/header.php` + `includes/catalogo.php` (`catalog_product_schema`).
- `robots.txt`: `Disallow: /includes/`, `/tools/`, `/assets/vid/` + referencia al sitemap.
- `sitemap.xml`: incluye `/`, `/productos`, `/ofertas` y `/accesorios`; el carrito está excluido.
- Breadcrumb visual en páginas internas (`includes/components/breadcrumb.php`).
- Imágenes con `width`/`height`, `loading="lazy"` salvo hero (`loading="eager"` + `fetchpriority="high"`).
- Fuentes locales vía `@font-face` con `local()` (no requiere preconnect).
- `lang="es"`, viewport correcto.

---

## Tareas

### T1 — `noindex` en `/carrito` y quitarla del sitemap `ALTA`

**Estado de ejecución:** ✅ Completada y verificada en renderizado local.

**Estado previo:** `/carrito` era indexable (solo 404 tenía `noindex`) y figuraba en `sitemap.xml` con prioridad 0.5.
**Acción:**
1. En `includes/header.php`, emitir `noindex, follow` también cuando `$currentPage === 'carrito'`.
2. Quitar la entrada de `/carrito` de `sitemap.xml`.
3. Dejar el breadcrumb visual en `/carrito` (no afecta indexación).

**Criterio de aceptación:**
- `curl /carrito` devuelve `<meta name="robots" content="noindex, follow">`.
- `sitemap.xml` no contiene `/carrito`.
- No se rompe el `noindex` de la 404.

---

### T2 — Imagen Open Graph dedicada 1200x630 `ALTA`

**Estado de ejecución:** ✅ Completada y verificada. Imagen 1200x630, 172,9 KB, integrada en Open Graph y Twitter Card.

**Estado previo:** `og:image` usaba `logo-origen88.webp` (proporción incorrecta para previews en WhatsApp/Google; aparecía recortada).
**Acción:**
1. Generar `assets/img/cliente/logos/og-origen-88-1200x630.jpg` (o `.png`): logo + nombre de marca sobre fondo de marca, proporción exacta 1200x630, peso < 300 KB.
2. En `config.php`, apuntar `seo_og_image` a la nueva imagen.
3. En `includes/header.php`, agregar `og:image:width`, `og:image:height` y `og:image:alt` (usar `htmlspecialchars`).

**Criterio de aceptación:** la imagen existe con esa resolución; los tags width/height/alt se renderizan; no queda la referencia al logo cuadrado como `og:image` principal.

---

### T3 — `og:site_name` + Twitter Card `MEDIA`

**Estado de ejecución:** ✅ Completada y verificada.

**Estado previo:** el header no emitía `og:site_name` ni tags de Twitter/X (X caía al fallback de Open Graph).
**Acción:** en `includes/header.php`, junto al bloque Open Graph:
- `<meta property="og:site_name" content="<?= htmlspecialchars($cliente['nombre']) ?>">`
- `<meta name="twitter:card" content="summary_large_image">` (mismo title/description/image que OG).

**Criterio de aceptación:** ambos tags presentes en todas las páginas, valores escapados.

---

### T4 — Contenido SEO por página de catálogo desde `config.php` `MEDIA`

**Estado de ejecución:** ✅ Completada. Las cuatro páginas indexables tienen títulos y descripciones únicos dentro de los límites definidos.

**Estado previo:** `catalog_page_config` ya usaba la clave `paginas` de `config.php`, pero faltaba validar y ajustar títulos y descripciones únicas.
**Acción:**
1. Auditar `cliente['paginas']` en `config.php`.
2. Ajustar textos faltantes o duplicados. No inventar datos del cliente: usar `seo_localidad`, `seo_provincia` y `rubro` sin copiar de otras webs.

**Criterio de aceptación:** cada página indexable tiene `title` y `description` únicos dentro de los límites; nada queda vacío.

---

### T5 — Sitemap: `lastmod` coherente con los cambios `MEDIA`

**Estado de ejecución:** ✅ Completada el 2026-10-19 con la opción A (sitemap estático).

**Estado previo:** `sitemap.xml` mantenía `lastmod` fijo en `2026-09-18`.
**Acción (decidir una):**
- **Opción A (simple, recomendada):** mantener `sitemap.xml` estático; actualizar `lastmod` a la fecha del deploy / último cambio real de contenido en cada edición relevante. Documentarlo en este archivo.
- **Opción B (automática):** generar el sitemap con PHP (`sitemap.php` reescribiendo `sitemap.xml` o servir `application/xml` con `lastmod = filemtime` del catálogo). Solo si el hosting permite.

**Criterio de aceptación:** `lastmod` refleja la fecha real del último cambio de la URL; el sitemap sigue siendo XML válido referencia­do por `robots.txt`.

---

### T6 — `og:image` contextual en páginas de catálogo `BAJA`

**Estado de ejecución:** ✅ Completada. `/ofertas` usa el fallback global mientras no tenga productos asociados.

**Estado previo:** todas las páginas usaban la imagen OG global.
**Acción:** en `includes/header.php`, si `$pageProducts` no está vacío, usar la imagen (y descripción del primer producto) como `og:image` de la página, con fallback a la global.
**Criterio de aceptación:** `/productos`, `/ofertas` y `/accesorios` comparten con imagen de producto; sigue existiendo fallback global.

---

### T7 — `robots.txt`: bloquear assets internos no indexables `BAJA`

**Estado de ejecución:** ✅ Completada. Se bloqueó `/assets/vid/`; no se bloquearon imágenes públicas.

**Estado previo:** no se bloqueaba `/assets/vid/`.
**Acción:** agregar `Disallow: /assets/vid/` y evaluar `Disallow: /assets/img/cliente/indispensables/` (material de campaña interna; NO bloquear imágenes de productos, esas sí deben indexarse).

**Criterio de aceptación:** imágenes de productos y logos siguen accesibles para Google Images; `robots.txt` sigue siendo válido (verificar con Google Robots Tester).

---

### T8 — Canonical/OG en 404 `BAJA`

**Estado de ejecución:** ✅ Completada y verificada con respuesta HTTP 404.

**Estado previo:** la página `not-found` tenía `noindex, follow`, pero `canonical` y `og:url` apuntaban a la URL inexistente solicitada.
**Acción:** en `includes/header.php`, omitir `canonical`, `og:url` y `og:image` cuando `!empty($pageConfig['is_not_found'])` (práctica recomendada por Google para páginas noindex).
**Criterio de aceptación:** la 404 no emite canonical; el resto de las páginas no cambia.

---

### T9 — Schema `Store`: enriquecer y confirmar datos `BAJA`

**Estado de ejecución:** ✅ Implementación técnica y confirmación humana completadas.

**Estado previo:** el `Store` tenía dirección, geo, horarios y `sameAs` con Instagram, pero parte de los datos estaba hardcodeada o sin confirmar.
**Acción:**
1. Mover la dirección/datos hardcodeados (`Ejército de los Andes 129`, Río Tercero) a claves de `config.php` (ej. `direccion`, `horarios`) y leerlas desde ahí (fuente única de verdad).
2. Agregar a `sameAs` si el cliente tiene otras redes o su ficha de Google Business Profile.
3. Marcas confirmadas en `config.php`: Navajo, Kaizen, SOX e I-Run. Los productos solo emiten `Product.brand` cuando la marca está confirmada; no existe fallback que invente a Origen8.8 como fabricante.

La ficha pública fue localizada, pero su actualización externa permanece pendiente en T10: la búsqueda pública muestra horarios anteriores y una categoría incorrecta.

**Criterio de aceptación:** Schema Validator y Rich Results Test sin errores; ningún dato queda hardcodeado en el template cuando ya existía en `config.php`.

---

### T10 — Externas (fuera del repo) `INFO — NO codificar`

Estas requieren credenciales/acceso del cliente; documentarlas, no implementarlas en código:

- [ ] Registrar el sitio en Google Search Console y enviar `sitemap.xml`.
- [ ] Verificar indexación de `/`, `/productos`, `/ofertas`, `/accesorios` (inspección de URL) tras deploy.
- [ ] Actualizar el Perfil de Negocio de Google localizado: cargar horarios partidos 10:00–12:45 y 17:15–20:30 (lunes a viernes y sábados), corregir la categoría pública `repair service`, y confirmar dirección, teléfono, web y fotos.
- [ ] Decidir con el cliente si quiere Google Analytics / GA4 u otro tracking (no agregar sin pedido explícito).
- [ ] Favicon: generar `apple-touch-icon` (180x180 PNG) y sumarlo al `<head>` (mejora menor de marca).

---

## Checklist de cierre general (obligatorio antes de marcar el PR done)

Seguir el checklist completo de `AGENTS.md`. Resumen específico SEO:

- [ ] Un solo `h1` por página (el hero tiene dos ramas pero excluyentes — re-verificar en vivo).
- [ ] `/productos`, `/ofertas`, `/accesorios` y `/carrito` funcionan y el breadcrumb quedó intacto.
- [ ] `Offer.price` solo para productos con precio real visible; sin precio → "Consultar precio" y sin offer.
- [ ] JSON-LD válido (Schema Validator) en las 5 rutas.
- [ ] `robots.txt` y `sitemap.xml` alineados con las rutas reales post-T1/T7.
- [ ] Datos del cliente escapados con `htmlspecialchars()` en todo tag nuevo.
- [ ] Mobile revisado antes que desktop.
- [ ] Sin referencias al workspace local ni `localhost` en URLs públicas (el sitemap y canonical siguen en el dominio de producción).

---

## Notas para la IA ejecutora

1. Tocar solo los archivos listados por tarea; no refactorizar de más.
2. No quitar claves existentes de `config.php` (solo agregar).
3. Mantener compatibilidad PHP 7.4+ y el estilo actual del código (sin framework, sin comentarios de AI).
4. Si una tarea depende de datos del cliente que no existen (ej. redes sociales nuevas), dejar placeholder documentado en este archivo y no inventar contenido.
5. Orden sugerido: T1 → T2 → T3 → T4 → T5 → (T6, T7, T8, T9 en cualquier orden) → T10 documentada.
