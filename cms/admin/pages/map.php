<?php
/** Mapa del sitio: árbol de todo lo publicado y en borrador, con origen y acceso a editar. */
declare(strict_types=1);

$lang = (string) ($_GET['lang'] ?? cms_default_lang());
if (!in_array($lang, cms_langs(), true)) $lang = cms_default_lang();
$map = cms_site_map($lang);
$counts = cms_map_counts($map);
$icons = ['home' => '⌂', 'page' => '▭', 'type' => '▤', 'item' => '·', 'static' => '▣', 'external' => '↗'];
$statusLabel = ['published' => 'publicado', 'draft' => 'borrador', 'scheduled' => 'programado'];

function admin_map_node(array $n, array $icons, array $statusLabel, int $depth = 0): void
{
    $has = !empty($n['children']);
    $open = $depth < 1 || $n['kind'] === 'type' && count($n['children']) <= 12;
    echo '<li class="ad-map-node ad-map-' . cms_e($n['kind']) . '">';
    if ($has) echo '<details' . ($open ? ' open' : '') . '><summary class="ad-map-row">';
    else echo '<div class="ad-map-row">';
    echo '<span class="ad-map-icon" aria-hidden="true">' . $icons[$n['kind']] . '</span>';
    echo '<span class="ad-map-label">' . cms_e($n['label']);
    if ($n['kind'] === 'type') echo ' <small class="ad-help">' . (int) ($n['count_pub'] ?? 0) . '/' . (int) ($n['count'] ?? 0) . ' publicados</small>';
    echo '</span>';
    if ($n['url'] !== '') echo '<a class="ad-map-url" href="' . cms_e($n['url']) . '" target="_blank" rel="noopener">' . cms_e(preg_replace('#^https?://[^/]+#', '', $n['url'])) . '</a>';
    elseif ($n['kind'] === 'type') echo '<span class="ad-map-url ad-help">/' . cms_e($n['segment'] ?? '') . '/…</span>';
    if ($n['status'] !== '' && $n['kind'] === 'item') echo '<span class="ad-pill ' . ($n['status'] === 'published' ? 'on' : ($n['status'] === 'scheduled' ? 'warn' : '')) . '">' . $statusLabel[$n['status']] . '</span>';
    if ($n['noindex']) echo '<span class="ad-pill" title="No aparece en buscadores ni en el sitemap">noindex</span>';
    echo '<span class="ad-map-source">' . cms_e($n['source']) . ($n['updated'] ? ' · ' . cms_e($n['updated']) : '') . '</span>';
    if ($n['edit'] !== '') echo '<a class="ad-btn ad-btn-sm ad-btn-light" href="' . cms_e($n['edit']) . '">Editar</a>';
    if ($has) {
        echo '</summary><ul class="ad-map-children">';
        foreach ($n['children'] as $c) admin_map_node($c, $icons, $statusLabel, $depth + 1);
        echo '</ul></details>';
    } else echo '</div>';
    echo '</li>';
}

admin_header('Mapa del sitio', 'map');
?>
<p class="ad-help">Todo lo que responde en el sitio, de dónde sale cada cosa y en qué estado está. Las ramas se pliegan y despliegan.
<?php if (count(cms_langs()) > 1): ?> Idioma: <?php foreach (cms_active_langs() as $l): ?><a href="<?= admin_url('map', ['lang' => $l]) ?>"<?= $l === $lang ? ' class="on"' : '' ?>><?= strtoupper($l) ?></a> <?php endforeach; endif; ?></p>
<div class="ad-map-legend">
  <span><span class="ad-pill on">publicado</span> <?= (int) $counts['published'] ?></span>
  <span><span class="ad-pill">borrador</span> <?= (int) $counts['draft'] ?></span>
  <span><span class="ad-pill warn">programado</span> <?= (int) $counts['scheduled'] ?></span>
  <span class="ad-help">▭ plantilla fija · ▤ colección de contenido · ▣ carpeta fuera del CMS · ↗ enlace externo</span>
  <a class="ad-btn ad-btn-sm ad-btn-light" href="<?= CMS_BASE ?>/sitemap.xml" target="_blank" rel="noopener">sitemap.xml ↗</a>
</div>
<ul class="ad-map">
<?php admin_map_node($map, $icons, $statusLabel); ?>
</ul>
<?php admin_footer();
