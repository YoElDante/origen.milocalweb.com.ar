# Resumen de documentación — Origen8.8

Esta sesión dejó **documentación y orden**: dividió CSS, configuración y carrito en parciales, agregó builds reproducibles y creó estos cinco documentos. **No corrigió el producto**: el sitio sigue **NO LISTO** y los 10 P1 de la auditoría continúan abiertos.

> Los cambios de código que se listan abajo son del refactor estructural previo, no de esta tarea de documentación. Esta tarea solo creó los cinco `.md` de `docs/`; no modificó código, configuración, assets ni documentos existentes.

## Fixes 2026-11-10

- `#ubicacion` corregido; `/ofertas` vacía queda `noindex` y fuera del sitemap.
- 5 fuentes woff2 locales y Space Mono 400/700.
- `docs/`, `AGENTS.md`, `README.md`, `.gitignore`, `.git` y `.atl` bloqueados.
- Detalle completo: [Resumen de fixes](../../../docs/resumen-fixes-2026-11-10.md).

## Qué se hizo

| Acción | Archivos | Resultado |
|---|---|---|
| Documentar | `docs/README.md`, `docs/estado-actual.md`, `docs/arquitectura.md`, `docs/mapa-sitio.md`, `docs/resumen-documentacion.md` | 5 documentos nuevos; los documentos existentes quedaron intactos |
| Dividir CSS | `assets/css/styles.css` → `assets/css/src/*.css`; `tools/build-css.php` | 17 parciales, máximo 365 líneas; bundle de 64.394 bytes |
| Dividir config | `config.php` → `config.php` + `config/*.php` | `config.php` de 91 líneas + 10 parciales, máximo 301 líneas; array resuelto idéntico |
| Dividir cart JS | `assets/js/cart.js` → `assets/js/cart/*.js`; `tools/build-js.php` | 8 parciales, máximo 165 líneas; bundle generado y `node --check` OK |
| Documentar main JS | `assets/js/main.js` | 347 líneas en el corte de `CHANGES-SUMMARY.md`; se documentó en sitio, no se dividió |
| Comentarios documentales | 36 PHP, 9 JS, 17 CSS y `.htaccess` | Comentarios agregados sin cambiar comportamiento |
| Restaurar comentarios HTML | `includes/footer.php` | 3 comentarios restaurados: `<!-- Badge MiLocalWeb -->`, `<!-- Botón flotante del pedido -->`, `<!-- Botón flotante de WhatsApp -->` |
| Commits | — | No se hizo `git add`, `commit` ni `push`; los cambios quedaron en working tree |

## Archivos divididos

| Antes | Líneas | Después | Máx. líneas |
|---|---:|---|---:|
| `assets/css/styles.css` | 3765 | 17 parciales en `assets/css/src/` | 365 |
| `config.php` | 869 | `config.php` de 91 líneas + 10 parciales en `config/` | 301 |
| `assets/js/cart.js` | 409 | 8 parciales en `assets/js/cart/` | 165 |
| `assets/js/main.js` | 347 | Sin dividir; documentado en sitio | 347 |

> Los conteos son líneas físicas del estado final. El refactor de `config/` incluye `catalogo-parte-1.php` y `catalogo-parte-2.php`; el máximo indicado es el del momento de la división. `main.js` quedó en 400 líneas; `cart.js` es un bundle generado de 541 líneas y `catalogo-parte-1.php` tiene 304 líneas.

## Verificación

| Prueba | Resultado |
|---|---|
| `php -l` | 36 archivos PHP, 0 errores |
| `node --check` | `assets/js/main.js` y `assets/js/cart.js`, OK |
| CSS normalizado | Equivalente al original |
| Config resuelta | Hash SHA-256 idéntico: `62A269B33A59B99F0BB554BE998B19324B765D317A0F7690728D6EFD4A72193B` (61 claves) |
| HTML renderizado | Estructuralmente idéntico en `/`, `/productos`, `/ofertas`, `/accesorios`, `/carrito` y 404 (ignorando comentarios CSS) |
| Smoke test navegador | Agregar producto, contador y carrito con subtotal OK |
| Fuentes | 5 woff2 locales agregados; los 5 responden 200 |
| Git | Cambios en working tree, sin commits |

## Qué NO se tocó

- Lógica de negocio, contenido, datos, SEO y diseño: no se cambiaron.
- Los P0/P1 de [estado-actual.md](estado-actual.md) siguen abiertos. No hay P0; hay 10 P1.
- No se modificaron `docs/ficha-cliente.md`, `docs/informe_estilo_origen.md`, los planes de desarrollo ni las guías SEO existentes.
- No se cambiaron textos, imágenes, precios, rutas, metadatos ni el HTML visible.
- No se borraron archivos ni se hicieron commits.
- El array resuelto de `config.php` se mantuvo idéntico (hash de 61 claves).

## Cómo revertir

- Backup completo previo a los cambios: `C:\workspace\MiLocalWeb-WorkSpace\_backups\ProyectosWebs-20261109-203606\origen.milocalweb.com.ar`.
- Git: `git -C <ruta> status` y `git -C <ruta> diff`. No se hicieron commits.
- Para volver al estado del último commit hay que revertir los tracked y decidir qué hacer con los untracked del refactor (`config/`, `assets/css/src/`, `assets/js/cart/`, `tools/build-css.php`, `tools/build-js.php`). **No borrar untracked sin confirmación**: el backup es la vía segura.

## Pendientes recomendados

No se duplican acá: el detalle y las recomendaciones están en [estado-actual.md](estado-actual.md). Prioridad inmediata:

1. Decidir si se cargan ofertas reales para habilitar `/ofertas`; P1-01 (`#ubicacion`) y P1-03 (fuentes) ya están resueltos.
2. Completar CSP, `Store`/geo/categorías JSON-LD y accesibilidad (skip-link, focus global, headings).
3. Re-auditar el puntaje: S01 y S02 ya están resueltos por el refactor, pero 37/76 no se recalculó.
4. Cerrar el hardening de `config/` y la exposición de `docs/`, `AGENTS.md`, `README.md` y `.gitignore`.
5. Completar `docs/ficha-cliente.md` con datos reales, sin placeholders ni rutas `C:\workspace\...`.
