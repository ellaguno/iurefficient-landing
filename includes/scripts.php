<?php
/**
 * Scripts compartidos al final del body.
 *
 * Variables esperadas:
 *   $base_path     - Ruta base ('' para root, '../' para subdirectorios)
 *   $extra_scripts - (opcional) Array de librerías JS: 'aos', 'swiper', 'glightbox'
 */
if (!isset($extra_scripts)) $extra_scripts = [];
?>

    <!-- Scripts -->
<?php if (in_array('aos', $extra_scripts)): ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<?php endif; ?>
<?php if (in_array('swiper', $extra_scripts)): ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php endif; ?>
<?php if (in_array('glightbox', $extra_scripts)): ?>
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
<?php endif; ?>
    <script src="<?= $base_path ?>js/main.js"></script>
