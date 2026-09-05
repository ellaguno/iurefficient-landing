<?php /** Galería 3D. $b: title, subtitle, hint, images */ declare(strict_types=1);
$shots = $b['images'] ? array_map('cms_img', (array) $b['images']) : iure_screenshots();
?>
        <div class="gallery3d-wrapper" data-aos="fade-up">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle'], 'gallery3d-header') ?>
            <canvas id="gallery3d-canvas" data-images="<?= cms_e(implode(',', $shots)) ?>"></canvas>
            <div class="gallery3d-overlay">
                <p class="gallery3d-hint"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12l7 7 7-7"/></svg> <?= cms_e($b['hint']) ?></p>
            </div>
            <noscript><div class="gallery3d-fallback"><?php foreach ($shots as $i => $src): ?><img src="<?= cms_e($src) ?>" alt="Captura <?= $i + 1 ?>"><?php endforeach; ?></div></noscript>
        </div>
