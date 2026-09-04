<?php /** Índice de proyectos (/proyectos/). Activo solo si el tipo no tiene 'no_list'. Variables: $lang, $S, $t, $page, $type, $def */ declare(strict_types=1);
$items = cms_items('proyectos');
?>
    <main class="legal-page page-listado">
        <div class="container">
            <div class="legal-header legal-header-center">
                <h1><?= cms_e($t('proyectos_title', 'Proyectos')) ?></h1>
<?php if ($t('proyectos_intro')): ?>
                <p class="legal-meta"><?= cms_e($t('proyectos_intro')) ?></p>
<?php endif; ?>
            </div>
<?php if (!$items): ?>
            <p class="page-empty"><?= cms_e($t('proyectos_empty', 'Aún no hay proyectos publicados.')) ?></p>
<?php else: ?>
            <div class="page-grid">
<?php foreach ($items as $p): $u = cms_url('item:proyectos', $lang, $p['slug']); ?>
                <article class="page-card" data-aos="fade-up">
<?php if (!empty($p['image'])): ?>
                    <a class="page-card-img" href="<?= $u ?>"><?= cms_picture((string) $p['image'], (string) ($p['title'] ?? '')) ?></a>
<?php endif; ?>
                    <div class="page-card-body">
                        <small><?= cms_e(implode(' · ', array_filter([(string) ($p['category'] ?? ''), (string) ($p['client'] ?? ''), (string) ($p['year'] ?? '')]))) ?></small>
                        <h3><a href="<?= $u ?>"><?= cms_e($p['title'] ?? '') ?></a></h3>
<?php if (!empty($p['excerpt'])): ?>
                        <p><?= cms_e($p['excerpt']) ?></p>
<?php endif; ?>
                        <a class="page-more" href="<?= $u ?>"><?= cms_e($t('read_more', 'Leer más')) ?> →</a>
                    </div>
                </article>
<?php endforeach; ?>
            </div>
<?php endif; ?>
        </div>
    </main>
