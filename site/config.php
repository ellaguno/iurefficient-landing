<?php
/**
 * Iurefficient — configuración del sitio para cms_simple.
 *
 * Rutas públicas:
 *   /                Portada Teams: página por secciones del constructor (paginas/inicio.json)
 *   /derecho         Landing para abogados: página por secciones del constructor (paginas/derecho.json)
 *   /precios, /seguridad   Páginas por secciones del constructor (paginas/precios.json, seguridad.json)
 *   /buscar?q=       Buscador del sitio (buscar.php, noindex)
 *   /legal/{slug}    Aviso de privacidad, términos… (tipo "legal", legal.php)
 *   /{ruta}          Páginas libres creadas desde el panel, en árbol (tipo "paginas", pagina.php)
 *   /articulos/      Artículos, tutoriales y novedades (tipo "articulos", articulos.php + articulo.php)
 *   /proyectos/      Proyectos / casos (tipo "proyectos", proyectos.php + proyecto.php) — declarado, sin uso aún
 *   /help-portal/    Centro de ayuda (carpeta estática, fuera del CMS)
 *   /presentacion/   Presentación comercial (carpeta estática, fuera del CMS)
 *
 * 'tree' => true en un tipo: elementos con página padre y ruta completa (path); 'routes' vacío = cuelgan de la raíz.
 * 'noindex' => true en un tipo: sus detalles llevan meta robots noindex y no entran al sitemap.
 * Los tipos con 'group' => 'Nombre' se agrupan bajo ese encabezado (plegable) en el menú del panel.
 * Tipos de campo: text, textarea, html, date, number, url, email, select, checkbox, image, images, lines, tags.
 */
return [
    'name' => 'Iurefficient',
    'site_url' => 'https://iurefficient.com',
    'home_item' => ['paginas', 'inicio'],        // la portada es la página "Portada Teams" del constructor (data/content/paginas/inicio.json)   // dominio canónico (canonical, sitemap, JSON-LD); Ajustes → URL canónica lo puede sobrescribir
    'langs' => ['es', 'en'],          // el inglés se activa en Ajustes → Idiomas
    'default_lang' => 'es',
    'timezone' => 'America/Mexico_City',
    'admin_logo' => 'logo.svg',

    'types' => [
        // ---- Páginas ------------------------------------------------------------------------------
        'paginas' => [
            'label' => 'Páginas libres',
            'label_singular' => 'Página',
            'group' => 'Páginas',
            'help' => 'Páginas de contenido libre en cualquier ruta (/mi-pagina o /padre/hija). Elige en la barra lateral si llevan la cabecera y el pie de Teams o de Abogados.',
            'routes' => ['es' => ''],   // cuelgan de la raíz
            'tree' => true,             // con página padre y ruta completa
            'no_list' => true,
            'template_single' => 'pagina',
            'schema' => 'WebPage',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['brand', 'updated', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'summary', 'image_field' => 'image',
            'fields' => [
                'title'    => ['type' => 'text', 'i18n' => true, 'label' => 'Título', 'required' => true],
                'sections' => ['type' => 'sections', 'label' => 'Secciones de la página',
                               'help' => 'La página se arma con secciones: hero, texto, tarjetas, video, planes, preguntas, llamado a la acción… Cada una tiene su contenido y su estilo.'],
                'summary'  => ['type' => 'textarea', 'i18n' => true, 'label' => 'Descripción para buscadores y tarjetas (opcional)', 'rows' => 2, 'sidebar' => true],
                'brand'    => ['type' => 'select', 'label' => 'Cabecera y pie', 'sidebar' => true,
                               'options' => ['derecho' => 'Iurefficient (Abogados)', 'teams' => 'Iurefficient Teams']],
                'image'    => ['type' => 'image', 'label' => 'Imagen para redes y tarjetas (opcional)', 'sidebar' => true],
                'order'    => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],

        'legal' => [
            'label' => 'Páginas legales',
            'group' => 'Páginas',
            'label_singular' => 'Página legal',
            'routes' => ['es' => 'legal'],
            'no_list' => true,
            'template_single' => 'legal',
            'schema' => 'WebPage',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['updated_label', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'summary', 'image_field' => '',
            'fields' => [
                'title'         => ['type' => 'text', 'i18n' => true, 'label' => 'Título', 'required' => true],
                'updated_label' => ['type' => 'text', 'i18n' => true, 'label' => 'Texto de última actualización', 'placeholder' => 'Última actualización: Enero 2025', 'sidebar' => true],
                'summary'       => ['type' => 'textarea', 'i18n' => true, 'label' => 'Resumen (recuadro destacado al inicio)', 'rows' => 3],
                'body'          => ['type' => 'html', 'i18n' => true, 'label' => 'Contenido', 'size' => 'lg',
                                    'help' => 'Los subtítulos (Título 2) generan el índice automáticamente. Las citas se muestran como recuadros destacados.'],
                'order'         => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],

        // ---- Artículos y proyectos ---------------------------------------------------------------------
        // Un tipo con 'no_list' => true no tiene índice público ni entra al sitemap; sus elementos publicados sí
        // se ven en /{ruta}/{url}. Proyectos sigue así hasta que tenga contenido; Artículos ya está activo.
        'articulos' => [
            'label' => 'Artículos',
            'group' => 'Páginas',
            'label_singular' => 'Artículo',
            'help' => 'Artículos, tutoriales y novedades de versión (migrados del blog el 2026-09-04). Índice público en /articulos/.',
            'routes' => ['es' => 'articulos'],
            'template_list' => 'articulos',
            'template_single' => 'articulo',
            'schema' => 'Article',
            'sort' => ['field' => 'date', 'dir' => 'desc'],
            'list' => ['date', 'category', 'brand'],
            'title_field' => 'title', 'excerpt_field' => 'excerpt', 'image_field' => 'image',
            'fields' => [
                'title'    => ['type' => 'text', 'i18n' => true, 'label' => 'Título', 'required' => true],
                'excerpt'  => ['type' => 'textarea', 'i18n' => true, 'label' => 'Resumen (listado y buscadores)', 'rows' => 3],
                'body'     => ['type' => 'html', 'i18n' => true, 'label' => 'Contenido', 'size' => 'lg',
                               'help' => 'Escribe como en Word. La barra permite subir imágenes, insertar de la Biblioteca y videos de YouTube.'],
                'date'     => ['type' => 'date', 'label' => 'Fecha', 'sidebar' => true],
                'author'   => ['type' => 'text', 'label' => 'Autor', 'sidebar' => true],
                'category' => ['type' => 'text', 'i18n' => true, 'label' => 'Categoría', 'sidebar' => true],
                'tags'     => ['type' => 'tags', 'i18n' => true, 'label' => 'Etiquetas (separadas por coma)', 'sidebar' => true],
                'image'    => ['type' => 'image', 'label' => 'Imagen destacada', 'sidebar' => true],
                'brand'    => ['type' => 'select', 'label' => 'Cabecera y pie', 'sidebar' => true,
                               'options' => ['derecho' => 'Iurefficient (Abogados)', 'teams' => 'Iurefficient Teams']],
            ],
        ],
        'proyectos' => [
            'label' => 'Proyectos',
            'group' => 'Páginas',
            'label_singular' => 'Proyecto',
            'help' => 'Casos de éxito / proyectos. El índice público (/proyectos/) está desactivado hasta que tenga contenido y diseño.',
            'routes' => ['es' => 'proyectos'],
            'no_list' => true,
            'template_list' => 'proyectos',
            'template_single' => 'proyecto',
            'schema' => 'CreativeWork',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['client', 'category', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'excerpt', 'image_field' => 'image',
            'fields' => [
                'title'    => ['type' => 'text', 'i18n' => true, 'label' => 'Título', 'required' => true],
                'excerpt'  => ['type' => 'textarea', 'i18n' => true, 'label' => 'Descripción corta (tarjeta y buscadores)', 'rows' => 2],
                'body'     => ['type' => 'html', 'i18n' => true, 'label' => 'Descripción del proyecto', 'size' => 'lg'],
                'results'  => ['type' => 'html', 'i18n' => true, 'label' => 'Resultados (opcional)'],
                'cta_text' => ['type' => 'text', 'i18n' => true, 'label' => 'Texto del botón (opcional)'],
                'cta_url'  => ['type' => 'url', 'label' => 'URL del botón', 'placeholder' => 'https://'],
                'client'   => ['type' => 'text', 'label' => 'Cliente', 'sidebar' => true],
                'category' => ['type' => 'text', 'i18n' => true, 'label' => 'Categoría (Despacho, Corporativo…)', 'sidebar' => true],
                'year'     => ['type' => 'text', 'label' => 'Año', 'sidebar' => true],
                'services' => ['type' => 'lines', 'i18n' => true, 'label' => 'Servicios / módulos usados (uno por línea)', 'sidebar' => true, 'rows' => 3],
                'image'    => ['type' => 'image', 'label' => 'Imagen principal (ancha)', 'sidebar' => true],
                'gallery'  => ['type' => 'images', 'label' => 'Galería (una imagen por línea)', 'sidebar' => true, 'rows' => 3],
                'brand'    => ['type' => 'select', 'label' => 'Cabecera y pie', 'sidebar' => true,
                               'options' => ['derecho' => 'Iurefficient (Abogados)', 'teams' => 'Iurefficient Teams']],
                'order'    => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],

        // ---- Piezas que usan las landings ------------------------------------------------------------
        'planes' => [
            'label' => 'Planes de precios',
            'group' => 'Páginas',
            'label_singular' => 'Plan',
            'routes' => ['es' => 'planes'],
            'no_list' => true,
            'noindex' => true,   // páginas de detalle de relleno: fuera del índice y del sitemap
            'template_single' => 'plan',
            'schema' => 'Product',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['product', 'price', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'description', 'image_field' => '',
            'fields' => [
                'title'        => ['type' => 'text', 'i18n' => true, 'label' => 'Nombre del plan', 'required' => true],
                'product'      => ['type' => 'select', 'label' => 'Dónde se muestra', 'sidebar' => true,
                                   'options' => ['derecho' => 'Abogados (/derecho y /precios)', 'teams' => 'Teams (portada)']],
                'description'  => ['type' => 'text', 'i18n' => true, 'label' => 'Descripción corta (ej. "Despachos en crecimiento")'],
                'price'        => ['type' => 'text', 'label' => 'Precio mensual (solo el número, ej. 1,499)', 'sidebar' => true],
                'price_annual' => ['type' => 'text', 'label' => 'Precio con pago anual (por mes; se muestra donde hay conmutador mensual/anual)', 'sidebar' => true],
                'period'       => ['type' => 'text', 'i18n' => true, 'label' => 'Periodo', 'default' => 'MXN/mes', 'sidebar' => true],
                'badge'        => ['type' => 'text', 'i18n' => true, 'label' => 'Etiqueta (ej. "Más popular"; vacío = sin etiqueta)', 'sidebar' => true],
                'featured'     => ['type' => 'checkbox', 'label' => 'Plan destacado', 'text' => 'Resaltar esta tarjeta', 'sidebar' => true],
                'features'     => ['type' => 'lines', 'i18n' => true, 'label' => 'Características incluidas (una por línea)', 'rows' => 8],
                'overage'      => ['type' => 'text', 'i18n' => true, 'label' => 'Excedentes (se muestran donde hay conmutador mensual/anual)', 'placeholder' => '+$1,000/usuario, +$120/GB…'],
                'cta_text'     => ['type' => 'text', 'i18n' => true, 'label' => 'Texto del botón', 'default' => 'Comenzar prueba gratuita'],
                'cta_style'    => ['type' => 'select', 'label' => 'Estilo del botón', 'options' => ['outline' => 'Contorno', 'primary' => 'Relleno']],
                'cta_url'      => ['type' => 'text', 'label' => 'Enlace del botón', 'default' => '#contacto'],
                'order'        => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
        'equipo' => [
            'label' => 'Equipo',
            'group' => 'Páginas',
            'label_singular' => 'Integrante',
            'routes' => ['es' => 'equipo'],
            'no_list' => true,
            'noindex' => true,   // páginas de detalle de relleno: fuera del índice y del sitemap
            'template_single' => 'miembro',
            'schema' => 'Person',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['role', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'bio', 'image_field' => 'photo',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Nombre', 'required' => true],
                'role'  => ['type' => 'text', 'i18n' => true, 'label' => 'Cargo', 'sidebar' => true],
                'bio'   => ['type' => 'textarea', 'i18n' => true, 'label' => 'Semblanza', 'rows' => 4],
                'photo' => ['type' => 'image', 'label' => 'Foto (cuadrada, 400×400)', 'sidebar' => true],
                'order' => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
        'faq' => [
            'label' => 'Preguntas frecuentes',
            'group' => 'Páginas',
            'label_singular' => 'Pregunta',
            'routes' => ['es' => 'preguntas'],
            'no_list' => true,
            'noindex' => true,   // páginas de detalle de relleno: fuera del índice y del sitemap
            'template_single' => 'pregunta',
            'schema' => 'Question',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['section', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'answer_plain', 'image_field' => '',
            'fields' => [
                'title'   => ['type' => 'text', 'i18n' => true, 'label' => 'Pregunta', 'required' => true],
                'section' => ['type' => 'select', 'label' => 'Página', 'sidebar' => true,
                              'options' => ['precios' => 'Precios (/precios)', 'seguridad' => 'Seguridad (/seguridad)']],
                'answer'  => ['type' => 'html', 'i18n' => true, 'label' => 'Respuesta'],
                'order'   => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
    ],

    // Constructor de páginas: paleta de fondos que ofrece la pestaña "Estilo" de cada sección (clases sec-bg-* en sections.css)
    'sections' => [
        'palette' => ['white' => 'Blanco', 'light' => 'Gris claro', 'dark' => 'Oscuro', 'primary' => 'Índigo', 'gradient' => 'Degradado de marca'],
        // clases del tema que usan los bloques de los paquetes (cabecera estándar, botones)
        'classes' => ['container' => 'container', 'header' => 'section-header', 'title' => 'section-title', 'subtitle' => 'section-subtitle', 'btn' => 'btn btn-primary'],
    ],
    // Paquetes de bloques y efectos compartidos (cms/packs/*): galería 3D, carrusel, lightbox, shader, luz en tarjetas, degradado
    'packs' => ['visual', 'motion'],
    'block_aliases' => ['galeria3d' => 'visual/galeria3d'],   // páginas guardadas con el bloque antiguo del tema

    'pages' => [
        // 'derecho' ya no es plantilla fija: es la página "Abogados" del constructor (data/content/paginas/derecho.json)
        // 'precios' y 'seguridad' son páginas del constructor (data/content/paginas/precios.json y seguridad.json)
        'buscar'    => ['label' => 'Buscar', 'routes' => ['es' => 'buscar', 'en' => 'search'], 'template' => 'buscar', 'noindex' => true],
    ],

    'settings' => [
        'Enlaces y demos' => [
            'demo_teams_url'   => ['type' => 'url', 'label' => 'Demo de Teams (botón "Entrar al demo")'],
            'demo_derecho_url' => ['type' => 'url', 'label' => 'Demo para abogados (botón "Usar Demo")'],
            'blog_url'         => ['type' => 'url', 'label' => 'Blog'],
            'help_url'         => ['type' => 'text', 'label' => 'Centro de ayuda'],
            'presentacion_url' => ['type' => 'text', 'label' => 'Presentación comercial'],
            'youtube_video_id' => ['type' => 'text', 'label' => 'ID del video de YouTube "Mira Iurefficient en acción"'],
            'youtube_why_url'  => ['type' => 'url', 'label' => 'Video "¿Por qué usar Iurefficient?" (botón rojo en /derecho)'],
        ],
        'Imágenes del sitio' => [
            'logo_teams'       => ['type' => 'image', 'label' => 'Logotipo de Teams (cabecera de la portada)'],
            'dashboard_mockup' => ['type' => 'image', 'label' => 'Captura del dashboard (hero)'],
            'screenshots'      => ['type' => 'images', 'label' => 'Capturas de la galería 3D (una por línea, en orden)', 'rows' => 7],
            'logo_white'       => ['type' => 'image', 'label' => 'Logotipo blanco (pie de página)'],
            'team_placeholder' => ['type' => 'image', 'label' => 'Foto por defecto del equipo (si un integrante no tiene foto)'],
        ],
        'Menú de la landing para abogados' => [
            'menu_derecho' => ['type' => 'lines', 'label' => 'Enlaces del menú (una por línea: Texto | URL | 1 para abrir en pestaña nueva)', 'rows' => 7],
            'menu_derecho_en' => ['type' => 'lines', 'label' => 'Enlaces del menú en inglés (mismo formato; vacío = usa los de español)', 'rows' => 7],
        ],
    ],

    'strings_groups' => [
        'Precios (conmutador mensual/anual)' => ['p_toggle_monthly', 'p_toggle_annual', 'p_toggle_discount'],
        'Páginas, artículos y proyectos' => ['pg_cta_title', 'pg_cta_text', 'pg_cta_button', 'articulos_title', 'articulos_intro', 'articulos_empty', 'articulos_meta_title', 'articulos_meta_desc',
                            'proyectos_title', 'proyectos_intro', 'proyectos_empty', 'proyectos_meta_title', 'proyectos_meta_desc', 'read_more', 'back_to_list', 'toc_title', 'published_on', 'by_author'],
        'Buscador' => ['search_placeholder', 'search_button', 'search_title', 'search_results', 'search_one', 'search_empty', 'search_hint', 'buscar_meta_title', 'search_type_page', 'search_type_article', 'search_type_project', 'search_type_legal', 'search_type_faq', 'search_type_home'],
        'Navegación y pie' => ['nav_btn_abogados', 'nav_btn_demo_teams', 'nav_btn_demo_derecho', 't_footer_tagline', 't_footer_beta_note', 'footer_copy', 'footer_made', 'crumb_home', 'not_found_title', 'not_found_text', 'go_home'],
        'Formulario de contacto' => ['f_name_ph', 'f_email_ph', 'f_email_ph_teams', 'f_phone_ph', 'f_size_teams', 'f_size_derecho'],
        'SEO (título y descripción de cada página)' => ['home_meta_title', 'home_meta_desc', 'buscar_meta_title'],
    ],

    // El formulario de la landing envía a /api/send-contact.php (correo HTML + confirmación al cliente).
    // Este bloque solo aplica si algún día se usa el receptor genérico /_cms/form.
    'form' => ['required' => ['nombre', 'email'], 'email_field' => 'email', 'name_field' => 'nombre', 'honeypot' => 'empresa_web2'],
    'max_image_width' => 1800,
    'code_editor' => true,
];
