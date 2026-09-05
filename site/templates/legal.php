<?php /** Página legal (/legal/{slug}). Variables: $lang, $S, $t, $page, $item, $def */ declare(strict_types=1);
[$body, $toc] = iure_legal_body(cms_content((string) ($item['body'] ?? '')));
?>
    <main class="legal-page">
        <div class="container">
            <div class="legal-content">
                <div class="legal-header">
                    <h1><?= cms_e($item['title'] ?? '') ?></h1>
<?php if (!empty($item['updated_label'])): ?>
                    <p class="legal-meta"><?= cms_e($item['updated_label']) ?></p>
<?php endif; ?>
                </div>

<?php if ($toc): ?>
                <div class="legal-toc">
                    <h4><?= iure_l('Contenido', 'Contents') ?></h4>
                    <ol>
<?php foreach ($toc as [$id, $text]): ?>
                        <li><a href="#<?= cms_e($id) ?>"><?= cms_e(preg_replace('/^\d+[.)]?\s*/', '', $text)) ?></a></li>
<?php endforeach; ?>
                    </ol>
                </div>
<?php endif; ?>

<?php if (!empty($item['summary'])): ?>
                <div class="highlight-box">
                    <p><strong><?= iure_l('Resumen', 'Summary') ?>:</strong> <?= cms_e($item['summary']) ?></p>
                </div>
<?php endif; ?>

                <?= $body ?>
            </div>
        </div>
    </main>
