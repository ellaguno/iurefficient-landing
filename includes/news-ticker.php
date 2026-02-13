<?php
/**
 * Blog News Banner - Visual carousel of recent blog posts with images
 *
 * Fetches latest posts from blog.iurefficient.com RSS feed,
 * scrapes og:image from each post, with file-based caching (1h TTL).
 */

$cache_dir = __DIR__ . '/../cache';
if (!is_dir($cache_dir)) {
    @mkdir($cache_dir, 0750, true);
}
$cache_file = $cache_dir . '/rss-cache.json';
$cache_ttl = 3600; // 1 hour
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
                    if ($count >= 6) break;

                    $link = (string) $item->link;

                    // Extract categories
                    $categories = [];
                    foreach ($item->category as $cat) {
                        $cat_name = (string) $cat;
                        if ($cat_name !== 'Noticias' && $cat_name !== 'Uncategorized') {
                            $categories[] = $cat_name;
                        }
                    }

                    // Scrape og:image from the post page
                    $image = '';
                    $page_ctx = stream_context_create([
                        'http' => ['timeout' => 3, 'user_agent' => 'Iurefficient-Landing/1.0']
                    ]);
                    $page_html = @file_get_contents($link, false, $page_ctx);
                    if ($page_html !== false) {
                        // Try og:image first
                        if (preg_match('/<meta\s+property=["\']og:image["\']\s+content=["\'](.*?)["\']/i', $page_html, $m)) {
                            $image = $m[1];
                        }
                        // Fallback: first wp-post-image
                        if (!$image && preg_match('/<img[^>]+class=["\'][^"\']*wp-post-image[^"\']*["\'][^>]+src=["\'](.*?)["\']/i', $page_html, $m)) {
                            $image = $m[1];
                        }
                    }

                    $timestamp = strtotime((string) $item->pubDate);
                    $news_items[] = [
                        'title'      => (string) $item->title,
                        'link'       => $link,
                        'image'      => $image,
                        'date'       => $timestamp ? date('d M Y', $timestamp) : '',
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
        // Silently fail - section just won't show
    }
}

// Only render if we have news
if (!empty($news_items)):
?>
<!-- Blog News Banner -->
<section class="blog-banner">
    <div class="container">
        <div class="blog-banner__header">
            <div class="blog-banner__title-group">
                <h2 class="blog-banner__heading">Noticias <span class="gradient-text">Juridicas</span></h2>
                <p class="blog-banner__subtitle">Lo ultimo del mundo legal, directo de nuestro blog</p>
            </div>
            <a href="https://blog.iurefficient.com" target="_blank" rel="noopener noreferrer" class="btn btn-outline blog-banner__cta">
                Ver todo el blog
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="blog-banner__track">
        <div class="blog-banner__scroll">
            <?php foreach ($news_items as $item): ?>
            <a href="<?= htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" class="blog-banner__card">
                <div class="blog-banner__image">
                    <?php if ($item['image']): ?>
                    <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>" alt="" loading="lazy">
                    <?php else: ?>
                    <div class="blog-banner__placeholder">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="blog-banner__info">
                    <?php if ($item['categories']): ?>
                    <div class="blog-banner__badges">
                        <?php foreach ($item['categories'] as $cat): ?>
                        <span class="blog-banner__badge"><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <h3 class="blog-banner__card-title"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <?php if ($item['date']): ?>
                    <span class="blog-banner__date"><?= htmlspecialchars($item['date'], ENT_QUOTES, 'UTF-8') ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; ?>
            <!-- Duplicate for seamless loop -->
            <?php foreach ($news_items as $item): ?>
            <a href="<?= htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" class="blog-banner__card" aria-hidden="true" tabindex="-1">
                <div class="blog-banner__image">
                    <?php if ($item['image']): ?>
                    <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>" alt="" loading="lazy">
                    <?php else: ?>
                    <div class="blog-banner__placeholder">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="blog-banner__info">
                    <?php if ($item['categories']): ?>
                    <div class="blog-banner__badges">
                        <?php foreach ($item['categories'] as $cat): ?>
                        <span class="blog-banner__badge"><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <h3 class="blog-banner__card-title"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <?php if ($item['date']): ?>
                    <span class="blog-banner__date"><?= htmlspecialchars($item['date'], ENT_QUOTES, 'UTF-8') ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
