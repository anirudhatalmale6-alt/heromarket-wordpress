<?php
/**
 * Single post template
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
            <div style="margin-bottom: 20px; font-size: 14px; color: #999;">
                <?php echo esc_html(get_the_date()); ?>
                <?php
                $cats = get_the_category();
                if ($cats) : ?>
                    <span style="color: #ccc; margin: 0 8px;">|</span>
                    <span style="color: var(--hm-red);"><?php echo esc_html($cats[0]->name); ?></span>
                <?php endif; ?>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div style="margin-bottom: 30px;">
                    <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: 8px;')); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
