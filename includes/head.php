<?php
/**
 * <head> compartido.
 *
 * Variables esperadas:
 *   $page_title       - Título de la página
 *   $page_description - Meta description
 *   $base_path        - Ruta base ('' para root, '../' para subdirectorios)
 *   $og_image         - (opcional) URL de la imagen OG
 *   $og_url           - (opcional) URL canónica
 *   $extra_css        - (opcional) Array de librerías CSS adicionales: 'aos', 'swiper', 'glightbox'
 *   $page_styles      - (opcional) String con CSS inline específico de la página
 */
if (!isset($extra_css)) $extra_css = [];
if (!isset($page_styles)) $page_styles = '';
if (!isset($og_image)) $og_image = '';
if (!isset($og_url)) $og_url = '';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
    <meta name="keywords" content="software legal, gestión de casos, IA legal, abogados, despacho jurídico, documentos legales">
    <meta name="author" content="Iurefficient">
<?php if ($og_image || $og_url): ?>

    <!-- Open Graph -->
<?php if ($og_url): ?>
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($og_url) ?>">
    <meta property="og:type" content="website">
<?php endif; ?>
<?php if ($og_image): ?>
    <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">
<?php endif; ?>
<?php endif; ?>

    <title><?= htmlspecialchars($page_title) ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= $base_path ?>images/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php if (in_array('aos', $extra_css)): ?>
    <!-- AOS - Animate on Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php endif; ?>

<?php if (in_array('swiper', $extra_css)): ?>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<?php endif; ?>

<?php if (in_array('glightbox', $extra_css)): ?>
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">
<?php endif; ?>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base_path ?>css/styles.css">

<?php if ($page_styles): ?>
    <style>
<?= $page_styles ?>
    </style>
<?php endif; ?>
</head>
