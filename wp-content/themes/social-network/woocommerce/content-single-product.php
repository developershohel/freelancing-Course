<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('shadow p-4 mb-5', $product); ?>>
    <div class="container">
        <div class="row">
            <div class="col-auto mb-3">
                <div class="product-title">
                    <?php woocommerce_template_single_title(); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="product-thumbnail bg-white p-4 mb-3">
                    <?php echo get_the_post_thumbnail(); ?>
                </div>
                <div class="text-center product-price">
                    <span>Price per pc</span><?php woocommerce_template_loop_price(); ?></div>
                <div class="text-center product-cart">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 bg-white p-4">
                <div class="prodict-description">
                    <?php
                    if ($product->get_description()) {
                        echo $product->get_description();
                    } else {
                        woocommerce_template_single_excerpt();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>
