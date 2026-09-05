# Sitio iurefficient.com (cms_simple)

Sitio público de Iurefficient sobre [cms_simple](https://github.com/ellaguno/cms_simple): PHP plano, sin base de datos,
contenido en JSON y panel de administración en `/admin/`.

Migrado el 3 de septiembre de 2026 desde el sitio estático que estaba en producción. La versión anterior quedó en el
tag `pre-cms-migration` de este repositorio y en `../backups/2026-09-03/`.

## Rutas

| URL | Qué es | De dónde sale |
|---|---|---|
| `/` | Portada Iurefficient Teams | página "Portada Teams" del **constructor** (`data/content/paginas/inicio.json`, config `home_item`) |
| `/derecho` | Landing para abogados | página "Abogados" del **constructor** (`data/content/paginas/derecho.json`, 11 secciones) |
| `/precios` | Planes, comparativa y FAQ | página del **constructor** (`data/content/paginas/precios.json`) |
| `/seguridad` | Seguridad, confidencialidad y privacidad | página del **constructor** (`data/content/paginas/seguridad.json`) |
| `/en/…` | Versión en inglés de todo el sitio | mismas páginas y colecciones, campos bilingües (`i18n`) con respaldo al español |
| `/legal/privacidad`, `/legal/terminos` | Páginas legales | tipo de contenido "Páginas legales" |
| `/pages/{url}` | Páginas libres creadas desde el panel | tipo "Páginas" + `site/templates/pagina.php` |
| `/articulos/`, `/articulos/{url}` | Artículos, tutoriales y novedades de versión (88 entradas migradas del blog el 2026-09-04) | tipo "Artículos" + `articulos.php` / `articulo.php` |
| `/proyectos/{url}` | Proyectos / casos de éxito — declarado, sin uso aún | tipo "Proyectos" + `proyecto.php`; índice `/proyectos/` desactivado (`no_list`) |
| `/buscar?q=` | Buscador del sitio (noindex) | `site/templates/buscar.php` + `iure_search()` en `site/inc/functions.php` |
| `/help-portal/` | Centro de ayuda | carpeta PHP independiente (fuera del CMS) |
| `/presentacion/` | Presentación comercial | HTML estático (fuera del CMS) |
| `/admin/` | Panel | núcleo `cms/` |

Las URLs viejas (`/teams`, `/legal/privacidad.php`, `*.html`) redirigen con 301 (Admin → Redirecciones).

## Qué se edita desde el panel

- **Planes de precios**: nombre, precio mensual y anual, etiqueta, destacado, características, excedentes, botón y en
  qué página se muestra (Teams, Abogados o Precios).
- **Equipo**: nombre, cargo, semblanza y foto.
- **Preguntas frecuentes**: pregunta y respuesta, para /precios o /seguridad.
En el panel todos los tipos de contenido cuelgan del grupo plegable **Páginas** (campo `group` de cada tipo en
`site/config.php`).

- **Páginas libres**: páginas del **constructor** (la portada y /derecho son dos de ellas), en cualquier ruta (`/mi-pagina` o `/padre/hija`, con página padre).
  Cada página es una lista de secciones (hero, texto, texto e imagen, imagen, video, galería 3D, HTML, espacio,
  tarjetas, antes y después, tabla comparativa, testimonio, planes, preguntas frecuentes, equipo, últimos artículos,
  páginas hijas, insignias, llamado a la acción) con pestañas Contenido y Estilo (fondo de la paleta, color de texto,
  espacio, ancho, alineación, animación, imagen de fondo, ancla, clases, ocultar en móvil). Vista previa en vivo a
  la derecha: se actualiza al editar y al hacer clic en una sección de la vista previa se abre su tarjeta.
- **Páginas legales**: título, fecha, resumen y contenido con editor visual. El índice se genera de los subtítulos.
- **Artículos**: título, resumen, contenido, fecha, autor, categoría, etiquetas, imagen destacada y marca. El índice
  `/articulos/` filtra por categoría, etiqueta y búsqueda, con paginación de 12. Los videos de YouTube se insertan
  como `<div class="video-embed"><iframe …></div>`.
- **Proyectos**: declarado con plantillas listas (`proyectos.php`/`proyecto.php`); el índice público se activa
  quitando `'no_list' => true` del tipo en `site/config.php`.

### Constructor de páginas (secciones)

- El tema declara los bloques en `site/blocks.php` (campos como en `config.php`, `wrap_class`, `styles` permitidos)
  y dibuja cada uno en `site/blocks/<clave>.php` con `$b` (datos), `$st` (estilo), `$sec`, `$lang`, `$S`, `$t`,
  `$page`, `$item`. El núcleo (`cms/lib/sections.php`) envuelve cada bloque en `<section class="sec sec-<clave>
  sec-bg-* sec-pad-* sec-w-* sec-align-* …">`; las clases de estilo viven en `site/assets/css/sections.css`.
- Un tipo usa el constructor con un campo `'type' => 'sections'`. Se guarda como lista de
  `{id, type, data, style, hidden}` dentro del JSON del elemento.
- Vista previa en vivo: el formulario se envía sin guardar a `admin/?p=preview`, que inyecta el elemento en memoria
  y deja que el enrutador público lo dibuje con el tema dentro del iframe. Clic en la vista previa ⇄ tarjeta.
- Panel: Mapa del sitio (árbol de todo lo que responde), vista previa de borradores con token, publicación
  programada, versiones (últimas 10, restaurables), duplicar.

### Paquetes de bloques y efectos (cms/packs)

Recursos compartidos entre sitios: cada paquete es una carpeta autocontenida (`pack.php` manifiesto, `blocks.php`,
`blocks/*.php`, `assets/`, `LICENSES.md`). El tema los activa con `'packs' => ['visual']` en `site/config.php`;
sus bloques aparecen en el selector como `visual/galeria3d`, y sus efectos en la pestaña Estilo de cualquier sección.
El núcleo carga el CSS y JS de un paquete solo en las páginas que usan alguno de sus bloques o efectos, y las
librerías abiertas (three.js, Swiper, GLightbox, GSAP…) las descarga `cms/assets/cms.js` bajo demanda con
`CMS.load('three')`. Un bloque del tema puede usar un efecto de paquete declarándolo en `'effects'` y activándolo o
no desde su vista con `cms_section_effect('visual/shader', $on)`. Los bloques de paquete usan clases neutras
(`cms-*`, `vis-*`) y variables `--cms-*` que el tema define en `styles.css`; `sections.classes` en la configuración
mapea la cabecera estándar a las clases del tema.

Paquete **visual** (extraído de este sitio): galería 3D, carrusel, galería con lightbox; efectos fondo de ondas
WebGL, luz que sigue al cursor en tarjetas, degradado animado. El hero, las tarjetas y el cierre del tema los usan.
Paquete **motion** (reescrito en limpio a partir de katapolt.mx, sobre GSAP 3.13 gratuito): marquesina, cifras
animadas, titular grande, galería con parallax; efectos texto revelado, aparición escalonada, parallax de fondo y
cursor magnético de sitio. Cada paquete lleva su `LICENSES.md`.

### Vistas previas de bloques y efectos

Cada bloque y efecto tiene una imagen o GIF que se muestra en el manual (catálogo) y en el selector del constructor al
pasar el ratón; el efecto elegido en Estilo también muestra la suya. Convención de archivos: `site/assets/previews/
<clave>.(gif|png)` para bloques del tema y `cms/packs/<paquete>/assets/previews/<bloque>.*` y `efecto-<efecto>.*`
para paquetes. Se generan solas: `tools/make-previews.sh http://127.0.0.1:8080` (Chrome sin interfaz sobre páginas
de demostración con `?cmsbare=1`; `CMS_ROOT=/otro/sitio … --solo-tema` para otro sitio, `--solo=clave` para una).

### Respaldos

Admin → Respaldos: zip de `data/` y `uploads/` (opcionalmente `site/`) en `/backups`, con nota; descargar, restaurar
(con respaldo automático previo y conservando usuarios) y eliminar. Requiere la extensión zip de PHP.

### Importar un diseño (IA con visión)

Admin → Importar diseño: de un PDF o imagen de una página a un borrador del constructor. El navegador rasteriza el
archivo con pdf.js en pantallas de 1400×1100 y extrae su capa de texto (`cms/admin/assets/importar.js`); el servidor
arma el prompt con el catálogo real de bloques y un JSON Schema de la respuesta, llama al modelo y materializa las
secciones (`cms/lib/import.php`). Proveedores: OpenRouter (cualquier modelo con visión; clave y modelo en la propia
pantalla, guardados en `data/settings.json`) o la CLI de Claude Code si está instalada en el equipo (desarrollo local).
Las pantallas de referencia quedan en `uploads/import/<slug>/` y se muestran, con las notas del análisis (imágenes que
faltan, partes sin bloque, paleta), en el panel "Diseño importado" del constructor. `'importer' => false` en
`site/config.php` lo desactiva. Experimento desde la línea de comandos: `tools/import-design.py` (usa
`tools/blocks-schema.php`, que exporta catálogo, schema y prompt). Resultado de las pruebas con la portada real:
Sonnet y Opus reconstruyen las 11 secciones y los 20 títulos exactos; Haiku no.

### Sitio bilingüe (español e inglés)

`'langs' => ['es', 'en']` en `site/config.php`; el inglés se activa en Ajustes → Idiomas. Los campos de texto de los
tipos y de los bloques llevan `'i18n' => true`, así que el editor muestra el conmutador ES/EN. Al dibujar el sitio, el
núcleo resuelve los campos bilingües al idioma de la petición (`cms_localize`, `cms_render_lang()`), de modo que las
plantillas y vistas siguen usando `$item['title']` o `$b['title']` sin cambios. Los textos fijos del tema usan
`iure_l('es', 'en')`; el selector de idioma es `iure_lang_switch()`. Lo que falta por traducir se muestra en español.
`tools/i18n-en.py` convirtió el contenido existente y creó las páginas precios y seguridad (antes plantillas fijas).
Los 88 artículos siguen en español (se muestran con respaldo en /en/).

### Manual embebido

Admin → Manual: doce capítulos en `cms/manual/*.md` (Markdown con capturas en `cms/manual/img/`), desde instalar y
armar el primer portal hasta el constructor, el editor, SEO, GEO y mantenimiento. El capítulo de bloques lista el
catálogo real del sitio. Un sitio puede añadir capítulos propios en `site/manual/*.md`.

### Editor visual

Barra completa (títulos 1 a 4, negritas, cursivas, subrayado, tachado, listas con sangría, cita, bloque de código,
línea horizontal, alineación, enlace, video, subir imagen, biblioteca, quitar formato) y botón **HTML** que cambia a
un editor de código (CodeMirror, cargado bajo demanda) para editar el HTML tal cual; lo escrito ahí se guarda sin
pasar por el editor visual. Los videos de YouTube o Vimeo se insertan como `<div class="video-embed"><iframe
class="ql-video" …></div>`, al 100 % del ancho tanto en el panel como en el sitio (`legal.css`); en el editor el
video no recibe clics, se selecciona el bloque y se quita con Supr.

### Buscador

Icono de lupa en las dos cabeceras (despliega el campo; en móvil es un campo fijo del menú) que envía a `/buscar?q=`.
Busca sin distinguir mayúsculas ni acentos en artículos, páginas libres, proyectos, legales, preguntas frecuentes y en
los textos de las páginas fijas (portada, /derecho, /precios, /seguridad). Los resultados se ordenan por relevancia
(coincidencia en el título pesa más) y muestran un fragmento con las palabras resaltadas. Textos en
Textos del sitio → Buscador. Es búsqueda en memoria sobre los JSON: suficiente para algunos cientos de elementos.

### Migración del blog (WordPress → Artículos)

`tools/import-wp.php` importa las entradas de blog.iurefficient.com por la API REST: omite la categoría
"Noticias" (resúmenes automáticos con audio, que siguen en WordPress), descarga imágenes y PDF a `uploads/blog/`,
limpia el HTML de Gutenberg, convierte los embeds de YouTube y escribe `data/content/articulos/<slug>.json`.
Genera además `tools/wp-redirects.txt` con las reglas 301 para el `.htaccess` de WordPress. Se puede repetir
(`--dry-run`, `--slug=…`, `--limit=N`). Las entradas vacías quedan como borrador.
- **Textos del sitio**: títulos, subtítulos, botones, textos del pie, SEO de cada página.
- **Ajustes**: correo, redes, logotipos, capturas de la galería 3D, URLs de demos, blog, video de YouTube y menú de la
  landing para abogados.
- **Menú**: menú de la portada Teams.
- **Código del tema**: plantillas, CSS y JS (con respaldo automático). Ahí viven los bloques que no están en datos:
  tarjetas de características, tabla comparativa de /precios (arreglo `$comparativa` en `precios.php`), secciones
  técnicas de /seguridad.

## Estructura

```
index.php, admin/, cms/     núcleo de cms_simple 1.8.0 (cms/packs: paquetes compartidos; cms/assets/cms.js: cargador; cms/manual) (se actualiza sustituyendo cms/). Cambios locales pendientes de
                            llevar al repo cms_simple: grupos en el menú del panel ('group'), textos por defecto
                            completados desde site/defaults, 'noindex' por tipo, URL canónica (site_url), /llms.txt,
                            cms_jsonld_graph() acepta null (páginas sin schema)
site/config.php             tipos de contenido, páginas, ajustes, grupos de textos y paleta del constructor
site/blocks.php, blocks/    catálogo y vistas de las secciones del constructor
site/inc/layout.php         cabecera y pie (marca Teams o Abogados según la página)
site/inc/functions.php      helpers: tarjetas de plan, formulario, índice legal…
site/templates/             legal, pagina (constructor: portada, /derecho, /precios, /seguridad), articulos/articulo, proyectos/proyecto,
                            plan, miembro, pregunta, 404
site/assets/css|js|img      styles.css, teams.css, precios.css, seguridad.css, legal.css (legales, páginas libres,
                            artículos, proyectos, preguntas y 404), main.js, imágenes
site/defaults/              ajustes, textos y menú iniciales (copia de data/)
data/                       contenido real: settings, strings, menu, redirects, content/<tipo>/<slug>.json
uploads/                    archivos subidos desde el panel (no se versionan)
api/send-contact.php        receptor del formulario de contacto (correo HTML + confirmación al cliente)
help-portal/, presentacion/ carpetas estáticas
```

## Desarrollo local

```bash
php -S 127.0.0.1:8080 _router-dev.php
# http://127.0.0.1:8080  y  http://127.0.0.1:8080/admin/
```

La primera vez que abres `/admin/` te pide crear el usuario administrador (`data/users.json`, no se versiona).

## Despliegue (cPanel / HostGator)

1. Sube todo el repositorio a `public_html` (o clona y haz `git pull`). Excluye `land.zip`, `oimage.*` y `cache/`.
2. Permisos de escritura (755 o 775) en `data/` y `uploads/`.
3. Abre `https://iurefficient.com/admin/` y crea el usuario administrador.
4. Revisa Ajustes → correo de contacto y Ajustes → Imágenes (opcional: botón "Generar WebP").
5. Comprueba `/`, `/derecho`, `/precios`, `/seguridad`, `/legal/privacidad`, `/help-portal/`, `/presentacion/`
   y `/sitemap.xml`.

## SEO y GEO

- **Dominio canónico**: `site_url` en `site/config.php` (o Ajustes → URL canónica) fija `https://iurefficient.com` en
  canonical, sitemap y JSON-LD aunque entren por www. `.htaccess` redirige www → apex y http → https (compatible con
  Cloudflare). Cloudflare debe tener además "Always Use HTTPS" y no bloquear los bots de IA en su robots.txt gestionado.
- **Datos estructurados** (`iure_jsonld()` en `site/inc/functions.php`): SoftwareApplication con ofertas en `/` y
  `/derecho`, FAQPage en `/precios` y `/seguridad` (a partir de las preguntas del CMS), más Organization, WebSite y
  BreadcrumbList del núcleo.
- **Índice limpio**: los detalles de planes, equipo y preguntas llevan `noindex` y no entran al sitemap
  (`'noindex' => true` en el tipo).
- **`/llms.txt`**: resumen del sitio para motores de IA; se edita en `site/llms.txt` (Código del tema). `{{site}}`
  se sustituye por la URL canónica.
- **Rendimiento**: scripts con `defer`; three.js (600 KB) se carga solo cuando la galería 3D se acerca al viewport.
- **Textos**: títulos y descripciones SEO viven en Textos del sitio → SEO. Escribe siempre con acentos.

### Actualizar un sitio ya desplegado

Contenido nuevo generado en local (por ejemplo `data/content/articulos/` y `uploads/blog/` de la migración, o
`data/content/paginas/inicio.json`, `derecho.json`, `precios.json` y `seguridad.json`, que desde el 5 de septiembre de
2026 **son** la portada, /derecho, /precios y /seguridad; y el contenido bilingüe de planes, FAQ, equipo y legales) se sube aparte, como archivos nuevos, sin tocar el resto de `data/`. Sin esos JSON, `/` cae a `home.php`
(que ya no existe) y `/derecho` responde 404.

Sube solo el código: todo **excepto** `data/` y `uploads/` (ahí viven el contenido, los ajustes, los usuarios y los
archivos subidos en producción). Los textos nuevos que traiga el tema se completan solos desde
`site/defaults/strings.json` y aparecen en Textos del sitio. Para generar el zip:

```bash
zip -r ../iurefficient-landing-subir.zip . -x '.git/*' '.claude/*' 'data/*' 'uploads/*' 'land.zip' 'oimage.*' 'cache/*' '_router-dev.php'
```

Requisitos: PHP 7.4+ con `json`, `mbstring`, `fileinfo`, `session` (y `gd` para WebP); Apache con `mod_rewrite`.

## Formulario de contacto

`main.js` envía el formulario a `/api/send-contact.php`, que manda el aviso a `contacto@iurefficient.com` y una
confirmación al cliente con `mail()`. El receptor genérico de cms_simple (`/_cms/form`) queda disponible pero no se usa.
