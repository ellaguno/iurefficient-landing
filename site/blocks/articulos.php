<?php /** Últimos artículos. $b: title, count, category, button_text */ declare(strict_types=1);
$items = cms_items('articulos');
if (trim((string) $b['category']) !== '') $items = array_filter($items, fn($p) => ($p['category'] ?? '') === trim((string) $b['category']));
$items = array_slice(array_values($items), 0, max(1, (int) $b['count']));
if (!$items) return;
?>
        <div class="container">
            <?= iure_section_header((string) $b['title']) ?>
            <div class="page-grid">
<?php foreach ($items as $p): $u = cms_url('item:articulos', $lang, $p['slug']); ?>
                <article class="page-card" data-aos="fade-up">
<?php if (!empty($p['image'])): ?>                    <a class="page-card-img" href="<?= $u ?>"><?= cms_picture((string) $p['image'], (string) ($p['title'] ?? '')) ?></a>
<?php endif; ?>
                    <div class="page-card-body"><small><?= cms_e(($p['category'] ?? '') ? $p['category'] . ' · ' : '') . cms_date((string) ($p['date'] ?? ''), $lang) ?></small><h3><a href="<?= $u ?>"><?= cms_e($p['title'] ?? '') ?></a></h3><?php if (!empty($p['excerpt'])): ?><p><?= cms_e($p['excerpt']) ?></p><?php endif; ?></div>
                </article>
<?php endforeach; ?>
            </div>
<?php if (trim((string) $b['button_text']) !== ''): ?>
            <p class="sec-more"><a class="btn btn-outline" href="<?= cms_url('list:articulos', $lang) ?>"><?= cms_e($b['button_text']) ?></a></p>
<?php endif; ?>
        </div>
