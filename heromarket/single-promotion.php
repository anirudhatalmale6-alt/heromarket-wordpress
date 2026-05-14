<?php
/**
 * Single promotion template
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<div class="page-content">
    <div class="container" style="max-width: 900px;">
        <?php while (have_posts()) : the_post(); ?>
            <div style="margin-bottom: 20px;">
                <?php
                $terms = get_the_terms(get_the_ID(), 'promo_category');
                if ($terms) : ?>
                    <span class="promo-category" style="display: inline-block; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--hm-red); letter-spacing: 0.5px;"><?php echo esc_html($terms[0]->name); ?></span>
                    <span style="color: #ccc; margin: 0 8px;">|</span>
                <?php endif; ?>
                <span style="color: #999; font-size: 14px;"><?php echo esc_html(get_the_date()); ?></span>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div style="margin-bottom: 30px;">
                    <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: 8px;')); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;">
                <a href="<?php echo esc_url(home_url('/promotions/')); ?>" style="color: var(--hm-red); font-weight: 600;">
                    <i class="fa-solid fa-arrow-left"></i> Back to Promotions
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
