<?php
require_once 'inc/tz-loader.php';
if (!function_exists('tz_setup_theme')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    function tz_setup_theme()
    {
        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain('pronations');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        /**
         * Custom title
         *
         */
        add_theme_support('title-tag');

        // Automatic feed links
        add_theme_support('automatic-feed-links');

        // Custom Logo
        $custom_logo = array(
            'width' => 150,
            'height' => 150,
            'flex-width' => true,
            'flex-height' => true,
        );
        add_theme_support('custom-logo', $custom_logo);

        // Custom post format
        $post_format = array(
            'gallery',
            'aside',
            'chat',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio'
        );
        add_theme_support('post-formats', $post_format);

        // Post thumbnail
        add_theme_support('post-thumbnails');

        // Post thumbnail size
        add_image_size('tz_img_small', 300, 300, true);
        add_image_size('tz_img_medium', 550, 550, true);
        add_image_size('tz_img_medium_large', 992, 0, true);
        add_image_size('tz_img_large', 1200, 0, true);
        add_image_size('tz_img_ext_large', 1400, 0, true);
        add_image_size('tz_services', 250, 250, true);

        // Custom background image
        $custom_background = array(
            'default-image' => '',
            'default-position-x' => 'center',    // 'left', 'center', 'right'
            'default-position-y' => 'center',     // 'top', 'center', 'bottom'
            'default-size' => 'auto',    // 'auto', 'contain', 'cover'
            'default-repeat' => 'no-repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
            'default-attachment' => 'scroll',  // 'scroll', 'fixed'
            'default-color' => '',
        );
        add_theme_support('custom-background', $custom_background);

        // Custom header
        $custom_header = array(
            'default-image' => '',
            'width' => 64,
            'height' => 64,
            'flex-height' => true,
            'flex-width' => true,
            'default-text-color' => '',
            'header-text' => true,
            'uploads' => true,
            'video' => true,
            'video-active-callback' => 'is_front_page',
        );
        add_theme_support('custom-header', $custom_header);
        add_theme_support('custom-header-uploads');

        // HTML5 Support
        $html5 = array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
            'style',
            'script'
        );

        add_theme_support('html5', $html5);

        // Auto refresh after adding widgets
        add_theme_support('customize-selective-refresh-widgets');

        // Editor enqueue
        add_editor_style(TZ_ENQUEUE_DIR . '/css/editor-style.css');

        /**
         * Add support for editor styles.
         */
        add_theme_support('editor-styles');

        /**
         * Add support for editor font sizes.
         */
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name' => __('Small', 'storefront'),
                    'size' => 14,
                    'slug' => 'small',
                ),
                array(
                    'name' => __('Normal', 'storefront'),
                    'size' => 16,
                    'slug' => 'normal',
                ),
                array(
                    'name' => __('Medium', 'storefront'),
                    'size' => 23,
                    'slug' => 'medium',
                ),
                array(
                    'name' => __('Large', 'storefront'),
                    'size' => 26,
                    'slug' => 'large',
                ),
                array(
                    'name' => __('Huge', 'storefront'),
                    'size' => 37,
                    'slug' => 'huge',
                ),
            )
        );

        /**
         * Add support for responsive embedded content.
         */

        add_theme_support('responsive-embeds');
        // Register nav menus
        register_nav_menus(array(
            'primary' => esc_html('Primary Menu'),
            'top_header' => esc_html('Top Header Menu'),
            'social_media' => esc_html('Social Media Menu'),
            'footer' => esc_html('Footer Menu')
        ));

        // Support woocommerce theme
        $woocommerce_array = array(
            'thumbnail_image_width' => 150,
            'single_image_width' => 300,

            'product_grid' => array(
                'default_rows' => 3,
                'min_rows' => 2,
                'max_rows' => 8,
                'default_columns' => 4,
                'min_columns' => 2,
                'max_columns' => 5,
            ),
        );
        add_theme_support('woocommerce', $woocommerce_array);
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

    }
}
add_action('after_setup_theme', 'tz_setup_theme');


// Header Menu Class
function tz_li_menu_class($classes)
{
    if (in_array('menu-item', $classes)) {
        $classes[] = 'nav-item ';
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'tz_li_menu_class');


function tz_link_class($atts)
{
    $atts['class'] = 'nav-link text-white';

    return $atts;
}

add_filter('nav_menu_link_attributes', 'tz_link_class');

function tz_dropdown_menu_class($classes)
{
    $classes[] = 'dropdown-menu';

    return $classes;
}

add_filter('nav_menu_submenu_css_class', 'tz_dropdown_menu_class');
function woocommerce_live_search()
{
    ?>
    <form role="search" method="get" class="wc-live-product-search" action="<?php echo esc_url(home_url('/')); ?>">
        <i class="fa fa-search"></i>
       <input type="search" id="wc-live-product-search-field" class="search-field form-control"
               placeholder="<?php echo esc_attr__('Search products&hellip;', 'themezone'); ?>"
               value="<?php echo get_search_query(); ?>" name="s"/>
    </form>
    <ul id="wc-live-search-results"></ul>
    <?php
}