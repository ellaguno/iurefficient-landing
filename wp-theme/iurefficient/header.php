<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="software legal, gestión de casos, IA legal, abogados, despacho jurídico, documentos legales">
    <meta name="author" content="Iurefficient">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.png'); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="Iurefficient" class="logo-img">
                </a>

                <button class="nav-toggle" id="navToggle" aria-label="Menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="<?php echo esc_url(home_url('/#caracteristicas')); ?>">Características</a></li>
                    <li><a href="<?php echo esc_url(home_url('/seguridad/')); ?>">Seguridad</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#equipo')); ?>">Equipo</a></li>
                    <li><a href="https://blog.iurefficient.com" target="_blank">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/precios/')); ?>">Precios</a></li>
                    <li><a href="<?php echo esc_url(home_url('/help-portal/')); ?>">Ayuda</a></li>
                    <li><a href="https://demo.iurefficient.com" target="_blank" class="btn btn-primary btn-sm">Usar Demo</a></li>
                </ul>
            </nav>
        </div>
    </header>
