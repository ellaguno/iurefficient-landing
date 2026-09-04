<?php /** Detalle de proyecto / caso (/proyectos/{slug}). Variables: $lang, $S, $t, $page, $item, $def */ declare(strict_types=1);
$brand = iure_brand($page);
$hasList = empty($def['no_list']);
$facts = array_filter([
    'Cliente' => (string) ($item['client'] ?? ''),
    'Categoría' => (string) ($item['category'] ?? ''),
    'Año' => (string) ($item['year'] ?? ''),
    'Servicios' => implode(', ', (array) ($item['services'] ?? [])),
]);
?>
    <main class="legal-page page-proyecto">
        <div class="container">
            <article class="legal-content">
                <div class="legal-header">
                    <h1><?= cms_e($item['title'] ?? '') ?></h1>
<?php if (!empty($item['excerpt'])): ?>
                    <p class="legal-meta"><?= cms_e($item['excerpt']) ?></p>
<?php endif; ?>
                </div>

<?php if (!empty($item['image'])): ?>
                <figure class="page-hero"><?= cms_picture((string) $item['image'], (string) ($item['title'] ?? ''), '', true) ?></figure>
<?php endif; ?>

<?php if ($facts): ?>
                <dl class="page-facts">
<?php foreach ($facts as $k => $v): ?>
                    <div><dt><?= cms_e($k) ?></dt><dd><?= cms_e($v) ?></dd></div>
<?php endforeach; ?>
                </dl>
<?php endif; ?>

                <?= cms_content((string) ($item['body'] ?? '')) ?>

<?php if (!empty($item['results'])): ?>
                <h2>Resultados</h2>
                <?= cms_content((string) $item['results']) ?>
<?php endif; ?>

<?php if (!empty($item['gallery'])): ?>
                <div class="page-gallery">
<?php foreach ((array) $item['gallery'] as $img): if (trim((string) $img) === '') continue; ?>
                    <figure><?= cms_picture((string) $img, (string) ($item['title'] ?? '')) ?></figure>
<?php endforeach; ?>
                </div>
<?php endif; ?>

<?php if (!empty($item['cta_url']) && !empty($item['cta_text'])): ?>
                <p><a class="btn btn-outline" href="<?= cms_e($item['cta_url']) ?>" target="_blank" rel="noopener"><?= cms_e($item['cta_text']) ?></a></p>
<?php endif; ?>

<?php if ($hasList): ?>
                <p><a href="<?= cms_url('list:proyectos', $lang) ?>">← <?= cms_e($t('back_to_list', 'Volver')) ?></a></p>
<?php endif; ?>

                <?= iure_page_cta($brand) ?>
            </article>
        </div>
    </main>
