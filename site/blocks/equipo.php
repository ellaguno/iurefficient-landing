<?php /** Equipo. $b: title, subtitle */ declare(strict_types=1);
$equipo = cms_items('equipo');
if (!$equipo) return;
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
            <div class="team-grid">
<?php $i = 0; foreach ($equipo as $m): $photo = iure_img((string) ($m['photo'] ?? ''), (string) ($S['team_placeholder'] ?? '')); ?>
                <div class="team-member" data-aos="fade-up" data-aos-delay="<?= $i++ * 100 ?>">
                    <div class="member-photo"><?php if ($photo): ?><img src="<?= cms_e($photo) ?>" alt="<?= cms_e($m['title'] ?? '') ?>"><?php endif; ?></div>
                    <h4><?= cms_e($m['title'] ?? '') ?></h4>
                    <p class="member-role"><?= cms_e($m['role'] ?? '') ?></p>
                    <p class="member-bio"><?= cms_e($m['bio'] ?? '') ?></p>
                </div>
<?php endforeach; ?>
            </div>
        </div>
