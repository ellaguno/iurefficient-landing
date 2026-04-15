<?php
/**
 * Iurefficient Theme Functions
 */

// Theme setup
function iurefficient_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
}
add_action('after_setup_theme', 'iurefficient_setup');

// Include modular files
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/menus.php';
require_once get_template_directory() . '/inc/pricing-data.php';
require_once get_template_directory() . '/inc/contact-handler.php';
require_once get_template_directory() . '/inc/news-ticker.php';
