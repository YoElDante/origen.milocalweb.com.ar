# Guía de Pendientes SEO — Origen8.8

> **Objetivo**: Completar el SEO de `origen.milocalweb.com.ar` para que Google, ChatGPT, Gemini, Perplexity y otros motores con IA recomienden el negocio cuando alguien busque indumentaria deportiva para **bikers, corredores, trekking, chalecos para montaña, camperas outdoor, hidratación**, etc., en **Río Tercero y zona**.
>
> **Basado en**: lo que funcionó en `eznutrifit.milocalweb.com.ar` (schema.org, robots.txt, sitemap con imágenes, miniaturas para redes, pruebas en validadores).
>
> **Alcance**: catálogo con pedido asistido, multi-página (`home`, `productos`, `ofertas`, `accesorios`, `carrito`). Sin e-commerce completo: sin pasarelas, sin login, sin base de datos.

---

## Estado actual resumido

### ✅ Lo que ya existe

| Archivo | Qué tiene |
|---------|-----------|
| `config.php` | Campos SEO: `seo_keywords_primarias`, `seo_localidad`, `seo_provincia`, `seo_zona_influencia`, `seo_lat`, `seo_long`, `seo_og_image`, `seo_categorias`, `seo_marcas`, datos de ubicación. |
| `includes/header.php` | JSON-LD básico (`Store`, `WebSite`, `BreadcrumbList`, `ItemList`), Open Graph básico, canonical, meta robots, descripción. |
| `includes/catalogo.php` | `catalog_product_schema()` genera `Product` con `Offer` cuando el producto tiene precio. |
| `robots.txt` | Permite indexación, bloquea `/includes/` y `/tools/`, declara sitemap. |
| `sitemap.xml` | 5 URLs (`/`, `/productos`, `/ofertas`, `/accesorios`, `/carrito`) con prioridades. |
| `includes/sections/hero.php` | H1 en home: `"Indumentaria Deportiva en Río Tercero"`. |

### ⚠️ Lo que falta o está incompleto

- Geo tags (`geo.region`, `geo.placename`, `geo.position`, `ICBM`).
- Twitter Card.
- Open Graph: dimensiones de imagen (`og:image:width`, `og:image:height`), `og:image:alt`, `og:site_name`.
- Imagen OG de **1200×630 px** (la actual es un logo cuadrado WebP).
- JSON-LD `Store` incompleto: falta `image`, `logo`, `currenciesAccepted`, `paymentAccepted`, `priceRange`, `areaServed`, `hasMap`, `sameAs`, `author` (MiLocalWeb), `makesOffer`.
- JSON-LD de categorías y marcas como entidades.
- `FAQPage` (solo si se agrega una sección de preguntas frecuentes).
- Alt text optimizado en logo, hero, productos, local, footer.
- Jerarquía de headings en páginas internas y secciones.
- Sitemap con namespace de imágenes (`image:image`) y geo (`geo:geo`).
- `.htaccess`: forzar HTTPS y headers de caché para assets.
- Optimización de performance / Core Web Vitals.
- Google Search Console: verificación, sitemap, indexación.
- Google Business Profile: vincular URL y mantener NAP consistente.
- Sección SEO en `docs/ficha-cliente.md`.

---

## 1. Metadatos obligatorios en `<head>`

**Archivo**: `includes/header.php`

### 1.1 Meta tags básicos que faltan

Agregar o corregir:

```html
<meta name="author" content="milocalweb.com.ar">
<meta name="generator" content="MiLocalWeb">
<meta name="theme-color" content="#000000">
<meta name="mobile-web-app-capable" content="yes">
```

- `theme-color` debe venir de `$cliente['colors']['color-primary']`.
- `author` siempre `milocalweb.com.ar` (es la agencia creadora, no el cliente).

### 1.2 Title y description por página

| Página | Title sugerido | Description sugerida |
|--------|----------------|----------------------|
| Home | `Origen8.8 — Indumentaria Deportiva en Río Tercero, Córdoba` | `Origen8.8: ropa deportiva para running, trekking y bikes en Río Tercero. Calzas, shorts, tops, camperas y accesorios. Consultá stock y precio por WhatsApp. Envíos a Calamuchita y zona.` |
| Productos | `Productos — Origen8.8 en Río Tercero` | `Catálogo de indumentaria deportiva Origen8.8: remeras, calzas, bikers, shorts, pantalones y accesorios para running, trekking y bikes. Consultá por WhatsApp.` |
| Ofertas | `Ofertas — Origen8.8 en Río Tercero` | `Oportunidades y productos con descuento en indumentaria deportiva y outdoor en Origen8.8, Río Tercero. Pedí precio final por WhatsApp.` |
| Accesorios | `Accesorios — Origen8.8 en Río Tercero` | `Accesorios para running, trekking y bikes: lentes, hidratación, gorras, botellas y bolsos. Origen8.8 en Río Tercero.` |
| Carrito | `Mi pedido — Origen8.8` | `Prepará tu pedido de indumentaria deportiva en Origen8.8 y envialo por WhatsApp para confirmar stock y precio final.` |

**Reglas**:

- `<title>`: máximo 60 caracteres, incluir rubro + localidad.
- `<meta name="description">`: 150-160 caracteres, incluir productos + ubicación + CTA WhatsApp.
- Canonical: usar URL absoluta de cada página (no solo `/`).

### 1.3 Geo tags (obligatorio para SEO local)

```html
<meta name="geo.region" content="AR-X">
<meta name="geo.placename" content="Río Tercero, Córdoba, Argentina">
<meta name="geo.position" content="-32.1838792;-64.1177626">
<meta name="ICBM" content="-32.1838792, -64.1177626">
```

- Fuente: `$cliente['seo_lat']` y `$cliente['seo_long']`.

### 1.4 Open Graph completo

```html
<meta property="og:title" content="Origen8.8 — Indumentaria Deportiva en Río Tercero">
<meta property="og:description" content="Ropa deportiva para running, trekking y bikes en Río Tercero. Calzas, shorts, tops y accesorios. Consultá por WhatsApp.">
<meta property="og:type" content="website">
<meta property="og:locale" content="es_AR">
<meta property="og:url" content="https://origen.milocalweb.com.ar/">
<meta property="og:image" content="https://origen.milocalweb.com.ar/assets/img/cliente/seo/og-image-1200x630.webp">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Origen8.8 — Indumentaria deportiva en Río Tercero">
<meta property="og:site_name" content="Origen8.8">
```

### 1.5 Twitter Card

```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Origen8.8 — Indumentaria Deportiva en Río Tercero">
<meta name="twitter:description" content="Ropa deportiva para running, trekking y bikes en Río Tercero. Calzas, shorts, tops y accesorios. Consultá por WhatsApp.">
<meta name="twitter:image" content="https://origen.milocalweb.com.ar/assets/img/cliente/seo/og-image-1200x630.webp">
<meta name="twitter:image:alt" content="Origen8.8 — Indumentaria deportiva en Río Tercero">
```

---

## 2. Imágenes sociales / miniaturas

**Carpeta sugerida**: `assets/img/cliente/seo/`

### 2.1 Miniatura principal Open Graph (WhatsApp, Facebook, Instagram, LinkedIn)

- **Tamaño**: 1200×630 px.
- **Formato**: WebP con fallback JPG.
- **Contenido**: logo Origen8.8 + foto de producto (calza/biker/campera) + texto corto `"Indumentaria deportiva en Río Tercero"` + WhatsApp.
- **Nombre**: `og-image-1200x630.webp`.
- **Peso objetivo**: < 150 KB.

### 2.2 Logo cuadrado para Google / rich results

- **Tamaño**: 300×300 px o 600×600 px.
- **Fondo**: transparente o blanco.
- **Nombre**: `logo-300x300-transp.webp`.
- Se usa en JSON-LD `logo` e `image` del `Store`.

### 2.3 Favicon completo

Asegurar que exista:

```html
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/cliente/iconos/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/img/cliente/iconos/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/cliente/iconos/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
```

---

## 3. Structured Data — JSON-LD

**Archivo**: `includes/header.php`

### 3.1 Nodo `Store` completo

Incluir TODAS estas propiedades (omitir solo si el dato no existe):

```json
{
  "@type": "Store",
  "@id": "https://origen.milocalweb.com.ar/#store",
  "name": "Origen8.8",
  "slogan": "Línea tiempo libre",
  "description": "Indumentaria y accesorios para el tiempo libre en Río Tercero. Running, trekking y bikes.",
  "url": "https://origen.milocalweb.com.ar/",
  "telephone": "+5493571329870",
  "image": "https://origen.milocalweb.com.ar/assets/img/cliente/seo/logo-300x300-transp.webp",
  "logo": "https://origen.milocalweb.com.ar/assets/img/cliente/seo/logo-300x300-transp.webp",
  "currenciesAccepted": "ARS",
  "paymentAccepted": "Efectivo, Transferencia, Mercado Pago",
  "priceRange": "$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Ejército de los Andes 129",
    "addressLocality": "Río Tercero",
    "addressRegion": "Córdoba",
    "postalCode": "X5850",
    "addressCountry": "AR"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "-32.1838792",
    "longitude": "-64.1177626"
  },
  "hasMap": "https://maps.app.goo.gl/HUvBH4WQ8sBVuuQMA",
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      "opens": "09:00",
      "closes": "20:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Saturday",
      "opens": "09:00",
      "closes": "12:00"
    }
  ],
  "sameAs": [
    "https://www.instagram.com/origen8.8/"
  ],
  "areaServed": [
    { "@type": "City", "name": "Río Tercero" },
    { "@type": "State", "name": "Córdoba" },
    { "@type": "AdministrativeArea", "name": "Valle de Calamuchita" },
    { "@type": "AdministrativeArea", "name": "Almafuerte" },
    { "@type": "AdministrativeArea", "name": "Tancacha" },
    { "@type": "AdministrativeArea", "name": "Santa Rosa de Calamuchita" },
    { "@type": "AdministrativeArea", "name": "Embalse" },
    { "@type": "AdministrativeArea", "name": "Villa General Belgrano" }
  ],
  "makesOffer": [
    // Ver sección 3.4
  ],
  "author": {
    "@type": "Organization",
    "name": "MiLocalWeb",
    "url": "https://milocalweb.com.ar",
    "telephone": "+5493513783473",
    "description": "Páginas web para negocios locales — Diseño, SEO y presencia digital"
  }
}
```

### 3.2 `WebSite`

```json
{
  "@type": "WebSite",
  "@id": "https://origen.milocalweb.com.ar/#website",
  "url": "https://origen.milocalweb.com.ar/",
  "name": "Origen8.8",
  "inLanguage": "es-AR",
  "publisher": { "@id": "https://origen.milocalweb.com.ar/#store" }
}
```

### 3.3 `BreadcrumbList` por página

En `home`:

```json
{
  "@type": "BreadcrumbList",
  "@id": "https://origen.milocalweb.com.ar/#breadcrumb",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Indumentaria Deportiva en Río Tercero",
      "item": "https://origen.milocalweb.com.ar/"
    }
  ]
}
```

En páginas internas (`productos`, `ofertas`, `accesorios`, `carrito`):

```json
{
  "@type": "BreadcrumbList",
  "@id": "https://origen.milocalweb.com.ar/productos/#breadcrumb",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Inicio",
      "item": "https://origen.milocalweb.com.ar/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Productos",
      "item": "https://origen.milocalweb.com.ar/productos"
    }
  ]
}
```

### 3.4 `Product` + `Offer` por ítem del catálogo

Cada producto en `makesOffer` (o en `ItemList` de la página) debe generar:

```json
{
  "@type": "Product",
  "name": "Biker I-Run Mujer",
  "description": "Biker I-Run mujer, talle S al 2XL.",
  "image": "https://origen.milocalweb.com.ar/assets/img/cliente/productos/catalogo/biker-irun-mujer.webp",
  "category": "Indumentaria",
  "brand": {
    "@type": "Brand",
    "name": "Origen8.8"
  },
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock",
    "priceCurrency": "ARS",
    "price": "85000",
    "url": "https://wa.me/5493571329870?text=Hola!%20Vi%20Biker%20I-Run%20Mujer%20en%20tu%20web",
    "seller": {
      "@type": "Store",
      "name": "Origen8.8"
    }
  }
}
```

**Reglas importantes**:

- Si `mostrar_precio` es `false`, **NO emitir** `Offer.price`. Solo `availability` + `priceCurrency` + `businessFunction`.
- Si `disponible` es `false`, usar `https://schema.org/OutOfStock`.
- Cada producto debe tener URL canónica o link a WhatsApp.

### 3.5 Categorías como entidades `Product`

Usar `$cliente['seo_categorias']`:

```json
{
  "@type": "Product",
  "name": "Calzas",
  "category": "Indumentaria Deportiva",
  "description": "Calzas deportivas para running, gym y entrenamiento en Río Tercero."
}
```

### 3.6 Marcas como entidades `Organization`

Usar `$cliente['seo_marcas']`:

```json
{
  "@type": "Organization",
  "name": "Navajo",
  "description": "Marca de equipamiento para running, trail y trekking disponible en Origen8.8."
}
```

### 3.7 `FAQPage` (opcional)

Si se agrega una sección de preguntas frecuentes, incluir:

```json
{
  "@type": "FAQPage",
  "@id": "https://origen.milocalweb.com.ar/#faq",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿Hacen envíos a otras localidades?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sí, realizamos envíos a todo el Valle de Calamuchita, Villa General Belgrano, Embalse, Santa Rosa de Calamuchita, Almafuerte y Tancacha. Consultá por WhatsApp."
      }
    }
  ]
}
```

### 3.8 Reglas estrictas del JSON-LD

- `author` del `Store` debe ser `MiLocalWeb`, `+5493513783473`, `https://milocalweb.com.ar`.
- `sameAs`: solo incluir URLs que existan (filtrar vacíos con `array_filter`).
- `email`: si `$cliente['email']` está vacío, omitir la propiedad.
- `areaServed`: incluir Río Tercero, Córdoba y todas las localidades de `seo_zona_influencia`.
- Todo dato del JSON-LD debe tener evidencia en contenido visible (regla 2.6 de la guía eznutrifit).

---

## 4. HTML semántico y contenido visible

### 4.1 Jerarquía de headings

| Elemento | Regla | Ejemplo |
|----------|-------|---------|
| `<h1>` | Uno por página. Rubro + localidad. Sin slogan. | `"Indumentaria Deportiva en Río Tercero"` |
| `<h2>` | Título natural de cada sección. | `"Ropa deportiva"`, `"Accesorios deportivos"` |
| `<h3>` | Nombres de productos o subcategorías. | `"Biker I-Run Mujer"`, `"Remeras y musculosas — Hombre"` |

**Tareas**:

- [ ] `home`: mantener H1 actual, revisar que no haya otro H1.
- [ ] `productos.php`: H1 debe ser `"Productos"` o `"Productos — Indumentaria deportiva en Río Tercero"`.
- [ ] `ofertas.php`: H1 `"Ofertas"`.
- [ ] `accesorios.php`: H1 `"Accesorios"`.
- [ ] `carrito.php`: H1 `"Mi pedido"`.
- [ ] Cada sección del catálogo debe tener un `<h2>` descriptivo.
- [ ] Cada grupo debe tener un `<h3>` con la subcategoría.
- [ ] Cada producto debe tener su nombre en `<h3>` o `<h4>` (actualmente en `product-card.php`).

### 4.2 Distribución de keywords en contenido visible

Las keywords a cubrir:

- **Primaria**: `indumentaria deportiva Río Tercero`
- **Secundarias**: `ropa deportiva Río Tercero`, `running Río Tercero`, `trekking Río Tercero`, `bikes Río Tercero`, `calzas Río Tercero`, `shorts deportivos Río Tercero`, `tops deportivos Río Tercero`, `camperas outdoor Río Tercero`, `chalecos hidratación Río Tercero`, `lentes deportivos Río Tercero`, `accesorios para bikers Río Tercero`.
- **Zona de influencia**: `Valle de Calamuchita`, `Villa General Belgrano`, `Embalse`, `Santa Rosa de Calamuchita`, `Almafuerte`, `Tancacha`.

**Dónde ponerlas**:

| Ubicación | Qué incluir |
|-----------|-------------|
| `hero_descripcion` | `"Running, trekking y bikes en Río Tercero. Ropa, calzado y accesorios para todas tus actividades al aire libre. Atendemos el Valle de Calamuchita y el interior de Córdoba."` |
| `nosotros_texto` | Mencionar categorías y marcas (`Navajo`, `Kaizen`, calzas, camperas, chalecos, hidratación). |
| Subtítulos de sección | Incluir keywords de forma natural. |
| Alt text de imágenes | Producto + `Origen8.8 Río Tercero`. |

---

## 5. Alt text de imágenes

**Regla general**: `{Sujeto} — {Contexto} en {Localidad}`.

| Imagen | Alt text correcto |
|--------|-------------------|
| Logo navbar | `Logo Origen8.8 — Indumentaria deportiva en Río Tercero` |
| Logo hero | `Logo Origen8.8 — Indumentaria deportiva en Río Tercero` |
| Hero image | `Origen8.8 — Indumentaria deportiva para running, trekking y bikes en Río Tercero` |
| Producto destacado | `{Nombre producto} — Origen8.8 Río Tercero` |
| Producto del catálogo | `{Nombre producto} — Origen8.8` |
| Foto del local | `Local Origen8.8 en Ejército de los Andes 129, Río Tercero` |
| Mapa | `Mapa de Origen8.8 en Ejército de los Andes 129, Río Tercero` |
| Logo MiLocalWeb | `MiLocalWeb.com.ar — Páginas web para negocios locales` |
| Iconos SVG | `aria-hidden="true"` (decorativos) |

**Archivos a revisar**:

- `includes/header.php` (logo navbar)
- `includes/sections/hero.php` (logo + hero)
- `includes/sections/productos.php` (productos destacados)
- `includes/components/product-card.php` (catálogo)
- `includes/sections/nuestro-local.php`, `ubicacion.php`, `indumentaria.php`
- `includes/footer.php` (logo + MiLocalWeb)

---

## 6. Archivos técnicos

### 6.1 `robots.txt`

**Archivo actual**: `robots.txt`

Mejoras:

```txt
# MiLocalWeb — origen.milocalweb.com.ar
# Permite indexación completa de Google y Bing

User-agent: *
Allow: /

# Bloquear rastreo de archivos internos
Disallow: /config.php
Disallow: /includes/
Disallow: /docs/
Disallow: /tools/

# Crawl delay amigable
Crawl-delay: 10

Sitemap: https://origen.milocalweb.com.ar/sitemap.xml
```

### 6.2 `sitemap.xml`

**Archivo actual**: `sitemap.xml`

Mejoras:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:geo="http://www.google.com/geo/schemas/sitemap/1.0">
  <url>
    <loc>https://origen.milocalweb.com.ar/</loc>
    <lastmod>2026-10-03</lastmod>
    <changefreq>monthly</changefreq>
    <priority>1.0</priority>
    <geo:geo>
      <geo:format>georss</geo:format>
    </geo:geo>
    <image:image>
      <image:loc>https://origen.milocalweb.com.ar/assets/img/cliente/seo/logo-300x300-transp.webp</image:loc>
      <image:title>Origen8.8 — Logo</image:title>
    </image:image>
    <image:image>
      <image:loc>https://origen.milocalweb.com.ar/assets/img/cliente/seo/og-image-1200x630.webp</image:loc>
      <image:title>Origen8.8 — Indumentaria deportiva en Río Tercero</image:title>
    </image:image>
    <image:image>
      <image:loc>https://origen.milocalweb.com.ar/assets/img/cliente/identidad/origen-bolsa-paisaje.jpg</image:loc>
      <image:title>Origen8.8 — Hero</image:title>
    </image:image>
  </url>
  <url>
    <loc>https://origen.milocalweb.com.ar/productos</loc>
    <lastmod>2026-10-03</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>https://origen.milocalweb.com.ar/ofertas</loc>
    <lastmod>2026-10-03</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>https://origen.milocalweb.com.ar/accesorios</loc>
    <lastmod>2026-10-03</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://origen.milocalweb.com.ar/carrito</loc>
    <lastmod>2026-10-03</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>
</urlset>
```

- Actualizar `lastmod` en cada deploy.
- Incluir las imágenes más importantes en el nodo de home.

### 6.3 `.htaccess`

Verificar / agregar:

```apache
# Forzar HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]

# Cache de assets
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
</IfModule>

# Compresión
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/css application/javascript image/svg+xml
</IfModule>
```

---

## 7. Rendimiento y Core Web Vitals

### 7.1 Imágenes

- [ ] Convertir JPG/PNG restantes a WebP.
- [ ] Asegurar `loading="lazy"` en todas las imágenes que no sean hero/logo.
- [ ] Asegurar `width` y `height` explícitos para evitar CLS.
- [ ] Usar `fetchpriority="high"` solo en hero.
- [ ] Optimizar imágenes del catálogo a máximo 800 px de ancho.

### 7.2 CSS / JS

- [ ] Mantener CSS vanilla (sin frameworks).
- [ ] Revisar que no haya CSS crítico bloqueante innecesario.
- [ ] Defer o async en scripts no críticos.
- [ ] Minificar `styles.css`, `main.js`, `cart.js` en producción.

### 7.3 Métricas objetivo

| Métrica | Objetivo |
|---------|----------|
| LCP (Largest Contentful Paint) | < 2.5 s |
| INP (Interaction to Next Paint) | < 200 ms |
| CLS (Cumulative Layout Shift) | < 0.1 |
| FCP (First Contentful Paint) | < 1.8 s |

---

## 8. Google Search Console y presencia local

### 8.1 Verificación en Search Console

1. Ir a [Google Search Console](https://search.google.com/search-console).
2. Añadir propiedad tipo **Prefijo de URL**: `https://origen.milocalweb.com.ar`.
3. Método: **Etiqueta HTML**.
4. Copiar la meta tag y pegarla en `includes/header.php`.
5. Verificar.

### 8.2 Subir sitemap

1. En Search Console → Sitemaps.
2. Añadir `sitemap.xml`.

### 8.3 Solicitar indexación

1. Inspección de URLs → `https://origen.milocalweb.com.ar/`.
2. Solicitar indexación.
3. Repetir para `/productos`, `/ofertas`, `/accesorios`.

### 8.4 Google Business Profile

- Si el cliente tiene perfil, actualizar la URL a `https://origen.milocalweb.com.ar/`.
- Asegurar que el nombre, dirección y teléfono (NAP) coincidan exactamente con el JSON-LD.
- Subir fotos del local y productos.
- Pedir reseñas a clientes.

---

## 9. Checklist de implementación

### Fase A — Auditoría

- [ ] A.1 Leer `config.php` y confirmar todos los campos SEO.
- [ ] A.2 Revisar `includes/header.php` meta tags actuales.
- [ ] A.3 Validar JSON-LD actual en Schema.org Validator.
- [ ] A.4 Revisar `robots.txt` y `sitemap.xml`.
- [ ] A.5 Revisar headings en todas las páginas.
- [ ] A.6 Revisar alt text de todas las imágenes.

### Fase B — Meta tags y Open Graph

- [ ] B.1 Agregar `author`, `generator`, `theme-color`, `mobile-web-app-capable`.
- [ ] B.2 Agregar geo tags.
- [ ] B.3 Agregar `og:image:width`, `og:image:height`, `og:image:alt`, `og:site_name`.
- [ ] B.4 Agregar Twitter Card completo.
- [ ] B.5 Crear imagen OG 1200×630.

### Fase C — JSON-LD

- [ ] C.1 Completar nodo `Store` (`image`, `logo`, `currenciesAccepted`, `paymentAccepted`, `priceRange`, `areaServed`, `hasMap`, `sameAs`, `author`, `makesOffer`).
- [ ] C.2 Generar `Product` + `Offer` por cada producto del catálogo (respetar `mostrar_precio`).
- [ ] C.3 Agregar categorías como entidades `Product`.
- [ ] C.4 Agregar marcas como entidades `Organization`.
- [ ] C.5 Mejorar `BreadcrumbList` por página.
- [ ] C.6 Agregar `FAQPage` si se incluye sección de preguntas.
- [ ] C.7 Validar en Rich Results Test y Schema.org Validator.

### Fase D — Contenido visible

- [ ] D.1 Optimizar `hero_descripcion` con keywords y zona de influencia.
- [ ] D.2 Optimizar `nosotros_texto` con categorías y marcas.
- [ ] D.3 Revisar H1 de cada página.
- [ ] D.4 Revisar H2 y subtítulos de cada sección.
- [ ] D.5 Asegurar que cada producto tenga nombre en heading.
- [ ] D.6 Actualizar alt text en todas las imágenes.

### Fase E — Archivos técnicos

- [ ] E.1 Actualizar `robots.txt`.
- [ ] E.2 Actualizar `sitemap.xml` con imágenes y geo namespace.
- [ ] E.3 Verificar `.htaccess` (HTTPS + caché + compresión).
- [ ] E.4 Crear `site.webmanifest` y favicons si no existen.

### Fase F — Performance

- [ ] F.1 Convertir imágenes a WebP.
- [ ] F.2 Revisar lazy loading y dimensiones.
- [ ] F.3 Minificar CSS/JS.
- [ ] F.4 Medir con PageSpeed Insights.

### Fase G — Google y redes

- [ ] G.1 Verificar dominio en Search Console.
- [ ] G.2 Subir sitemap.
- [ ] G.3 Solicitar indexación.
- [ ] G.4 Validar Rich Results.
- [ ] G.5 Actualizar Google Business Profile.
- [ ] G.6 Probar previews en WhatsApp, Facebook, Instagram, Twitter.

### Fase H — Documentación

- [ ] H.1 Actualizar `docs/ficha-cliente.md` con sección SEO.
- [ ] H.2 Confirmar `seo_marcas` con el cliente (actualmente `Navajo`, `Kaizen`).
- [ ] H.3 Confirmar email del cliente o mantener vacío.

---

## 10. Herramientas de verificación

| Herramienta | URL | Para qué sirve |
|-------------|-----|----------------|
| Google Rich Results Test | https://search.google.com/test/rich-results | Validar JSON-LD |
| Schema.org Validator | https://validator.schema.org/ | Validar structured data |
| Open Graph Debugger | https://www.opengraph.xyz/ | Previews sociales |
| Meta Tags Preview | https://metatags.io/ | WhatsApp, Facebook, Twitter |
| Google PageSpeed Insights | https://pagespeed.web.dev/ | Performance y SEO básico |
| Google Search Console | https://search.google.com/search-console | Indexación y sitemap |
| Google Mobile-Friendly Test | https://search.google.com/test/mobile-friendly | Usabilidad móvil |
| WhatsApp Link Preview | Compartir link en un chat propio | Ver miniatura real |

---

## 11. Notas específicas para Origen8.8

### 11.1 Productos "a consultar"

Como no todos los productos tienen precio cargado, el JSON-LD debe respetar `mostrar_precio`. Si no hay precio, no emitir `Offer.price`. La descripción del `Offer` puede aclarar `"Consultar precio por WhatsApp"`.

### 11.2 Catálogo multi-página

A diferencia de EZ Nutrifit (single page), Origen tiene páginas separadas. Cada página debe tener:

- Title único.
- Meta description única.
- Canonical propia.
- BreadcrumbList propio.
- H1 propio.

### 11.3 Keywords de nicho

Priorizar en contenido visible y JSON-LD:

- `indumentaria deportiva Río Tercero`
- `ropa para correr Río Tercero`
- `ropa para bikers Río Tercero`
- `ropa de trekking Río Tercero`
- `chalecos para montaña Río Tercero`
- `camperas outdoor Río Tercero`
- `calzas deportivas Río Tercero`
- `lentes deportivos Río Tercero`
- `hidratación running Río Tercero`
- `bolsos deportivos Río Tercero`

### 11.4 Redes sociales

Actualmente solo hay Instagram. Si el cliente abre Facebook o TikTok, agregar las URLs a `config.php` y al JSON-LD `sameAs`.

### 11.5 Email del cliente

`config.php` tiene `'email' => ''`. Mantener vacío hasta que el cliente lo confirme. No inventar email en JSON-LD.

---

## 12. Ejemplo de sección SEO para `docs/ficha-cliente.md`

```markdown
## SEO

- **Keywords primarias**: Indumentaria Deportiva
- **Keywords de producto**: running, trekking, bikes, calzas, shorts, tops, camperas outdoor, chalecos para montaña, lentes deportivos, hidratación
- **Localidad**: Río Tercero
- **Provincia**: Córdoba
- **Zona de influencia**: Valle de Calamuchita, Almafuerte, Tancacha, Santa Rosa de Calamuchita, Embalse, Villa General Belgrano
- **Coordenadas (lat, long)**: -32.1838792, -64.1177626
- **Google Maps link**: https://maps.app.goo.gl/HUvBH4WQ8sBVuuQMA
- **Google Business Profile URL**: *(pendiente)*
- **Dominio**: https://origen.milocalweb.com.ar
- **Marcas destacadas**: Navajo, Kaizen
```

---

## 13. Resumen ejecutivo

Para que Google y las IAs recomienden Origen8.8 por indumentaria deportiva en Río Tercero y zona, hay que completar **cuatro pilares**:

1. **Metadatos y Open Graph**: geo tags, Twitter Card, imagen 1200×630, titles/descriptions por página.
2. **JSON-LD completo**: `Store` con todos los campos, `Product` + `Offer` por ítem, categorías, marcas, breadcrumbs.
3. **Contenido visible coherente**: headings, alt text, descripciones con keywords de nicho.
4. **Técnico y presencia**: robots.txt, sitemap con imágenes, HTTPS, caché, Search Console, Google Business Profile.

Sin el JSON-LD y sin la imagen social, el sitio es casi invisible para IAs y redes. Esas dos tareas son las de mayor impacto.
