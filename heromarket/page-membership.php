<?php
/**
 * Template Name: Membership
 */
get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <h1>Membership</h1>
    </div>
</div>

<section class="membership-section">
    <div class="container">
        <h2>HeroMarket Membership is now FREE for everyone for life!</h2>

        <div class="member-count">
            <?php echo esc_html(get_theme_mod('heromarket_member_count', '240,084')); ?>+
            <br><span style="font-size: 16px; font-weight: 400; color: #666;">Registered Members</span>
        </div>

        <div class="benefits">
            <div class="benefit-item">
                <i class="fa-solid fa-tag"></i>
                <div>
                    <strong>Exclusive Offers</strong>
                    <p>Get access to promotional offers reserved only for members</p>
                </div>
            </div>
            <div class="benefit-item">
                <i class="fa-solid fa-coins"></i>
                <div>
                    <strong>Reward Points</strong>
                    <p>Earn reward points on every transaction</p>
                </div>
            </div>
            <div class="benefit-item">
                <i class="fa-solid fa-bell"></i>
                <div>
                    <strong>Regular Updates</strong>
                    <p>Stay informed about current deals and sales</p>
                </div>
            </div>
            <div class="benefit-item">
                <i class="fa-solid fa-bolt"></i>
                <div>
                    <strong>Instant Savings</strong>
                    <p>Immediate access to savings opportunities</p>
                </div>
            </div>
        </div>

        <?php
        // Show page content if any (for membership images/extra content)
        while (have_posts()) : the_post();
            $content = get_the_content();
            if ($content) :
                ?>
                <div class="page-content" style="padding-top: 30px;">
                    <?php the_content(); ?>
                </div>
                <?php
            endif;
        endwhile;
        ?>

        <div style="margin-top: 30px;">
            <a href="#" class="btn-primary">Register Now</a>
        </div>

        <?php
        $terms_page = get_page_by_path('membership-terms-and-conditions');
        if ($terms_page) : ?>
            <p style="margin-top: 20px; font-size: 13px;">
                <a href="<?php echo esc_url(get_permalink($terms_page)); ?>">Membership Terms &amp; Conditions</a>
            </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
