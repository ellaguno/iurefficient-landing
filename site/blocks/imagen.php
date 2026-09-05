<?php /** Imagen. $b: image, alt, caption, link */ declare(strict_types=1);
if (empty($b['image'])) return;
$pic = cms_picture((string) $b['image'], (string) $b['alt']);
?>
        <div class="container">
            <figure class="sec-figure" data-aos="fade-up">
                <?= trim((string) $b['link']) !== '' ? '<a href="' . cms_e(iure_href((string) $b['link'])) . '">' . $pic . '</a>' : $pic ?>
<?php if (trim((string) $b['caption']) !== ''): ?>
                <figcaption><?= cms_e($b['caption']) ?></figcaption>
<?php endif; ?>
            </figure>
        </div>
