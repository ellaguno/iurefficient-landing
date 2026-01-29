<?php
/**
 * Tabla comparativa de planes (generada desde $plans y $comparison_categories).
 *
 * Variables esperadas:
 *   $plans                - Array de planes (de pricing-data.php)
 *   $comparison_categories - Categorías y features para la tabla
 */
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
<?php foreach ($plans as $plan): ?>
                            <th><?= htmlspecialchars($plan['name']) ?><br><small>$<?= format_price($plan['monthly']) ?>/mes</small></th>
<?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ($comparison_categories as $category_name => $features): ?>
                        <tr class="feature-category">
                            <td colspan="4"><?= htmlspecialchars($category_name) ?></td>
                        </tr>
<?php foreach ($features as $feature_key => $feature_label): ?>
                        <tr>
                            <td><?= htmlspecialchars($feature_label) ?></td>
<?php foreach ($plans as $plan): ?>
<?php
    $value = $plan['comparison'][$feature_key] ?? false;
    if ($value === true) {
        $cell = '<span class="check-icon">✓</span>';
    } elseif ($value === false) {
        $cell = '<span class="x-icon">—</span>';
    } else {
        $cell = htmlspecialchars($value);
    }
?>
                            <td><?= $cell ?></td>
<?php endforeach; ?>
                        </tr>
<?php endforeach; ?>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
