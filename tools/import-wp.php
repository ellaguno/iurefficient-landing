<?php
/**
 * Importa entradas de un WordPress (API REST) al tipo "articulos" de cms_simple.
 *
 *   php tools/import-wp.php [--dry-run] [--skip-cat=Noticias] [--limit=N] [--slug=una-entrada]
 *
 * - Lee todas las entradas publicadas de https://blog.iurefficient.com/wp-json/wp/v2/posts (con _embed).
 * - Omite las que tengan la categoría indicada en --skip-cat (por defecto "Noticias": resúmenes automáticos con audio).
 * - Descarga la imagen destacada y las imágenes del cuerpo a uploads/blog/ y reescribe las rutas.
 * - Limpia el HTML de Gutenberg (clases wp-block-*, srcset, títulos duplicados), convierte los embeds de YouTube en
 *   <div class="video-embed"> y reescribe los enlaces internos entre entradas migradas.
 * - Escribe data/content/articulos/<slug>.json (publicado) y tools/wp-redirects.txt con las reglas 301 para el .htaccess
 *   de WordPress (URL vieja → https://iurefficient.com/articulos/<slug>).
 *
 * Se puede ejecutar varias veces: sobrescribe los JSON y solo descarga las imágenes que falten.
 */
declare(strict_types=1);

$_SERVER['SCRIPT_NAME'] = '/index.php';
require dirname(__DIR__) . '/cms/bootstrap.php';

const WP_BASE = 'https://blog.iurefficient.com';
const SITE_URL = 'https://iurefficient.com';
const UPLOAD_DIR = 'uploads/blog';
const TYPE = 'articulos';
const DEFAULT_BRAND = 'derecho';

$opts = getopt('', ['dry-run', 'skip-cat::', 'limit::', 'slug::']);
$dry = isset($opts['dry-run']);
$skipCat = $opts['skip-cat'] ?? 'Noticias';
$limit = (int) ($opts['limit'] ?? 0);
$only = $opts['slug'] ?? null;

// Prioridad para elegir la categoría principal cuando una entrada tiene varias.
$catPriority = ['Tutorial', 'Versiones', 'Jurídico', 'Derecho', 'Ley', 'Seguridad', 'Tecnología', 'Contable & Fiscal', 'Consultoría',
    'TI', 'Equipos', 'Aplicaciones', 'Experto', 'Video', 'Iurefficient', 'General'];
$catRename = ['Versiones' => 'Novedades de versión'];
$authorRename = ['Noticias' => 'Iurefficient'];

function wp_get(string $url): string
{
    $ctx = stream_context_create(['http' => ['header' => "User-Agent: Mozilla/5.0 (X11; Linux x86_64) cms_simple-import\r\nAccept: */*\r\n", 'timeout' => 60]]);
    $r = @file_get_contents($url, false, $ctx);
    if ($r === false) throw new RuntimeException("No se pudo leer $url");
    return $r;
}

function wp_json(string $url): array
{
    $d = json_decode(wp_get($url), true);
    if (!is_array($d)) throw new RuntimeException("JSON inválido en $url");
    return $d;
}

function out(string $s): void { fwrite(STDOUT, $s . "\n"); }

/** Descarga una imagen a uploads/blog/ (si no existe) y devuelve la ruta relativa para el CMS, o '' si falla. */
function fetch_image(string $url, bool $dry): string
{
    global $downloaded;
    $url = html_entity_decode($url);
    if (!preg_match('#^https?://#', $url)) return '';
    // codifica caracteres no ASCII de la ruta (guiones largos, acentos) para que la descarga funcione
    $url = preg_replace_callback('/[^\x21-\x7E]/', fn($m) => rawurlencode($m[0]), $url);
    $name = basename(rawurldecode((string) parse_url($url, PHP_URL_PATH)));
    $name = preg_replace('/-{2,}/', '-', (string) preg_replace('/[^A-Za-z0-9._-]+/', '-', strtr($name, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n', 'ü' => 'u'])));
    // quita el sufijo -1024x598 que WordPress añade a los tamaños intermedios y prueba primero el original
    $orig = preg_replace('/-\d{2,4}x\d{2,4}(\.[a-z0-9]+)$/i', '$1', $name);
    $candidates = array_unique([[$orig, preg_replace('/-\d{2,4}x\d{2,4}(\.[a-z0-9]+)$/i', '$1', $url)], [$name, $url]], SORT_REGULAR);
    foreach ($candidates as [$file, $src]) {
        $file = preg_replace('/[^A-Za-z0-9._-]/', '-', $file);
        $rel = UPLOAD_DIR . '/' . $file;
        $abs = CMS_ROOT . '/' . $rel;
        if (is_file($abs)) return $rel;
        if ($dry) return $rel;
        $data = @file_get_contents($src, false, stream_context_create(['http' => ['header' => "User-Agent: Mozilla/5.0 cms_simple-import\r\n", 'timeout' => 60]]));
        if ($data === false || strlen($data) < 100) continue;
        if (!is_dir(dirname($abs))) mkdir(dirname($abs), 0755, true);
        file_put_contents($abs, $data);
        $downloaded++;
        return $rel;
    }
    return '';
}

/** Limpia el HTML de Gutenberg y lo adapta al tema. $slugMap: slug WP → slug nuevo para enlaces internos. */
function clean_body(string $html, string $title, array $slugMap, bool $dry): string
{
    // título repetido al inicio (bloque post-title)
    $html = preg_replace('#^\s*<h[12][^>]*class="[^"]*wp-block-post-title[^"]*"[^>]*>.*?</h[12]>#is', '', $html);
    // reproductor TTS o restos de plugins, por si vinieran en el contenido
    $html = preg_replace('#<div[^>]*tts-[^>]*>.*?</div>\s*</div>#is', '', $html);
    // embeds de YouTube → <div class="video-embed">
    $html = preg_replace_callback('#<figure[^>]*wp-block-embed[^>]*>(.*?)</figure>#is', function ($m) {
        if (preg_match('#<iframe[^>]*src="([^"]*youtu[^"]*)"[^>]*(?:title="([^"]*)")?#i', $m[1], $im) || preg_match('#(https?://(?:www\.)?(?:youtube\.com/watch\?v=|youtu\.be/)[A-Za-z0-9_-]+)#', strip_tags($m[1]), $im)) {
            $src = html_entity_decode($im[1]);
            if (preg_match('#(?:embed/|v=|youtu\.be/)([A-Za-z0-9_-]{6,})#', $src, $idm)) {
                $t = isset($im[2]) && $im[2] !== '' ? $im[2] : 'Video';
                return '<div class="video-embed"><iframe src="https://www.youtube-nocookie.com/embed/' . $idm[1] . '" title="' . cms_e(html_entity_decode($t)) . '" loading="lazy" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
            }
        }
        // otros embeds: dejar el iframe si lo hay, si no el texto
        if (preg_match('#<iframe.*?</iframe>#is', $m[1], $fm)) return '<div class="video-embed">' . $fm[0] . '</div>';
        return '<p>' . trim(strip_tags($m[1])) . '</p>';
    }, $html);
    // imágenes: descargar y reescribir
    $html = preg_replace_callback('#<img\b([^>]*)>#i', function ($m) use ($dry) {
        $a = $m[1];
        if (!preg_match('/\bsrc="([^"]+)"/', $a, $sm)) return $m[0];
        $rel = fetch_image($sm[1], $dry);
        $src = $rel ? '{{base}}/' . $rel : $sm[1];
        $alt = preg_match('/\balt="([^"]*)"/', $a, $am) ? $am[1] : '';
        $wh = '';
        if (preg_match('/\bwidth="(\d+)"/', $a, $wm) && preg_match('/\bheight="(\d+)"/', $a, $hm)) $wh = ' width="' . $wm[1] . '" height="' . $hm[1] . '"';
        return '<img src="' . cms_e($src) . '" alt="' . cms_e(html_entity_decode($alt)) . '"' . $wh . ' loading="lazy">';
    }, $html);
    // enlaces internos entre entradas migradas
    $html = preg_replace_callback('#href="' . preg_quote(WP_BASE, '#') . '/\d{4}/\d{2}/\d{2}/([^/"]+)/?"#', function ($m) use ($slugMap) {
        return isset($slugMap[$m[1]]) ? 'href="{{base}}/' . TYPE . '/' . $slugMap[$m[1]] . '"' : $m[0];
    }, $html);
    // bloque de archivo (PDF incrustado) → enlace de descarga
    $html = preg_replace_callback('#<div[^>]*wp-block-file[^>]*>.*?<a[^>]*href="([^"]+)"[^>]*>(.*?)</a>.*?</div>#is', function ($m) {
        return '<p><a class="btn btn-outline" href="' . $m[1] . '" target="_blank" rel="noopener">' . trim(strip_tags($m[2]) ?: 'Descargar') . '</a></p>';
    }, $html);
    // enlaces a archivos de wp-content/uploads (PDF, imágenes) → copia local
    $html = preg_replace_callback('#href="(' . preg_quote(WP_BASE, '#') . '/wp-content/uploads/[^"]+\.(?:pdf|png|jpe?g|webp|gif|docx?|xlsx?|pptx?))"#i', function ($m) use ($dry) {
        $rel = fetch_image($m[1], $dry);
        return $rel ? 'href="{{base}}/' . $rel . '"' : $m[0];
    }, $html);
    // botones de Gutenberg → botones del tema
    $html = preg_replace('#<div class="wp-block-buttons[^"]*">(.*?)</div>#is', '<p class="article-buttons">$1</p>', $html);
    $html = preg_replace('#<div class="wp-block-button[^"]*"><a class="wp-block-button__link[^"]*"#i', '<a class="btn btn-primary"', $html);
    $html = preg_replace('#(<a class="btn btn-primary"[^>]*>.*?</a>)</div>#is', '$1', $html);
    // separadores y clases de bloque
    $html = preg_replace('#<hr[^>]*>#i', '<hr>', $html);
    // clases de Gutenberg (wp-block-*, has-*, align*, size-*, is-*); se conservan las del tema (video-embed, btn…)
    $html = preg_replace_callback('/\s+class="([^"]*)"/', function ($m) {
        $keep = array_filter(explode(' ', $m[1]), fn($c) => $c !== '' && !preg_match('/^(wp-|has-|align|size-|is-|aligncenter|alignwide|alignfull)/', $c));
        return $keep ? ' class="' . implode(' ', $keep) . '"' : '';
    }, $html);
    $html = preg_replace('/\s+(?:srcset|sizes|decoding|data-[a-z-]+|style|id|dir)="[^"]*"/', '', $html);
    $html = preg_replace('#<figure>\s*<a href="([^"]*)">\s*(<img[^>]*>)\s*</a>\s*</figure>#is', '<figure><a href="$1">$2</a></figure>', $html);
    // párrafos vacíos y espacios
    $html = preg_replace('#<p>\s*(?:&nbsp;|\s)*</p>#i', '', $html);
    $html = preg_replace("/\n{3,}/", "\n\n", $html);
    return trim($html);
}

// ---- categorías, autores y entradas
out('Leyendo ' . WP_BASE . ' …');
$cats = [];
foreach (wp_json(WP_BASE . '/wp-json/wp/v2/categories?per_page=100') as $c) $cats[$c['id']] = html_entity_decode($c['name']);
$posts = [];
for ($page = 1; $page < 50; $page++) {
    $r = wp_json(WP_BASE . '/wp-json/wp/v2/posts?per_page=100&page=' . $page . '&_embed=1&status=publish');
    if (!$r || isset($r['code'])) break;
    $posts = array_merge($posts, $r);
    if (count($r) < 100) break;
}
out(count($posts) . ' entradas en WordPress.');

$keep = array_filter($posts, function ($p) use ($cats, $skipCat, $only) {
    $names = array_map(fn($id) => $cats[$id] ?? '', $p['categories']);
    if ($skipCat !== '' && in_array($skipCat, $names, true)) return false;
    if ($only !== null && $p['slug'] !== $only) return false;
    return true;
});
if ($limit > 0) $keep = array_slice($keep, 0, $limit);
out(count($keep) . ' entradas a importar' . ($dry ? ' (simulación, no se escribe nada)' : '') . '.');

// mapa slug WP → slug CMS (para enlaces internos y redirecciones)
$slugMap = [];
foreach ($keep as $p) {
    $s = cms_slugify(urldecode($p['slug']));
    if ($s === '' || ctype_digit($s)) $s = cms_slugify(html_entity_decode($p['title']['rendered'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    while (in_array($s, $slugMap, true)) $s .= '-2';
    $slugMap[$p['slug']] = $s;
}

$downloaded = 0; $written = 0; $redirects = [];
foreach ($keep as $p) {
    $slug = $slugMap[$p['slug']];
    $title = trim(html_entity_decode($p['title']['rendered'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $names = array_values(array_filter(array_map(fn($id) => $cats[$id] ?? '', $p['categories'])));
    $primary = '';
    foreach ($catPriority as $c) if (in_array($c, $names, true)) { $primary = $c; break; }
    if ($primary === '') $primary = $names[0] ?? '';
    if (preg_match('/^¿?\s*qu[eé] hay de nuevo/iu', $title)) $primary = 'Versiones';
    $primary = $catRename[$primary] ?? $primary;
    $author = html_entity_decode($p['_embedded']['author'][0]['name'] ?? 'Iurefficient');
    $author = $authorRename[$author] ?? $author;
    $tags = [];
    foreach ($p['_embedded']['wp:term'] ?? [] as $group) foreach ($group as $term) if (($term['taxonomy'] ?? '') === 'post_tag') $tags[] = html_entity_decode($term['name']);
    $excerpt = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($p['excerpt']['rendered'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    $excerpt = preg_replace('/\s*\[…\]$|\s*&hellip;$/u', '…', $excerpt);
    $image = '';
    if (!empty($p['_embedded']['wp:featuredmedia'][0]['source_url'])) $image = fetch_image($p['_embedded']['wp:featuredmedia'][0]['source_url'], $dry);
    $body = clean_body($p['content']['rendered'], $title, $slugMap, $dry);
    $words = str_word_count(strip_tags($body));
    $hasVideo = strpos($body, 'video-embed') !== false;
    $empty = trim(strip_tags($body)) === '' && !$hasVideo;

    $item = [
        'slug' => $slug,
        'status' => $empty ? 'draft' : 'published',
        'title' => $title,
        'excerpt' => $excerpt,
        'body' => $body,
        'date' => substr($p['date'], 0, 10),
        'author' => $author,
        'category' => $primary,
        'tags' => array_values(array_unique($tags)),
        'image' => $image,
        'brand' => DEFAULT_BRAND,
        'seo_title' => '',
        'seo_desc' => $excerpt,
        'created' => substr($p['date'], 0, 10),
        'updated' => substr($p['modified'] ?? $p['date'], 0, 10),
        'wp_id' => $p['id'],
        'wp_url' => $p['link'],
    ];
    $old = (string) parse_url($p['link'], PHP_URL_PATH);
    $redirects[] = 'Redirect 301 ' . $old . ' ' . SITE_URL . '/' . TYPE . '/' . $slug;
    if (rtrim($old, '/') !== $old) $redirects[] = 'Redirect 301 ' . rtrim($old, '/') . ' ' . SITE_URL . '/' . TYPE . '/' . $slug;

    out(sprintf('  %s  %-60s %-22s %4d palabras%s%s', $item['date'], mb_substr($slug, 0, 60), $primary, $words, $image ? '' : '  (sin imagen)', $empty ? '  ⚠ vacía → borrador' : ($words < 40 && !$hasVideo ? '  ⚠ muy corta' : ($hasVideo ? '  ▶ video' : ''))));
    if (!$dry) { cms_item_save(TYPE, $item); $written++; }
}

if (!$dry) {
    file_put_contents(__DIR__ . '/wp-redirects.txt', "# Reglas 301 para el .htaccess de " . WP_BASE . " (entradas migradas a " . SITE_URL . "/" . TYPE . "/)\n# Generado por tools/import-wp.php el " . date('Y-m-d') . "\n" . implode("\n", $redirects) . "\n");
    out("\n$written artículos escritos en data/content/" . TYPE . "/, $downloaded imágenes descargadas a " . UPLOAD_DIR . "/, " . count($redirects) . " reglas en tools/wp-redirects.txt");
}
