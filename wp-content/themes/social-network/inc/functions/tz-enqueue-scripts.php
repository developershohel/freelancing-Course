<?php
if (!function_exists('pn_enqueue_scripts')) {
    /**
     * Enqueue all css and js files
     * add google fonts
     *
     */

    function pn_enqueue_scripts()
    {
        // Main stylesheet
        wp_enqueue_style('stylesheet', get_stylesheet_uri(), array(), TZ_THEME_VERSION);

//        // jQuery
//        wp_enqueue_script('tz-jQuery', 'https://cdn.jsdelivr.net/gh/developershohel/cdn.codepen.live@main/jquery/jquery/v3.6.0/jquery.min.js', array(), '3.5.1', true);
//        wp_enqueue_script('jquery-migrate', 'https://cdn.jsdelivr.net/gh/developershohel/cdn.codepen.live@main/jquery/migrate/v4.4.0/jquery-migrate.min.js', array(), '4.4.0', true);

        //Bootstrap
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/gh/developershohel/cdn.codepen.live@main/bootstrap/v5.2.0/css/bootstrap.min.css', array(), '5.0.0');
        wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/gh/developershohel/cdn.codepen.live@main/bootstrap/v5.2.0/js/bootstrap.min.js', array(), '5.0.0', true);

        // Fontawesome
        wp_enqueue_style('font-awesome-6', 'https://cdn.jsdelivr.net/gh/developershohel/cdn.codepen.live@main/fontawesome/v6.2.0/css/all.min.css', array(), '6.2.2');


        // Main js
        wp_enqueue_script('main', TZ_ENQUEUE_DIR . '/js/app.js', array());

        /*wp_enqueue_style('', TZ_ENQUEUE_DIR.'js/', array(), TZ_THEME_VERSION);
        wp_enqueue_script('', TZ_ENQUEUE_DIR.'js/', array(), TZ_THEME_VERSION, true);*/

    }
}
add_action('wp_enqueue_scripts', 'pn_enqueue_scripts');