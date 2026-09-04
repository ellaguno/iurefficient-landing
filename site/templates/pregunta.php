<?php /** Detalle de una pregunta frecuente (/preguntas/{slug}). Variables: $item */ declare(strict_types=1);
$dest = ($item['section'] ?? '') === 'seguridad' ? cms_url('page:seguridad', $lang) . '/#faq' : cms_url('page:precios', $lang) . '/';
?>
    <main class="legal-page">
        <div class="container">
            <div class="legal-content">
                <div class="legal-header"><h1><?= cms_e($item['title'] ?? '') ?></h1></div>
                <?= cms_content((string) ($item['answer'] ?? '')) ?>
                <p><a href="<?= cms_e($dest) ?>">Ver todas las preguntas frecuentes</a></p>
            </div>
        </div>
    </main>
