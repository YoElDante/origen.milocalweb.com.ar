# Documentación — Origen8.8

Catálogo con pedido asistido de Origen8.8, un local de indumentaria deportiva y accesorios outdoor en Río Tercero (Córdoba), construido en PHP plano. Esta carpeta reúne el estado vigente, la arquitectura, el mapa del sitio y el registro de la documentación.

> **Veredicto de auditoría (2026-11-09):** **NO LISTO** — 37/76 ítems aplicables (48,7 %), sin P0 y con 10 P1 abiertos. Los P1 siguen abiertos y el puntaje no se recalculó tras el refactor; el detalle está en [estado-actual.md](estado-actual.md).

## Orden de lectura

1. [Estado actual](estado-actual.md) — veredicto, cumplimiento, SEO y deuda priorizada.
2. [Arquitectura](arquitectura.md) — archivos, flujos, builds y diagramas.
3. [Mapa del sitio](mapa-sitio.md) — rutas, anclas, sitemap y enlaces internos.
4. [Resumen de documentación](resumen-documentacion.md) — qué se hizo en esta sesión y cómo verificarlo.

## Documentos existentes

- [Ficha del cliente](ficha-cliente.md) — datos de negocio y relevamiento. **Incompleta:** conserva placeholders y rutas absolutas del workspace.
- [Informe de estilo](informe_estilo_origen.md) — identidad visual, paleta y criterios de marca.
- [Plan de desarrollo original](plan-desarrollo-origen.md) — documento histórico de la landing; algunas decisiones ya no reflejan el catálogo actual.
- [Plan de catálogo y carrito](plan-desarrollo-origen-catalogo-carrito.md) — plan específico de la transformación a catálogo con pedido asistido.
- [Plan template reusable](plan-template-php-catalogo-carrito.md) — patrón para replicar el catálogo en otros clientes MiLocalWeb.
- [Guía de SEO pendiente](guia-seo-pendientes.md) — trabajo SEO detallado. Es un documento de trabajo y puede estar desactualizado respecto de la auditoría.
- [SEO — tareas pendientes](seo-tareas-pendientes.md) — ejecución por tareas y acciones humanas. También puede contener estados históricos.
- [Comandos PHP](comandos-php.md) — servidor local y comandos de desarrollo.

## Documentos de raíz

- [AGENTS.md](../AGENTS.md) — guía canónica del proyecto: modelo de negocio, reglas de catálogo, carrito, SEO y convenciones.
- [README.md](../README.md) — README humano. Está desactualizado en varios puntos (Google Fonts, `reels.php`, directiva de `robots.txt`); ver P2-13 en [estado-actual.md](estado-actual.md).

## Para una IA

Leer primero `AGENTS.md` de la raíz, luego [estado-actual.md](estado-actual.md) y [arquitectura.md](arquitectura.md). Antes de tocar datos, leer `config.php` y el parcial correspondiente de `config/`.

No editar a mano los archivos generados:

- `assets/css/styles.css` → se genera con `php tools/build-css.php` desde `assets/css/src/`.
- `assets/js/cart.js` → se genera con `php tools/build-js.php` desde `assets/js/cart/`.

`assets/js/main.js` se mantiene a mano. Cualquier cambio de producto, precio, ruta o SEO debe salir de `config.php` o de `config/*.php`, que son la fuente de verdad.
