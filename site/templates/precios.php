<?php /** Planes y precios (/precios). Variables: $lang, $S, $t, $page */ declare(strict_types=1);
$h = fn(string $k, string $d = '') => iure_h($k, $d);
$planes = iure_planes('precios');
$faq = iure_faq('precios');
$contact = cms_url('page:derecho', $lang) . '/#contacto';
$check = '<span class="check-icon">✓</span>';
$no = '<span class="x-icon">—</span>';
// Tabla comparativa: [categoría => [característica => [valor por plan…]]]. Se edita aquí (Código del tema → precios.php).
$comparativa = [
    'Gestión de Casos' => [
        'Casos activos' => ['50', '200', 'Ilimitados'],
        'Gestión de clientes' => [true, true, true],
        'Calendario legal' => [true, true, true],
        'Alertas de plazos' => [true, true, true],
    ],
    'Inteligencia Artificial' => [
        'Consultas IA mensuales' => ['500', '2,000', '10,000'],
        'Análisis de documentos' => [true, true, true],
        'Extracción de cláusulas' => [true, true, true],
        'Resumen automático' => [true, true, true],
        'Búsqueda semántica avanzada' => [false, true, true],
    ],
    'Almacenamiento y Documentos' => [
        'Almacenamiento' => ['2 GB', '4 GB', '40 GB'],
        'Versionado de documentos' => [true, true, true],
        'OCR para PDFs escaneados' => [false, true, true],
    ],
    'Colaboración' => [
        'Usuarios incluidos' => ['3', '15', '100'],
        'Roles y permisos' => [false, true, true],
        'Historial de actividad' => ['30 días', '90 días', 'Ilimitado'],
    ],
    'Integraciones' => [
        'Google Calendar' => [false, true, true],
        'Google Drive' => [false, true, true],
        'Microsoft 365' => [false, false, true],
        'API acceso' => [false, true, true],
        'Webhooks' => [false, false, true],
    ],
    'Soporte' => [
        'Tipo de soporte' => ['Email', 'Prioritario', 'Dedicado 24/7'],
        'Tiempo de respuesta' => ['48 horas', '12 horas', '2 horas'],
        'Capacitación' => ['Documentación', 'Webinars', 'Personalizada'],
        'SLA garantizado' => [false, '99.5%', '99.9%'],
    ],
];
$cols = count($planes) + 1;
?>
    <!-- Hero -->
    <section class="pricing-page-hero">
        <div class="container">
            <h1 data-aos="fade-up"><?= $h('p_hero_title', 'Planes transparentes, <span class="gradient-text">sin sorpresas</span>') ?></h1>
            <p data-aos="fade-up" data-aos-delay="100"><?= cms_e($t('p_hero_text')) ?></p>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="pricing" style="padding-top: var(--spacing-3xl);">
        <div class="container">
            <div class="pricing-toggle" data-aos="fade-up">
                <span class="active" id="monthlyLabel"><?= cms_e($t('p_toggle_monthly', 'Mensual')) ?></span>
                <div class="toggle-switch" id="pricingToggle" role="switch" aria-checked="false" tabindex="0"></div>
                <span id="annualLabel"><?= cms_e($t('p_toggle_annual', 'Anual')) ?></span>
<?php if ($t('p_toggle_discount')): ?>
                <span class="discount-badge"><?= cms_e($t('p_toggle_discount')) ?></span>
<?php endif; ?>
            </div>

            <div class="pricing-grid">
<?php foreach ($planes as $i => $p) { $p['cta_url'] = ($p['cta_url'] ?? '') === '' || $p['cta_url'] === '#contacto' ? $contact : $p['cta_url']; echo iure_plan_card($p, $i * 100, true), "\n"; } ?>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
<?php if ($planes): ?>
    <section class="pricing-comparison">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('p_compare_title', 'Comparativa <span class="gradient-text">detallada</span>') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('p_compare_subtitle', 'Todas las características lado a lado')) ?></p>
            </div>

            <div class="comparison-table-wrapper" data-aos="fade-up">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Característica</th>
<?php foreach ($planes as $p): ?>
                            <th><?= cms_e($p['title'] ?? '') ?><br><small>$<?= cms_e($p['price'] ?? '') ?>/mes</small></th>
<?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ($comparativa as $cat => $rows): ?>
                        <tr class="feature-category"><td colspan="<?= $cols ?>"><?= cms_e($cat) ?></td></tr>
<?php foreach ($rows as $label => $vals): ?>
                        <tr>
                            <td><?= cms_e($label) ?></td>
<?php for ($i = 0; $i < count($planes); $i++): $v = $vals[$i] ?? false; ?>
                            <td><?= $v === true ? $check : ($v === false || $v === '' ? $no : cms_e((string) $v)) ?></td>
<?php endfor; ?>
                        </tr>
<?php endforeach; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- FAQ Section -->
<?php if ($faq): ?>
    <section class="faq-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('p_faq_title', 'Preguntas <span class="gradient-text">frecuentes</span>') ?></h2>
            </div>

            <div class="faq-grid">
<?php foreach ($faq as $i => $q): ?>
                <div class="faq-item" data-aos="fade-up" data-aos-delay="<?= $i * 50 ?>">
                    <h4><?= cms_e($q['title'] ?? '') ?></h4>
                    <?= cms_content((string) ($q['answer'] ?? '')) ?>
                </div>
<?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- Guarantee -->
<?php if ($t('p_guarantee_title')): ?>
    <section class="guarantee-section">
        <div class="container">
            <div class="guarantee-card" data-aos="zoom-in">
                <h3><?= cms_e($t('p_guarantee_title')) ?></h3>
                <p><?= cms_e($t('p_guarantee_text')) ?></p>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2><?= cms_e($t('p_cta_title', '¿Listo para empezar?')) ?></h2>
                <p><?= cms_e($t('p_cta_text')) ?></p>
                <a href="<?= cms_e($contact) ?>" class="btn btn-primary btn-lg"><?= cms_e($t('p_cta_button', 'Comenzar prueba gratuita')) ?></a>
            </div>
        </div>
    </section>

    <script>
        // Conmutador mensual / anual
        (function () {
            var toggle = document.getElementById('pricingToggle');
            var monthlyLabel = document.getElementById('monthlyLabel');
            var annualLabel = document.getElementById('annualLabel');
            var amounts = document.querySelectorAll('.pricing-price .amount[data-annual]');
            if (!toggle) return;
            function flip() {
                toggle.classList.toggle('active');
                var isAnnual = toggle.classList.contains('active');
                toggle.setAttribute('aria-checked', isAnnual ? 'true' : 'false');
                monthlyLabel.classList.toggle('active', !isAnnual);
                annualLabel.classList.toggle('active', isAnnual);
                amounts.forEach(function (a) { a.textContent = isAnnual ? a.dataset.annual : a.dataset.monthly; });
            }
            toggle.addEventListener('click', flip);
            toggle.addEventListener('keydown', function (e) { if (e.key === ' ' || e.key === 'Enter') { e.preventDefault(); flip(); } });
        })();
    </script>
