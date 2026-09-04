<?php
/**
 * Iurefficient — configuración del sitio para cms_simple.
 *
 * Rutas públicas:
 *   /                Portada Teams (home.php)
 *   /derecho         Landing para abogados (derecho.php)
 *   /precios         Planes y comparativa (precios.php)
 *   /seguridad       Seguridad, confidencialidad y privacidad (seguridad.php)
 *   /legal/{slug}    Aviso de privacidad, términos… (tipo "legal", legal.php)
 *   /help-portal/    Centro de ayuda (carpeta estática, fuera del CMS)
 *   /presentacion/   Presentación comercial (carpeta estática, fuera del CMS)
 *
 * Tipos de campo: text, textarea, html, date, number, url, email, select, checkbox, image, images, lines, tags.
 */
return [
    'name' => 'Iurefficient',
    'langs' => ['es'],
    'default_lang' => 'es',
    'timezone' => 'America/Mexico_City',
    'admin_logo' => 'logo.svg',

    'types' => [
        'planes' => [
            'label' => 'Planes de precios',
            'label_singular' => 'Plan',
            'routes' => ['es' => 'planes'],
            'no_list' => true,
            'template_single' => 'plan',
            'schema' => 'Product',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['product', 'price', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'description', 'image_field' => '',
            'fields' => [
                'title'        => ['type' => 'text', 'label' => 'Nombre del plan', 'required' => true],
                'product'      => ['type' => 'select', 'label' => 'Dónde se muestra', 'sidebar' => true,
                                   'options' => ['teams' => 'Portada Teams (/)', 'derecho' => 'Página Abogados (/derecho)', 'precios' => 'Página de precios (/precios)']],
                'description'  => ['type' => 'text', 'label' => 'Descripción corta (ej. "Despachos en crecimiento")'],
                'price'        => ['type' => 'text', 'label' => 'Precio mensual (solo el número, ej. 1,499)', 'sidebar' => true],
                'price_annual' => ['type' => 'text', 'label' => 'Precio con pago anual (por mes; solo se usa en /precios)', 'sidebar' => true],
                'period'       => ['type' => 'text', 'label' => 'Periodo', 'default' => 'MXN/mes', 'sidebar' => true],
                'badge'        => ['type' => 'text', 'label' => 'Etiqueta (ej. "Más popular"; vacío = sin etiqueta)', 'sidebar' => true],
                'featured'     => ['type' => 'checkbox', 'label' => 'Plan destacado', 'text' => 'Resaltar esta tarjeta', 'sidebar' => true],
                'features'     => ['type' => 'lines', 'label' => 'Características incluidas (una por línea)', 'rows' => 8],
                'overage'      => ['type' => 'text', 'label' => 'Excedentes (solo se muestra en /precios)', 'placeholder' => '+$1,000/usuario, +$120/GB…'],
                'cta_text'     => ['type' => 'text', 'label' => 'Texto del botón', 'default' => 'Comenzar prueba gratuita'],
                'cta_style'    => ['type' => 'select', 'label' => 'Estilo del botón', 'options' => ['outline' => 'Contorno', 'primary' => 'Relleno']],
                'cta_url'      => ['type' => 'text', 'label' => 'Enlace del botón', 'default' => '#contacto'],
                'order'        => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
        'equipo' => [
            'label' => 'Equipo',
            'label_singular' => 'Integrante',
            'routes' => ['es' => 'equipo'],
            'no_list' => true,
            'template_single' => 'miembro',
            'schema' => 'Person',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['role', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'bio', 'image_field' => 'photo',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Nombre', 'required' => true],
                'role'  => ['type' => 'text', 'label' => 'Cargo', 'sidebar' => true],
                'bio'   => ['type' => 'textarea', 'label' => 'Semblanza', 'rows' => 4],
                'photo' => ['type' => 'image', 'label' => 'Foto (cuadrada, 400×400)', 'sidebar' => true],
                'order' => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
        'faq' => [
            'label' => 'Preguntas frecuentes',
            'label_singular' => 'Pregunta',
            'routes' => ['es' => 'preguntas'],
            'no_list' => true,
            'template_single' => 'pregunta',
            'schema' => 'Question',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['section', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'answer_plain', 'image_field' => '',
            'fields' => [
                'title'   => ['type' => 'text', 'label' => 'Pregunta', 'required' => true],
                'section' => ['type' => 'select', 'label' => 'Página', 'sidebar' => true,
                              'options' => ['precios' => 'Precios (/precios)', 'seguridad' => 'Seguridad (/seguridad)']],
                'answer'  => ['type' => 'html', 'label' => 'Respuesta'],
                'order'   => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
        'legal' => [
            'label' => 'Páginas legales',
            'label_singular' => 'Página legal',
            'routes' => ['es' => 'legal'],
            'no_list' => true,
            'template_single' => 'legal',
            'schema' => 'WebPage',
            'sort' => ['field' => 'order', 'dir' => 'asc'],
            'list' => ['updated_label', 'order'],
            'title_field' => 'title', 'excerpt_field' => 'summary', 'image_field' => '',
            'fields' => [
                'title'         => ['type' => 'text', 'label' => 'Título', 'required' => true],
                'updated_label' => ['type' => 'text', 'label' => 'Texto de última actualización', 'placeholder' => 'Última actualización: Enero 2025', 'sidebar' => true],
                'summary'       => ['type' => 'textarea', 'label' => 'Resumen (recuadro destacado al inicio)', 'rows' => 3],
                'body'          => ['type' => 'html', 'label' => 'Contenido', 'size' => 'lg',
                                    'help' => 'Los subtítulos (Título 2) generan el índice automáticamente. Las citas se muestran como recuadros destacados.'],
                'order'         => ['type' => 'number', 'label' => 'Orden', 'sidebar' => true],
            ],
        ],
    ],

    'pages' => [
        'derecho'   => ['label' => 'Abogados', 'routes' => ['es' => 'derecho'], 'template' => 'derecho', 'schema' => 'WebPage'],
        'precios'   => ['label' => 'Precios', 'routes' => ['es' => 'precios'], 'template' => 'precios', 'schema' => 'WebPage'],
        'seguridad' => ['label' => 'Seguridad', 'routes' => ['es' => 'seguridad'], 'template' => 'seguridad', 'schema' => 'WebPage'],
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
        ],
    ],

    'strings_groups' => [
        'Portada Teams' => ['t_hero_title', 't_hero_subtitle', 't_hero_cta1', 't_hero_cta2', 't_problem_title', 't_problem_subtitle', 't_solution_title', 't_solution_subtitle',
                            't_video_title', 't_video_subtitle', 't_gallery_title', 't_gallery_subtitle', 't_gallery_hint', 't_audience_title', 't_audience_subtitle',
                            't_testimonial', 't_testimonial_cite', 't_compare_title', 't_compare_subtitle', 't_pricing_title', 't_pricing_subtitle',
                            't_security_title', 't_security_subtitle', 't_cta_title', 't_cta_button', 't_cta_note', 't_footer_tagline', 't_footer_beta_note'],
        'Landing Abogados (/derecho)' => ['d_hero_title', 'd_hero_subtitle', 'd_hero_cta1', 'd_hero_cta_youtube', 'd_hero_cta2', 'd_problem_title', 'd_problem_subtitle',
                            'd_features_title', 'd_features_subtitle', 'd_video_title', 'd_video_subtitle', 'd_gallery_title', 'd_gallery_subtitle', 'd_gallery_hint', 'd_benefits_title',
                            'd_security_title', 'd_security_subtitle', 'd_security_standards_title', 'd_security_more', 'd_team_title', 'd_team_subtitle',
                            'd_pricing_title', 'd_pricing_subtitle', 'd_pricing_footer', 'd_cta_title', 'd_cta_text', 'd_cta_button', 'd_cta_note', 'd_footer_tagline'],
        'Precios (/precios)' => ['p_hero_title', 'p_hero_text', 'p_toggle_monthly', 'p_toggle_annual', 'p_toggle_discount', 'p_compare_title', 'p_compare_subtitle',
                            'p_faq_title', 'p_guarantee_title', 'p_guarantee_text', 'p_cta_title', 'p_cta_text', 'p_cta_button'],
        'Seguridad (/seguridad)' => ['s_hero_title', 's_hero_text', 's_hero_update', 's_faq_title', 's_contact_title', 's_contact_text', 's_contact_report', 's_cta_title', 's_cta_text', 's_cta_button', 's_footer_doc'],
        'Navegación y pie' => ['nav_btn_abogados', 'nav_btn_demo_teams', 'nav_btn_demo_derecho', 'footer_copy', 'footer_made', 'crumb_home', 'not_found_title', 'not_found_text', 'go_home'],
        'Formulario de contacto' => ['f_name_ph', 'f_email_ph', 'f_email_ph_teams', 'f_phone_ph', 'f_size_teams', 'f_size_derecho'],
        'SEO (título y descripción de cada página)' => ['home_meta_title', 'home_meta_desc', 'derecho_meta_title', 'derecho_meta_desc', 'precios_meta_title', 'precios_meta_desc',
                            'seguridad_meta_title', 'seguridad_meta_desc'],
    ],

    // El formulario de la landing envía a /api/send-contact.php (correo HTML + confirmación al cliente).
    // Este bloque solo aplica si algún día se usa el receptor genérico /_cms/form.
    'form' => ['required' => ['nombre', 'email'], 'email_field' => 'email', 'name_field' => 'nombre', 'honeypot' => 'empresa_web2'],
    'max_image_width' => 1800,
    'code_editor' => true,
];
