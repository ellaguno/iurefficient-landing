<?php /** Planes. $b: title, subtitle, product, footer_text, footer_url */ declare(strict_types=1);
$planes = iure_planes((string) $b['product']);
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
            <div class="pricing-grid">
<?php foreach ($planes as $i => $p) echo iure_plan_card($p, $i * 100), "\n"; ?>
            </div>
<?php if (trim((string) $b['footer_text']) !== ''): ?>
            <div class="pricing-footer" data-aos="fade-up"><p>¿Necesitas algo diferente? <a href="<?= cms_e(iure_href((string) $b['footer_url'])) ?>"><?= cms_e($b['footer_text']) ?></a></p></div>
<?php endif; ?>
        </div>
