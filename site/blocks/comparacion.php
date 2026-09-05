<?php /** Antes y después. $b: title, subtitle, before_*, after_* */ declare(strict_types=1);
$x = '<svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>';
$ok = '<svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>';
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
            <div class="comparison-grid">
                <div class="comparison-card comparison-before" data-aos="fade-right">
                    <div class="comparison-header"><span class="comparison-icon"><?= cms_e($b['before_icon']) ?></span><h3><?= cms_e($b['before_title']) ?></h3></div>
                    <ul class="comparison-list"><?php foreach ((array) $b['before_items'] as $li): ?><li><?= $x ?> <?= cms_e($li) ?></li><?php endforeach; ?></ul>
                </div>
                <div class="comparison-arrow" data-aos="zoom-in"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
                <div class="comparison-card comparison-after" data-aos="fade-left">
                    <div class="comparison-header"><span class="comparison-icon"><?= cms_e($b['after_icon']) ?></span><h3><?= cms_e($b['after_title']) ?></h3></div>
                    <ul class="comparison-list"><?php foreach ((array) $b['after_items'] as $li): ?><li><?= $ok ?> <?= cms_e($li) ?></li><?php endforeach; ?></ul>
                </div>
            </div>
        </div>
