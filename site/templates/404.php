<?php /** Página no encontrada. Variables: $lang, $S, $t, $page */ declare(strict_types=1); ?>
    <main class="legal-page">
        <div class="container">
            <div class="legal-content" style="text-align:center;">
                <div class="legal-header" style="border:0;">
                    <h1><?= cms_e($t('not_found_title', 'Página no encontrada')) ?></h1>
                    <p class="legal-meta"><?= cms_e($t('not_found_text', 'La página que buscas no existe o cambió de lugar.')) ?></p>
                </div>
                <p>
                    <a class="btn btn-primary" href="<?= cms_url('home', $lang) ?>"><?= cms_e($t('go_home', 'Ir al inicio')) ?></a>
                    <a class="btn btn-outline" href="<?= cms_url('page:derecho', $lang) ?>/">Para abogados</a>
                </p>
            </div>
        </div>
    </main>
