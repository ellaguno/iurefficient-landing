<?php
/**
 * Help Portal Footer
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
        <li><a href="<?php echo esc_url(home_url('/funcionalidades/')); ?>">Funcionalidades</a></li>
        <li><a href="<?php echo esc_url(home_url('/industrias/')); ?>">Industrias</a></li>
        <li><a href="<?php echo esc_url(home_url('/planes/')); ?>">Planes y Precios</a></li>
        <li><a href="<?php echo esc_url(home_url('/guia-inicio/')); ?>">Primeros Pasos</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Soporte</h4>
      <ul>
        <li><a href="<?php echo esc_url(home_url('/faq/')); ?>">Preguntas Frecuentes</a></li>
        <li><a href="mailto:soporte@iurefficient.com">soporte@iurefficient.com</a></li>
        <li><a href="mailto:sales@iurefficient.com">sales@iurefficient.com</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Legal</h4>
      <ul>
        <li><a href="<?php echo esc_url(home_url('/privacidad/')); ?>">Aviso de Privacidad</a></li>
        <li><a href="<?php echo esc_url(home_url('/terminos/')); ?>">Terminos de Servicio</a></li>
        <li><a href="<?php echo esc_url(home_url('/seguridad/')); ?>">Seguridad</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; <?php echo date('Y'); ?> Iurefficient. Todos los derechos reservados.
  </div>
</footer>
