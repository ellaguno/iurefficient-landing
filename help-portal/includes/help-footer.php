<?php
/**
 * Footer del Help Portal.
 *
 * Variables esperadas:
 *   $base_path - Ruta base al root del sitio (ej. '../')
 */
?>
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="navbar-logo" style="color:#fff;">Iur<span>efficient</span></div>
      <p>Tu Colaborador Especialista Inteligente. Potencia tu practica profesional con Inteligencia Artificial.</p>
    </div>
    <div class="footer-col">
      <h4>Producto</h4>
      <ul>
        <li><a href="<?= $base_path ?>help-portal/funcionalidades.php">Funcionalidades</a></li>
        <li><a href="<?= $base_path ?>help-portal/industrias.php">Industrias</a></li>
        <li><a href="<?= $base_path ?>help-portal/planes.php">Planes y Precios</a></li>
        <li><a href="<?= $base_path ?>help-portal/guia-inicio.php">Primeros Pasos</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Soporte</h4>
      <ul>
        <li><a href="<?= $base_path ?>help-portal/faq.php">Preguntas Frecuentes</a></li>
        <li><a href="mailto:soporte@iurefficient.com">soporte@iurefficient.com</a></li>
        <li><a href="mailto:sales@iurefficient.com">sales@iurefficient.com</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Legal</h4>
      <ul>
        <li><a href="<?= $base_path ?>legal/privacidad.php">Aviso de Privacidad</a></li>
        <li><a href="<?= $base_path ?>legal/terminos.php">Terminos de Servicio</a></li>
        <li><a href="<?= $base_path ?>seguridad/">Seguridad</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; <?= date('Y') ?> Iurefficient. Todos los derechos reservados.
  </div>
</footer>
