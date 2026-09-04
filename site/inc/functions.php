<?php
/** Iurefficient — helpers del tema. Disponibles en layout y plantillas. */
declare(strict_types=1);

/** Marca visual de la página: "teams" (portada y precios) o "derecho" (landing legal, seguridad, legales). */
function iure_brand(array $page): string
{
    $r = $page['route'] ?? '';
    $item = $GLOBALS['item'] ?? null;
    if ($r === 'home' || $r === 'page:precios') return 'teams';
    if ($r === 'item:planes' && !empty($item['product']) && $item['product'] !== 'derecho') return 'teams';
    // Páginas, artículos y proyectos eligen su cabecera y pie en el panel (campo "brand").
    if (in_array($r, ['item:paginas', 'item:articulos', 'item:proyectos'], true) && ($item['brand'] ?? '') === 'teams') return 'teams';
    if ($r === 'page:buscar' && ($_GET['b'] ?? '') === 'teams') return 'teams';
    return 'derecho';
}

/** Hoja de estilo extra de una ruta (site/assets/css/<nombre>.css) y clase page-<nombre> del body. */
function iure_page_css(string $route): string
{
    if ($route === 'page:precios') return 'precios';
    if ($route === 'page:seguridad') return 'seguridad';
    // Legales, páginas libres, artículos, proyectos, preguntas y 404 comparten la tipografía de legal.css
    if ($route === '404' || $route === 'page:buscar' || preg_match('#^(item|list):(legal|paginas|articulos|proyectos|faq)$#', $route)) return 'legal';
    return '';
}

/** Bloque final de contacto para páginas libres, artículos y proyectos (textos pg_cta_*). */
function iure_page_cta(string $brand): string
{
    $lang = cms_default_lang();
    $t = fn(string $k, string $d) => (string) cms_t($k, $lang, $d);
    $dest = ($brand === 'teams' ? cms_url('home', $lang) : cms_url('page:derecho', $lang) . '/') . '#contacto';
    return '<div class="page-cta"><h2>' . cms_e($t('pg_cta_title', '¿Quieres ver Iurefficient en acción?')) . '</h2>'
        . '<p>' . cms_e($t('pg_cta_text', 'Agenda una demostración o empieza tu prueba gratuita hoy mismo.')) . '</p>'
        . '<a class="btn btn-primary btn-lg" href="' . cms_e($dest) . '">' . cms_e($t('pg_cta_button', 'Solicitar demo')) . '</a></div>';
}

/** Texto fijo que puede contener HTML sencillo (spans de color, negritas). Sin escapar. */
function iure_h(string $key, string $default = ''): string
{
    return (string) cms_t($key, cms_default_lang(), $default);
}

/** Enlaces de ajustes con valores por defecto (por si el ajuste está vacío). */
function iure_link(string $key): string
{
    $S = cms_settings();
    $defaults = [
        'demo_teams_url' => 'https://0.ds.iurefficient.com',
        'demo_derecho_url' => 'https://demo.iurefficient.com',
        'blog_url' => 'https://blog.iurefficient.com',
        'help_url' => '/help-portal/',
        'presentacion_url' => '/presentacion/',
        'youtube_video_id' => 'SAdlFVYjVI0',
        'youtube_why_url' => 'https://www.youtube.com/watch?v=2RqRNHPVC9U',
    ];
    $v = trim((string) ($S[$key] ?? ''));
    $v = $v !== '' ? $v : ($defaults[$key] ?? '');
    return preg_match('#^/#', $v) ? CMS_BASE . $v : $v;
}

/** Ruta pública de una imagen del tema (site/assets/img) o subida (uploads/). */
function iure_img(string $path, string $fallback = ''): string
{
    $p = trim($path) !== '' ? $path : $fallback;
    return $p === '' ? '' : cms_img($p);
}

/** Capturas de pantalla para la galería 3D (ajuste "screenshots" o las 7 por defecto). */
function iure_screenshots(): array
{
    $S = cms_settings();
    $list = array_values(array_filter((array) ($S['screenshots'] ?? [])));
    if (!$list) for ($i = 1; $i <= 7; $i++) $list[] = 'screenshot-' . $i . '.png';
    return array_map('cms_img', $list);
}

/** Planes publicados de un producto (teams | derecho | precios). */
function iure_planes(string $product): array
{
    return array_values(array_filter(cms_items('planes'), fn($p) => ($p['product'] ?? '') === $product));
}

/** Preguntas frecuentes publicadas de una sección (precios | seguridad). */
function iure_faq(string $section): array
{
    return array_values(array_filter(cms_items('faq'), fn($p) => ($p['section'] ?? '') === $section));
}

/** Tarjeta de plan (portada, /derecho y /precios). $withAnnual añade data-monthly/data-annual y excedentes. */
function iure_plan_card(array $p, int $delay = 0, bool $withAnnual = false): string
{
    $featured = !empty($p['featured']);
    $style = ($p['cta_style'] ?? 'outline') === 'primary' ? 'btn-primary' : 'btn-outline';
    $price = (string) ($p['price'] ?? '');
    $annual = (string) ($p['price_annual'] ?? '');
    $h = '<div class="pricing-card' . ($featured ? ' pricing-featured' : '') . '" data-aos="fade-up" data-aos-delay="' . $delay . '">';
    if (!empty($p['badge'])) $h .= '<div class="pricing-badge">' . cms_e($p['badge']) . '</div>';
    $h .= '<div class="pricing-header"><h3>' . cms_e($p['title'] ?? '') . '</h3>';
    if (!empty($p['description'])) $h .= '<p class="pricing-description">' . cms_e($p['description']) . '</p>';
    $h .= '</div>';
    $h .= '<div class="pricing-price"><span class="currency">$</span><span class="amount"'
        . ($withAnnual && $annual !== '' ? ' data-monthly="' . cms_e($price) . '" data-annual="' . cms_e($annual) . '"' : '')
        . '>' . cms_e($price) . '</span><span class="period">' . cms_e($p['period'] ?? 'MXN/mes') . '</span></div>';
    $h .= '<ul class="pricing-features">';
    foreach ((array) ($p['features'] ?? []) as $f) {
        $h .= '<li><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> ' . cms_e($f) . '</li>';
    }
    $h .= '</ul>';
    if ($withAnnual && !empty($p['overage'])) $h .= '<p class="pricing-overage">Excedentes: ' . cms_e($p['overage']) . '</p>';
    $h .= '<a href="' . cms_e($p['cta_url'] ?: '#contacto') . '" class="btn ' . $style . ' btn-block">' . cms_e($p['cta_text'] ?: 'Comenzar prueba gratuita') . '</a>';
    return $h . '</div>';
}

/** Formulario de contacto de las landings (envía a /api/send-contact.php vía main.js). */
function iure_contact_form(string $origin, string $buttonText): string
{
    $lang = cms_default_lang();
    $t = fn(string $k, string $d) => (string) cms_t($k, $lang, $d);
    $sizes = $origin === 'teams'
        ? $t('f_size_teams', "Tamano de tu equipo\n1-5|1-5 personas\n6-20|6-20 personas\n21-50|21-50 personas\n50+|Mas de 50")
        : $t('f_size_derecho', "Tamaño de tu despacho\n1|Solo yo\n2-5|2-5 abogados\n6-20|6-20 abogados\n20+|Más de 20");
    $lines = cms_lines($sizes);
    $ph = array_shift($lines) ?: '';
    $h = '<form class="cta-form" id="contactForm">';
    $h .= '<input type="hidden" name="origen" value="' . cms_e($origin) . '">';
    $h .= '<div class="form-row"><input type="text" name="nombre" placeholder="' . cms_e($t('f_name_ph', 'Tu nombre')) . '" required>';
    $h .= '<input type="email" name="email" placeholder="' . cms_e($origin === 'teams' ? $t('f_email_ph_teams', 'Tu email corporativo') : $t('f_email_ph', 'Tu email')) . '" required></div>';
    $h .= '<div class="form-row"><input type="tel" name="telefono" placeholder="' . cms_e($t('f_phone_ph', 'Tu teléfono (opcional)')) . '">';
    $h .= '<select name="tamano"><option value="">' . cms_e($ph) . '</option>';
    foreach ($lines as $l) {
        [$v, $label] = array_pad(array_map('trim', explode('|', $l, 2)), 2, '');
        $h .= '<option value="' . cms_e($v) . '">' . cms_e($label !== '' ? $label : $v) . '</option>';
    }
    $h .= '</select></div>';
    $h .= '<button type="submit" class="btn btn-primary btn-lg btn-block">' . cms_e($buttonText)
        . ' <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>';
    return $h . '</form>';
}

/** Añade id a los <h2> del contenido (legales y páginas libres) y devuelve [html, [[id, texto], …]] para el índice. */
function iure_legal_body(string $html): array
{
    $toc = [];
    $html = preg_replace_callback('#<h2([^>]*)>(.*?)</h2>#is', function ($m) use (&$toc) {
        $text = trim(strip_tags($m[2]));
        $id = preg_match('/id="([^"]+)"/', $m[1], $im) ? $im[1] : cms_slugify(preg_replace('/^\d+[.)]?\s*/', '', $text));
        $toc[] = [$id, $text];
        $attrs = preg_replace('/\s*id="[^"]*"/', '', $m[1]);
        return '<h2 id="' . cms_e($id) . '"' . $attrs . '>' . $m[2] . '</h2>';
    }, $html);
    return [$html, $toc];
}

/** Iconos sociales del pie: usa Ajustes → Redes si hay URL; si no, deja los enlaces vacíos como en el sitio original. */
function iure_footer_social(): string
{
    $S = cms_settings();
    $li = $S['social']['linkedin'] ?? '';
    $x = $S['social']['x'] ?? '';
    $svgLi = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>';
    $svgX = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>';
    $ext = fn($u) => $u ? ' target="_blank" rel="noopener"' : '';
    return '<div class="footer-social"><a href="' . cms_e($li ?: '#') . '" aria-label="LinkedIn"' . $ext($li) . '>' . $svgLi . '</a>'
        . '<a href="' . cms_e($x ?: '#') . '" aria-label="Twitter"' . $ext($x) . '>' . $svgX . '</a></div>';
}

/** JSON-LD adicional del tema según la ruta: FAQPage en /precios y /seguridad, SoftwareApplication con ofertas en / y /derecho. */
function iure_jsonld(array $page): ?array
{
    $route = $page['route'] ?? '';
    $lang = $page['lang'] ?? cms_default_lang();
    $S = cms_settings();
    $site = $S['site_name'] ?? cms_config('name');
    $org = ['@id' => cms_site_url() . '/#organization'];
    if ($route === 'page:precios' || $route === 'page:seguridad') {
        $faq = iure_faq($route === 'page:precios' ? 'precios' : 'seguridad');
        if (!$faq) return null;
        $q = [];
        foreach ($faq as $f) {
            $a = trim(preg_replace('/\s+/', ' ', strip_tags(cms_content((string) ($f['answer'] ?? '')))));
            if ($a === '') continue;
            $q[] = ['@type' => 'Question', 'name' => (string) ($f['title'] ?? ''), 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $a]];
        }
        return $q ? ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $q] : null;
    }
    if ($route === 'home' || $route === 'page:derecho') {
        $teams = $route === 'home';
        $planes = iure_planes($teams ? 'teams' : 'derecho');
        $url = cms_abs_url($teams ? cms_url('home', $lang) : cms_url('page:derecho', $lang));
        $offers = [];
        foreach ($planes as $p) {
            $price = preg_replace('/[^\d.]/', '', (string) ($p['price'] ?? ''));
            if ($price === '') continue;
            $offers[] = ['@type' => 'Offer', 'name' => (string) ($p['title'] ?? ''), 'price' => $price, 'priceCurrency' => 'MXN',
                'description' => trim(((string) ($p['description'] ?? '')) . ' ' . implode(', ', (array) ($p['features'] ?? []))),
                'url' => cms_abs_url(cms_url('page:precios', $lang)), 'availability' => 'https://schema.org/InStock',
                'priceSpecification' => ['@type' => 'UnitPriceSpecification', 'price' => $price, 'priceCurrency' => 'MXN', 'billingDuration' => 'P1M']];
        }
        $app = ['@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
            'name' => $teams ? $site . ' Teams' : $site,
            'url' => $url,
            'applicationCategory' => 'BusinessApplication',
            'applicationSubCategory' => $teams ? 'Gestión de proyectos con IA' : 'Software de gestión de casos para abogados',
            'operatingSystem' => 'Web',
            'inLanguage' => 'es-MX',
            'description' => (string) cms_t($teams ? 'home_meta_desc' : 'derecho_meta_desc', $lang),
            'publisher' => $org, 'provider' => $org, 'areaServed' => 'MX'];
        if ($offers) $app['offers'] = $offers;
        if (!empty($S['dashboard_mockup']) || $teams) $app['screenshot'] = cms_abs_url(iure_img((string) ($S['dashboard_mockup'] ?? ''), 'dashboard-mockup.png'));
        return $app;
    }
    return null;
}

/* ------------------------------------------------------------------ buscador del sitio (/buscar?q=) */

/** Minúsculas sin acentos, para comparar. */
function iure_norm(string $s): string
{
    $s = mb_strtolower(html_entity_decode(strip_tags($s), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    return strtr($s, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n']);
}

/** Expresión regular que encuentra $word ignorando mayúsculas y acentos (para resaltar). */
function iure_word_regex(string $word): string
{
    $map = ['a' => '[aáÁ]', 'e' => '[eéÉ]', 'i' => '[iíÍ]', 'o' => '[oóÓ]', 'u' => '[uúüÚÜ]', 'n' => '[nñÑ]'];
    $re = '';
    foreach (preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY) as $ch) $re .= $map[$ch] ?? preg_quote($ch, '/');
    return '/' . $re . '/iu';
}

/** Fuentes de la búsqueda: [etiqueta, título, url, texto largo, fecha]. */
function iure_search_sources(string $lang): array
{
    $src = [];
    $types = [
        'articulos' => ['Artículo', ['excerpt', 'body']],
        'paginas'   => ['Página', ['subtitle', 'summary', 'body']],
        'proyectos' => ['Proyecto', ['excerpt', 'body', 'results']],
        'legal'     => ['Legal', ['summary', 'body']],
        'faq'       => ['Pregunta frecuente', ['answer']],
    ];
    foreach ($types as $type => [$label, $fields]) {
        if (!cms_type($type)) continue;
        foreach (cms_items($type) as $it) {
            $text = '';
            foreach ($fields as $f) { $v = $it[$f] ?? ''; $text .= ' ' . (is_array($v) ? implode(' ', $v) : (string) $v); }
            $src[] = [$label, (string) ($it['title'] ?? ''), cms_url('item:' . $type, $lang, $it['slug']), cms_content($text), (string) ($it['date'] ?? $it['updated'] ?? '')];
        }
    }
    // páginas fijas: título SEO, descripción y todos los textos de su grupo en Textos del sitio
    $pages = [
        'home'      => ['Portada Teams', 'home_meta_title', 'home_meta_desc', cms_url('home', $lang)],
        'derecho'   => ['Landing Abogados (/derecho)', 'derecho_meta_title', 'derecho_meta_desc', cms_url('page:derecho', $lang)],
        'precios'   => ['Precios (/precios)', 'precios_meta_title', 'precios_meta_desc', cms_url('page:precios', $lang)],
        'seguridad' => ['Seguridad (/seguridad)', 'seguridad_meta_title', 'seguridad_meta_desc', cms_url('page:seguridad', $lang)],
    ];
    $groups = (array) cms_config('strings_groups');
    foreach ($pages as $k => [$group, $tk, $dk, $url]) {
        $text = (string) cms_t($dk, $lang);
        foreach ((array) ($groups[$group] ?? []) as $key) { $v = cms_t($key, $lang); $text .= ' ' . (is_array($v) ? implode(' ', $v) : (string) $v); }
        $src[] = ['Página', (string) cms_t($tk, $lang, ucfirst($k)), $url, $text, ''];
    }
    return $src;
}

/** Busca $q en todo el sitio. Devuelve [['label','title','url','snippet','score'], …] ordenado por relevancia. */
function iure_search(string $q, string $lang, int $max = 50): array
{
    $words = array_values(array_filter(preg_split('/\s+/', iure_norm($q)), fn($w) => mb_strlen($w) >= 2));
    if (!$words) return [];
    $out = [];
    foreach (iure_search_sources($lang) as [$label, $title, $url, $text, $date]) {
        $nt = iure_norm($title);
        $plain = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        $nb = iure_norm($plain);
        $score = 0;
        foreach ($words as $w) {
            $inT = mb_strpos($nt, $w) !== false;
            $inB = mb_strpos($nb, $w) !== false;
            if (!$inT && !$inB) { $score = 0; break; }
            $score += ($inT ? 5 : 0) + ($inB ? 1 : 0);
        }
        if ($score === 0) continue;
        if (mb_strpos($nt, implode(' ', $words)) !== false) $score += 5;
        // fragmento alrededor de la primera coincidencia
        $pos = false;
        foreach ($words as $w) if (($pos = mb_strpos($nb, $w)) !== false) break;
        $start = $pos === false ? 0 : max(0, $pos - 80);
        $snippet = mb_substr($plain, $start, 240);
        if ($start > 0) $snippet = '…' . preg_replace('/^\S*\s/', '', $snippet);
        if (mb_strlen($plain) > $start + 240) $snippet = preg_replace('/\s\S*$/', '', $snippet) . '…';
        $snippet = cms_e($snippet);
        $titleH = cms_e($title);
        foreach ($words as $w) { $re = iure_word_regex($w); $snippet = preg_replace($re, '<mark>$0</mark>', $snippet); $titleH = preg_replace($re, '<mark>$0</mark>', $titleH); }
        $out[] = ['label' => $label, 'title' => $titleH, 'url' => $url, 'snippet' => $snippet, 'score' => $score, 'date' => $date];
    }
    usort($out, fn($a, $b) => [$b['score'], $b['date']] <=> [$a['score'], $a['date']]);
    return array_slice($out, 0, $max);
}

/** Formulario de búsqueda (cabecera: icono que despliega el campo; página: campo grande). */
function iure_search_form(string $brand, string $q = '', bool $inline = true): string
{
    $lang = cms_default_lang();
    $t = fn(string $k, string $d) => (string) cms_t($k, $lang, $d);
    $action = cms_url('page:buscar', $lang);
    $ph = $t('search_placeholder', 'Buscar en el sitio…');
    $btn = $t('search_button', 'Buscar');
    $icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>';
    $hidden = $brand === 'teams' ? '<input type="hidden" name="b" value="teams">' : '';
    if ($inline) {
        return '<li class="nav-search"><button type="button" class="nav-search-btn" aria-label="' . cms_e($btn) . '" aria-expanded="false">' . $icon . '</button>'
            . '<form class="nav-search-form" action="' . cms_e($action) . '" method="get" role="search">' . $hidden
            . '<input type="search" name="q" placeholder="' . cms_e($ph) . '" aria-label="' . cms_e($ph) . '" autocomplete="off">'
            . '<button type="submit" aria-label="' . cms_e($btn) . '">' . $icon . '</button></form></li>';
    }
    return '<form class="search-form" action="' . cms_e($action) . '" method="get" role="search">' . $hidden
        . '<input type="search" name="q" value="' . cms_e($q) . '" placeholder="' . cms_e($ph) . '" aria-label="' . cms_e($ph) . '" autofocus>'
        . '<button type="submit" class="btn btn-primary">' . $icon . ' ' . cms_e($btn) . '</button></form>';
}
