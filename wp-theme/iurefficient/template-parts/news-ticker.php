<?php
/**
 * Blog News Banner - Visual carousel of recent blog posts with images
 *
 * Uses iurefficient_get_news_items() to fetch cached blog post data.
 */
$news_items = iurefficient_get_news_items();

// Only render if we have news
if ( ! empty( $news_items ) ) :
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
            <?php foreach ( $news_items as $item ) : ?>
            <a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank" rel="noopener noreferrer" class="blog-banner__card">
                <div class="blog-banner__image">
                    <?php if ( $item['image'] ) : ?>
                    <img src="<?php echo esc_url( $item['image'] ); ?>" alt="" loading="lazy">
                    <?php else : ?>
                    <div class="blog-banner__placeholder">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="blog-banner__info">
                    <?php if ( $item['categories'] ) : ?>
                    <div class="blog-banner__badges">
                        <?php foreach ( $item['categories'] as $cat ) : ?>
                        <span class="blog-banner__badge"><?php echo esc_html( $cat ); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <h3 class="blog-banner__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
                    <?php if ( $item['date'] ) : ?>
                    <span class="blog-banner__date"><?php echo esc_html( $item['date'] ); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; ?>
            <!-- Duplicate for seamless loop -->
            <?php foreach ( $news_items as $item ) : ?>
            <a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank" rel="noopener noreferrer" class="blog-banner__card" aria-hidden="true" tabindex="-1">
                <div class="blog-banner__image">
                    <?php if ( $item['image'] ) : ?>
                    <img src="<?php echo esc_url( $item['image'] ); ?>" alt="" loading="lazy">
                    <?php else : ?>
                    <div class="blog-banner__placeholder">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="blog-banner__info">
                    <?php if ( $item['categories'] ) : ?>
                    <div class="blog-banner__badges">
                        <?php foreach ( $item['categories'] as $cat ) : ?>
                        <span class="blog-banner__badge"><?php echo esc_html( $cat ); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <h3 class="blog-banner__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
                    <?php if ( $item['date'] ) : ?>
                    <span class="blog-banner__date"><?php echo esc_html( $item['date'] ); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
