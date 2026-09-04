# Sitio iurefficient.com (cms_simple)

Sitio público de Iurefficient sobre [cms_simple](https://github.com/ellaguno/cms_simple): PHP plano, sin base de datos,
contenido en JSON y panel de administración en `/admin/`.

Migrado el 3 de septiembre de 2026 desde el sitio estático que estaba en producción. La versión anterior quedó en el
tag `pre-cms-migration` de este repositorio y en `../backups/2026-09-03/`.

## Rutas

| URL | Qué es | De dónde sale |
|---|---|---|
| `/` | Portada Iurefficient Teams | `site/templates/home.php` + textos + planes (producto "teams") |
| `/derecho` | Landing para abogados | `site/templates/derecho.php` + textos + planes ("derecho") + equipo |
| `/precios` | Planes, comparativa y FAQ | `site/templates/precios.php` + planes ("precios") + FAQ ("precios") |
| `/seguridad` | Seguridad, confidencialidad y privacidad | `site/templates/seguridad.php` + FAQ ("seguridad") |
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

- **Páginas libres**: páginas de contenido libre en `/pages/{url}`. Título, subtítulo, resumen, contenido con editor visual,
  imagen de cabecera, índice opcional de subtítulos, bloque de contacto opcional y elección de cabecera/pie
  (Iurefficient o Teams). Para enlazarlas: Menú (portada) o Ajustes → Menú de la landing para abogados.
- **Páginas legales**: título, fecha, resumen y contenido con editor visual. El índice se genera de los subtítulos.
- **Artículos**: título, resumen, contenido, fecha, autor, categoría, etiquetas, imagen destacada y marca. El índice
  `/articulos/` filtra por categoría, etiqueta y búsqueda, con paginación de 12. Los videos de YouTube se insertan
  como `<div class="video-embed"><iframe …></div>`.
- **Proyectos**: declarado con plantillas listas (`proyectos.php`/`proyecto.php`); el índice público se activa
  quitando `'no_list' => true` del tipo en `site/config.php`.

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
index.php, admin/, cms/     núcleo de cms_simple 1.3.1 (se actualiza sustituyendo cms/). Cambios locales pendientes de
                            llevar al repo cms_simple: grupos en el menú del panel ('group'), textos por defecto
                            completados desde site/defaults, 'noindex' por tipo, URL canónica (site_url), /llms.txt,
                            cms_jsonld_graph() acepta null (páginas sin schema)
site/config.php             tipos de contenido, páginas, ajustes y grupos de textos
site/inc/layout.php         cabecera y pie (marca Teams o Abogados según la página)
site/inc/functions.php      helpers: tarjetas de plan, formulario, índice legal…
site/templates/             home, derecho, precios, seguridad, legal, pagina, articulos/articulo, proyectos/proyecto,
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

Contenido nuevo generado en local (por ejemplo `data/content/articulos/` y `uploads/blog/` de la migración) se sube
aparte, como carpetas nuevas, sin tocar el resto de `data/`.

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
