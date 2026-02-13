<?php
/**
 * News Ticker - Cintillo de noticias del blog
 *
 * Fetches latest posts from blog.iurefficient.com RSS feed
 * with file-based caching (30 min TTL).
 */

$cache_dir = __DIR__ . '/../cache';
if (!is_dir($cache_dir)) {
    @mkdir($cache_dir, 0750, true);
}
$cache_file = $cache_dir . '/rss-cache.json';
$cache_ttl = 1800; // 30 minutes
$feed_url = 'https://blog.iurefficient.com/feed/';
$news_items = [];

// Try to read from cache first
if (file_exists($cache_file) && !is_link($cache_file) && (time() - filemtime($cache_file)) < $cache_ttl) {
    $cached = json_decode(file_get_contents($cache_file), true);
    if ($cached && !empty($cached['items'])) {
        $news_items = $cached['items'];
    }
}

// Fetch fresh data if cache is empty or expired
if (empty($news_items)) {
    try {
        $ctx = stream_context_create([
            'http' => ['timeout' => 5, 'user_agent' => 'Iurefficient-Landing/1.0']
        ]);
        $raw = @file_get_contents($feed_url, false, $ctx);

        if ($raw !== false) {
            $prev_errors = libxml_use_internal_errors(true);
            $xml = @simplexml_load_string($raw, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NONET);
            libxml_clear_errors();
            libxml_use_internal_errors($prev_errors);

            if ($xml && isset($xml->channel->item)) {
                $count = 0;
                foreach ($xml->channel->item as $item) {
                    if ($count >= 5) break;

                    // Extract categories
                    $categories = [];
                    foreach ($item->category as $cat) {
                        $cat_name = (string) $cat;
                        if ($cat_name !== 'Noticias' && $cat_name !== 'Uncategorized') {
                            $categories[] = $cat_name;
                        }
                    }

                    $timestamp = strtotime((string) $item->pubDate);
                    $news_items[] = [
                        'title' => (string) $item->title,
                        'link'  => (string) $item->link,
                        'date'  => $timestamp ? date('d M', $timestamp) : '',
                        'categories' => array_slice($categories, 0, 2),
                    ];
                    $count++;
                }

                // Save to cache
                @file_put_contents($cache_file, json_encode([
                    'items' => $news_items,
                    'fetched_at' => time()
                ]), LOCK_EX);
            }
        }
    } catch (Exception $e) {
        // Silently fail - ticker just won't show
    }
}

// Only render if we have news
if (!empty($news_items)):
?>
<!-- News Ticker -->
<div class="news-ticker" id="newsTicker" role="marquee" aria-label="Noticias recientes del blog" aria-live="off">
    <div class="news-ticker__label">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
        </svg>
        <span>Noticias</span>
    </div>
    <div class="news-ticker__track">
        <div class="news-ticker__content">
            <?php foreach ($news_items as $item): ?>
            <a href="<?= htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" class="news-ticker__item">
                <?php if ($item['date']): ?>
                <span class="news-ticker__date"><?= htmlspecialchars($item['date'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
                <?php foreach ($item['categories'] as $cat): ?>
                <span class="news-ticker__badge"><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></span>
                <?php endforeach; ?>
                <span class="news-ticker__title"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></span>
            </a>
            <?php endforeach; ?>
            <!-- Duplicate for seamless loop -->
            <?php foreach ($news_items as $item): ?>
            <a href="<?= htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" class="news-ticker__item" aria-hidden="true" tabindex="-1">
                <?php if ($item['date']): ?>
                <span class="news-ticker__date"><?= htmlspecialchars($item['date'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
                <?php foreach ($item['categories'] as $cat): ?>
                <span class="news-ticker__badge"><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></span>
                <?php endforeach; ?>
                <span class="news-ticker__title"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="news-ticker__actions">
        <a href="https://blog.iurefficient.com" target="_blank" rel="noopener noreferrer" class="news-ticker__cta">
            Ver todo
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/>
            </svg>
        </a>
        <button class="news-ticker__close" id="newsTickerClose" aria-label="Cerrar noticias">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
<?php endif; ?>
