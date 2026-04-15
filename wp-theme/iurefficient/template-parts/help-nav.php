<?php
/**
 * Help Portal Navigation
 *
 * Expected variable:
 *   $current_help_page - 'inicio','guia','funcionalidades','industrias','planes','faq'
 */
if (!isset($current_help_page)) {
    $current_help_page = '';
}
?>
<nav class="navbar">
  <div class="navbar-inner">
    <a href="<?php echo esc_url(home_url('/help-portal/')); ?>" class="navbar-logo">Iur<span>efficient</span> &middot; Ayuda</a>
    <ul class="navbar-links">
      <li><a href="<?php echo esc_url(home_url('/help-portal/')); ?>"<?php echo $current_help_page === 'inicio' ? ' class="active"' : ''; ?>>Inicio</a></li>
      <li><a href="<?php echo esc_url(home_url('/guia-inicio/')); ?>"<?php echo $current_help_page === 'guia' ? ' class="active"' : ''; ?>>Primeros Pasos</a></li>
      <li><a href="<?php echo esc_url(home_url('/funcionalidades/')); ?>"<?php echo $current_help_page === 'funcionalidades' ? ' class="active"' : ''; ?>>Funcionalidades</a></li>
      <li><a href="<?php echo esc_url(home_url('/industrias/')); ?>"<?php echo $current_help_page === 'industrias' ? ' class="active"' : ''; ?>>Industrias</a></li>
      <li><a href="<?php echo esc_url(home_url('/planes/')); ?>"<?php echo $current_help_page === 'planes' ? ' class="active"' : ''; ?>>Planes</a></li>
      <li><a href="<?php echo esc_url(home_url('/faq/')); ?>"<?php echo $current_help_page === 'faq' ? ' class="active"' : ''; ?>>FAQ</a></li>
    </ul>
    <a href="<?php echo esc_url(home_url('/planes/#prueba')); ?>" class="navbar-cta">Prueba Gratis</a>
  </div>
</nav>
