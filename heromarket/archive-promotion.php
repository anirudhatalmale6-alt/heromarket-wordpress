<?php
/**
 * Promotion archive template
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1>What's In Store</h1>
    </div>
</div>

<section class="whats-in-store">
    <div class="container">
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
            if (have_posts()) :
                while (have_posts()) : the_post();
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
            else :
                ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                    <p>No promotions yet.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
            'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
        ));
        ?>
    </div>
</section>

<?php get_footer(); ?>
