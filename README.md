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
| `/articulos/{url}` | Artículos (blog) — declarado, sin uso aún | tipo "Artículos" + `articulo.php`; índice `/articulos/` desactivado (`no_list`) |
| `/proyectos/{url}` | Proyectos / casos de éxito — declarado, sin uso aún | tipo "Proyectos" + `proyecto.php`; índice `/proyectos/` desactivado (`no_list`) |
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
- **Artículos** y **Proyectos**: declarados para el futuro con plantillas de detalle e índice listas
  (`articulos.php`/`articulo.php`, `proyectos.php`/`proyecto.php`). Los elementos publicados ya se ven en
  `/articulos/{url}` y `/proyectos/{url}`; el índice público y su entrada en el sitemap se activan quitando
  `'no_list' => true` del tipo en `site/config.php`. El menú sigue apuntando al blog externo (Ajustes → Blog).
- **Textos del sitio**: títulos, subtítulos, botones, textos del pie, SEO de cada página.
- **Ajustes**: correo, redes, logotipos, capturas de la galería 3D, URLs de demos, blog, video de YouTube y menú de la
  landing para abogados.
- **Menú**: menú de la portada Teams.
- **Código del tema**: plantillas, CSS y JS (con respaldo automático). Ahí viven los bloques que no están en datos:
  tarjetas de características, tabla comparativa de /precios (arreglo `$comparativa` en `precios.php`), secciones
  técnicas de /seguridad.

## Estructura

```
index.php, admin/, cms/     núcleo de cms_simple 1.1.0 (se actualiza sustituyendo cms/). Cambio local pendiente de
                            llevar al repo cms_simple: grupos plegables en el menú del panel ('group' en cada tipo;
                            cms/admin/inc/layout.php, assets/admin.css, assets/admin.js)
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

### Actualizar un sitio ya desplegado

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
