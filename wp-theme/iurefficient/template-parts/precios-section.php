<!-- Pricing Section -->
<section class="pricing" id="precios">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Planes que se adaptan a <span class="gradient-text">tu práctica</span></h2>
            <p class="section-subtitle">Sin contratos forzosos. Cancela cuando quieras.</p>
        </div>

<?php
$pricing_data = iurefficient_get_pricing_data();
$plans = $pricing_data['plans'];
$show_toggle = false;
$show_overage = false;
$show_extra_features = false;
$show_footer_link = true;
get_template_part('template-parts/pricing-cards', null, array(
    'plans'               => $plans,
    'show_toggle'         => $show_toggle,
    'show_overage'        => $show_overage,
    'show_extra_features' => $show_extra_features,
    'show_footer_link'    => $show_footer_link,
));
?>
    </div>
</section>
