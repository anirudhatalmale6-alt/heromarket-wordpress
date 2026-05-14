<?php
/**
 * Template Name: Store Locator
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1>Find Us</h1>
    </div>
</div>

<section class="store-locator">
    <div class="container">
        <?php
        $regions = get_terms(array(
            'taxonomy'   => 'store_region',
            'hide_empty' => true,
            'orderby'    => 'name',
        ));
        ?>

        <?php if (!empty($regions) && !is_wp_error($regions)) : ?>
        <div class="store-tabs">
            <button class="active" data-region="all">All Stores</button>
            <?php foreach ($regions as $region) : ?>
                <button data-region="<?php echo esc_attr($region->slug); ?>"><?php echo esc_html($region->name); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="store-grid" id="storeGrid">
            <?php
            $stores = new WP_Query(array(
                'post_type'      => 'store',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ));

            if ($stores->have_posts()) :
                while ($stores->have_posts()) : $stores->the_post();
                    $address = get_post_meta(get_the_ID(), '_store_address', true);
                    $hours   = get_post_meta(get_the_ID(), '_store_hours', true);
                    $map_url = get_post_meta(get_the_ID(), '_store_map_url', true);
                    $terms   = get_the_terms(get_the_ID(), 'store_region');
                    $region_slugs = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
                    ?>
                    <div class="store-card" data-region="<?php echo esc_attr($region_slugs); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('store-thumb'); ?>
                        <?php else : ?>
                            <div style="width:100%; height:180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999;">
                                <i class="fa-solid fa-store" style="font-size: 36px;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="store-info">
                            <h3><?php the_title(); ?></h3>
                            <?php if ($address) : ?>
                                <p><?php echo esc_html($address); ?></p>
                            <?php endif; ?>
                            <?php if ($hours) : ?>
                                <p class="store-hours"><i class="fa-regular fa-clock"></i> <?php echo esc_html($hours); ?></p>
                            <?php endif; ?>
                            <?php if ($map_url) : ?>
                                <a href="<?php echo esc_url($map_url); ?>" class="btn-directions" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-solid fa-map-marker-alt"></i> View Map
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                    <p>No store locations added yet. Add stores from the WordPress admin panel.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
