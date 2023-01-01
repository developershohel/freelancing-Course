<?php

define('OP3_SMART_THEME_VERSION', '1.0.20');
define('OP3_SMART_THEME_DIR', rtrim(get_template_directory(), '/') . '/');

// Minified resources (script and style)
if (!defined('OP3_SMART_DEBUG')) {
    define('OP3_SMART_DEBUG', '.min');
}

// Define dependencies
define('OPS_DEPENDENCY__DASHBOARD', '1.0.66');

/**
 * Loading Redux Framework and OP config
 */
if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/vendor/ReduxFramework/ReduxCore/framework.php')) {
    require_once(dirname(__FILE__) . '/vendor/ReduxFramework/ReduxCore/framework.php');
}
if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/options.php')) {
    require_once(dirname(__FILE__) . '/options.php');
}

/**
 * smart functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package smart
 */

if (!function_exists('op_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function op_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain('op3_smart', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('related-article-size', 350, 195, true);

        add_image_size('homepage-grid-size', 383, 215, array('center', 'center'));
        add_image_size('homepage-list-size', 420, 260, array('center', 'center'));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html_x('Header Menu', 'Menus', 'op3_smart'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            // 'aside',
            // 'image',
            'audio',
            'video',
            // 'quote',
            // 'link',
            'gallery',
        ));

        // WooCommerce support
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
}
add_action('after_setup_theme', 'op_setup');

/**
 * Register widget area and widgets.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function op_widgets_init()
{
    register_sidebar(array(
        'name' => _x('Sidebar', 'Widgets', 'op3_smart'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        register_sidebar(array(
            'name' => _x('Shop Sidebar', 'Widgets', 'op3_smart'),
            'id' => 'shop-archive',
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => _x('Shop Product Details Sidebar', 'Widgets', 'op3_smart'),
            'id' => 'shop-single',
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
    }

    register_widget('Op_Social_Profiles_Widget');
    register_widget('Op_Optin_Form_Widget');
}

add_action('widgets_init', 'op_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function op_scripts()
{
    // We don't want to load theme scripts
    // or styles on LiveEditor pages
    // or in LiveEditor
    if (is_op_page()) {
        return;
    }

    // CSS debug version
    if (OP3_SMART_DEBUG === '') {
        wp_enqueue_style('opst-css-reset', get_template_directory_uri() . '/css/reset' . OP3_SMART_DEBUG . '.css', array(), OP3_SMART_THEME_VERSION);
        wp_enqueue_style('opst-css-bootstrap', get_template_directory_uri() . '/css/bootstrap' . OP3_SMART_DEBUG . '.css', array('opst-css-reset'), OP3_SMART_THEME_VERSION);
        wp_enqueue_style('opst-css-swipebox', get_template_directory_uri() . '/js/swipebox/css/swipebox' . OP3_SMART_DEBUG . '.css', array('opst-css-bootstrap'), OP3_SMART_THEME_VERSION);
        wp_enqueue_style('opst-css-style', get_template_directory_uri() . '/css/style' . OP3_SMART_DEBUG . '.css', array('opst-css-swipebox'), OP3_SMART_THEME_VERSION);
    } else {
        wp_enqueue_style('opst-css-style', get_template_directory_uri() . '/css/all' . OP3_SMART_DEBUG . '.css', array(), OP3_SMART_THEME_VERSION);
    }

    // JS debug version
    if (OP3_SMART_DEBUG === '') {
        wp_enqueue_script('opst-js-ie10-viewport-bug-workaround', get_template_directory_uri() . '/js/ie10-viewport-bug-workaround' . OP3_SMART_DEBUG . '.js', array('opst-js-bootstrap'), OP3_SMART_THEME_VERSION, true);
        wp_enqueue_script('opst-js-fitvids', get_template_directory_uri() . '/js/jquery.fitvids' . OP3_SMART_DEBUG . '.js', array('opst-js-ie10-viewport-bug-workaround'), OP3_SMART_THEME_VERSION, true);
        wp_enqueue_script('opst-js-swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox' . OP3_SMART_DEBUG . '.js', array('opst-js-bootstrap'), OP3_SMART_THEME_VERSION, true);
        wp_enqueue_script('opst-js-ofi', get_template_directory_uri() . '/js/ofi' . OP3_SMART_DEBUG . '.js', array('opst-js-bootstrap'), OP3_SMART_THEME_VERSION, true);
        wp_enqueue_script('opst-js-script', get_template_directory_uri() . '/js/script' . OP3_SMART_DEBUG . '.js', array('opst-js-fitvids', 'opst-js-ofi'), OP3_SMART_THEME_VERSION, true);
        wp_enqueue_script('opst-js-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . OP3_SMART_DEBUG . '.js', array('opst-js-script'), OP3_SMART_THEME_VERSION, true);

    } else {
        wp_enqueue_script('opst-js-script', get_template_directory_uri() . '/js/all' . OP3_SMART_DEBUG . '.js', array('jquery'), OP3_SMART_THEME_VERSION, true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'op_scripts', 8);

/**
 * Enqueue bootstrap script
 * https://optimizepress.atlassian.net/browse/OP3-2704
 *
 * @return void
 */
function bootstrap_script()
{
    if (is_op_page()) {
        return;
    }

    wp_enqueue_script('opst-js-bootstrap', get_template_directory_uri() . '/js/bootstrap' . OP3_SMART_DEBUG . '.js', array('jquery'), OP3_SMART_THEME_VERSION, true);
}

add_action('wp_enqueue_scripts', 'bootstrap_script', -99);

/**
 * Removes the Redux inline styles
 * from LiveEditor pages and
 * from LiveEditor
 */
function remove_output_css($field)
{
    if (is_op_page()) {
        return false;
    }
    return $field;
}

add_action('redux/field/op_options/output_css', 'remove_output_css');

/**
 * Add theme support for infinite scroll.
 *
 * @return void
 * @uses add_theme_support
 */
function op_infinite_scroll_init()
{
    global $op_options;

    add_theme_support('infinite-scroll', array(
        'container' => 'infinite-scroll-container',
        'footer' => 'colophon',
        'render' => 'op_infinite_scroll_render',
        'type' => 'click',
        // 'footer_widgets'    => array(
        //     'op_footer_sidebar_1',
        //     'op_footer_sidebar_2',
        //     'op_footer_sidebar_3',
        //     'op_footer_sidebar_4'
        // ),
        'footer_widgets' => true,
        'wrapper' => false,
        'posts_per_page' => false,
    ));
}

add_action('after_setup_theme', 'op_infinite_scroll_init');

/**
 * Render more posts for infinite scroll.
 * It uses either content-full, content-grid or content-list templates.
 *
 * @return void
 */
function op_infinite_scroll_render()
{
    global $op_options;
    while (have_posts()) : the_post();

        // TODO: Refactor this class handling (related
        // to homepage grid template)
        if (is_home()) {
            if (op_get_homepage_template() === 'grid') {
                echo '<div class="';
                op_template_grid_item_class();
                echo '">';
            } else {
                echo '<div class="col-md-12">';
            }
            get_template_part('template-parts/loop/content', op_get_homepage_template());
            echo '</div>';
        } else {
            if (op_get_archive_template() === 'grid') {
                echo '<div class="';
                op_template_grid_item_class();
                echo '">';
            } else {
                echo '<div class="col-md-12">';
            }
            get_template_part('template-parts/loop/content', op_get_archive_template());
            echo '</div>';
        }
    endwhile;
}

/**
 * For the homepage and archives, when grid layout is used, we
 * want to force the number of posts per package (for now)
 * TODO: This can be better. Perhaps an option for this?
 */
function force_posts_per_page($query)
{
    global $op_options;

    // This shouldn't affect any admin pages,
    // nor queries other than main query,
    // nor any queries when jetpack
    // infinite scroll is active,
    if (is_admin()
        || !$query->is_main_query()
        || is_infinite_scroll_enabled()
    ) {
        return;
    }

    // Calculate what is the correct number of posts to show in grid layout,
    // based on value set in Setting -> Reading -> Blog pages show at most
    $default_posts_per_page = (int)get_option('posts_per_page');
    $default_mod = $default_posts_per_page % 3;
    $new_posts_per_page = $default_posts_per_page - $default_mod;

    // Homepage
    if (is_home() && op_get_homepage_template() === 'grid') {

        // If homepage hero is off, or hero doesn't contain a post,
        // set the number of posts to new default value,
        // since we don't have to take an
        // additional displayed
        // post into account
        if ((int)$op_options['homepage_hero_enabled'] === 0 || $op_options['homepage_hero_design'] !== 'featured-post') {
            $query->set('posts_per_page', $new_posts_per_page);
            return;
        }

        // Homepage Hero is on, so first page must be set to
        // new default value + 1 to account for the
        // featured post, and rest of the pages
        // is set to just new default value
        if (is_paged()) {
            $page_nr = $query->get('paged');
            $offset = (($page_nr - 1) * $new_posts_per_page) + 1;
            $query->set('offset', $offset);
            $query->set('posts_per_page', $new_posts_per_page);
        } else {
            $query->set('posts_per_page', $new_posts_per_page + 1);
        }
    }

    // Archives page
    if (is_archive() && op_get_archive_template() === 'grid') {
        $query->set('posts_per_page', $new_posts_per_page);
    }
}

add_action('pre_get_posts', 'force_posts_per_page', 11);

function custom_tag_cloud_widget($args)
{
    $args['largest'] = 1; //largest tag
    $args['smallest'] = 1; //smallest tag
    $args['unit'] = 'em'; //tag font unit
    return $args;
}

add_filter('widget_tag_cloud_args', 'custom_tag_cloud_widget');

/**
 * Custom optin style for theme
 */
function custom_optin_style($path, $style, $data)
{
    if ('optimizetheme_optin_1' == $style) {
        return get_template_directory() . '/inc/optimizetheme_optin_1.php';
    }

    return $path;
}

add_filter('op_style_template_path_optin_form', 'custom_optin_style', 10, 3);

/**
 * Helper functions for this theme.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Widgets for this theme.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Comment Walker.
 */
require get_template_directory() . '/inc/smart_walker_comment.php';

/**
 * Load Share Buttons.
 */
require get_template_directory() . '/inc/share-buttons.php';

/**
 * Load Actions & Filters
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Load WooCommerce custom parts
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load auto-updates parts (only if OP is active!)
 */
if (function_exists('op_define_vars')) {
    require get_template_directory() . '/inc/auto-updates.php';
}

function op3_get_var($array, $key, $default = '', $wrap = '', $force = false)
{
    $val = isset($array[$key]) ? $array[$key] : $default;

    $run = true;
    if (!$force && $val == '') {
        $run = false;
    }
    if ($wrap != '' && $run) {
        $val = sprintf($wrap, $val);
    }
    return $val;
}

function op3_get_var_e($array, $key, $default = '', $wrap = '', $force = false)
{
    echo op3_get_var($array, $key, $default, $wrap, $force);
}

/**
 * Check plugin dependencies
 *
 * @return bool
 */
function op3_smart_check_dependencies()
{
    // Check dashboard version
    if (defined('OPD_VERSION') && function_exists('op3_is_dev_version') && !op3_is_dev_version()) {
        if (version_compare(OPD_VERSION, OPS_DEPENDENCY__DASHBOARD, '<')) {
            return false;
        }
    }

    return true;
}

/**
 * Add some notices to the admin screens
 *
 * @return void
 */
function op3SmartInitNotices()
{

    if (!op3_smart_check_dependencies()) {
        echo '<div class="notice notice-error"><p><strong>Smart Theme</strong>: Please make sure all plugin dependencies are up to date.<br>
            - OptimizePress Dashboard <strong>v' . OPS_DEPENDENCY__DASHBOARD . '</strong> needed (you have <strong>v' . OPD_VERSION . '</strong>)<br>
            <a href="' . admin_url('plugins.php') . '">Check for updates</a></p></div>';
    }
}

// Add notices
add_action('admin_notices', 'op3SmartInitNotices');

// Remove dashboard widget
function op3ReduxRemoveDashboardWidget()
{
    remove_meta_box('redux_dashboard_widget', 'dashboard', 'side');
}

add_action('wp_dashboard_setup', 'op3ReduxRemoveDashboardWidget', 100);

function themezone_memberpress_add_member()
{
    add_submenu_page(
        'admin.php',
        'Add new member',
        'Add new member',
        'manage_options',
        'new-member',
        'themezone_memberpress_add_member_content');
}

function themezone_memberpress_add_member_content()
{

    ?>
    <div class="et_pb_section et_pb_section_2 et_section_regular">
        <div class="et_pb_row et_pb_row_3">
            <div class="et_pb_column et_pb_column_4_4 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough et-last-child">
                <div class="et_pb_module et_pb_code et_pb_code_0">
                    <div class="et_pb_code_inner">
                        <div class="mp_wrapper">
                            <form class="mepr-signup-form mepr-form" method="post" action="/registration/#mepr_jump"
                                  enctype="multipart/form-data" novalidate="">
                                <input type="hidden" name="mepr_process_signup_form" value="1">
                                <input type="hidden" name="mepr_product_id" value="1069">
                                <input type="hidden" name="mepr_transaction_id" value="">
                                <div class="mp-form-row mepr_bold mepr_price">
                                    <div class="mepr_price_cell_label">Price:</div>
                                    <div class="mepr_price_cell">
                                        Free
                                    </div>
                                </div>
                                <div class="mp-form-row mepr_first_name mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="user_first_name1">First Name:*</label>
                                        <span class="cc-error">First Name Required</span></div>
                                    <input type="text" name="user_first_name" id="user_first_name1"
                                           class="mepr-form-input" value="" required=""></div>
                                <div class="mp-form-row mepr_last_name mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="user_last_name1">Last Name:*</label>
                                        <span class="cc-error">Last Name Required</span></div>
                                    <input type="text" name="user_last_name" id="user_last_name1"
                                           class="mepr-form-input" value="" required=""></div>
                                <div class="mp-form-row mepr_custom_field mepr_mepr-address-one mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr-address-one1">Address Line 1:*</label>
                                        <span class="cc-error">Address Line 1 is Required</span></div>
                                    <input type="text" name="mepr-address-one" id="mepr-address-one1"
                                           class="mepr-form-input " value="" required=""></div>
                                <div class="mp-form-row mepr_custom_field mepr_mepr-address-two">
                                    <div class="mp-form-label">
                                        <label for="mepr-address-two1">Address Line 2:</label>
                                        <span class="cc-error">Address Line 2 is not valid</span></div>
                                    <input type="text" name="mepr-address-two" id="mepr-address-two1"
                                           class="mepr-form-input " value=""></div>
                                <div class="mp-form-row mepr_custom_field mepr_mepr-address-city mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr-address-city1">City:*</label>
                                        <span class="cc-error">City is Required</span></div>
                                    <input type="text" name="mepr-address-city" id="mepr-address-city1"
                                           class="mepr-form-input " value="" required=""></div>
                                <div class="mp-form-row mepr_custom_field mepr_mepr-address-country mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr-address-country1">Country:*</label>
                                        <span class="cc-error">Country is Required</span></div>
                                    <select name="mepr-address-country" id="mepr-address-country1"
                                            class=" mepr-countries-dropdown mepr-form-input mepr-select-field"
                                            required="">
                                        <option value="">-- Select Country --</option>
                                        <option value="US">United States (US)</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AX">Åland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="PW">Belau</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo (Brazzaville)</option>
                                        <option value="CD">Congo (Kinshasa)</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CW">CuraÇao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Republic of Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="CI">Ivory Coast</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao S.A.R., China</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="KP">North Korea</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PS">Palestinian Territory</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="BL">Saint Barthélemy</option>
                                        <option value="SH">Saint Helena</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin (French part)</option>
                                        <option value="SX">Saint Martin (Dutch part)</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">São Tomé and Príncipe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia/Sandwich Islands</option>
                                        <option value="KR">South Korea</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syria</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom (UK)</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="WS">Western Samoa</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select></div>
                                <div class="mp-form-row mepr_custom_field mepr_mepr-address-state mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr-address-state1">State/Province:*</label>
                                        <span class="cc-error">State/Province is Required</span></div>
                                    <select data-fieldname="mepr-address-state" data-value="" id="mepr-address-state1"
                                            class=" mepr-hidden mepr-states-dropdown mepr-form-input mepr-select-field"
                                            style="display: none;">
                                    </select>
                                    <input type="text" name="mepr-address-state" data-fieldname="mepr-address-state"
                                           data-value="" id="mepr-address-state1"
                                           class=" mepr-states-text mepr-form-input" value="" required="required"></div>
                                <div class="mp-form-row mepr_custom_field mepr_mepr-address-zip mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr-address-zip1">Zip/Postal Code:*</label>
                                        <span class="cc-error">Zip/Postal Code is Required</span></div>
                                    <input type="text" name="mepr-address-zip" id="mepr-address-zip1"
                                           class="mepr-form-input " value="" required=""></div>
                                <input type="hidden" class="mepr-geo-country" name="mepr-geo-country" value="">
                                <div class="mp-form-row mepr_username mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="user_login1">Username:*</label>
                                        <span class="cc-error">Invalid Username</span></div>
                                    <input type="text" name="user_login" id="user_login1" class="mepr-form-input"
                                           value="" required=""></div>
                                <div class="mp-form-row mepr_email mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="user_email1">Email:*</label>
                                        <span class="cc-error">Invalid Email</span></div>
                                    <input type="email" name="user_email" id="user_email1" class="mepr-form-input"
                                           value="" required=""></div>
                                <div class="mp-form-row mepr_email_stripe mepr-field-required mepr-hidden"></div>
                                <div class="mp-form-row mepr_password mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr_user_password1">Password:*</label>
                                        <span class="cc-error">Invalid Password</span></div>
                                    <div class="mp-hide-pw">
                                        <input type="password" name="mepr_user_password" id="mepr_user_password1"
                                               class="mepr-form-input mepr-password" value="" required="">
                                        <button type="button" class="button mp-hide-pw hide-if-no-js" data-toggle="0"
                                                aria-label="Show password">
                                            <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="mp-form-row mepr_password_confirm mepr-field-required">
                                    <div class="mp-form-label">
                                        <label for="mepr_user_password_confirm1">Password Confirmation:*</label>
                                        <span class="cc-error">Password Confirmation Doesn't Match</span></div>
                                    <div class="mp-hide-pw">
                                        <input type="password" name="mepr_user_password_confirm"
                                               id="mepr_user_password_confirm1"
                                               class="mepr-form-input mepr-password-confirm" value="" required="">
                                        <button type="button" class="button mp-hide-pw hide-if-no-js" data-toggle="0"
                                                aria-label="Show password">
                                            <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" id="mepr_coupon_code-1069" name="mepr_coupon_code" value="">
                                <div class="mepr-transaction-invoice-wrapper" style="padding-top:10px">
<span class="mepr-invoice-loader mepr-hidden">
<img data-lazyloaded="1" data-placeholder-resp="100x10"
     src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAiIHZpZXdCb3g9IjAgMCAxMDAgMTAiPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHN0eWxlPSJmaWxsOiNjZmQ0ZGI7ZmlsbC1vcGFjaXR5OiAwLjE7Ii8+PC9zdmc+"
     decoding="async" data-src="https://modernshamama.com/wp-includes/js/thickbox/loadingAnimation.gif" alt="Loading..."
     title="Loading icon" width="100" height="10">
</span>
                                    <div></div>
                                </div>
                                <div class="mepr_spacer">&nbsp;</div>
                                <div class="mp-form-submit">
                                    <label for="mepr_no_val" class="mepr-visuallyhidden">No val</label>
                                    <input type="text" id="mepr_no_val" name="mepr_no_val"
                                           class="mepr-form-input mepr-visuallyhidden mepr_no_val mepr-hidden"
                                           autocomplete="off"><input type="submit" class="mepr-submit"
                                                                     value="Register Now">
                                    <img data-lazyloaded="1" data-placeholder-resp="16x16"
                                         src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2Ij48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBzdHlsZT0iZmlsbDojY2ZkNGRiO2ZpbGwtb3BhY2l0eTogMC4xOyIvPjwvc3ZnPg=="
                                         width="16" height="16" decoding="async"
                                         data-src="https://modernshamama.com/wp-admin/images/loading.gif"
                                         alt="Loading..." style="display: none;" class="mepr-loading-gif"
                                         title="Loading icon">
                                    <span class="mepr-form-has-errors">Please fix the errors above</span></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="et_pb_module et_pb_divider et_pb_divider_0 et_pb_divider_position_ et_pb_space">
                    <div class="et_pb_divider_internal"></div>
                </div>
                <div class="et_pb_module et_pb_text et_pb_text_3  et_pb_text_align_left et_pb_bg_layout_light">
                    <div class="et_pb_text_inner"><p style="text-align: center;">Already have an account <a
                                    href="https://modernshamama.com/iamadragon/">Log In</a></p></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}