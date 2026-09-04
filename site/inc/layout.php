<?php
/**
 * Iurefficient — layout del tema: site_header($page) y site_footer($page).
 * Dos "marcas" visuales: Teams (portada y /precios) y Abogados (/derecho, /seguridad, /legal/…).
 * $page trae: lang, route, path, title, desc, canonical, alt, jsonld, og_image, noindex.
 */
declare(strict_types=1);

function site_header(array $page): void
{
    $lang = $page['lang'];
    $S = cms_settings();
    $t = fn(string $k, $d = '') => cms_t($k, $lang, $d);
    $site = $S['site_name'] ?? cms_config('name');
    $brand = iure_brand($page);
    $route = $page['route'] ?? '';
    $v = CMS_VERSION . '.' . (string) @filemtime(CMS_SITE . '/assets/css/styles.css');
    $landing = in_array($route, ['home', 'page:derecho'], true);   // hero con shader, galería 3D, video
    $pageCss = ['page:precios' => 'precios', 'page:seguridad' => 'seguridad', 'item:legal' => 'legal'][$route] ?? '';
    $bodyClass = 'brand-' . $brand . ($pageCss ? ' page-' . $pageCss : '') . ($route === '404' ? ' page-404' : '');
    ?><!DOCTYPE html>
<html lang="<?= cms_e($lang) ?>"<?= $brand === 'teams' ? ' class="teams-page"' : '' ?>>
<head>
<?php cms_head($page); ?>
    <meta name="author" content="<?= cms_e($site) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php if ($landing): ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">
<?php endif; ?>
    <link rel="stylesheet" href="<?= cms_asset('css/styles.css') ?>?v=<?= $v ?>">
<?php if ($brand === 'teams'): ?>
    <link rel="stylesheet" href="<?= cms_asset('css/teams.css') ?>?v=<?= $v ?>">
<?php endif; ?>
<?php if ($pageCss): ?>
    <link rel="stylesheet" href="<?= cms_asset('css/' . $pageCss . '.css') ?>?v=<?= $v ?>">
<?php endif; ?>
</head>
<body class="<?= $bodyClass ?>">
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
<?php if ($brand === 'teams'): ?>
                <a href="<?= cms_url('home', $lang) ?>" class="logo">
                    <img src="<?= cms_e(iure_img((string) ($S['logo_teams'] ?? ''), 'logo_teams.svg')) ?>" alt="<?= cms_e($site) ?>" class="logo-img">
                    <span class="logo-teams-badge">Teams</span>
                </a>
<?php else: ?>
                <a href="<?= cms_url('page:derecho', $lang) ?>/" class="logo">
                    <img src="<?= cms_e(iure_img((string) ($S['logo'] ?? ''), 'logo.svg')) ?>" alt="<?= cms_e($site) ?>" class="logo-img">
                </a>
<?php endif; ?>

                <button class="nav-toggle" id="navToggle" aria-label="Menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <ul class="nav-menu" id="navMenu">
<?php if ($brand === 'teams'):
    foreach (cms_menu($lang) as $it): ?>
                    <li><a href="<?= cms_e(cms_menu_url((string) ($it['url'] ?? '/'), $lang)) ?>"<?= !empty($it['new_tab']) ? ' target="_blank" rel="noopener"' : '' ?>><?= cms_e($it['label'] ?? '') ?></a></li>
<?php endforeach; ?>
                    <li><a href="<?= cms_url('page:derecho', $lang) ?>/" class="btn btn-outline btn-sm"><?= cms_e($t('nav_btn_abogados', 'Abogados')) ?></a></li>
                    <li><a href="<?= cms_e(iure_link('demo_teams_url')) ?>" class="btn btn-primary btn-sm"><?= cms_e($t('nav_btn_demo_teams', 'Entrar al demo')) ?></a></li>
<?php else:
    foreach ((array) ($S['menu_derecho'] ?? []) as $line):
        [$label, $url, $nt] = array_pad(array_map('trim', explode('|', (string) $line, 3)), 3, '');
        if ($label === '') continue; ?>
                    <li><a href="<?= cms_e(cms_menu_url($url ?: '/', $lang)) ?>"<?= $nt !== '' ? ' target="_blank" rel="noopener"' : '' ?>><?= cms_e($label) ?></a></li>
<?php endforeach; ?>
                    <li><a href="<?= cms_e(iure_link('demo_derecho_url')) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm"><?= cms_e($t('nav_btn_demo_derecho', 'Usar Demo')) ?></a></li>
<?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
<?php
}

function site_footer(array $page): void
{
    $lang = $page['lang'];
    $S = cms_settings();
    $t = fn(string $k, $d = '') => cms_t($k, $lang, $d);
    $brand = iure_brand($page);
    $route = $page['route'] ?? '';
    $landing = in_array($route, ['home', 'page:derecho'], true);
    $v = CMS_VERSION . '.' . (string) @filemtime(CMS_SITE . '/assets/js/main.js');
    $home = cms_url('home', $lang);
    $derecho = cms_url('page:derecho', $lang) . '/';
    $precios = cms_url('page:precios', $lang) . '/';
    $seguridad = cms_url('page:seguridad', $lang) . '/';
    $legal = fn(string $slug) => cms_url('item:legal', $lang, $slug);
    $email = (string) ($S['email'] ?? 'contacto@iurefficient.com');
    $logoWhite = iure_img((string) ($S['logo_white'] ?? ''), 'logo-white.svg');
    ?>
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="<?= cms_e($logoWhite) ?>" alt="<?= cms_e($S['site_name'] ?? 'Iurefficient') ?>" class="footer-logo">
                    <p><?= cms_e($brand === 'teams' ? $t('t_footer_tagline', 'Gestion de proyectos potenciada con inteligencia artificial.') : $t('d_footer_tagline', 'Transformando la práctica legal con inteligencia artificial.')) ?></p>
                    <?= iure_footer_social() ?>
                </div>
<?php if ($brand === 'teams'): ?>
                <div class="footer-links">
                    <h4>Producto</h4>
                    <ul>
                        <li><a href="<?= cms_e(iure_link('presentacion_url')) ?>">Presentación</a></li>
                        <li><a href="<?= $precios ?>">Precios</a></li>
                        <li><a href="<?= $home ?>#seguridad">Seguridad</a></li>
                        <li><a href="<?= $home ?>#contacto">Prueba gratuita</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Iurefficient</h4>
                    <ul>
                        <li><a href="<?= $derecho ?>">Para Abogados</a></li>
                        <li><a href="<?= cms_e(iure_link('blog_url')) ?>" target="_blank" rel="noopener">Blog</a></li>
                        <li><a href="<?= cms_e(iure_link('help_url')) ?>" target="_blank" rel="noopener">Centro de Ayuda</a></li>
                        <li><a href="mailto:<?= cms_e($email) ?>">Contacto</a></li>
                    </ul>
                </div>
<?php else: ?>
                <div class="footer-links">
                    <h4>Producto</h4>
                    <ul>
                        <li><a href="<?= $derecho ?>#caracteristicas">Características</a></li>
                        <li><a href="<?= $precios ?>">Precios</a></li>
                        <li><a href="<?= $derecho ?>#seguridad">Seguridad</a></li>
                        <li><a href="<?= cms_e(iure_link('help_url')) ?>" target="_blank" rel="noopener">Centro de Ayuda</a></li>
                        <li><a href="<?= $derecho ?>#contacto">Demo</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Empresa</h4>
                    <ul>
                        <li><a href="<?= $derecho ?>#equipo">Equipo</a></li>
                        <li><a href="<?= cms_e(iure_link('blog_url')) ?>" target="_blank" rel="noopener">Blog</a></li>
                        <li><a href="<?= $home ?>">Iurefficient Teams</a></li>
                        <li><a href="mailto:<?= cms_e($email) ?>">Contacto</a></li>
                    </ul>
                </div>
<?php endif; ?>
                <div class="footer-links">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="<?= $legal('privacidad') ?>">Aviso de Privacidad</a></li>
                        <li><a href="<?= $legal('terminos') ?>">Términos y Condiciones</a></li>
                        <li><a href="<?= $seguridad ?>">Seguridad</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
<?php if ($route === 'page:seguridad' && $t('s_footer_doc')): ?>
                <p><?= cms_e($t('s_footer_doc')) ?></p>
<?php endif; ?>
                <p><?= cms_e(str_replace('{year}', date('Y'), (string) $t('footer_copy', '© {year} Iurefficient. Todos los derechos reservados.'))) ?></p>
<?php if ($brand === 'teams' && $t('t_footer_beta_note')): ?>
                <p class="beta-note"><?= cms_e($t('t_footer_beta_note')) ?></p>
<?php endif; ?>
<?php if ($t('footer_made')): ?>
                <p><?= cms_e($t('footer_made')) ?></p>
<?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top/Bottom Button -->
    <button class="scroll-btn" id="scrollBtn" aria-label="Scroll">
        <svg class="scroll-icon-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M7 13l5 5 5-5M7 6l5 5 5-5"/>
        </svg>
        <svg class="scroll-icon-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 11l-5-5-5 5M17 18l-5-5-5 5"/>
        </svg>
    </button>

    <!-- Scripts -->
<?php if ($landing): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
<?php endif; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="<?= cms_asset('js/main.js') ?>?v=<?= $v ?>"></script>
</body>
</html>
<?php
}
