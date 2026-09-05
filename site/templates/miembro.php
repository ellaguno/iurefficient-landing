<?php /** Detalle de un integrante del equipo (/equipo/{slug}). Variables: $item */ declare(strict_types=1);
$photo = iure_img((string) ($item['photo'] ?? ''), (string) ($S['team_placeholder'] ?? ''));
?>
    <section class="team" style="padding-top: calc(80px + var(--spacing-3xl));">
        <div class="container">
            <div class="team-grid" style="max-width: 420px; margin: 0 auto;">
                <div class="team-member">
                    <div class="member-photo"><?php if ($photo): ?><img src="<?= cms_e($photo) ?>" alt="<?= cms_e($item['title'] ?? '') ?>"><?php endif; ?></div>
                    <h4><?= cms_e($item['title'] ?? '') ?></h4>
                    <p class="member-role"><?= cms_e($item['role'] ?? '') ?></p>
                    <p class="member-bio"><?= cms_e($item['bio'] ?? '') ?></p>
                </div>
            </div>
            <div class="pricing-footer"><p><a href="<?= iure_url_derecho($lang) ?>#equipo">Conoce a todo el equipo</a></p></div>
        </div>
    </section>
