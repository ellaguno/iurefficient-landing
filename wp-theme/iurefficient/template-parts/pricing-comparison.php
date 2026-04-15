<?php
/**
 * Tabla comparativa de planes (generada desde pricing data).
 *
 * Uses iurefficient_get_pricing_data() to get plans and comparison categories.
 */
$pricing_data = iurefficient_get_pricing_data();
$plans = $pricing_data['plans'];
$comparison_categories = $pricing_data['comparison_categories'];
?>
    <!-- Comparison Table -->
    <section class="pricing-comparison">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Comparativa <span class="gradient-text">detallada</span></h2>
                <p class="section-subtitle">Todas las características lado a lado</p>
            </div>

            <div class="comparison-table-wrapper" data-aos="fade-up">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Característica</th>
<?php foreach ( $plans as $plan ) : ?>
                            <th><?php echo esc_html( $plan['name'] ); ?><br><small>$<?php echo esc_html( iurefficient_format_price( $plan['monthly'] ) ); ?>/mes</small></th>
<?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ( $comparison_categories as $category_name => $features ) : ?>
                        <tr class="feature-category">
                            <td colspan="4"><?php echo esc_html( $category_name ); ?></td>
                        </tr>
<?php foreach ( $features as $feature_key => $feature_label ) : ?>
                        <tr>
                            <td><?php echo esc_html( $feature_label ); ?></td>
<?php foreach ( $plans as $plan ) :
    $value = isset( $plan['comparison'][ $feature_key ] ) ? $plan['comparison'][ $feature_key ] : false;
    if ( $value === true ) {
        $cell = '<span class="check-icon">✓</span>';
    } elseif ( $value === false ) {
        $cell = '<span class="x-icon">—</span>';
    } else {
        $cell = esc_html( $value );
    }
?>
                            <td><?php echo $cell; ?></td>
<?php endforeach; ?>
                        </tr>
<?php endforeach; ?>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
