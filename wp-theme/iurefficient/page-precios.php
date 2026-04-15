<?php
/* Template Name: Precios */
get_header();

// Load centralized pricing data
require_once get_template_directory() . '/inc/pricing-data.php';
?>

<style>
    /* Page-specific styles */
    .pricing-page-hero {
        padding: calc(80px + var(--spacing-3xl)) 0 var(--spacing-3xl);
        background: var(--gradient-hero);
        color: var(--white);
        text-align: center;
    }

    .pricing-page-hero h1 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: var(--spacing-md);
    }

    .pricing-page-hero p {
        font-size: 1.125rem;
        opacity: 0.8;
        max-width: 600px;
        margin: 0 auto;
    }

    .pricing-toggle {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: var(--spacing-md);
        margin-bottom: var(--spacing-3xl);
    }

    .pricing-toggle span {
        font-weight: 500;
        color: var(--gray-500);
    }

    .pricing-toggle span.active {
        color: var(--gray-900);
    }

    .toggle-switch {
        position: relative;
        width: 56px;
        height: 28px;
        background: var(--gray-200);
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: background var(--transition-base);
    }

    .toggle-switch.active {
        background: var(--primary-500);
    }

    .toggle-switch::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 24px;
        height: 24px;
        background: var(--white);
        border-radius: var(--radius-full);
        transition: transform var(--transition-base);
        box-shadow: var(--shadow-sm);
    }

    .toggle-switch.active::after {
        transform: translateX(28px);
    }

    .discount-badge {
        background: var(--success-500);
        color: var(--white);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.5rem;
        border-radius: var(--radius-full);
    }

    .pricing-comparison {
        padding: var(--spacing-4xl) 0;
    }

    .comparison-table-wrapper {
        overflow-x: auto;
        margin: 0 -1rem;
        padding: 0 1rem;
    }

    .comparison-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .comparison-table th,
    .comparison-table td {
        padding: var(--spacing-md) var(--spacing-lg);
        text-align: left;
        border-bottom: 1px solid var(--gray-100);
    }

    .comparison-table th {
        background: var(--gray-50);
        font-weight: 700;
        color: var(--gray-900);
    }

    .comparison-table th:not(:first-child) {
        text-align: center;
    }

    .comparison-table td:not(:first-child) {
        text-align: center;
    }

    .comparison-table .feature-category {
        background: var(--primary-50, #eef2ff);
        font-weight: 700;
        color: var(--primary-700);
    }

    .comparison-table .check-icon {
        color: var(--success-500);
        font-size: 1.25rem;
    }

    .comparison-table .x-icon {
        color: var(--gray-300);
    }

    .faq-section {
        background: var(--gray-50);
        padding: var(--spacing-4xl) 0;
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: var(--spacing-xl);
        max-width: 1000px;
        margin: 0 auto;
    }

    @media (max-width: 500px) {
        .faq-grid {
            grid-template-columns: 1fr;
        }
    }

    .faq-item {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: var(--spacing-xl);
    }

    .faq-item h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: var(--spacing-sm);
    }

    .faq-item p {
        color: var(--gray-600);
        font-size: 0.9375rem;
    }

    .guarantee-section {
        padding: var(--spacing-4xl) 0;
        text-align: center;
    }

    .guarantee-card {
        max-width: 600px;
        margin: 0 auto;
        padding: var(--spacing-2xl);
        background: linear-gradient(135deg, var(--success-500) 0%, var(--accent-500) 100%);
        border-radius: var(--radius-xl);
        color: var(--white);
    }

    .guarantee-card h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: var(--spacing-md);
    }

    .guarantee-card p {
        opacity: 0.9;
    }

    .pricing-overage {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin-top: var(--spacing-md);
        padding-top: var(--spacing-md);
        border-top: 1px solid var(--gray-100);
    }

    .comparison-table th small {
        font-weight: 500;
        opacity: 0.7;
    }
</style>

    <!-- Hero -->
    <section class="pricing-page-hero">
        <div class="container">
            <h1 data-aos="fade-up">Planes transparentes, <span class="gradient-text">sin sorpresas</span></h1>
            <p data-aos="fade-up" data-aos-delay="100">Elige el plan que mejor se adapte a tu practica. Sin contratos forzosos, cancela cuando quieras.</p>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="pricing" style="padding-top: var(--spacing-3xl);">
        <div class="container">
<?php
$show_toggle = true;
$show_overage = true;
$show_extra_features = true;
$show_footer_link = false;
get_template_part('template-parts/pricing', 'cards');
?>
        </div>
    </section>

<?php get_template_part('template-parts/pricing', 'comparison'); ?>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Preguntas <span class="gradient-text">frecuentes</span></h2>
            </div>

            <div class="faq-grid">
                <div class="faq-item" data-aos="fade-up" data-aos-delay="0">
                    <h4>Puedo cambiar de plan en cualquier momento?</h4>
                    <p>Si, puedes subir o bajar de plan cuando quieras. Los cambios se aplican en tu proximo ciclo de facturacion. Si subes de plan, solo pagas la diferencia prorrateada.</p>
                </div>

                <div class="faq-item" data-aos="fade-up" data-aos-delay="50">
                    <h4>Hay compromiso de permanencia?</h4>
                    <p>No. Todos nuestros planes son sin contrato. Puedes cancelar cuando quieras y seguiras teniendo acceso hasta el final de tu periodo pagado.</p>
                </div>

                <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                    <h4>Que metodos de pago aceptan?</h4>
                    <p>Aceptamos tarjetas de credito y debito (Visa, Mastercard, American Express), transferencia bancaria y PayPal. Para planes empresariales ofrecemos facturacion.</p>
                </div>

                <div class="faq-item" data-aos="fade-up" data-aos-delay="150">
                    <h4>Ofrecen descuentos para despachos pequenos?</h4>
                    <p>Si, ofrecemos un 20% de descuento en planes anuales. Tambien tenemos programas especiales para recien egresados y despachos pro bono. Contactanos para mas informacion.</p>
                </div>

                <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h4>Que pasa con mis datos si cancelo?</h4>
                    <p>Tienes 30 dias despues de cancelar para exportar todos tus datos. Despues de ese periodo, los eliminamos de forma segura de nuestros servidores.</p>
                </div>

                <div class="faq-item" data-aos="fade-up" data-aos-delay="250">
                    <h4>La prueba gratuita requiere tarjeta de credito?</h4>
                    <p>No. La prueba de 14 dias es completamente gratuita y no requiere tarjeta de credito. Solo te pediremos datos de pago si decides continuar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Guarantee -->
    <section class="guarantee-section">
        <div class="container">
            <div class="guarantee-card" data-aos="zoom-in">
                <h3>Garantia de satisfaccion de 30 dias</h3>
                <p>Si no estas completamente satisfecho con Iurefficient en los primeros 30 dias, te devolvemos el 100% de tu dinero. Sin preguntas.</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2>Listo para empezar?</h2>
                <p>Prueba Iurefficient gratis por 14 dias. Sin tarjeta de credito.</p>
                <a href="<?php echo esc_url(home_url('/#contacto')); ?>" class="btn btn-primary btn-lg">Comenzar prueba gratuita</a>
            </div>
        </div>
    </section>

<script>
    // Pricing toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('pricingToggle');
        const monthlyLabel = document.getElementById('monthlyLabel');
        const annualLabel = document.getElementById('annualLabel');
        const amounts = document.querySelectorAll('.pricing-price .amount');

        if (toggle) {
            toggle.addEventListener('click', function() {
                this.classList.toggle('active');
                const isAnnual = this.classList.contains('active');

                monthlyLabel.classList.toggle('active', !isAnnual);
                annualLabel.classList.toggle('active', isAnnual);

                amounts.forEach(function(amount) {
                    var value = isAnnual ? amount.dataset.annual : amount.dataset.monthly;
                    amount.textContent = value;
                });
            });
        }
    });
</script>

<?php get_footer(); ?>
