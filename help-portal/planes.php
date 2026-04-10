<?php
$base_path = '../';
$current_help_page = 'planes';

// Cargar precios centralizados del sitio principal
require_once __DIR__ . '/../includes/pricing-data.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planes y Precios — Iurefficient</title>
  <meta name="description" content="Planes y precios de Iurefficient. Desde despachos pequenos hasta enterprise. Prueba gratis 14 dias.">
  <link rel="icon" type="image/png" href="<?= $base_path ?>images/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/includes/help-nav.php'; ?>

<div class="page-header">
  <div class="page-header-inner">
    <div class="breadcrumb"><a href="<?= $base_path ?>help-portal/">Ayuda</a> / Planes y Precios</div>
    <h1>Planes y Precios</h1>
    <p>Elige el plan que mejor se adapte a tu practica profesional. Todos incluyen 14 dias de prueba gratis.</p>
  </div>
</div>

<section class="section">
  <div class="pricing-grid">

    <?php foreach ($plans as $key => $plan): ?>
    <div class="pricing-card<?= $plan['featured'] ? ' featured' : '' ?>">
      <?php if ($plan['badge']): ?>
      <?php endif; ?>
      <div class="pricing-name"><?= htmlspecialchars($plan['name']) ?></div>
      <div class="pricing-price">$<?= format_price($plan['monthly']) ?> <small>USD/mes</small></div>
      <div class="pricing-desc"><?= htmlspecialchars($plan['description']) ?>.</div>
      <ul class="pricing-features">
        <?php foreach ($plan['features'] as $feature): ?>
        <li><?= htmlspecialchars($feature) ?></li>
        <?php endforeach; ?>
        <?php if (!empty($plan['extra_features'])): ?>
        <?php foreach ($plan['extra_features'] as $extra): ?>
        <li><?= htmlspecialchars($extra) ?></li>
        <?php endforeach; ?>
        <?php endif; ?>
      </ul>
      <?php if ($plan['cta_style'] === 'primary'): ?>
      <a href="#prueba" class="btn btn-primary"><?= htmlspecialchars($plan['cta_text']) ?></a>
      <?php else: ?>
      <?php if ($key === 'enterprise'): ?>
      <a href="mailto:sales@iurefficient.com" class="btn btn-outline"><?= htmlspecialchars($plan['cta_text']) ?></a>
      <?php else: ?>
      <a href="#prueba" class="btn btn-outline"><?= htmlspecialchars($plan['cta_text']) ?></a>
      <?php endif; ?>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>

  </div>

  <p style="text-align:center; margin-top:1.5rem; color:var(--gray-500); font-size:.9rem;">
    Pago anual disponible con 20% de descuento. Todos los precios en USD + IVA aplicable.
    <br><a href="<?= $base_path ?>precios/" style="font-weight:600;">Ver comparativa completa de planes</a>
  </p>
</section>

<!-- Prueba gratis -->
<section class="section" id="prueba">
  <div class="cta-banner">
    <h2>Prueba Gratis — 14 Dias</h2>
    <p>Acceso completo al Plan <?= htmlspecialchars($plans['profesional']['name']) ?>. Sin tarjeta de credito. Sin compromiso.</p>
    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem; margin-top:1.5rem;">
      <div style="text-align:left; background:rgba(255,255,255,.15); padding:1rem 1.5rem; border-radius:var(--radius-sm);">
        <p style="opacity:1; margin:0;">&#10003; Acceso completo al Plan <?= htmlspecialchars($plans['profesional']['name']) ?></p>
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

<?php include __DIR__ . '/includes/help-footer.php'; ?>

<script src="app.js"></script>
</body>
</html>
