<?php /** Tarjetas. $b: title, subtitle, items, variant */ declare(strict_types=1);
$v = (string) $b['variant'];
$grid = ['feature' => 'features-grid', 'benefit' => 'benefits-grid', 'security' => 'security-grid', 'audience' => 'audience-grid'][$v] ?? 'features-grid';
$card = ['feature' => 'feature-card', 'benefit' => 'benefit-item', 'security' => 'security-card', 'audience' => 'audience-card'][$v] ?? 'feature-card';
$iconCls = ['feature' => 'feature-icon', 'benefit' => 'benefit-icon', 'security' => 'security-icon', 'audience' => 'audience-icon'][$v] ?? 'feature-icon';
$hTag = $v === 'feature' ? 'h3' : 'h4';
cms_section_effect('visual/spotlight', $v === 'feature');
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
            <div class="<?= $grid ?>">
<?php $i = 0; foreach ((array) $b['items'] as $line): [$ttl, $txt, $ic] = iure_split($line); if ($ttl === '') continue; ?>
                <div class="<?= $card ?>" data-aos="fade-up" data-aos-delay="<?= min($i++ * 100, 500) ?>">
<?php if ($ic !== ''): ?>                    <div class="<?= $iconCls ?>"><?= iure_card_icon($ic) ?></div>
<?php endif; ?>
<?php if ($v === 'benefit'): ?>
                    <div class="benefit-content"><h4><?= cms_e($ttl) ?></h4><?php if ($txt !== ''): ?><p><?= cms_e($txt) ?></p><?php endif; ?></div>
<?php else: ?>
                    <<?= $hTag ?>><?= cms_e($ttl) ?></<?= $hTag ?>>
<?php if ($txt !== ''): ?>                    <p><?= cms_e($txt) ?></p>
<?php endif; ?>
<?php endif; ?>
                </div>
<?php endforeach; ?>
            </div>
        </div>
