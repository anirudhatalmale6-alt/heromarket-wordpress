<?php
/**
 * HeroMarket Theme Functions
 */

define('HEROMARKET_VERSION', '1.0.0');

function heromarket_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 78,
        'width'       => 95,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');

    register_nav_menus(array(
        'primary' => 'Primary Navigation',
        'footer'  => 'Footer Navigation',
    ));

    add_image_size('promo-thumb', 600, 400, true);
    add_image_size('store-thumb', 500, 300, true);
    add_image_size('slider-full', 1920, 800, true);
}
add_action('after_setup_theme', 'heromarket_setup');

function heromarket_scripts() {
    wp_enqueue_style('heromarket-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    wp_enqueue_style('heromarket-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11');
    wp_enqueue_style('heromarket-style', get_stylesheet_uri(), array(), HEROMARKET_VERSION);

    wp_enqueue_script('heromarket-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);
    wp_enqueue_script('heromarket-main', get_template_directory_uri() . '/js/main.js', array('heromarket-swiper'), HEROMARKET_VERSION, true);
}
add_action('wp_enqueue_scripts', 'heromarket_scripts');

// Register custom post types
function heromarket_register_post_types() {
    // Promotions
    register_post_type('promotion', array(
        'labels' => array(
            'name'          => 'Promotions',
            'singular_name' => 'Promotion',
            'add_new_text'  => 'Add New Promotion',
            'edit_item'     => 'Edit Promotion',
            'new_item'      => 'New Promotion',
            'all_items'     => 'All Promotions',
            'view_item'     => 'View Promotion',
            'search_items'  => 'Search Promotions',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-megaphone',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'       => array('slug' => 'promotions'),
        'show_in_rest'  => true,
    ));

    // Promotion categories
    register_taxonomy('promo_category', 'promotion', array(
        'labels' => array(
            'name'          => 'Promo Categories',
            'singular_name' => 'Promo Category',
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'promo-category'),
    ));

    // Store Locations
    register_post_type('store', array(
        'labels' => array(
            'name'          => 'Store Locations',
            'singular_name' => 'Store',
            'add_new_text'  => 'Add New Store',
            'edit_item'     => 'Edit Store',
            'all_items'     => 'All Stores',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-location',
        'supports'      => array('title', 'editor', 'thumbnail'),
        'rewrite'       => array('slug' => 'stores'),
        'show_in_rest'  => true,
    ));

    // Store regions
    register_taxonomy('store_region', 'store', array(
        'labels' => array(
            'name'          => 'Regions',
            'singular_name' => 'Region',
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'region'),
    ));

    // Hero Slider
    register_post_type('slider', array(
        'labels' => array(
            'name'          => 'Hero Slides',
            'singular_name' => 'Slide',
            'add_new_text'  => 'Add New Slide',
            'all_items'     => 'All Slides',
        ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-images-alt2',
        'supports'      => array('title', 'thumbnail'),
        'show_in_rest'  => true,
    ));
}
add_action('init', 'heromarket_register_post_types');

// Store meta boxes
function heromarket_store_meta_boxes() {
    add_meta_box('store_details', 'Store Details', 'heromarket_store_details_cb', 'store', 'normal', 'high');
    add_meta_box('slider_details', 'Slide Details', 'heromarket_slider_details_cb', 'slider', 'normal', 'high');
}
add_action('add_meta_boxes', 'heromarket_store_meta_boxes');

function heromarket_store_details_cb($post) {
    wp_nonce_field('heromarket_store_nonce', 'heromarket_store_nonce');
    $address = get_post_meta($post->ID, '_store_address', true);
    $hours   = get_post_meta($post->ID, '_store_hours', true);
    $map_url = get_post_meta($post->ID, '_store_map_url', true);
    $phone   = get_post_meta($post->ID, '_store_phone', true);
    ?>
    <table class="form-table">
        <tr><th><label for="store_address">Address</label></th>
        <td><textarea id="store_address" name="store_address" rows="3" style="width:100%"><?php echo esc_textarea($address); ?></textarea></td></tr>
        <tr><th><label for="store_hours">Operating Hours</label></th>
        <td><input type="text" id="store_hours" name="store_hours" value="<?php echo esc_attr($hours); ?>" style="width:100%" placeholder="e.g. Daily: 8.00am to 10.00pm"></td></tr>
        <tr><th><label for="store_map_url">Google Maps URL</label></th>
        <td><input type="url" id="store_map_url" name="store_map_url" value="<?php echo esc_attr($map_url); ?>" style="width:100%"></td></tr>
        <tr><th><label for="store_phone">Phone</label></th>
        <td><input type="text" id="store_phone" name="store_phone" value="<?php echo esc_attr($phone); ?>" style="width:100%"></td></tr>
    </table>
    <?php
}

function heromarket_slider_details_cb($post) {
    wp_nonce_field('heromarket_slider_nonce', 'heromarket_slider_nonce');
    $link = get_post_meta($post->ID, '_slider_link', true);
    $order = get_post_meta($post->ID, '_slider_order', true);
    ?>
    <table class="form-table">
        <tr><th><label for="slider_link">Link URL</label></th>
        <td><input type="url" id="slider_link" name="slider_link" value="<?php echo esc_attr($link); ?>" style="width:100%" placeholder="Leave empty for no link"></td></tr>
        <tr><th><label for="slider_order">Display Order</label></th>
        <td><input type="number" id="slider_order" name="slider_order" value="<?php echo esc_attr($order); ?>" style="width:80px" min="0"></td></tr>
    </table>
    <?php
}

function heromarket_save_store_meta($post_id) {
    if (!isset($_POST['heromarket_store_nonce']) || !wp_verify_nonce($_POST['heromarket_store_nonce'], 'heromarket_store_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('store_address', 'store_hours', 'store_map_url', 'store_phone');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_store', 'heromarket_save_store_meta');

function heromarket_save_slider_meta($post_id) {
    if (!isset($_POST['heromarket_slider_nonce']) || !wp_verify_nonce($_POST['heromarket_slider_nonce'], 'heromarket_slider_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['slider_link'])) update_post_meta($post_id, '_slider_link', esc_url_raw($_POST['slider_link']));
    if (isset($_POST['slider_order'])) update_post_meta($post_id, '_slider_order', intval($_POST['slider_order']));
}
add_action('save_post_slider', 'heromarket_save_slider_meta');

// Customizer settings
function heromarket_customize_register($wp_customize) {
    // Social Media Section
    $wp_customize->add_section('heromarket_social', array(
        'title'    => 'Social Media Links',
        'priority' => 30,
    ));

    $socials = array('facebook', 'instagram', 'tiktok', 'youtube', 'messenger');
    foreach ($socials as $social) {
        $wp_customize->add_setting('heromarket_' . $social, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('heromarket_' . $social, array(
            'label'   => ucfirst($social) . ' URL',
            'section' => 'heromarket_social',
            'type'    => 'url',
        ));
    }

    // Company Info Section
    $wp_customize->add_section('heromarket_company', array(
        'title'    => 'Company Information',
        'priority' => 31,
    ));

    $wp_customize->add_setting('heromarket_copyright', array(
        'default'           => 'Copyright &copy; 2024 My Hero Hypermarket Sdn Bhd 200401038165 (676676-T)',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('heromarket_copyright', array(
        'label'   => 'Copyright Text',
        'section' => 'heromarket_company',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('heromarket_about_short', array(
        'default'           => 'HeroMarket has grown with the city of Klang Valley. Starting as a small, friendly neighbourhood store in 2005 has expanded into 36 outlets across Peninsular Malaysia.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('heromarket_about_short', array(
        'label'   => 'Short About Text (Homepage)',
        'section' => 'heromarket_company',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('heromarket_member_count', array(
        'default'           => '240,084',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('heromarket_member_count', array(
        'label'   => 'Member Count',
        'section' => 'heromarket_company',
        'type'    => 'text',
    ));

    // Google Analytics
    $wp_customize->add_setting('heromarket_gtag', array(
        'default'           => 'G-SBPWTDEF0Q',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('heromarket_gtag', array(
        'label'   => 'Google Analytics ID',
        'section' => 'heromarket_company',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'heromarket_customize_register');

// Widgets
function heromarket_widgets_init() {
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'heromarket_widgets_init');

// Helper: get social links
function heromarket_get_social_links() {
    $socials = array(
        'facebook'  => 'fa-brands fa-facebook-f',
        'instagram' => 'fa-brands fa-instagram',
        'tiktok'    => 'fa-brands fa-tiktok',
        'youtube'   => 'fa-brands fa-youtube',
        'messenger' => 'fa-brands fa-facebook-messenger',
    );
    $links = array();
    foreach ($socials as $key => $icon) {
        $url = get_theme_mod('heromarket_' . $key, '');
        if ($url) {
            $links[] = array('url' => $url, 'icon' => $icon, 'name' => $key);
        }
    }
    return $links;
}

// Permalink flush on theme activation
function heromarket_activate() {
    heromarket_register_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'heromarket_activate');
