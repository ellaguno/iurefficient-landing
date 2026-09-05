<?php /** Página libre (/p/{slug}). Variables: $lang, $S, $t, $page, $item, $def */ declare(strict_types=1);
$body = cms_content((string) ($item['body'] ?? ''));
$toc = [];
if (!empty($item['toc'])) [$body, $toc] = iure_legal_body($body);
$brand = iure_brand($page);
$crumbs = (array) ($page['crumbs'] ?? []);
$children = cms_tree_children('paginas', (string) $item['slug']);
?>
    <main class="legal-page page-libre">
        <div class="container">
            <div class="legal-content">
<?php if (count($crumbs) > 2): ?>
                <nav class="page-crumbs" aria-label="Ruta"><?php foreach (array_slice($crumbs, 0, -1) as [$cl, $cu]): ?><a href="<?= cms_e($cu) ?>"><?= cms_e($cl) ?></a> <span>›</span> <?php endforeach; ?><span><?= cms_e($item['title'] ?? '') ?></span></nav>
<?php endif; ?>
                <div class="legal-header">
                    <h1><?= cms_e($item['title'] ?? '') ?></h1>
<?php if (!empty($item['subtitle'])): ?>
                    <p class="legal-meta"><?= cms_e($item['subtitle']) ?></p>
<?php endif; ?>
                </div>

<?php if (!empty($item['image'])): ?>
                <figure class="page-hero"><?= cms_picture((string) $item['image'], (string) ($item['title'] ?? ''), '', true) ?></figure>
<?php endif; ?>

<?php if ($toc): ?>
                <div class="legal-toc">
                    <h4><?= cms_e($t('toc_title', 'Contenido')) ?></h4>
                    <ol>
<?php foreach ($toc as [$id, $text]): ?>
                        <li><a href="#<?= cms_e($id) ?>"><?= cms_e(preg_replace('/^\d+[.)]?\s*/', '', $text)) ?></a></li>
<?php endforeach; ?>
                    </ol>
                </div>
<?php endif; ?>

<?php if (!empty($item['summary'])): ?>
                <div class="highlight-box">
                    <p><?= cms_e($item['summary']) ?></p>
                </div>
<?php endif; ?>

                <?= $body ?>

<?php if ($children): ?>
                <div class="page-grid page-children">
<?php foreach ($children as $c): ?>
                    <article class="page-card"><?php if (!empty($c['image'])): ?><a class="page-card-img" href="<?= cms_url('item:paginas', $lang, $c['slug']) ?>"><?= cms_picture((string) $c['image'], (string) ($c['title'] ?? '')) ?></a><?php endif; ?>
                        <div class="page-card-body"><h3><a href="<?= cms_url('item:paginas', $lang, $c['slug']) ?>"><?= cms_e($c['title'] ?? '') ?></a></h3><?php if (!empty($c['summary']) || !empty($c['subtitle'])): ?><p><?= cms_e($c['summary'] ?: $c['subtitle']) ?></p><?php endif; ?></div></article>
<?php endforeach; ?>
                </div>
<?php endif; ?>
<?php if (!empty($item['cta'])): ?>
                <?= iure_page_cta($brand) ?>
<?php endif; ?>
            </div>
        </div>
    </main>
