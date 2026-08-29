# Origen Run & Bike — Landing Page

Landing page profesional y optimizada para SEO del negocio **Origen Run & Bike**, ubicado en Río Tercero, Córdoba, Argentina.

> **En vivo:** [https://origen.milocalweb.com.ar/](https://origen.milocalweb.com.ar/)

---

## Sobre el proyecto

Origen es un local de indumentaria deportiva especializado en **running, trekking y bikes**. Esta landing funciona como hub central del negocio: presenta los productos destacados, la ubicación con mapa, las redes sociales y canaliza las consultas directamente a WhatsApp.

Desarrollada con el template de **MiLocalWeb** (`milocalweb.com.ar`), pensado para negocios locales que necesitan presencia digital, captación de leads y mejor posicionamiento en Google.

---

## Tecnologías

- **PHP 7.4+** plano, sin frameworks
- **HTML5 semántico**
- **CSS3** con custom properties (variables CSS)
- **JavaScript** vanilla (sin frameworks)
- **Google Fonts** (Open Sans)
- **SVG inline** para iconos

---

## Estructura del repositorio

```
.
├── index.php                 # Entry point
├── config.php                # Fuente única de datos del sitio
├── .htaccess                 # HTTPS forzado, caché y seguridad
├── assets/
│   ├── css/styles.css        # Estilos base + variables CSS
│   ├── js/main.js            # Interacciones esenciales
│   └── img/                  # Imágenes del cliente y de MiLocalWeb
├── includes/
│   ├── header.php            # <head>, navbar e inicio del <main>
│   ├── footer.php            # Footer MiLocalWeb + WhatsApp float
│   └── sections/             # Secciones de la landing
│       ├── hero.php
│       ├── productos.php
│       ├── ubicacion.php
│       ├── nosotros.php
│       ├── aside.php
│       ├── clientes.php
│       ├── estrella.php
│       └── reels.php
└── docs/
    ├── ficha-cliente.md
    ├── informe_estilo_origen.md
    └── plan-desarrollo-origen.md
```

---

## Personalización

La landing se genera íntegramente desde `config.php`. Para modificar textos, colores, productos, horarios o redes sociales, editá ese archivo.

### Datos principales

| Campo | Ubicación en `config.php` |
|-------|---------------------------|
| Nombre del negocio | `'nombre'` |
| Slogan | `'slogan'` |
| WhatsApp | `'whatsapp'` |
| Descripción hero | `'hero_descripcion'` |
| Productos destacados | `'productos'` |
| Dirección y mapa | `'direccion'`, `'gmaps_embed'`, `'gmaps_link'` |
| Horarios | `'horario'` |
| Redes sociales | `'redes'` |
| Colores | `'colors'` |

---

## SEO

- Title tag, meta description y Open Graph configurados desde `config.php`.
- Estructura semántica con un único `<h1>` por página.
- Mapa del sitio en `sitemap.xml`.
- Archivo `robots.txt` con directiva `index, follow`.
- Forzado de HTTPS y caché inmutable vía `.htaccess`.

---

## Licencia

© Origen Run & Bike. Todos los derechos reservados.

Hecho con ❤️ por [MiLocalWeb.com.ar](https://milocalweb.com.ar).
