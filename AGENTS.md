# AGENTS.md — MiLocalWeb Landing Page

> Instrucciones para asistentes de código. Leer esto ANTES de cualquier acción.
> Este archivo existe en cada proyecto cliente y es la guía canónica.

---

## 1. Contexto del Negocio

MiLocalWeb (milocalweb.com.ar) es un servicio de marketing digital para negocios locales.
Una landing page optimizada para SEO es **uno de los productos del paquete**.

**Modelo de negocio:**
- Cada cliente recibe una landing page en un subdominio (`cliente.milocalweb.com.ar`)
- La landing funciona como hub central: indexa en Google, linkea redes sociales,
  Google Business Profile, y canaliza consultas a WhatsApp
- La página NO es e-commerce — es vitrina, captación de leads y presencia digital

**Monetización para MiLocalWeb:**
- La landing incluye elementos publicitarios propios (footer, aside) que promocionan
  el servicio de MiLocalWeb y generan tráfico hacia milocalweb.com.ar
- Se puede incluir una sección discreta de "Otros Clientes" como vidriera del portfolio

---

## 2. Arquitectura del Template

```
{cliente}.milocalweb.com.ar/
├── index.php                  ← Entry point. Arma la página completa.
├── config.php                 ← ÚNICA fuente de datos del sitio.
├── .htaccess                  ← Seguridad, caché, HTTPS forzado.
├── assets/
│   ├── css/styles.css         ← Estilos base (neutros) + variables CSS.
│   ├── js/main.js             ← Smooth scroll, back-to-top, WhatsApp float.
│   └── img/
│       ├── cliente/           ← Imágenes del negocio (logos, productos, fotos).
│       ├── milocalweb/        ← Assets de MiLocalWeb (logos, iconos).
│       └── terceros/          ← Logos de terceros (ej. Freebox, Origen).
├── includes/
│   ├── header.php             ← <head> completo + navbar + inicio del <main>.
│   ├── footer.php             ← Footer estándar MiLocalWeb + WhatsApp float.
│   └── sections/
│       ├── hero.php           ← Hero section (3 layouts configurables).
│       ├── productos.php      ← Hasta 3 productos destacados.
│       ├── ubicacion.php      ← Mapa, dirección, horarios, estrellas.
│       └── nosotros.php       ← Quiénes somos, galería, redes, CTA final.
└── docs/
    ├── ficha-cliente.md       ← Datos estructurados del cliente (template).
    ├── {cliente}.cliente.md   ← Datos básicos de contacto.
    └── informe_estilo_{cliente}.md ← Identidad visual (colores, tipografías).
```

**Principio fundamental:** `config.php` es la fuente única de verdad.
Toda la landing se genera a partir de ese array. Si algo no está en `config.php`,
no aparece en la página.

---

## 3. Flujo de Trabajo para un Nuevo Cliente

Cuando se trabaja con un cliente nuevo, el orden es:

1. **Leer `docs/ficha-cliente.md`** — contiene todos los datos en formato estructurado
2. **Leer `docs/informe_estilo_{cliente}.md`** — define la identidad visual
3. **Llenar `config.php`** con los datos reales del cliente
4. **NO inventar estilos** — el CSS debe reflejar la identidad del cliente,
   no un estilo predefinido. Si no hay informe de estilo, usar valores neutros
   y tipografías system-ui.
5. **Verificar que las imágenes referenciadas en config.php existen** en `assets/img/`
6. **Generar/actualizar `sitemap.xml`** si el cliente lo requiere

---

## 4. Estrategia SEO

La landing está optimizada para búsquedas locales en Google. Elementos clave:

- **Title tag:** `{nombre} — {slogan}` (ej: "EZ Nutrifit — Estamos con vos y para vos!")
- **Meta description:** primeras 160 chars del hero_descripcion
- **Open Graph:** título, descripción, type=website, locale=es_AR
- **robots:** index, follow
- **Estructura semántica:** un `<h1>` por página (el slogan en el hero),
  `<h2>` para títulos de sección, `<h3>` para subtítulos
- **Alt text:** todas las imágenes tienen alt descriptivo
- **HTTPS forzado** vía .htaccess
- **Cache immutability** para CSS/JS (cache busting por filemtime)

**Google Business Profile:**
- La URL de la landing debe estar registrada en el perfil de Google Business del cliente
- La sección de Ubicación debe incluir el iframe embed de Google Maps
- Las estrellas y reseñas (si existen) deben mostrarse para reforzar prueba social

---

## 5. Elementos Estándar (Obligatorios en Toda Landing)

Estos componentes van en **todas** las landing pages, sin excepción:

### Footer MiLocalWeb
- Logo o nombre de MiLocalWeb con link a `https://milocalweb.com.ar#contacto`
- Badge: "Hecho con ❤️ por MiLocalWeb.com.ar"
- CTA: "¿Te gustó esta web? Pedí la tuya sin cargo" → WhatsApp de MiLocalWeb
- Copyright del cliente
- Botón "volver arriba"

### Aside Publicitario
- Espacio reservado para publicidad de terceros o autopromoción de MiLocalWeb
- Debe ser discreto, no invasivo
- En desktop: sidebar lateral; en mobile: banner horizontal entre secciones
- Contenido configurable vía `config.php`

### WhatsApp Float
- Botón flotante verde de WhatsApp siempre visible (abajo a la derecha)
- Link directo a wa.me/{numero}?text={mensaje}

### Sección "Nuestros Clientes"
- Muestra 3-4 logos de otros clientes de MiLocalWeb
- Super discreta: solo logos en escala de grises, sin textos llamativos
- Link a milocalweb.com.ar o a un portfolio

---

## 6. Reglas Estrictas

### Lo que NUNCA se debe hacer:
- ❌ Eliminar el footer estándar de MiLocalWeb
- ❌ Eliminar el aside publicitario
- ❌ Eliminar el WhatsApp float
- ❌ Cambiar la estructura de `config.php` (agregar claves sí, quitar las obligatorias no)
- ❌ Inventar un estilo visual sin basarse en el informe de identidad del cliente
- ❌ Usar lorem ipsum o placeholders — si no hay dato real, mostrar "próximamente"
- ❌ Hardcodear colores en los templates PHP (usar siempre variables CSS desde config.php)
- ❌ Agregar dependencias externas innecesarias (JS frameworks, icon fonts pesadas, trackers sin consentimiento)

### Lo que SIEMPRE se debe hacer:
- ✅ Mantener `config.php` como fuente única de verdad
- ✅ Usar variables CSS (`--color-*`) para todos los colores
- ✅ Respetar la estructura de secciones existente
- ✅ Documentar cualquier sección nueva en `docs/ficha-cliente.md`
- ✅ Usar `htmlspecialchars()` en todo output de datos del cliente
- ✅ Mantener compatibilidad mobile-first

---

## 7. Convenciones Técnicas

- **PHP:** Sin framework. PHP plano con includes. Compatible con PHP 7.4+.
- **CSS:** Variables CSS custom properties. Sin preprocesadores. Mobile-first.
- **JS:** Vanilla JS. Sin frameworks. Mínimo y solo para interacción esencial.
- **Imágenes:** Formato WebP prioritario. Lazy loading por defecto.
- **Tipografía:** `system-ui` como fallback. Google Fonts solo si el cliente tiene
  tipografía corporativa definida.
- **Íconos:** SVG inline (evitar icon fonts, evitan requests extra).
- **Rendimiento:** Sin jQuery, sin Bootstrap, sin Tailwind. CSS hecho a medida.

---

## 8. Checklist de Implementación

Al terminar una landing page, verificar:

- [ ] `config.php` completo y sin placeholders
- [ ] Imágenes del cliente en `assets/img/cliente/`
- [ ] `AGENTS.md` presente en la raíz (este archivo)
- [ ] `docs/ficha-cliente.md` completo
- [ ] Footer MiLocalWeb visible y funcional
- [ ] Aside publicitario presente
- [ ] WhatsApp float funcional
- [ ] Meta tags correctos (title, description, OG)
- [ ] .htaccess con HTTPS forzado y caché
- [ ] Responsive en mobile (viewport configurado, media queries)
- [ ] Sin errores de PHP (display_errors off en producción)
