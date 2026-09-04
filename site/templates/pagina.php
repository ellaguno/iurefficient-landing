<?php /** Página libre (/p/{slug}). Variables: $lang, $S, $t, $page, $item, $def */ declare(strict_types=1);
$body = cms_content((string) ($item['body'] ?? ''));
$toc = [];
if (!empty($item['toc'])) [$body, $toc] = iure_legal_body($body);
$brand = iure_brand($page);
?>
    <main class="legal-page page-libre">
        <div class="container">
            <div class="legal-content">
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

<?php if (!empty($item['cta'])): ?>
                <?= iure_page_cta($brand) ?>
<?php endif; ?>
            </div>
        </div>
    </main>
