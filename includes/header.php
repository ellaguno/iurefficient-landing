<?php
/**
 * Header/Nav compartido.
 *
 * Variables esperadas:
 *   $base_path    - Ruta base ('' para root, '../' para subdirectorios)
 *   $current_page - Identificador de página: 'home', 'precios', 'seguridad', 'legal'
 */
?>
    <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="<?= $base_path ?: '/' ?>" class="logo">
                    <img src="<?= $base_path ?>images/logo.svg" alt="Iurefficient" class="logo-img">
                </a>

                <button class="nav-toggle" id="navToggle" aria-label="Menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="<?= $base_path ?>#caracteristicas"<?= $current_page === 'caracteristicas' ? ' class="active"' : '' ?>>Características</a></li>
                    <li><a href="<?= $base_path ?>seguridad/"<?= $current_page === 'seguridad' ? ' class="active"' : '' ?>>Seguridad</a></li>
                    <li><a href="<?= $base_path ?>#equipo"<?= $current_page === 'equipo' ? ' class="active"' : '' ?>>Equipo</a></li>
                    <li><a href="https://blog.iurefficient.com" target="_blank">Blog</a></li>
                    <li><a href="<?= $base_path ?>precios/"<?= $current_page === 'precios' ? ' class="active"' : '' ?>>Precios</a></li>
                    <li><a href="https://demo.iurefficient.com" target="_blank" class="btn btn-primary btn-sm">Usar Demo</a></li>
                </ul>
            </nav>
        </div>
    </header>
