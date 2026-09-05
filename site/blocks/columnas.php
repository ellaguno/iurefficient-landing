<?php /** Texto e imagen. $b: title, body, image, side, button_text, button_url */ declare(strict_types=1); ?>
        <div class="container">
            <div class="sec-cols<?= $b['side'] === 'left' ? ' sec-cols-left' : '' ?>" data-aos="fade-up">
                <div class="sec-cols-text legal-content">
<?php if (trim((string) $b['title']) !== ''): ?>
                    <h2 class="section-title"><?= iure_inline_html((string) $b['title']) ?></h2>
<?php endif; ?>
                    <?= cms_content((string) $b['body']) ?>
<?php if (trim((string) $b['button_text']) !== ''): ?>
                    <p><a href="<?= cms_e(iure_href((string) $b['button_url'])) ?>" class="btn btn-primary"><?= cms_e($b['button_text']) ?></a></p>
<?php endif; ?>
                </div>
<?php if (!empty($b['image'])): ?>
                <div class="sec-cols-img"><?= cms_picture((string) $b['image'], strip_tags((string) $b['title'])) ?></div>
<?php endif; ?>
            </div>
        </div>
