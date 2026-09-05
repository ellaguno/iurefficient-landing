<?php /** Insignias. $b: title, items, button_text, button_url */ declare(strict_types=1); ?>
        <div class="container">
            <div class="security-standards" data-aos="fade-up">
<?php if (trim((string) $b['title']) !== ''): ?>
                <h4><?= iure_inline_html((string) $b['title']) ?></h4>
<?php endif; ?>
                <div class="standards-logos">
<?php foreach ((array) $b['items'] as $line): [$ic, $txt] = iure_split($line, 2); if ($txt === '') { $txt = $ic; $ic = ''; } ?>
                    <div class="standard-badge"><?php if ($ic !== ''): ?><span class="standard-icon"><?= cms_e($ic) ?></span><?php endif; ?><span><?= cms_e($txt) ?></span></div>
<?php endforeach; ?>
                </div>
<?php if (trim((string) $b['button_text']) !== ''): ?>
                <a href="<?= cms_e(iure_href((string) $b['button_url'])) ?>" class="btn btn-outline"><?= cms_e($b['button_text']) ?></a>
<?php endif; ?>
            </div>
        </div>
