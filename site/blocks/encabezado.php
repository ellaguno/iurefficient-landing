<?php /** Encabezado de página. $b: title, text, note, dark */ declare(strict_types=1); ?>
        <div class="container">
            <h1 data-aos="fade-up"><?= iure_inline_html((string) $b['title']) ?></h1>
<?php if (trim((string) $b['text']) !== ''): ?>
            <p data-aos="fade-up" data-aos-delay="100"><?= iure_inline_html((string) $b['text']) ?></p>
<?php endif; ?>
<?php if (trim((string) $b['note']) !== ''): ?>
            <p class="page-head-note" data-aos="fade-up" data-aos-delay="150"><?= cms_e($b['note']) ?></p>
<?php endif; ?>
        </div>
