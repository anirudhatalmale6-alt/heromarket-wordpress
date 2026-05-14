<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="facebook-domain-verification" content="rbbunhhmrlvrt51fozkuuvp70tzd4i">
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/images/favicon.ico">
    <?php
    $gtag = get_theme_mod('heromarket_gtag', 'G-SBPWTDEF0Q');
    if ($gtag) : ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($gtag); ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo esc_js($gtag); ?>');
    </script>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>">
                <?php endif; ?>
            </a>

            <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <nav class="main-nav" role="navigation" aria-label="Primary">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'fallback_cb'    => 'heromarket_fallback_menu',
                ));
                ?>
            </nav>
        </div>
    </div>
</header>

<main id="content">
<?php

function heromarket_fallback_menu() {
    echo '<ul>';
    echo '<li class="current-menu-item"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';

    $pages = array('whats-in-store' => "What's In Store", 'about-us' => 'About Us', 'membership' => 'Membership');
    foreach ($pages as $slug => $title) {
        $page = get_page_by_path($slug);
        if ($page) {
            echo '<li><a href="' . esc_url(get_permalink($page)) . '">' . esc_html($title) . '</a></li>';
        }
    }

    echo '<li><a href="' . esc_url(home_url('/stores/')) . '">Find Us</a></li>';
    echo '</ul>';
}
