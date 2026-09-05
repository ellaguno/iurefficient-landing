<?php /** Preguntas frecuentes. $b: title, section, items */ declare(strict_types=1);
$qs = [];
if ((string) $b['section'] !== '') foreach (iure_faq((string) $b['section']) as $q) $qs[] = [(string) ($q['title'] ?? ''), cms_content((string) ($q['answer'] ?? ''))];
else foreach ((array) $b['items'] as $line) { [$q, $a] = iure_split($line, 2); if ($q !== '') $qs[] = [$q, '<p>' . cms_e($a) . '</p>']; }
if (!$qs) return;
?>
        <div class="container">
            <?= iure_section_header((string) $b['title']) ?>
            <div class="faq-grid">
<?php foreach ($qs as $i => [$q, $a]): ?>
                <div class="faq-item" data-aos="fade-up" data-aos-delay="<?= min($i * 50, 400) ?>"><h4><?= cms_e($q) ?></h4><?= $a ?></div>
<?php endforeach; ?>
            </div>
        </div>
