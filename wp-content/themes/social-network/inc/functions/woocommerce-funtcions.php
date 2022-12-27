<?php
// Add new tab to My Account menu

add_filter('woocommerce_account_menu_items', 'themezone_woocommerce_custom_endpoint', 40);
function themezone_woocommerce_custom_endpoint($menu_links)
{

    $menu_links = array_slice($menu_links, 0, 5, true)
        // Add your own slug (support, for example) and tab title here below
        + array('ticket' => 'Ticket', 'affiliate'=> 'Affiliate')
        + array_slice($menu_links, 5, NULL, true);

    return $menu_links;

}

// Let’s register this new endpoint permalink

add_action('init', 'themezone_woocommerce_new_endpoint');
function themezone_woocommerce_new_endpoint()
{
    add_rewrite_endpoint('ticket', EP_PAGES); // Don’t forget to change the slug here
    add_rewrite_endpoint('affiliate', EP_PAGES);
}

// Now let’s add some content inside your endpoint

add_action('woocommerce_account_ticket_endpoint', 'themezone_woocommerec_endpoint_content');
function themezone_woocommerec_endpoint_content()
{
    // At the moment I will add Learndash profile with the shordcode
    echo do_shortcode('[supportcandy]');
}
add_action('woocommerce_account_affiliate_endpoint', 'themezone_affiliate_content');
function themezone_affiliate_content(){
    echo do_shortcode('[yith_wcaf_affiliate_dashboard]');
}
// NB! In order to make it work you need to go to Settings > Permalinks and just push "Save Changes" button.

// If you need to change endpoint order then add your own order here

add_filter('woocommerce_account_menu_items', 'themezone_woocommerce_custom_endpoint_order');
function themezone_woocommerce_custom_endpoint_order()
{
    $myorder = array(
        'dashboard' => esc_html__('Home', 'woocommerce'),
        'orders' => __('My Orders', 'woocommerce'),
        'downloads' => __('Downloads', 'woocommerce'),
        'edit-account' => __('Profile', 'woocommerce'),
        'affiliate'=> __('Affiliate program', 'wooocmmerce'),
        'woo-wallet'=> __('Add Funds', 'woocommerce'),
        'ticket' => __('Ticket', 'woocommerce'),
        'customer-logout' => __('Log out', 'woocommerce'),
    );
    return $myorder;
}