<?php /** Buscador del sitio (/buscar?q=). Variables: $lang, $S, $t, $page */ declare(strict_types=1);
$q = trim((string) ($_GET['q'] ?? ''));
$brand = iure_brand($page);
$results = $q !== '' ? iure_search($q, $lang) : [];
$n = count($results);
$fmt = fn(string $s) => str_replace(['{n}', '{q}'], [(string) $n, $q], $s);
?>
    <main class="legal-page page-buscar">
        <div class="container">
            <div class="legal-content">
                <div class="legal-header">
                    <h1><?= cms_e($t('search_title', 'Buscar')) ?></h1>
                </div>
                <?= iure_search_form($brand, $q, false) ?>
<?php if ($q === ''): ?>
                <p class="search-count"><?= cms_e($t('search_hint', 'Busca en artículos, tutoriales, preguntas frecuentes y páginas del sitio.')) ?></p>
<?php elseif (!$results): ?>
                <p class="search-count"><?= cms_e($fmt($t('search_empty', 'No encontramos nada para «{q}». Prueba con otras palabras.'))) ?></p>
<?php else: ?>
                <p class="search-count"><?= cms_e($fmt($n === 1 ? $t('search_one', '1 resultado para «{q}»') : $t('search_results', '{n} resultados para «{q}»'))) ?></p>
                <ol class="search-results">
<?php foreach ($results as $r): ?>
                    <li>
                        <span class="search-type"><?= cms_e($r['label']) ?></span>
                        <h3><a href="<?= cms_e($r['url']) ?>"><?= $r['title'] ?></a></h3>
<?php if ($r['snippet'] !== ''): ?>
                        <p><?= $r['snippet'] ?></p>
<?php endif; ?>
                    </li>
<?php endforeach; ?>
                </ol>
<?php endif; ?>
            </div>
        </div>
    </main>
