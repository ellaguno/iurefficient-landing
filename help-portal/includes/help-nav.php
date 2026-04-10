<?php
/**
 * Navbar del Help Portal.
 *
 * Variables esperadas:
 *   $current_help_page - 'inicio','guia','funcionalidades','industrias','planes','faq'
 *   $base_path         - Ruta base al root del sitio (ej. '../')
 */
?>
<nav class="navbar">
  <div class="navbar-inner">
    <a href="<?= $base_path ?>help-portal/" class="navbar-logo">Iur<span>efficient</span> &middot; Ayuda</a>
    <ul class="navbar-links">
      <li><a href="<?= $base_path ?>help-portal/"<?= $current_help_page === 'inicio' ? ' class="active"' : '' ?>>Inicio</a></li>
      <li><a href="<?= $base_path ?>help-portal/guia-inicio.php"<?= $current_help_page === 'guia' ? ' class="active"' : '' ?>>Primeros Pasos</a></li>
      <li><a href="<?= $base_path ?>help-portal/funcionalidades.php"<?= $current_help_page === 'funcionalidades' ? ' class="active"' : '' ?>>Funcionalidades</a></li>
      <li><a href="<?= $base_path ?>help-portal/industrias.php"<?= $current_help_page === 'industrias' ? ' class="active"' : '' ?>>Industrias</a></li>
      <li><a href="<?= $base_path ?>help-portal/planes.php"<?= $current_help_page === 'planes' ? ' class="active"' : '' ?>>Planes</a></li>
      <li><a href="<?= $base_path ?>help-portal/faq.php"<?= $current_help_page === 'faq' ? ' class="active"' : '' ?>>FAQ</a></li>
    </ul>
    <a href="<?= $base_path ?>help-portal/planes.php#prueba" class="navbar-cta">Prueba Gratis</a>
  </div>
</nav>
