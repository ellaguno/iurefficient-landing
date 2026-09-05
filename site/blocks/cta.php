<?php /** Llamado a la acción. $b: title, text, form, origin, button_text, button_url, note */ declare(strict_types=1); ?>
<?php cms_section_effect('visual/gradient', !empty($b['gradient'])); ?>
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2><?= iure_inline_html((string) $b['title']) ?></h2>
<?php if (trim((string) $b['text']) !== ''): ?>
                <p><?= iure_inline_html((string) $b['text']) ?></p>
<?php endif; ?>
<?php if (!empty($b['form'])): ?>
                <?= iure_contact_form((string) $b['origin'], (string) ($b['button_text'] ?: 'Solicitar demo')) ?>
<?php elseif (trim((string) $b['button_text']) !== ''): ?>
                <p><a href="<?= cms_e(iure_href((string) $b['button_url'])) ?>" class="btn btn-primary btn-lg"><?= cms_e($b['button_text']) ?></a></p>
<?php endif; ?>
<?php if (trim((string) $b['note']) !== ''): ?>
                <p class="cta-note"><?= cms_e($b['note']) ?></p>
<?php endif; ?>
            </div>
        </div>
