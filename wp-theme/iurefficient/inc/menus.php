<?php
/**
 * Iurefficient - Menu Registration
 *
 * Menus are registered for future use. The nav in header.php
 * is currently hardcoded to preserve the exact original HTML structure.
 */

function iurefficient_register_menus() {
    register_nav_menus([
        'primary' => 'Menú Principal',
        'footer'  => 'Menú Footer',
    ]);
}
add_action('init', 'iurefficient_register_menus');
