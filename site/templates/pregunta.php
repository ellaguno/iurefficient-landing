<?php /** Detalle de una pregunta frecuente (/preguntas/{slug}). Variables: $item */ declare(strict_types=1);
$dest = ($item['section'] ?? '') === 'seguridad' ? iure_url_page('seguridad', $lang) . '#faq' : iure_url_page('precios', $lang);
?>
    <main class="legal-page">
        <div class="container">
            <div class="legal-content">
                <div class="legal-header"><h1><?= cms_e($item['title'] ?? '') ?></h1></div>
                <?= cms_content((string) ($item['answer'] ?? '')) ?>
                <p><a href="<?= cms_e($dest) ?>"><?= iure_l('Ver todas las preguntas frecuentes', 'See all frequently asked questions') ?></a></p>
            </div>
        </div>
    </main>
