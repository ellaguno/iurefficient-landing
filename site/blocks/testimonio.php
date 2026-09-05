<?php /** Testimonio. $b: quote, cite */ declare(strict_types=1); ?>
        <div class="container">
            <blockquote class="teams-testimonial" data-aos="fade-up"><?= cms_e($b['quote']) ?><?php if (trim((string) $b['cite']) !== ''): ?><cite><?= cms_e($b['cite']) ?></cite><?php endif; ?></blockquote>
        </div>
