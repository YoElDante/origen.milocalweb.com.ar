# Informe de Identidad Visual de Marca: ORIGEN

Este documento establece las bases de la identidad visual de la marca **Origen** a partir de las piezas gráficas analizadas (fotografías de producto, creatividades para redes sociales, fondo texturizado y logotipo original). Este informe en formato `.md` está estructurado para orientar el diseño y desarrollo web del proyecto, sirviendo como especificación directa para equipos de desarrollo e Inteligencia Artificial.

---

## 1. Paleta de Colores

La marca maneja una estética limpia, natural y atlética. Combina tonos orgánicos/térreos para colecciones femeninas, verdes agua y azules slate para indumentaria masculina, e integra texturas de hormigón/piedra con contrastes sólidos.

```json
{
  "colorPalette": {
    "primary": {
      "black": "#000000",
      "white": "#FFFFFF",
      "slateBlue": "#5C7C8A"
    },
    "secondary": {
      "softAqua": "#8EAAAF",
      "cyanSport": "#00BBAA",
      "textDark": "#2B2B2B"
    },
    "alternativeBackgrounds": {
      "veranoFemNude": "#DFD3CA",
      "veranoFemNudeDark": "#D4C5BB",
      "concreteTextureLight": "#E5E5E5"
    }
  }
}

```

### Colores Principales

* **Negro Puro (`#000000` / `rgba(0, 0, 0, 1)`):** Color base para el isologotipo, elementos de alto contraste y textos principales.
* **Blanco Puro (`#FFFFFF` / `rgba(255, 255, 255, 1)`):** Utilizado para tipografías prominentes sobre fondos de color, overlays y lectura limpia.
* **Azul Slate / Verde Muted (`#5C7C8A` / `rgba(92, 124, 138, 1)`):** Color de identidad de campañas masculinas (*short masculino*), aporta sobriedad y tono deportivo técnico.

### Colores Secundarios

* **Verde Agua / Soft Aqua (`#8EAAAF` / `rgba(142, 170, 175, 1)`):** Utilizado como fondo institucional ("Nos Estamos Renovando"). Ideal para banners y fondos secundarios.
* **Turquesa Deportivo / Cyan Sport (`#00BBAA` / `rgba(0, 187, 170, 1)`):** Presente en prendas específicas (calzas fem). Aporta un acento brillante y energético.
* **Gris Texto Oscuro (`#2B2B2B` / `rgba(43, 43, 43, 1)`):** Para cuerpos de texto sobre fondos claros.

### Opción de Color Alternativa (Colección Verano Fem)

* **Nude Térreo / Beige Warm (`#DFD3CA` / `rgba(223, 211, 202, 1)`):** Color de fondo consistente identificado en la gráfica *Verano Fem*. Ideal como paleta alternativa para colecciones de temporada o secciones orientadas a la mujer.
* **Nude Sombra (`#D4C5BB` / `rgba(212, 197, 187, 1)`):** Variante ligeramente más oscura para estados *hover* o contenedores secundarios dentro de la misma estética.

---

## 2. Tipografías (Fuentes)

```json
{
  "typography": {
    "logoFont": {
      "style": "Typewriter / Courier Monospaced Sans",
      "suggestedGoogleFonts": ["Courier Prime", "Cutive Mono", "Space Mono"],
      "usage": "Logo Origen, lema circular ('Sabemos dónde empieza, no dónde termina')"
    },
    "posterMainHeader": {
      "style": "Sans-serif Ultra-Condensed Heavy/Bold",
      "suggestedGoogleFonts": ["Oswald", "Anton", "Bebas Neue"],
      "usage": "Titulares principales ('SHORT MASCULINO', 'INDISPENSABLES', 'VERANO')"
    },
    "subtitleScript": {
      "style": "Serif Italics (Modern Display / Transitional)",
      "suggestedGoogleFonts": ["Playfair Display (Italic)", "Bodoni Moda (Italic)", "Lora (Italic)"],
      "usage": "Palabras de acento estético ('running', 'en el gym')"
    },
    "bodyText": {
      "style": "Sans-serif Geometric / Humanist Regular",
      "suggestedGoogleFonts": ["Open Sans", "Montserrat", "Inter"],
      "usage": "Descripciones de producto ('Tela respirable, cómodo y fresco'), anotaciones ('hidratación', 'calza')"
    }
  }
}

```

1. **Tipografía del Logo (Isologotipo):**
* **Estilo:** Monoespaciada tipo máquina de escribir con remates limpios.
* **Fuentes recomendadas:** *Courier Prime*, *Cutive Mono*, *Space Mono*.
* **Uso:** Nombre de la marca "ORIGEN" y la frase semicircular *"Sabemos dónde empieza, no dónde termina"*.


2. **Tipografía de Carteles / Titulares Principales:**
* **Estilo:** Sans-serif impactante, muy condensada, de trazo grueso (Heavy/Bold) en mayúsculas sostenidas.
* **Fuentes recomendadas:** *Oswald* (Bold/ExtraBold), *Anton*, *Bebas Neue*.
* **Uso:** Títulos promocionales de gran tamaño como "SHORT MASCULINO", "INDISPENSABLES", "VERANO".


3. **Tipografía de Subtítulos y Acentos (Script / Cursiva Elegant):**
* **Estilo:** Serif clásica en cursiva/itálica con alto contraste de trazos (elegancia editorial).
* **Fuentes recomendadas:** *Playfair Display* (Italic), *Bodoni Moda* (Italic), *Lora* (Italic).
* **Uso:** Palabras de acento intercaladas para romper la rigidez, como *"running"* en las placas masculinas o *"en el gym"* en la placa femenina.


4. **Tipografía de Cuerpo y Señaléctica de Producto:**
* **Estilo:** Sans-serif geométrica / humanista, limpia, sin serifa y de fácil lectura.
* **Fuentes recomendadas:** *Open Sans*, *Montserrat*, *Inter*.
* **Uso:** Descripciones cortas (*"Tela respirable, cómodo y fresco"*), etiquetas en imágenes (*"hidratación"*, *"camiseta"*, *"calza"*), y cuerpo de texto web.



---

## 3. Guía de Aplicación para Desarrollo UI / Web

### Configuración CSS Variables (Tokens de Diseño)

```css
:root {
  /* Colors */
  --color-primary-black: #000000;
  --color-primary-white: #ffffff;
  --color-slate-blue: #5c7c8a;
  
  --color-soft-aqua: #8eaaaf;
  --color-cyan-sport: #00bbaa;
  --color-text-dark: #2b2b2b;
  
  /* Alternative Collection Theme (Verano Fem) */
  --bg-verano-fem: #dfd3ca;
  --bg-verano-fem-dark: #d4c5bb;
  
  /* Fonts */
  --font-logo: 'Space Mono', monospace;
  --font-heading: 'Oswald', sans-serif;
  --font-accent: 'Playfair Display', serif;
  --font-body: 'Open Sans', sans-serif;
}

```

### Reglas de Diseño y Maquetación

* **Texturas de Fondo:** Integrar sutilmente fondos texturizados tipo piedra o hormigón claro (como el archivo `textura fondo piedra.webp`) en secciones clave (Hero, Cards de producto o Footer) para transmitir dureza e identidad outdoor/street.
* **Tratamiento Fotográfico:** Fotografía de producto con sombras suaves arrojadas, recortes limpios y composiciones estilo *collaging* con imágenes duplicadas con menor opacidad de fondo.
* **Puntos de Contacto UI:**
* **Botones (CTAs):** Fondo `#000000` con texto `#FFFFFF` en maiúsculas usando `--font-heading` para máxima firmeza visual, o variantes en `--color-cyan-sport` para destacar ofertas.
* **Tarjetas de Producto:** Mantener fondos neutros claros (`#DFD3CA` o `#F5F5F5`) para resaltar el color de la ropa deportiva.