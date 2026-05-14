<?php
/**
 * 404 template
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1>Page Not Found</h1>
    </div>
</div>

<div class="page-content" style="text-align: center; min-height: 300px;">
    <div class="container">
        <div style="font-size: 80px; color: #ddd; margin-bottom: 20px;">404</div>
        <p>Sorry, the page you were looking for could not be found.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary" style="margin-top: 20px;">Back to Home</a>
    </div>
</div>

<?php get_footer(); ?>
