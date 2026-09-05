<?php /** Índice de artículos (/articulos/). Activo solo si el tipo no tiene 'no_list'. Variables: $lang, $S, $t, $page, $type, $def */ declare(strict_types=1);
$q = trim((string) ($_GET['q'] ?? '')); $tag = trim((string) ($_GET['tag'] ?? '')); $cat = trim((string) ($_GET['cat'] ?? ''));
$items = cms_items('articulos');
if ($q !== '') { $n = mb_strtolower($q); $items = array_filter($items, fn($p) => mb_strpos(mb_strtolower(($p['title'] ?? '') . ' ' . ($p['excerpt'] ?? '') . ' ' . strip_tags((string) ($p['body'] ?? ''))), $n) !== false); }
if ($tag !== '') $items = array_filter($items, fn($p) => in_array($tag, (array) ($p['tags'] ?? []), true));
if ($cat !== '') $items = array_filter($items, fn($p) => ($p['category'] ?? '') === $cat);
$per = 12; $pg = max(1, (int) ($_GET['pg'] ?? 1)); $pages = max(1, (int) ceil(count($items) / $per));
$items = array_slice($items, ($pg - 1) * $per, $per, true);
$list = cms_url('list:articulos', $lang);
$cats = [];
foreach (cms_items('articulos') as $p) if (!empty($p['category'])) $cats[$p['category']] = ($cats[$p['category']] ?? 0) + 1;
arsort($cats);
?>
    <main class="legal-page page-listado">
        <div class="container">
            <div class="legal-header legal-header-center">
                <h1><?= cms_e($t('articulos_title', 'Artículos')) ?></h1>
<?php if ($t('articulos_intro')): ?>
                <p class="legal-meta"><?= cms_e($t('articulos_intro')) ?></p>
<?php endif; ?>
            </div>
<?php if ($cats): ?>
            <nav class="page-cats" aria-label="<?= iure_l('Categorías', 'Categories') ?>">
                <a href="<?= $list ?>"<?= $cat === '' && $tag === '' && $q === '' ? ' class="on"' : '' ?>><?= iure_l('Todos', 'All') ?></a>
<?php foreach ($cats as $c => $n): ?>
                <a href="<?= $list ?>?cat=<?= rawurlencode((string) $c) ?>"<?= $cat === (string) $c ? ' class="on"' : '' ?>><?= cms_e($c) ?> <small><?= $n ?></small></a>
<?php endforeach; ?>
            </nav>
<?php endif; ?>
<?php if ($q || $tag || $cat): ?>
            <p class="page-filter"><?= iure_l('Resultados para', 'Results for') ?> <strong><?= cms_e($q ?: $tag ?: $cat) ?></strong> · <a href="<?= $list ?>"><?= iure_l('ver todo', 'see all') ?></a></p>
<?php endif; ?>
<?php if (!$items): ?>
            <p class="page-empty"><?= cms_e($t('articulos_empty', 'Aún no hay artículos publicados.')) ?></p>
<?php else: ?>
            <div class="page-grid">
<?php foreach ($items as $p): $u = cms_url('item:articulos', $lang, $p['slug']); ?>
                <article class="page-card" data-aos="fade-up">
<?php if (!empty($p['image'])): ?>
                    <a class="page-card-img" href="<?= $u ?>"><?= cms_picture((string) $p['image'], (string) ($p['title'] ?? '')) ?></a>
<?php endif; ?>
                    <div class="page-card-body">
                        <small><?php if (!empty($p['category'])): ?><a href="<?= $list ?>?cat=<?= rawurlencode((string) $p['category']) ?>"><?= cms_e($p['category']) ?></a> · <?php endif; ?><?= cms_e(cms_date((string) ($p['date'] ?? ''), $lang)) ?></small>
                        <h3><a href="<?= $u ?>"><?= cms_e($p['title'] ?? '') ?></a></h3>
<?php if (!empty($p['excerpt'])): ?>
                        <p><?= cms_e($p['excerpt']) ?></p>
<?php endif; ?>
                        <a class="page-more" href="<?= $u ?>"><?= cms_e($t('read_more', 'Leer más')) ?> →</a>
                    </div>
                </article>
<?php endforeach; ?>
            </div>
<?php endif; ?>
<?php if ($pages > 1): ?>
            <nav class="page-pager"><?php for ($i = 1; $i <= $pages; $i++): $qs = http_build_query(array_filter(['q' => $q, 'tag' => $tag, 'cat' => $cat, 'pg' => $i > 1 ? $i : null])); ?><a href="<?= $list . ($qs ? '?' . $qs : '') ?>"<?= $i === $pg ? ' class="on"' : '' ?>><?= $i ?></a><?php endfor; ?></nav>
<?php endif; ?>
        </div>
    </main>
