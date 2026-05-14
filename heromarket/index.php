<?php
/**
 * Default template (blog/index fallback)
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1><?php echo is_home() ? 'Recipes &amp; Tips' : 'Blog'; ?></h1>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="promo-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <div class="promo-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('promo-thumb'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="promo-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <span class="promo-date"><?php echo esc_html(get_the_date()); ?></span>
                            <?php if (has_excerpt()) : ?>
                                <p style="margin-top: 8px; font-size: 13px; color: #666;"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                    <p>No posts yet.</p>
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
</div>

<?php get_footer(); ?>
