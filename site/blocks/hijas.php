<?php /** Páginas hijas. $b: title, intro */ declare(strict_types=1);
$children = $item ? cms_tree_children('paginas', (string) ($item['slug'] ?? '')) : [];
if (!$children) return;
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['intro']) ?>
            <div class="page-grid">
<?php foreach ($children as $c): $u = cms_url('item:paginas', $lang, $c['slug']); ?>
                <article class="page-card" data-aos="fade-up">
<?php if (!empty($c['image'])): ?>                    <a class="page-card-img" href="<?= $u ?>"><?= cms_picture((string) $c['image'], (string) ($c['title'] ?? '')) ?></a>
<?php endif; ?>
                    <div class="page-card-body"><h3><a href="<?= $u ?>"><?= cms_e($c['title'] ?? '') ?></a></h3><?php if (!empty($c['summary']) || !empty($c['subtitle'])): ?><p><?= cms_e($c['summary'] ?: $c['subtitle']) ?></p><?php endif; ?></div>
                </article>
<?php endforeach; ?>
            </div>
        </div>
