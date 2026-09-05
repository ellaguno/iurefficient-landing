<?php /** Hero. $b: title, subtitle, buttons, image, badges, shader */ declare(strict_types=1);
$img = iure_img((string) $b['image'], (string) ($S['dashboard_mockup'] ?? '') ?: 'dashboard-mockup.png');
$yt = '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>';
$arrow = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
$play = '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>';
?>
<?php cms_section_effect('visual/shader', !empty($b['shader'])); ?>
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title"><?= iure_inline_html((string) $b['title']) ?></h1>
<?php if (trim((string) $b['subtitle']) !== ''): ?>
                <p class="hero-subtitle"><?= iure_inline_html((string) $b['subtitle']) ?></p>
<?php endif; ?>
<?php if ($b['buttons']): ?>
                <div class="hero-ctas">
<?php foreach ((array) $b['buttons'] as $line): [$txt, $url, $style] = iure_split($line); if ($txt === '') continue; $style = $style ?: 'primary'; $ext = preg_match('#^https?://#', $url) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
                    <a href="<?= cms_e(iure_href($url)) ?>" class="btn btn-<?= cms_e($style) ?> btn-lg"<?= $ext ?>><?= $style === 'youtube' ? $yt . ' ' : ($style === 'secondary' ? $play . ' ' : '') ?><?= cms_e($txt) ?><?= $style === 'primary' ? ' ' . $arrow : '' ?></a>
<?php endforeach; ?>
                </div>
<?php endif; ?>
            </div>
<?php if ($img): ?>
            <div class="hero-image" data-aos="fade-up" data-aos-delay="200">
                <div class="hero-mockup"><img src="<?= cms_e($img) ?>" alt="<?= cms_e(strip_tags((string) $b['title'])) ?>"></div>
            </div>
<?php endif; ?>
<?php if ($b['badges']): ?>
            <div class="hero-social-proof" data-aos="fade-up" data-aos-delay="400">
                <div class="trust-badges">
<?php foreach ((array) $b['badges'] as $line): [$ic, $txt] = iure_split($line, 2); if ($txt === '') { $txt = $ic; $ic = ''; } ?>
                    <div class="trust-badge"><?php if ($ic !== ''): ?><span class="trust-icon"><?= cms_e($ic) ?></span><?php endif; ?><span><?= cms_e($txt) ?></span></div>
<?php endforeach; ?>
                </div>
            </div>
<?php endif; ?>
        </div>
