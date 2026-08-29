# Plan de Desarrollo — Landing Page Origen

> **Proyecto:** origen.milocalweb.com.ar
> **Cliente:** Origen Run & Bike — Ropa e indumentaria deportiva (running · trekking · bikes)
> **Localidad:** Río Tercero, Córdoba
> **Referencia de arquitectura:** eznutrifit.milocalweb.com.ar (misma estructura técnica y de secciones, identidad gráfica propia)
> **Fuentes de verdad:** `docs/ficha-cliente.md` (datos), `docs/informe_estilo_origen.md` (identidad visual), este documento (plan de implementación)

---

## 1. Alcance y Objetivos

Construir la landing page de Origen sobre el template MiLocalWeb, replicando la
arquitectura probada de EZ Nutrifit (CSS modular + Critical CSS, build en deploy,
secciones reutilizables, SEO local con JSON-LD) pero con:

- **Identidad visual propia**: tema **claro**, estética natural/atlética
  (opuesto al dark-neon de EZ Nutrifit), según `informe_estilo_origen.md`.
- **Copy real** extraído de las publicaciones de Instagram del cliente (capturado
  en los `.txt` junto a cada asset y volcado en este documento — los `.txt` se
  eliminan en la Fase 0).
- **Contenido en video**: Origen tiene 4 videos propios; la sección Reels replica
  el patrón de EZ Nutrifit (3 cards + link a Instagram).

La página NO es e-commerce: es vitrina, captación de leads y canal a WhatsApp.

---

## 2. Datos del Cliente

Fuente: `docs/ficha-cliente.md`.

| Campo | Valor |
|---|---|
| Nombre comercial | Origen (en Google Business: **"Origen Run & Bike"** — usar ese nombre en SEO) |
| Slogan | *Sabemos dónde empieza, no dónde termina* |
| Rubro | Ropa e indumentaria deportiva — running, trekking y bikes |
| WhatsApp | `5493571329870` |
| Instagram | https://www.instagram.com/origen8.8/ |
| Dirección | Ejército de los Andes 129, X5850, Río Tercero, Córdoba |
| Coordenadas | lat `-32.1838792` / lng `-64.1177626` |
| Horarios | Lun a Vie 9:00–20:00 · Sáb 9:00–12:00 · Dom cerrado |
| Reseñas | 1 reseña → `mostrar_estrellas = false` (prueba social insuficiente) |
| Maps embed | `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3376.755...!2sorigen%20run%20%26%20bike...` (normalizar zoom a `!1d1500`) |
| Maps link | https://maps.app.goo.gl/HUvBH4WQ8sBVuuQMA |

**Nota SEO:** el nombre en Google Business Profile es *"Origen Run & Bike"*.
Recomendación: `'nombre' => 'Origen Run & Bike'` en `config.php` para que el
title tag y el JSON-LD coincidan con el perfil (refuerza indexación local).
El logo ya comunica "ORIGEN" visualmente.

---

## 3. Identidad Gráfica → Tokens de Diseño

Fuente: `docs/informe_estilo_origen.md`. **Tema claro** (fondo blanco, texto
oscuro): lo inverso a EZ Nutrifit. No reutilizar sus tokens de color.

### 3.1 Paleta

```css
:root {
  /* ── Primarios ── */
  --color-primary:        #000000;  /* CTAs, titulares, navbar */
  --color-primary-hover:  #2b2b2b;
  --color-accent:         #00bbaa;  /* Cyan Sport: ofertas, badges, subrayados */
  --color-accent-hover:   #2accb8;
  --color-text:           #2b2b2b;  /* cuerpo de texto */
  --color-muted:          #5c7c8a;  /* Slate Blue: metadatos, íconos secundarios */
  --color-bg:             #ffffff;
  --color-bg-alt:         #e5e5e5;  /* secciones alternadas / hormigón claro */
  --color-card-bg:        #dfd3ca;  /* Nude Térreo: cards de producto */

  /* ── Extendidos (colecciones) ── */
  --color-soft-aqua:      #8eaaaf;  /* banners institucionales ("renovando") */
  --bg-verano-fem:        #dfd3ca;  /* colección Verano Fem */
  --bg-verano-fem-dark:   #d4c5bb;  /* hover / contenedores secundarios */
  --texture-stone:        url('/assets/img/cliente/identidad/textura-fondo-piedra.webp');
}
```

Mapeo a `config.php` (`colors[]`): las claves estándar se llenan con los valores
de arriba y se **agregan** las claves extendidas (`color-slate-blue`,
`color-soft-aqua`, `color-verano-fem`, `color-verano-fem-dark`). Agregar claves
está permitido; quitar obligatorias, no.

### 3.2 Tipografías (auto-hospedadas en `assets/fonts/`)

| Rol | Fuente | Pesos | Uso |
|---|---|---|---|
| Logo / lema circular | **Space Mono** | 400, 700 | "ORIGEN", lema *"Sabemos dónde empieza…"* |
| Titulares (H1–H3, botones) | **Oswald** | 500, 700 | Mayúsculas sostenidas, condensada |
| Acento editorial (itálica) | **Playfair Display Italic** | 500 | Palabras sueltas dentro de titulares: *running*, *en el gym* |
| Cuerpo | **Open Sans** | 400, 600 | Descripciones, señalética, body |

Reglas:

- Formato **woff2** con `unicode-range` (latin + latin-ext), `font-display: swap`,
  declaradas en `assets/fonts/fonts.css` — mismo patrón que EZ Nutrifit.
- **Firma tipográfica de Origen:** titulares Oswald en mayúsculas con una
  palabra en Playfair Display Italic (mezcla editorial/deportiva que usa la
  marca en sus placas). Ej: `INDISPENSABLES <em>running</em>`.
- Nunca cargar desde Google Fonts CDN: todo local para Lighthouse.

### 3.3 Texturas y Tratamiento Visual

- **Textura piedra (`textura-fondo-piedra.webp`)** en: fondo del Hero, banda
  del Footer y (opcional) tarjetas destacadas. Opacidad baja, no invasiva.
- **Botones CTA:** fondo `#000000`, texto `#FFFFFF`, Oswald uppercase.
  Variante acento `#00bbaa` para ofertas.
- **Tarjetas de producto:** fondo Nude `#DFD3CA`, hover `#D4C5BB`.
- **Collaging** (estilo de la marca): composiciones con la imagen duplicada
  detrás a menor opacidad — replicar en el Hero y en la sección Destacados
  con `::before` + `background-image` a ~15% opacity.
- **Sombras suaves arrojadas** en fotos de producto, recortes limpios.

---

## 4. Estado Actual del Proyecto

| Elemento | Estado |
|---|---|
| `index.php`, `config.php`, `includes/` (header, footer, 6 secciones base) | ✅ Scaffold del template, con placeholders |
| `AGENTS.md` | ✅ Versión base (desactualizada: no menciona estrella/reels/CSS modular → actualizar en Fase 5) |
| `assets/img/` | ⚠️ Assets crudos: nombres con espacios/mayúsculas, `.txt` mezclados, estructura sin convención |
| `assets/vid/` | ✅ 4 videos + carátulas (renombrar) |
| `assets/css/`, `assets/js/`, `assets/fonts/`, `tools/` | ❌ No existen → replicar de EZ Nutrifit |
| `robots.txt`, `sitemap.xml` | ❌ Faltan |
| `includes/secrets.php` | ❌ Falta (API key Google Static Maps, copiar patrón de EZ Nutrifit) |

---

## 5. Arquitectura Destino (réplica de EZ Nutrifit)

```
origen.milocalweb.com.ar/
├── index.php                  ← Orden de secciones (ver §6)
├── config.php                 ← Única fuente de datos
├── robots.txt / sitemap.xml   ← Nuevos
├── tools/build-css.php        ← Copiar de eznutrifit sin cambios
├── assets/
│   ├── css/  base · navbar · hero · estrella · sections · aside ·
│   │         clientes · footer · responsive  (fuentes modulares)
│   │         critical.css (inline en header) · styles.css (artefacto build)
│   ├── fonts/ fonts.css + woff2 (Space Mono, Oswald, Playfair It, Open Sans)
│   ├── js/    back-to-top · navbar · smooth-scroll · reels
│   ├── img/
│   │   ├── cliente/  logos · iconos · identidad · productos · campanas · local
│   │   ├── milocalweb/  (copiar de eznutrifit)
│   │   └── svg/         (copiar de eznutrifit: whatsapp, instagram, pin, etc.)
│   └── vid/reels/  3 mp4 + 3 posters webp
├── includes/
│   ├── header.php   ← <head> SEO + Critical CSS inline + navbar sticky
│   ├── footer.php   ← Footer MiLocalWeb + WhatsApp float
│   ├── secrets.php  ← GOOGLE_MAPS_API_KEY
│   └── sections/  hero · estrella · productos · nosotros · aside ·
│                  ubicacion · reels · clientes
└── docs/  (este plan, ficha-cliente, informe_estilo)
```

Reglas técnicas heredadas (no renegociar): PHP 7.4+ plano, vanilla JS,
mobile-first, `htmlspecialchars()` en todo output, cache-busting por `filemtime`,
`styles.css` es **artefacto de build** (nunca editarlo a mano; correr
`php tools/build-css.php` tras cada cambio en `assets/css/*.css`).

---

## 6. Estructura de Secciones (orden en `index.php`)

Orden replicado de EZ Nutrifit, con `nosotros` incorporado (Origen sí tiene
historia y fotos del local):

1. **Hero** `#inicio` — `hero.php`
2. **Destacados** (producto estrella/campaña) `#destacados` — `estrella.php`
3. **Productos** `#productos` — `productos.php`
4. **Nosotros** `#nosotros` — `nosotros.php`
5. **Aside publicitario** — `aside.php` (desktop: sidebar; mobile: banner)
6. **Ubicación** `#ubicacion` — `ubicacion.php`
7. **Reels / Videos** `#reels` — `reels.php`
8. **Otros clientes** — `clientes.php` (logos en escala de grises)
9. **Footer** + WhatsApp float — `footer.php`

### 6.1 Hero (`hero.php`)

- **Layout:** `split` (imagen izquierda con gradiente, texto derecha). Si la
  imagen elegida no acompaña el split, caer a `img-right`.
- **Fondo:** textura piedra sobre blanco → degrade hacia Nude `#DFD3CA`.
- **Imagen (decisión, ver §13):** `origen-bolsa-paisaje.jpg` (identidad de
  marca, dialoga con el slogan) o `local-1.webp`. No existe `hero.jpg`.
- **H1:** `Indumentaria Deportiva en Río Tercero` (keyword + localidad, como
  EZ Nutrifit). Palabra *deportiva* en Playfair Italic opcional.
- **Descripción:** *"Algo más que un local de indumentaria. Running, trekking
  y bikes: ropa, calzado y accesorios para volver a lo esencial."*
- **CTAs:** WhatsApp (negro) + "Conocenos en Instagram" (variante acento).
- **Collaging:** imagen duplicada al fondo a baja opacidad.

### 6.2 Destacados — `estrella.php` (hardcodeado)

Showcase "Colección Verano" con paleta Nude (bloque de color de identidad
Verano Fem del informe). Estructura igual a EZ Nutrifit: 1 imagen grande +
grid de 3 cards secundarias con overlay descriptivo.

| Slot | Asset | Copy (real del cliente) |
|---|---|---|
| Principal | `verano-fem-1.jpg` | **Nueva Colección Verano** — "Telas frescas y diseños que acompañan cada paso, dentro y fuera del entrenamiento." |
| Secundaria 1 | `indispensable-ella.jpg` | *Indispensables ella* — "Calzas y camisetas técnicas, accesorios de hidratación, indumentaria para cada deporte." |
| Secundaria 2 | `indispensable-el.jpg` | *Indispensables él* — "Kilómetros que se sienten livianos." |
| Secundaria 3 | `outdoor-campera.jpg` | *Outdoor real* — "Telas impermeables que te mantienen seco y cómodo en todo momento." |

- Título de sección: `INDISPENSABLES` (Oswald) + palabra acento *verano*
  (Playfair Italic).
- Fondo de la sección: `--bg-verano-fem` → aplica el tema Nude del informe.
- CTA: "Consultame por WhatsApp" (negro).

### 6.3 Productos (`productos.php`, datos desde `config.php`)

3 cards (mismo markup de EZ Nutrifit: imagen, nombre, descripción, botón
WhatsApp individual con mensaje por producto). Fondo de card Nude
`#DFD3CA`, hover `#D4C5BB`.

| # | Nombre | Descripción | Imagen |
|---|---|---|---|
| 1 | Short con calza interna | Doble capa: short + calza. Ajuste seguro, tela respirable, liviana y fresca. Ideal running, gym y entrenamientos intensos. | `short-con-calza.webp` |
| 2 | Short sin calza interna | Corte clásico y versátil, secado rápido, cintura regulable. Perfecto para running, ciclismo o uso diario. | `short-sin-calza.webp` |
| 3 | Tops | Comodidad, hermosura y calidad. Diseños que acompañan cada entrenamiento. | `tops.webp` |

Título: `Ropa Deportiva` + subtítulo con keywords locales (running, trekking,
bikes — Río Tercero).

### 6.4 Nosotros (`nosotros.php`)

- **Texto (real):** *"Volver al Origen es volver a lo que te hace bien. Es
  escuchar al cuerpo y moverse con él, no contra él. Es perderse en la
  montaña y encontrarse. Así nació Origen: de la necesidad de reconectar.
  Hoy Origen son clientes amigos que eligen moverse, sentirse vivos y volver
  a lo esencial."*
- **Galería:** `local-1.webp`, `local-2.webp` (interior del local).
- **Redes:** Instagram (`origen8.8`) + Sitio web.
- **CTA final** a WhatsApp.
- Detalle de identidad: texto del slogan en Space Mono como cita decorativa.

### 6.5 Aside Publicitario (`aside.php`)

Estándar MiLocalWeb (autopromoción → milocalweb.com.ar#contacto), discreto,
configurable vía `config.php`. Copiar de EZ Nutrifit.

### 6.6 Ubicación (`ubicacion.php`)

Un solo punto de venta (a diferencia de los 4 de EZ Nutrifit):

- Logo Origen + "Origen Run & Bike".
- Dirección, horarios, botón "Llevame allí".
- Mapa: Static Maps con API key (patrón `secrets.php`) o fallback iframe embed
  (normalizar `!1d1500`). Atributos `lat/lng` ya extraídos (§2).
- `mostrar_estrellas = false`.

### 6.7 Reels (`reels.php`, hardcodeado)

3 cards verticales, `preload="none"` (0 KB hasta play), poster WebP, botón
play custom + `reels.js`. Mismo patrón que EZ Nutrifit.

| Video | Poster | Título / descripción (copy real) |
|---|---|---|
| `volver-al-origen.mp4` | carátula → `volver-al-origen.webp` | **¿Qué significa volver al Origen?** — La historia de la marca: reconectar con el cuerpo y la montaña. |
| `pantalones-cargo-tecnicos.mp4` | carátula → `pantalones-cargo-tecnicos.webp` | **Pantalones cargo técnicos** — Impermeables, 8 bolsillos, corte recto o gaucha, talles M–4XL. |
| `lentes-deportivos.mp4` | carátula → `lentes-deportivos.webp` | **Lentes deportivos** — Lente panorámica espejada + UV400. Bici, trail y running. |

El 4° video (`chaleco y cinturones de hidratación - Navajo.mp4`) queda en el
banco de assets: rotación futura o reemplazo (la card es fija de a 3 por
grilla). Link final "Seguinos en Instagram".

### 6.8 Clientes + Footer (`clientes.php`, `footer.php`)

Estándar MiLocalWeb: logos de otros clientes en escala de grises (usar los
mismos assets de `assets/img/terceros/` de EZ Nutrifit: Freebox, Henko,
Somaginci) y footer con badge, CTA, copyright y back-to-top.

---

## 7. Inventario y Renombrado de Assets

Convención: `kebab-case`, sin espacios ni mayúsculas, bajo
`assets/img/cliente/`. Los `.txt` se eliminan **después** de Fase 0 (el copy
ya está volcado en §6). Prioridad **WebP** (convertir los JPG grandes).

| Actual | Destino |
|---|---|
| `img/logos/origen logo limpio 600x600 transp.webp` | `img/cliente/logos/logo-600x600-transp.webp` (navbar/hero) |
| `img/logos/origen logo hd transp 1024x1008.png` | `img/cliente/logos/logo-1024-transp.png` → generar webp |
| `img/logos/origen logo hd.png` (+ variantes 300/600/800) | recortes `logo-{300,600,800}.webp` según uso |
| `icons/origen icono.ico` | `img/cliente/iconos/favicon.ico` |
| `img/texturas/textura fondo piedra.webp` | `img/cliente/identidad/textura-fondo-piedra.webp` |
| `img/productos/shortMasculino1.webp` | `img/cliente/productos/short-con-calza.webp` |
| `img/productos/shortMasculino2.webp` | `img/cliente/productos/short-sin-calza.webp` |
| `img/productos/tops.webp` | `img/cliente/productos/tops.webp` |
| `img/productos/chaleco en montaña.webp`, `chaleco montañismo navajo.webp`, `cinturon de hidratacion - Navajo.webp` | `img/cliente/productos/navajo-chaleco.webp`, `navajo-chaleco-montana.webp`, `navajo-cinturon-hidratacion.webp` *(banco: productos alternativos)* |
| `img/campañas/verano fem.jpg` / `verano fem 2.jpg` | `img/cliente/campanas/verano-fem-1.webp` / `verano-fem-2.webp` |
| `img/indispensables/indispensable el.jpg` / `... ella.jpg` | `img/cliente/campanas/indispensable-el.webp` / `indispensable-ella.webp` |
| `img/ofertas/outdoor.jpg` / `outdoor-campera.jpg` / `outdoor-colorcrema.jpg` | `img/cliente/campanas/outdoor-1.webp` / `outdoor-campera.webp` / `outdoor-colorcrema.webp` |
| `img/identidad/origen bolsa paisaje.jpg` | `img/cliente/identidad/origen-bolsa-paisaje.webp` (candidato Hero) |
| `img/identidad/renovando.jpg` | `img/cliente/identidad/renovando.webp` (banco: banner institucional, fondo `--color-soft-aqua`) |
| `img/interior del local/interiorLocal1.webp` / `2` | `img/cliente/local/local-1.webp` / `local-2.webp` |
| `vid/identidad/Que significa volver al Origen .mp4` + Caratula.jpg | `vid/reels/volver-al-origen.mp4` + `volver-al-origen.webp` |
| `vid/productos/video pantalones.mp4` + caratula | `vid/reels/pantalones-cargo-tecnicos.mp4` + `.webp` |
| `vid/productos/Lentes deportivos.mp4` + caratula | `vid/reels/lentes-deportivos.mp4` + `.webp` |
| `img/productos/chaleco y cinturones de hidratación - Navajo.mp4` | *(banco — no en v1)* |
| — (crear) | `img/cliente/logos/og-image-1200x630.webp` (logo + textura piedra + lema) |

Copiar tal cual desde EZ Nutrifit: `assets/img/milocalweb/`, `assets/img/svg/`,
`assets/img/terceros/` (logos Freebox/Henko/Somaginci para §6.8).

---

## 8. Mapeo `config.php`

Claves estándar del template + extensiones. Resumen de valores:

```php
'nombre'    => 'Origen Run & Bike',
'slogan'    => 'Sabemos dónde empieza, no dónde termina',
'rubro'     => 'Ropa e indumentaria deportiva — Running · Trekking · Bikes',
'whatsapp'  => '5493571329870',
'whatsapp_mensaje' => 'Hola! Vi tu web y quisiera más info',

'hero_layout'      => 'split',
'hero_descripcion' => 'Algo más que un local de indumentaria. Running, trekking y bikes: ropa, calzado y accesorios para volver a lo esencial.',
'hero_boton'       => 'Escribinos por WhatsApp',
'hero_img'         => '/assets/img/cliente/identidad/origen-bolsa-paisaje.webp',

'logo_img'         => '/assets/img/cliente/logos/logo-600x600-transp.webp',
'favicon'          => '/assets/img/cliente/iconos/favicon.ico',

// 'colors' → §3.1 (tema claro + extendidos Nude/Slate/Aqua)
// 'tipografia' → '"Open Sans", system-ui, ...' (las demás van por fonts.css)

'productos'        → 3 productos de §6.3 (rutas relativas a /assets/img/)

'direccion'   => "Ejército de los Andes 129\nX5850\nRío Tercero\nCórdoba, Argentina",
'gmaps_embed' => embed de §2 (zoom !1d1500), 'gmaps_link' => maps.app.goo.gl/HUvBH4WQ8sBVuuQMA,
'mostrar_estrellas' => false,
'horario'     => 'Lunes a Viernes 9:00-20:00 | Sábados 9:00-12:00 | Domingo Cerrado',

'redes' => ['instagram' => 'https://www.instagram.com/origen8.8/', 'web' => 'https://origen.milocalweb.com.ar'],

'nosotros_texto'  => texto de §6.4,
'nosotros_galeria' => local-1.webp + local-2.webp,
```

Nuevas claves SEO (mismo patrón que EZ Nutrifit):

```php
'seo_keywords_primarias' => 'Indumentaria Deportiva',
'seo_localidad'  => 'Río Tercero',
'seo_provincia'  => 'Córdoba',
'seo_zona_influencia' => 'Valle de Calamuchita, Almafuerte, Tancacha, Santa Rosa de Calamuchita, Embalse, Villa General Belgrano',
'seo_lat' => '-32.1838792', 'seo_long' => '-64.1177626',
'seo_og_image' => '/assets/img/cliente/logos/og-image-1200x630.webp',
'og_descripcion' => 'Indumentaria deportiva en Río Tercero. Running, trekking y bikes. Calzas, shorts, tops y accesorios. ¡Escribinos por WhatsApp!',
'seo_categorias' => ['Running', 'Trekking', 'Bikes', 'Calzas', 'Shorts', 'Tops', 'Camperas outdoor', 'Hidratación', 'Lentes deportivos'],
'seo_marcas' => ['Navajo', 'Kaizen'],  // confirmar con el cliente (§13)
```

---

## 9. SEO y Datos Estructurados

- **Title:** `Origen Run & Bike — Indumentaria Deportiva en Río Tercero`
- **Meta description:** armada desde `og_descripcion` / hero (≤160 chars).
- **Canonical:** `https://origen.milocalweb.com.ar/`
- **Open Graph:** `og:title`, `og:description`, `og:image` (1200×630 nueva),
  `og:type=website`, `og:locale=es_AR`.
- **JSON-LD `@graph`:** `Store` (name, slogan, address, geo, telephone,
  openingHours de §2, sameAs Instagram) + `Product`/`Offer` por producto de
  config y por categoría con imagen (patrón literal de `header.php` de
  EZ Nutrifit — category = "Indumentaria Deportiva").
- **robots.txt + sitemap.xml:** copiar de EZ Nutrifit y ajustar dominio.
- **H1 único** (hero), `<h2>` por sección, `<h3>` en cards, alt descriptivo
  con nombre + rubro + localidad en toda imagen.
- **Google Business:** verificar que la landing esté linkeada en el perfil
  "Origen Run & Bike" (dirección §2).

---

## 10. Rendimiento (objetivo: Lighthouse ≥ 90 móvil)

Técnicas ya validadas en EZ Nutrifit (ver sus informes Lighthouse en
`eznutrifit.milocalweb.com.ar/docs/`):

- Critical CSS inline (`critical.css` → variables, reset, navbar, hero) +
  bundle async via `tools/build-css.php`.
- Fuentes locales woff2 con `font-display: swap` y preload de las 2 críticas
  (Oswald 700, Open Sans 400).
- Imágenes WebP, `width/height` explícitos, `loading="lazy"` (solo hero eager
  con `fetchpriority="high"`).
- Videos `preload="none"` + poster + botón play (0 KB hasta interacción).
- Sin frameworks, sin jQuery, SVG inline.
- Checklist post-implementación: correr Lighthouse móvil/desktop (instante,
  navegación, timespan) y guardar resúmenes en `docs/` como en EZ Nutrifit.

---

## 11. Plan de Trabajo por Fases

### Fase 0 — Preparación de assets
- [ ] Capturar copy de los `.txt` (ya está en §6 de este documento) y **eliminar los .txt**
- [ ] Renombrar/mover todo según §7; convertir JPG → WebP
- [ ] Copiar `milocalweb/`, `svg/`, `terceros/` desde EZ Nutrifit
- [ ] Generar favicon + `og-image-1200x630`
- [ ] Normalizar `gmaps_embed` (zoom `!1d1500`)

### Fase 1 — Infraestructura (copiar de EZ Nutrifit)
- [ ] `tools/build-css.php`, `assets/css/*` (modular + critical), `assets/fonts/fonts.css`
- [ ] Descargar woff2 de Space Mono, Oswald, Playfair Italic, Open Sans (latin/latin-ext)
- [ ] `assets/js/` (back-to-top, navbar, smooth-scroll, reels)
- [ ] `includes/header.php`, `footer.php`, `secrets.php` adaptados a Origen

### Fase 2 — `config.php`
- [ ] Llenar todas las claves según §8 (cero placeholders)
- [ ] Agregar claves de color extendidas (§3.1)

### Fase 3 — Secciones (en orden §6)
- [ ] `hero.php` — split + textura piedra + collaging + firma tipográfica
- [ ] `estrella.php` — "Colección Verano" sobre Nude (hardcodeado §6.2)
- [ ] `productos.php` — 3 cards Nude + WhatsApp por producto
- [ ] `nosotros.php` — historia + galería local + redes + CTA
- [ ] `aside.php`, `ubicacion.php`, `reels.php` (hardcodeado §6.7), `clientes.php`
- [ ] `footer.php` + WhatsApp float funcionales

### Fase 4 — SEO
- [ ] Head completo: title, meta, OG, canonical, JSON-LD Store+Products
- [ ] `robots.txt` + `sitemap.xml`
- [ ] Revisar jerarquía H1/H2/H3 y alt texts

### Fase 5 — QA y cierre
- [ ] `php tools/build-css.php` (y después de cada cambio CSS)
- [ ] Checklist §8 de `AGENTS.md` de Origen (footer, aside, float, meta, HTTPS, responsive)
- [ ] Actualizar `AGENTS.md` de Origen a la arquitectura nueva (estrella/reels/CSS modular/skill)
- [ ] Probar en `php -S localhost:8080` → mobile + desktop, links WhatsApp/maps/redes
- [ ] Lighthouse móvil/desktop → guardar resúmenes en `docs/`

---

## 12. Decisiones de Diseño Clave (resumen)

| Decisión | Elección | Razón |
|---|---|---|
| Tema | Claro (blanco + texto `#2B2B2B`) | Identidad Origen ≠ dark de EZ Nutrifit |
| CTA | Negro/Blanco, Oswald uppercase | Regla del informe de estilo |
| Acento | Cyan Sport `#00BBAA` | Energía deportiva, ofertas |
| Bloques de colección | Nude `#DFD3CA` (fem), Slate `#5C7C8A` (masc) | Colores de campaña identificados |
| Textura piedra | Hero + Footer (opacidad baja) | Identidad outdoor/street |
| Tipografía mixta | Oswald caps + palabra en Playfair Italic | Firma de las placas de la marca |
| Nombre SEO | "Origen Run & Bike" | Coincidir con Google Business Profile |
| Hero | `split` + `origen-bolsa-paisaje` | Imagen de marca disponible (no hay `hero.jpg`) |

---

## 13. Pendientes con el Cliente

- [ ] **Imagen Hero:** confirmar entre `origen-bolsa-paisaje` (propuesta) /
  `local-1` / foto nueva.
- [ ] Email de contacto (vacío en ficha).
- [ ] Mensaje por defecto de WhatsApp (propuesto: *"Hola! Vi tu web y quisiera más info"*).
- [ ] Confirmar marcas vendidas (se detectó **Navajo / Kaizen** en el chaleco
  de hidratación) para `seo_marcas` y posible sección de marcas.
- [ ] Medios de pago ("todas las tarjetas · % en efectivo") → ¿badge en Ubicación?
- [ ] Confirmar si los precios de posts (ej. pantalones $48.000) van en la web
  o quedan solo para WhatsApp (recomendación: solo WhatsApp, evitar precios desactualizados).

---

## 14. Reglas Inquebrantables

Véanse §5–§6 del `AGENTS.md` de este proyecto. Resumen operativo:

- `config.php` es la única fuente de datos; secciones hardcodeadas solo
  `estrella.php` y `reels.php`.
- Nunca eliminar: footer MiLocalWeb, aside publicitario, WhatsApp float.
- Colores solo por variables CSS desde `config.php`; jamás hardcodeados en PHP.
- `styles.css` nunca a mano → build. Sin lorem ipsum. `htmlspecialchars()` siempre.
- Nombres de assets en kebab-case, sin espacios ni mayúsculas.
- Ante dato faltante: mostrar "Próximamente" y anotarlo en §13 — no inventar.
