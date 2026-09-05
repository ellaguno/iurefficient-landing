<?php /** Tabla comparativa. $b: title, subtitle, head, rows */ declare(strict_types=1);
$head = array_map('trim', explode('|', (string) $b['head']));
$cell = function (string $v): string {
    $n = mb_strtolower(trim($v));
    if (in_array($n, ['si', 'sí', 'yes', '✓', 'true', 'x'], true)) return '<span class="check-icon">✓</span>';
    if (in_array($n, ['no', '✗', '-', '—', 'false'], true)) return '<span class="x-icon">—</span>';
    return cms_e($v);
};
?>
        <div class="container">
            <?= iure_section_header((string) $b['title'], (string) $b['subtitle']) ?>
            <div class="comparison-table-wrapper" data-aos="fade-up">
                <table class="comparison-table">
                    <thead><tr><?php foreach ($head as $h): ?><th><?= cms_e($h) ?></th><?php endforeach; ?></tr></thead>
                    <tbody>
<?php foreach ((array) $b['rows'] as $line): $cells = array_map('trim', explode('|', $line)); ?>
                        <tr><?php foreach ($cells as $i => $c): ?><td<?= $i > 0 && isset($head[$i]) ? ' data-label="' . cms_e($head[$i]) . '"' : '' ?>><?= $i === 0 ? cms_e($c) : $cell($c) ?></td><?php endforeach; ?></tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
