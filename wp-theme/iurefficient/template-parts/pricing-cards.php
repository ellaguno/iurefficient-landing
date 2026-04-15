<?php
/**
 * Pricing cards reutilizables (generadas desde $plans).
 *
 * Variables esperadas (via $args o extracted):
 *   $plans              - Array de planes (de iurefficient_get_pricing_data())
 *   $show_toggle        - (opcional, default false) Mostrar toggle mensual/anual
 *   $show_overage       - (opcional, default false) Mostrar excedentes
 *   $show_extra_features - (opcional, default false) Incluir features extra
 *   $show_footer_link   - (opcional, default false) Mostrar enlace a comparativa
 */

// Support both $args (from get_template_part) and direct variables
if ( ! empty( $args ) && is_array( $args ) ) {
    $plans              = isset( $args['plans'] ) ? $args['plans'] : array();
    $show_toggle        = isset( $args['show_toggle'] ) ? $args['show_toggle'] : false;
    $show_overage       = isset( $args['show_overage'] ) ? $args['show_overage'] : false;
    $show_extra_features = isset( $args['show_extra_features'] ) ? $args['show_extra_features'] : false;
    $show_footer_link   = isset( $args['show_footer_link'] ) ? $args['show_footer_link'] : false;
} else {
    if ( ! isset( $plans ) ) $plans = array();
    if ( ! isset( $show_toggle ) ) $show_toggle = false;
    if ( ! isset( $show_overage ) ) $show_overage = false;
    if ( ! isset( $show_extra_features ) ) $show_extra_features = false;
    if ( ! isset( $show_footer_link ) ) $show_footer_link = false;
}

$checkmark_svg = '<svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>';
?>

<?php if ( $show_toggle ) : ?>
            <!-- Toggle Mensual/Anual -->
            <div class="pricing-toggle" data-aos="fade-up">
                <span class="active" id="monthlyLabel">Mensual</span>
                <div class="toggle-switch" id="pricingToggle"></div>
                <span id="annualLabel">Anual</span>
                <span class="discount-badge">Ahorra 20%</span>
            </div>
<?php endif; ?>

            <div class="pricing-grid">
<?php $delay = 0; foreach ( $plans as $key => $plan ) : ?>
                <div class="pricing-card<?php echo $plan['featured'] ? ' pricing-featured' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
<?php if ( $plan['badge'] ) : ?>
                    <div class="pricing-badge"><?php echo esc_html( $plan['badge'] ); ?></div>
<?php endif; ?>
                    <div class="pricing-header">
                        <h3><?php echo esc_html( $plan['name'] ); ?></h3>
                        <p class="pricing-description"><?php echo esc_html( $plan['description'] ); ?></p>
                    </div>
                    <div class="pricing-price">
                        <span class="currency">$</span>
                        <span class="amount"<?php if ( $show_toggle ) : ?> data-monthly="<?php echo esc_attr( iurefficient_format_price( $plan['monthly'] ) ); ?>" data-annual="<?php echo esc_attr( iurefficient_format_price( $plan['annual'] ) ); ?>"<?php endif; ?>><?php echo esc_html( iurefficient_format_price( $plan['monthly'] ) ); ?></span>
                        <span class="period">MXN/mes</span>
                    </div>
                    <ul class="pricing-features">
<?php
    $features = $plan['features'];
    if ( $show_extra_features && ! empty( $plan['extra_features'] ) ) {
        $features = array_merge( $features, $plan['extra_features'] );
    }
    foreach ( $features as $feature ) :
?>
                        <li><?php echo $checkmark_svg; ?> <?php echo esc_html( $feature ); ?></li>
<?php endforeach; ?>
                    </ul>
<?php if ( $show_overage && ! empty( $plan['overage'] ) ) : ?>
                    <p class="pricing-overage">Excedentes: <?php echo esc_html( $plan['overage'] ); ?></p>
<?php endif; ?>
                    <a href="<?php echo esc_url( home_url( '/#contacto' ) ); ?>" class="btn btn-<?php echo esc_attr( $plan['cta_style'] ); ?> btn-block"><?php echo esc_html( $plan['cta_text'] ); ?></a>
                </div>
<?php $delay += 100; endforeach; ?>
            </div>

<?php if ( $show_footer_link ) : ?>
            <div class="pricing-footer" data-aos="fade-up">
                <p>¿Necesitas algo diferente? <a href="<?php echo esc_url( home_url( '/precios/' ) ); ?>">Ver comparativa completa de planes</a></p>
            </div>
<?php endif; ?>
