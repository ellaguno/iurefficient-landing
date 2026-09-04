<?php /** Detalle de un plan (/planes/{slug}): tarjeta sola con enlace a la página donde vive. Variables: $item */ declare(strict_types=1);
$dest = ['teams' => cms_url('home', $lang) . '#precios', 'derecho' => cms_url('page:derecho', $lang) . '/#precios', 'precios' => cms_url('page:precios', $lang) . '/'][$item['product'] ?? 'precios'] ?? cms_url('home', $lang);
?>
    <section class="pricing" style="padding-top: calc(80px + var(--spacing-3xl));">
        <div class="container">
            <div class="pricing-grid" style="max-width: 420px; margin: 0 auto;">
                <?= iure_plan_card($item, 0, true) ?>
            </div>
            <div class="pricing-footer" data-aos="fade-up">
                <p><a href="<?= cms_e($dest) ?>">Ver todos los planes</a></p>
            </div>
        </div>
    </section>
