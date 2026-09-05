<?php
/**
 * Iurefficient — catálogo de bloques (secciones) para el constructor de páginas.
 * Cada clave tiene su vista en site/blocks/<clave>.php. Campos: los mismos tipos que en config.php.
 * 'wrap_class' se añade al <section> envolvente (para reutilizar el CSS de las landings).
 * 'styles' limita los controles de estilo (ausente = todos).
 */
declare(strict_types=1);

$brandOpt = ['derecho' => 'Iurefficient (Abogados)', 'teams' => 'Iurefficient Teams'];
return [
    // ---- Cabeceras -------------------------------------------------------------------------------
    'hero' => [
        'label' => 'Hero', 'group' => 'Cabeceras', 'desc' => 'Título grande, subtítulo, botones, imagen y fondo animado opcional.',
        'wrap_class' => 'hero', 'styles' => ['bg', 'text', 'anchor', 'class', 'hide_mobile'],
        'fields' => [
            'title'    => ['type' => 'text', 'label' => 'Título (admite <span class="gradient-text">…</span> para el degradado)', 'required' => true],
            'subtitle' => ['type' => 'textarea', 'label' => 'Subtítulo (admite negritas y cursivas en HTML)', 'rows' => 2],
            'buttons'  => ['type' => 'lines', 'label' => 'Botones, uno por línea: Texto | URL | estilo (primary, secondary, outline, youtube)', 'rows' => 3, 'default' => ['Solicitar demo | #contacto | primary']],
            'image'    => ['type' => 'image', 'label' => 'Imagen (captura o mockup; vacío = captura del dashboard de Ajustes)'],
            'badges'   => ['type' => 'lines', 'label' => 'Insignias bajo la imagen: emoji | texto', 'rows' => 3],
            'shader'   => ['type' => 'checkbox', 'label' => 'Fondo', 'text' => 'Fondo animado (shader)', 'default' => true],
        ],
    ],
    'insignias' => [
        'label' => 'Insignias', 'group' => 'Cabeceras', 'desc' => 'Fila de sellos o logotipos de confianza (emoji + texto).',
        'wrap_class' => 'sec-generic',
        'fields' => [
            'title' => ['type' => 'text', 'label' => 'Título (opcional)'],
            'items' => ['type' => 'lines', 'label' => 'Insignias, una por línea: emoji | texto', 'rows' => 4, 'default' => ['🔒 | Cifrado AES-256', '🛡️ | Seguridad Enterprise']],
            'button_text' => ['type' => 'text', 'label' => 'Texto del botón (opcional)', 'half' => true],
            'button_url'  => ['type' => 'text', 'label' => 'URL del botón', 'half' => true],
        ],
    ],

    // ---- Contenido --------------------------------------------------------------------------------
    'texto' => [
        'label' => 'Texto', 'group' => 'Contenido', 'desc' => 'Texto libre con el editor visual (títulos, listas, imágenes, videos).',
        'wrap_class' => 'sec-generic',
        'fields' => ['body' => ['type' => 'html', 'label' => 'Contenido', 'size' => 'lg']],
    ],
    'columnas' => [
        'label' => 'Texto e imagen', 'group' => 'Contenido', 'desc' => 'Dos columnas: texto a un lado e imagen al otro.',
        'wrap_class' => 'sec-generic',
        'fields' => [
            'title' => ['type' => 'text', 'label' => 'Título'],
            'body'  => ['type' => 'html', 'label' => 'Texto'],
            'image' => ['type' => 'image', 'label' => 'Imagen'],
            'side'  => ['type' => 'select', 'label' => 'Imagen a la', 'options' => ['right' => 'Derecha', 'left' => 'Izquierda'], 'default' => 'right'],
            'button_text' => ['type' => 'text', 'label' => 'Texto del botón (opcional)'],
            'button_url'  => ['type' => 'text', 'label' => 'URL del botón'],
        ],
    ],
    'imagen' => [
        'label' => 'Imagen', 'group' => 'Contenido', 'desc' => 'Una imagen con pie opcional.',
        'wrap_class' => 'sec-generic',
        'fields' => [
            'image'   => ['type' => 'image', 'label' => 'Imagen', 'required' => true],
            'alt'     => ['type' => 'text', 'label' => 'Texto alternativo (accesibilidad y SEO)'],
            'caption' => ['type' => 'text', 'label' => 'Pie de imagen (opcional)'],
            'link'    => ['type' => 'text', 'label' => 'Enlace al hacer clic (opcional)'],
        ],
    ],
    'video' => [
        'label' => 'Video', 'group' => 'Contenido', 'desc' => 'Video de YouTube o Vimeo con título.',
        'wrap_class' => 'video-section',
        'fields' => [
            'title'    => ['type' => 'text', 'label' => 'Título (admite <span class="gradient-text">…</span>)', 'default' => 'Mira Iurefficient <span class="gradient-text">en acción</span>'],
            'subtitle' => ['type' => 'text', 'label' => 'Subtítulo'],
            'url'      => ['type' => 'text', 'label' => 'URL del video (YouTube o Vimeo)', 'required' => true, 'placeholder' => 'https://www.youtube.com/watch?v=…'],
        ],
    ],
    'galeria3d' => [
        'label' => 'Galería 3D', 'group' => 'Contenido', 'desc' => 'Capturas en la galería tridimensional con scroll.',
        'wrap_class' => 'screenshots', 'styles' => ['anchor', 'class', 'hide_mobile'],
        'fields' => [
            'title'    => ['type' => 'text', 'label' => 'Título', 'default' => 'Conoce la <span class="gradient-text">plataforma</span>'],
            'subtitle' => ['type' => 'text', 'label' => 'Subtítulo'],
            'hint'     => ['type' => 'text', 'label' => 'Texto de ayuda', 'default' => 'Usa el scroll para explorar'],
            'images'   => ['type' => 'images', 'label' => 'Imágenes (una por línea; vacío = capturas de Ajustes)', 'rows' => 5],
        ],
    ],
    'html' => [
        'label' => 'HTML', 'group' => 'Contenido', 'desc' => 'Código HTML tal cual (avanzado).',
        'wrap_class' => 'sec-generic',
        'fields' => ['code' => ['type' => 'code', 'label' => 'HTML', 'rows' => 10]],
    ],
    'separador' => [
        'label' => 'Espacio', 'group' => 'Contenido', 'desc' => 'Espacio en blanco o línea entre secciones.',
        'styles' => ['bg', 'anchor', 'class', 'hide_mobile'],
        'fields' => [
            'size' => ['type' => 'select', 'label' => 'Altura', 'options' => ['s' => 'Pequeño', 'm' => 'Medio', 'l' => 'Grande'], 'default' => 'm'],
            'line' => ['type' => 'checkbox', 'label' => 'Línea', 'text' => 'Mostrar una línea'],
        ],
    ],

    // ---- Tarjetas y listas ------------------------------------------------------------------------
    'tarjetas' => [
        'label' => 'Tarjetas', 'group' => 'Tarjetas y listas', 'desc' => 'Rejilla de tarjetas con icono, título y texto (características, beneficios, seguridad, para quién).',
        'wrap_class_by' => ['field' => 'variant', 'map' => ['feature' => 'features', 'benefit' => 'benefits', 'security' => 'security', 'audience' => 'audience']],
        'fields' => [
            'title'    => ['type' => 'text', 'label' => 'Título (admite <span class="gradient-text">…</span>)'],
            'subtitle' => ['type' => 'text', 'label' => 'Subtítulo'],
            'items'    => ['type' => 'lines', 'label' => 'Tarjetas, una por línea: Título | Texto | icono (emoji o: doc, users, bot, calendar, lock, shield, check, cloud, chart, clock)', 'rows' => 6, 'required' => true,
                           'default' => ['Gestión de documentos | Organiza y analiza documentos con IA. | doc', 'Control de casos | Expedientes y clientes en un solo lugar. | users']],
            'variant'  => ['type' => 'select', 'label' => 'Estilo', 'options' => ['feature' => 'Características (icono grande, efecto luz)', 'benefit' => 'Beneficios (icono a la izquierda)', 'security' => 'Seguridad (tarjeta compacta)', 'audience' => 'Para quién (emoji grande)'], 'default' => 'feature'],
        ],
    ],
    'comparacion' => [
        'label' => 'Antes y después', 'group' => 'Tarjetas y listas', 'desc' => 'Dos columnas: sin el producto (✗) y con el producto (✓).',
        'wrap_class' => 'problem-solution',
        'fields' => [
            'title'        => ['type' => 'text', 'label' => 'Título'],
            'subtitle'     => ['type' => 'text', 'label' => 'Subtítulo'],
            'before_title' => ['type' => 'text', 'label' => 'Columna "antes": título', 'default' => 'Sin Iurefficient'],
            'before_icon'  => ['type' => 'text', 'label' => 'Emoji "antes"', 'default' => '😫'],
            'before_items' => ['type' => 'lines', 'label' => 'Puntos "antes", uno por línea', 'rows' => 4],
            'after_title'  => ['type' => 'text', 'label' => 'Columna "después": título', 'default' => 'Con Iurefficient'],
            'after_icon'   => ['type' => 'text', 'label' => 'Emoji "después"', 'default' => '😊'],
            'after_items'  => ['type' => 'lines', 'label' => 'Puntos "después", uno por línea', 'rows' => 4],
        ],
    ],
    'tabla' => [
        'label' => 'Tabla comparativa', 'group' => 'Tarjetas y listas', 'desc' => 'Tabla de características contra la competencia o entre planes.',
        'wrap_class' => 'security',
        'fields' => [
            'title'    => ['type' => 'text', 'label' => 'Título'],
            'subtitle' => ['type' => 'text', 'label' => 'Subtítulo'],
            'head'     => ['type' => 'text', 'label' => 'Encabezados separados por |', 'default' => 'Característica | Otros | Iurefficient'],
            'rows'     => ['type' => 'lines', 'label' => 'Filas, una por línea, celdas separadas por | (escribe "si" o "no" para ✓ / —)', 'rows' => 6, 'required' => true],
        ],
    ],
    'testimonio' => [
        'label' => 'Testimonio', 'group' => 'Tarjetas y listas', 'desc' => 'Cita destacada con autor.',
        'wrap_class' => 'sec-generic',
        'fields' => [
            'quote' => ['type' => 'textarea', 'label' => 'Cita', 'rows' => 3, 'required' => true],
            'cite'  => ['type' => 'text', 'label' => 'Autor o cargo'],
        ],
    ],

    // ---- Datos del sitio ---------------------------------------------------------------------------
    'planes' => [
        'label' => 'Planes de precios', 'group' => 'Datos del sitio', 'desc' => 'Tarjetas de los planes cargados en Planes de precios.',
        'wrap_class' => 'pricing',
        'fields' => [
            'title'       => ['type' => 'text', 'label' => 'Título', 'default' => 'Planes que se adaptan a <span class="gradient-text">tu práctica</span>'],
            'subtitle'    => ['type' => 'text', 'label' => 'Subtítulo', 'default' => 'Sin contratos forzosos. Cancela cuando quieras.'],
            'product'     => ['type' => 'select', 'label' => 'Planes de', 'options' => ['derecho' => 'Abogados', 'teams' => 'Teams', 'precios' => 'Página de precios'], 'default' => 'derecho'],
            'footer_text' => ['type' => 'text', 'label' => 'Enlace al pie (texto)', 'default' => 'Ver comparativa completa de planes'],
            'footer_url'  => ['type' => 'text', 'label' => 'Enlace al pie (URL)', 'default' => '/precios/'],
        ],
    ],
    'faq' => [
        'label' => 'Preguntas frecuentes', 'group' => 'Datos del sitio', 'desc' => 'Preguntas de la sección elegida, o escritas aquí.',
        'wrap_class' => 'faq-section',
        'fields' => [
            'title'   => ['type' => 'text', 'label' => 'Título', 'default' => 'Preguntas <span class="gradient-text">frecuentes</span>'],
            'section' => ['type' => 'select', 'label' => 'Origen', 'options' => ['precios' => 'Preguntas de Precios', 'seguridad' => 'Preguntas de Seguridad', '' => 'Escribirlas aquí'], 'default' => 'precios'],
            'items'   => ['type' => 'lines', 'label' => 'Preguntas propias, una por línea: Pregunta | Respuesta', 'rows' => 5],
        ],
    ],
    'equipo' => [
        'label' => 'Equipo', 'group' => 'Datos del sitio', 'desc' => 'Integrantes cargados en Equipo.',
        'wrap_class' => 'team',
        'fields' => [
            'title'    => ['type' => 'text', 'label' => 'Título', 'default' => 'Creado por abogados, <span class="gradient-text">para abogados</span>'],
            'subtitle' => ['type' => 'text', 'label' => 'Subtítulo'],
        ],
    ],
    'articulos' => [
        'label' => 'Últimos artículos', 'group' => 'Datos del sitio', 'desc' => 'Tarjetas de los artículos más recientes.',
        'wrap_class' => 'sec-generic',
        'fields' => [
            'title'       => ['type' => 'text', 'label' => 'Título', 'default' => 'Artículos y novedades'],
            'count'       => ['type' => 'number', 'label' => 'Cuántos', 'default' => 3, 'min' => 1, 'max' => 12],
            'category'    => ['type' => 'text', 'label' => 'Solo de la categoría (opcional)'],
            'button_text' => ['type' => 'text', 'label' => 'Texto del botón "ver todos"', 'default' => 'Ver todos los artículos'],
        ],
    ],
    'hijas' => [
        'label' => 'Páginas hijas', 'group' => 'Datos del sitio', 'desc' => 'Tarjetas con las páginas que cuelgan de esta.',
        'wrap_class' => 'sec-generic',
        'fields' => [
            'title' => ['type' => 'text', 'label' => 'Título (opcional)'],
            'intro' => ['type' => 'textarea', 'label' => 'Texto introductorio (opcional)', 'rows' => 2],
        ],
    ],

    // ---- Cierre ------------------------------------------------------------------------------------
    'cta' => [
        'label' => 'Llamado a la acción', 'group' => 'Cierre', 'desc' => 'Bloque final con título, texto y formulario de contacto o botón.',
        'wrap_class' => 'cta', 'styles' => ['anchor', 'class', 'hide_mobile'],
        'fields' => [
            'title'       => ['type' => 'text', 'label' => 'Título', 'default' => '¿Listo para transformar tu práctica legal?', 'required' => true],
            'text'        => ['type' => 'text', 'label' => 'Texto'],
            'form'        => ['type' => 'checkbox', 'label' => 'Formulario', 'text' => 'Mostrar el formulario de contacto', 'default' => true],
            'origin'      => ['type' => 'select', 'label' => 'Formulario para', 'options' => $brandOpt, 'default' => 'derecho'],
            'button_text' => ['type' => 'text', 'label' => 'Texto del botón', 'default' => 'Solicitar demo gratuita'],
            'button_url'  => ['type' => 'text', 'label' => 'URL del botón (solo sin formulario)'],
            'note'        => ['type' => 'text', 'label' => 'Nota pequeña', 'default' => 'Sin compromiso • Setup en 24 horas • Soporte incluido'],
        ],
    ],
];
