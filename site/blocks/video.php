<?php /** Video. $b: title, subtitle, url */ declare(strict_types=1);
$src = iure_video_embed((string) $b['url']);
if ($src === '') return;
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
            <div class="video-wrapper" data-aos="zoom-in">
                <div class="video-container">
                    <iframe src="<?= cms_e($src) ?>" title="<?= cms_e(strip_tags((string) $b['title']) ?: 'Video') ?>" loading="lazy" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
