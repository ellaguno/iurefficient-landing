<?php /** Planes. $b: title, subtitle, product, footer_text, footer_url */ declare(strict_types=1);
$planes = iure_planes((string) $b['product']);
$toggle = !empty($b['toggle']);
$T = fn(string $k, string $d) => (string) cms_t($k, $lang, $d);
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
<?php if ($toggle): ?>
            <div class="pricing-toggle" data-aos="fade-up">
                <span class="active" data-toggle-monthly><?= cms_e($T('p_toggle_monthly', 'Mensual')) ?></span>
                <div class="toggle-switch" data-pricing-toggle role="switch" aria-checked="false" tabindex="0"></div>
                <span data-toggle-annual><?= cms_e($T('p_toggle_annual', 'Anual')) ?></span>
<?php if ($T('p_toggle_discount', '')): ?>                <span class="discount-badge"><?= cms_e($T('p_toggle_discount', '')) ?></span>
<?php endif; ?>
            </div>
<?php endif; ?>
            <div class="pricing-grid">
<?php foreach ($planes as $i => $p) echo iure_plan_card($p, $i * 100, $toggle), "\n"; ?>
            </div>
<?php if ($toggle): ?>
            <script>(function(){var s=document.currentScript.closest('section');var t=s.querySelector('[data-pricing-toggle]'),m=s.querySelector('[data-toggle-monthly]'),a=s.querySelector('[data-toggle-annual]'),am=s.querySelectorAll('.pricing-price .amount[data-annual]');if(!t)return;function f(){t.classList.toggle('active');var y=t.classList.contains('active');t.setAttribute('aria-checked',y?'true':'false');m.classList.toggle('active',!y);a.classList.toggle('active',y);am.forEach(function(x){x.textContent=y?x.dataset.annual:x.dataset.monthly;});}t.addEventListener('click',f);t.addEventListener('keydown',function(e){if(e.key===' '||e.key==='Enter'){e.preventDefault();f();}});})();</script>
<?php endif; ?>
<?php if (trim((string) $b['footer_text']) !== ''): ?>
            <div class="pricing-footer" data-aos="fade-up"><p><?= iure_l('¿Necesitas algo diferente?', 'Need something different?') ?> <a href="<?= cms_e(iure_href((string) $b['footer_url'])) ?>"><?= cms_e($b['footer_text']) ?></a></p></div>
<?php endif; ?>
        </div>
