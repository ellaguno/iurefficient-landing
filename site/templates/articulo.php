<?php /** Detalle de artículo (/articulos/{slug}). Variables: $lang, $S, $t, $page, $item, $def */ declare(strict_types=1);
$brand = iure_brand($page);
$hasList = empty($def['no_list']);
$meta = [];
if (!empty($item['date'])) $meta[] = cms_e($t('published_on', 'Publicado el')) . ' ' . cms_e(cms_date((string) $item['date'], $lang));
if (!empty($item['author'])) $meta[] = cms_e($t('by_author', 'por')) . ' ' . cms_e($item['author']);
if (!empty($item['category'])) $meta[] = $hasList ? '<a href="' . cms_url('list:articulos', $lang) . '?cat=' . rawurlencode((string) $item['category']) . '">' . cms_e($item['category']) . '</a>' : cms_e($item['category']);
?>
    <main class="legal-page page-articulo">
        <div class="container">
            <article class="legal-content">
                <div class="legal-header">
                    <h1><?= cms_e($item['title'] ?? '') ?></h1>
<?php if ($meta): ?>
                    <p class="legal-meta"><?= implode(' · ', $meta) ?></p>
<?php endif; ?>
                </div>

<?php if (!empty($item['image'])): ?>
                <figure class="page-hero"><?= cms_picture((string) $item['image'], (string) ($item['title'] ?? ''), '', true) ?></figure>
<?php endif; ?>

<?php if (!empty($item['excerpt'])): ?>
                <p class="page-lead"><?= cms_e($item['excerpt']) ?></p>
<?php endif; ?>

                <?= cms_content((string) ($item['body'] ?? '')) ?>

<?php if (!empty($item['tags'])): ?>
                <p class="page-tags"><?php foreach ((array) $item['tags'] as $tag): ?><span><?= cms_e($tag) ?></span> <?php endforeach; ?></p>
<?php endif; ?>

<?php if ($hasList): ?>
                <p><a href="<?= cms_url('list:articulos', $lang) ?>">← <?= cms_e($t('back_to_list', 'Volver')) ?></a></p>
<?php endif; ?>

                <?= iure_page_cta($brand) ?>
            </article>
        </div>
    </main>
