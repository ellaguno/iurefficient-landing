<?php
/**
 * Iurefficient - News Ticker Data Fetcher
 *
 * Fetches latest posts from blog.iurefficient.com RSS feed,
 * scrapes og:image from each post, with WordPress transient caching (1h TTL).
 */

function iurefficient_get_news_items() {
    $transient_key = 'iurefficient_rss_cache';
    $cache_ttl = HOUR_IN_SECONDS; // 1 hour
    $feed_url = 'https://blog.iurefficient.com/feed/';

    // Try to get from transient cache
    $cached = get_transient($transient_key);
    if ($cached !== false && !empty($cached)) {
        return $cached;
    }

    $news_items = [];

    try {
        $ctx = stream_context_create([
            'http' => ['timeout' => 5, 'user_agent' => 'Iurefficient-Landing/1.0'],
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
                        'http' => ['timeout' => 3, 'user_agent' => 'Iurefficient-Landing/1.0'],
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

                // Save to transient cache
                if (!empty($news_items)) {
                    set_transient($transient_key, $news_items, $cache_ttl);
                }
            }
        }
    } catch (Exception $e) {
        // Silently fail - section just won't show
    }

    return $news_items;
}
