<?php
/* Template Name: Planes */
get_header();
$current_help_page = 'planes';
get_template_part('template-parts/help-nav');

// Load centralized pricing data
require_once get_template_directory() . '/inc/pricing-data.php';
?>

<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/styles.css'); ?>">

<div class="page-header">
  <div class="page-header-inner">
    <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/help-portal/')); ?>">Ayuda</a> / Planes y Precios</div>
    <h1>Planes y Precios</h1>
    <p>Elige el plan que mejor se adapte a tu practica profesional. Todos incluyen 14 dias de prueba gratis.</p>
  </div>
</div>

<section class="section">
  <div class="pricing-grid">

    <?php foreach ($plans as $key => $plan): ?>
    <div class="pricing-card<?php echo $plan['featured'] ? ' featured' : ''; ?>">
      <?php if ($plan['badge']): ?>
      <?php endif; ?>
      <div class="pricing-name"><?php echo esc_html($plan['name']); ?></div>
      <div class="pricing-price">$<?php echo format_price($plan['monthly']); ?> <small>USD/mes</small></div>
      <div class="pricing-desc"><?php echo esc_html($plan['description']); ?>.</div>
      <ul class="pricing-features">
        <?php foreach ($plan['features'] as $feature): ?>
        <li><?php echo esc_html($feature); ?></li>
        <?php endforeach; ?>
        <?php if (!empty($plan['extra_features'])): ?>
        <?php foreach ($plan['extra_features'] as $extra): ?>
        <li><?php echo esc_html($extra); ?></li>
        <?php endforeach; ?>
        <?php endif; ?>
      </ul>
      <?php if ($plan['cta_style'] === 'primary'): ?>
      <a href="#prueba" class="btn btn-primary"><?php echo esc_html($plan['cta_text']); ?></a>
      <?php else: ?>
      <?php if ($key === 'enterprise'): ?>
      <a href="mailto:sales@iurefficient.com" class="btn btn-outline"><?php echo esc_html($plan['cta_text']); ?></a>
      <?php else: ?>
      <a href="#prueba" class="btn btn-outline"><?php echo esc_html($plan['cta_text']); ?></a>
      <?php endif; ?>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>

  </div>

  <p style="text-align:center; margin-top:1.5rem; color:var(--gray-500); font-size:.9rem;">
    Pago anual disponible con 20% de descuento. Todos los precios en USD + IVA aplicable.
    <br><a href="<?php echo esc_url(home_url('/precios/')); ?>" style="font-weight:600;">Ver comparativa completa de planes</a>
  </p>
</section>

<!-- Prueba gratis -->
<section class="section" id="prueba">
  <div class="cta-banner">
    <h2>Prueba Gratis &mdash; 14 Dias</h2>
    <p>Acceso completo al Plan <?php echo esc_html($plans['profesional']['name']); ?>. Sin tarjeta de credito. Sin compromiso.</p>
    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem; margin-top:1.5rem;">
      <div style="text-align:left; background:rgba(255,255,255,.15); padding:1rem 1.5rem; border-radius:var(--radius-sm);">
        <p style="opacity:1; margin:0;">&#10003; Acceso completo al Plan <?php echo esc_html($plans['profesional']['name']); ?></p>
        <p style="opacity:1; margin:.25rem 0 0;">&#10003; Sin tarjeta de credito requerida</p>
        <p style="opacity:1; margin:.25rem 0 0;">&#10003; Onboarding guiado 1-on-1</p>
        <p style="opacity:1; margin:.25rem 0 0;">&#10003; Soporte prioritario durante prueba</p>
        <p style="opacity:1; margin:.25rem 0 0;">&#10003; Carga tus primeros 10 casos gratis</p>
      </div>
    </div>
    <div style="margin-top:1.5rem;">
      <a href="mailto:sales@iurefficient.com?subject=Prueba gratuita Iurefficient" class="btn-white">Solicitar prueba gratis</a>
    </div>
    <p style="opacity:.8; margin-top:1rem; font-size:.88rem;">Garantia: Si no ahorras al menos 10 horas en el primer mes, devolucion completa.</p>
  </div>
</section>

<!-- Contacto -->
<section class="section" style="text-align:center;">
  <h2 class="section-title">Necesitas ayuda para elegir?</h2>
  <p class="section-subtitle">Nuestro equipo esta listo para asesorarte.</p>
  <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:2rem; margin-top:1.5rem;">
    <div>
      <p style="font-weight:600; margin-bottom:.25rem;">Email</p>
      <a href="mailto:sales@iurefficient.com">sales@iurefficient.com</a>
    </div>
    <div>
      <p style="font-weight:600; margin-bottom:.25rem;">Demo en vivo</p>
      <span style="color:var(--gray-600);">30 minutos personalizados</span>
    </div>
  </div>
</section>

<?php
get_template_part('template-parts/help-footer');
?>

<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/help-portal/app.js'); ?>"></script>

<?php get_footer(); ?>
