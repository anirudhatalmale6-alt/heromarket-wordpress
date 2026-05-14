<?php
/**
 * Generic page template
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</div>

<?php get_footer(); ?>
