<?php
/**
 * Homepage template
 */
get_header();
?>

<?php // Hero Slider ?>
<section class="hero-slider">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <?php
            $slides = new WP_Query(array(
                'post_type'      => 'slider',
                'posts_per_page' => 10,
                'orderby'        => 'meta_value_num',
                'meta_key'       => '_slider_order',
                'order'          => 'ASC',
            ));

            if ($slides->have_posts()) :
                while ($slides->have_posts()) : $slides->the_post();
                    $link = get_post_meta(get_the_ID(), '_slider_link', true);
                    $img = get_the_post_thumbnail_url(get_the_ID(), 'slider-full');
                    if (!$img) continue;
                    ?>
                    <div class="swiper-slide">
                        <?php if ($link) : ?><a href="<?php echo esc_url($link); ?>"><?php endif; ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php if ($link) : ?></a><?php endif; ?>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback placeholder
                ?>
                <div class="swiper-slide">
                    <div style="background: linear-gradient(135deg, #CE1E42, #b31a39); height: 400px; display: flex; align-items: center; justify-content: center; color: #fff;">
                        <div style="text-align: center;">
                            <h2 style="color: #fff; font-size: 36px; margin-bottom: 10px;">Welcome to HeroMarket</h2>
                            <p style="font-size: 18px; opacity: 0.9;">Fresh &amp; Easy - Your Neighbourhood Hypermarket</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<?php // What's In Store Section ?>
<section class="whats-in-store">
    <div class="container">
        <div class="section-title">
            <h2>What's In Store</h2>
            <p>Discover our latest promotions, specials, and notices</p>
        </div>

        <?php
        $categories = get_terms(array(
            'taxonomy'   => 'promo_category',
            'hide_empty' => true,
        ));
        ?>

        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
        <div class="tab-nav">
            <button class="active" data-filter="all">All</button>
            <?php foreach ($categories as $cat) : ?>
                <button data-filter="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="promo-grid" id="promoGrid">
            <?php
            $promos = new WP_Query(array(
                'post_type'      => 'promotion',
                'posts_per_page' => 12,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($promos->have_posts()) :
                while ($promos->have_posts()) : $promos->the_post();
                    $terms = get_the_terms(get_the_ID(), 'promo_category');
                    $cat_slugs = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
                    $cat_name = $terms ? $terms[0]->name : 'Promotion';
                    ?>
                    <div class="promo-card" data-category="<?php echo esc_attr($cat_slugs); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('promo-thumb'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="promo-content">
                            <span class="promo-category"><?php echo esc_html($cat_name); ?></span>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <span class="promo-date"><?php echo esc_html(get_the_date()); ?></span>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                    <p>No promotions yet. Add promotions from the WordPress admin panel.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php // About Section ?>
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>About HeroMarket</h2>
                <p><?php echo wp_kses_post(get_theme_mod('heromarket_about_short', 'HeroMarket has grown with the city of Klang Valley. Starting as a small, friendly neighbourhood store in 2005 has expanded into 36 outlets across Peninsular Malaysia.')); ?></p>
                <p>Our company aims to be one of the leading wholesale and retail company by providing the best value, a wide assortment of goods, and continuous excellent service.</p>
                <?php
                $about_page = get_page_by_path('about-us');
                if ($about_page) : ?>
                    <a href="<?php echo esc_url(get_permalink($about_page)); ?>" class="btn-primary">Learn More</a>
                <?php endif; ?>
            </div>
            <div class="about-image">
                <?php
                $about_img = get_theme_mod('heromarket_about_image', '');
                if ($about_img) : ?>
                    <img src="<?php echo esc_url($about_img); ?>" alt="About HeroMarket" style="border-radius: 8px;">
                <?php else : ?>
                    <div style="background: #f0f0f0; height: 300px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #999;">
                        <span>About Image</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php // Quick Links / Portfolio Section ?>
<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-grid">
            <?php
            $quicklinks = array(
                array('title' => 'Membership', 'slug' => 'membership', 'icon' => 'fa-solid fa-id-card'),
                array('title' => 'Deals', 'slug' => 'whats-in-store', 'icon' => 'fa-solid fa-tags'),
                array('title' => 'Store Locations', 'slug' => 'store-locator', 'icon' => 'fa-solid fa-location-dot'),
                array('title' => 'Bakery', 'slug' => 'bakery', 'icon' => 'fa-solid fa-bread-slice'),
            );

            foreach ($quicklinks as $link) :
                $page = get_page_by_path($link['slug']);
                $url = $page ? get_permalink($page) : '#';

                $thumb = '';
                if ($page) {
                    $thumb = get_the_post_thumbnail_url($page->ID, 'promo-thumb');
                }
                ?>
                <a href="<?php echo esc_url($url); ?>" class="portfolio-item">
                    <?php if ($thumb) : ?>
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($link['title']); ?>">
                    <?php else : ?>
                        <div style="width:100%; height:200px; background: linear-gradient(135deg, #CE1E42, #d63a5a); display: flex; align-items: center; justify-content: center;">
                            <i class="<?php echo esc_attr($link['icon']); ?>" style="font-size: 48px; color: #fff;"></i>
                        </div>
                    <?php endif; ?>
                    <div class="overlay">
                        <h3><?php echo esc_html($link['title']); ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
