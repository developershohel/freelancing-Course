<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
global $wp_query;
$cat_id = $wp_query->get_queried_object_id();
$cats = get_the_category_by_ID($cat_id);
?>

    <div class="container mt-4">
        <div class="social-icon-section">
            <?php

            if (woocommerce_product_loop()) {
                if (wc_get_loop_prop('total')) {
                    $term_child = get_term_children($cat_id, 'product_cat');
                    if ($term_child) {
                        foreach ($term_child as $term_id) {
                            $term = get_term($term_id);
                            ?>
                            <div class="<?php echo $term->slug ?> shadow mb-4">
                                <div class="product-header bg-dark">
                                    <a class="product-category"
                                       href="<?php echo get_category_link($term->term_id) ?>"><?php echo $term->name ?></a>
                                    <div class="product-quantity text-center">In stock</div>
                                    <div class="label"></div>
                                    <div class="product-cost text-center">Price</div>
                                    <div class="add-to-cart"></div>
                                </div>
                                <div class="product-body">
                                    <?php
                                    $softregs = array(
                                        'product_cat' => $term->slug,
                                        'posts_per_page' => 10,
                                    );
                                    $softregs_product = new WP_Query($softregs);
                                    while ($softregs_product->have_posts()): $softregs_product->the_post();
                                        global $product;
                                        ?>
                                        <div class="product-content my-3 bg-white shadow-sm">
                                            <div class="product-title">
                                                <a href="<?php echo get_the_permalink(); ?>">
                                                    <?php
                                                    woocommerce_template_loop_product_thumbnail();
                                                    woocommerce_template_loop_product_title();
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="product-stock text-center">
                                                <span><?php echo $product->get_stock_quantity() ?></span>
                                            </div>
                                            <div class="product-label"><span>Price per pc</span></div>
                                            <div class="text-center product-price"><?php woocommerce_template_loop_price(); ?></div>
                                            <div class="text-center text-center product-cart">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                                <a class="product-buy-now" href="<?php echo get_permalink(); ?>"
                                                   title="Buy Now"><i
                                                            class="fa-solid fa-cart-shopping"></i></a>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                                <div class="product-footer text-center pb-3">
                                    <button type="button" class="loading-more btn">View more</button>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="facebook-softregs shadow mb-4">
                            <div class="product-header bg-dark">
                                <a class="product-category"
                                   href="<?php echo get_category_link($cat_id) ?>"><?php echo $cats ?></a>
                                <div class="product-quantity text-center">In stock</div>
                                <div class="label"></div>
                                <div class="product-cost text-center">Price</div>
                                <div class="add-to-cart"></div>
                            </div>
                            <div class="product-body">
                                <?php
                                $softregs = array(
                                    'product_cat' => $cats,
                                    'posts_per_page' => 10,
                                );
                                $softregs_product = new WP_Query($softregs);
                                while ($softregs_product->have_posts()): $softregs_product->the_post();
                                    global $product;
                                    ?>
                                    <div class="product-content my-3 bg-white shadow-sm">
                                        <div class="product-title">
                                            <a href="<?php echo get_the_permalink(); ?>">
                                                <?php
                                                woocommerce_template_loop_product_thumbnail();
                                                woocommerce_template_loop_product_title();
                                                ?>
                                            </a>
                                        </div>
                                        <div class="product-stock text-center">
                                            <span><?php echo $product->get_stock_quantity() ?></span>
                                        </div>
                                        <div class="product-label"><span>Price per pc</span></div>
                                        <div class="text-center product-price"><?php woocommerce_template_loop_price(); ?></div>
                                        <div class="text-center text-center product-cart">
                                            <?php woocommerce_template_loop_add_to_cart(); ?>
                                            <a class="product-buy-now" href="<?php echo get_permalink(); ?>"
                                               title="Buy Now"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                                wp_reset_postdata();

                                ?>

                            </div>
                            <div class="product-footer text-center pb-3">
                                <button type="button" class="loading-more btn">View more</button>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer();
