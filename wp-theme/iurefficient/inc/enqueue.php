<?php
/**
 * Iurefficient - Asset Enqueue
 */

function iurefficient_enqueue_assets() {
    $theme_uri = get_template_directory_uri();
    $theme_version = wp_get_theme()->get('Version');

    // Google Fonts - Inter
    wp_enqueue_style(
        'google-fonts-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        [],
        null
    );

    // Conditionally load libraries on front page and relevant pages
    $needs_aos = is_front_page() || is_page(['precios', 'seguridad']);
    $needs_swiper = is_front_page();
    $needs_glightbox = is_front_page();

    // AOS - Animate on Scroll
    if ($needs_aos) {
        wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css', [], '2.3.1');
        wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', [], '2.3.1', true);
    }

    // Swiper
    if ($needs_swiper) {
        wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11');
        wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true);
    }

    // GLightbox
    if ($needs_glightbox) {
        wp_enqueue_style('glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css', [], '3.2.0');
        wp_enqueue_script('glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js', [], '3.2.0', true);
    }

    // Main stylesheet
    wp_enqueue_style('iurefficient-main', $theme_uri . '/css/main.css', ['google-fonts-inter'], $theme_version);

    // Main JS
    $js_deps = [];
    if ($needs_aos) $js_deps[] = 'aos';
    if ($needs_swiper) $js_deps[] = 'swiper';
    if ($needs_glightbox) $js_deps[] = 'glightbox';

    wp_enqueue_script('iurefficient-main', $theme_uri . '/js/main.js', $js_deps, $theme_version, true);

    // Pass AJAX URL to main.js
    wp_localize_script('iurefficient-main', 'iurefficient_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);

    // Help Portal assets - conditional on help portal pages
    $help_portal_slugs = ['help-portal', 'guia-inicio', 'funcionalidades', 'industrias', 'planes', 'faq'];
    if (is_page($help_portal_slugs)) {
        wp_enqueue_style('iurefficient-help-portal', $theme_uri . '/css/help-portal.css', ['iurefficient-main'], $theme_version);
        wp_enqueue_script('iurefficient-help-portal', $theme_uri . '/js/help-portal-app.js', ['iurefficient-main'], $theme_version, true);
    }

    // Page-specific inline styles
    if (is_page('precios')) {
        $pricing_styles = <<<'CSS'
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
CSS;
        wp_add_inline_style('iurefficient-main', $pricing_styles);
    }

    if (is_page(['privacidad', 'terminos'])) {
        $legal_styles = <<<'CSS'
        .legal-page {
            padding: calc(80px + var(--spacing-3xl)) 0 var(--spacing-4xl);
        }
        .legal-content {
            max-width: 800px;
            margin: 0 auto;
        }
        .legal-header {
            margin-bottom: var(--spacing-3xl);
            padding-bottom: var(--spacing-2xl);
            border-bottom: 1px solid var(--gray-200);
        }
        .legal-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: var(--spacing-md);
        }
        .legal-meta {
            color: var(--gray-500);
            font-size: 0.9375rem;
        }
        .legal-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-top: var(--spacing-3xl);
            margin-bottom: var(--spacing-md);
        }
        .legal-content h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-top: var(--spacing-xl);
            margin-bottom: var(--spacing-sm);
        }
        .legal-content p {
            color: var(--gray-600);
            margin-bottom: var(--spacing-md);
            line-height: 1.7;
        }
        .legal-content ul, .legal-content ol {
            color: var(--gray-600);
            margin-bottom: var(--spacing-md);
            padding-left: var(--spacing-xl);
        }
        .legal-content li {
            margin-bottom: var(--spacing-sm);
            line-height: 1.7;
        }
        .legal-content a {
            color: var(--primary-500);
        }
        .legal-content a:hover {
            text-decoration: underline;
        }
        .legal-toc {
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-3xl);
        }
        .legal-toc h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-md);
        }
        .legal-toc ol {
            padding-left: var(--spacing-lg);
        }
        .legal-toc li {
            margin-bottom: var(--spacing-xs);
        }
        .legal-toc a {
            color: var(--gray-600);
            font-size: 0.9375rem;
        }
        .highlight-box {
            background: var(--primary-50, #eef2ff);
            border-left: 4px solid var(--primary-500);
            padding: var(--spacing-lg);
            margin: var(--spacing-xl) 0;
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }
CSS;
        wp_add_inline_style('iurefficient-main', $legal_styles);
    }
}
add_action('wp_enqueue_scripts', 'iurefficient_enqueue_assets');

// Add preconnect for Google Fonts
function iurefficient_preconnect_google_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'iurefficient_preconnect_google_fonts', 1);
