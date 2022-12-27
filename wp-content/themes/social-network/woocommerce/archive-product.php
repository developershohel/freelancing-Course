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
?>

    <div class="container mt-4">
        <div class="social-icon-section">
            <div class="facebook-softregs shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $fb_softregs_cats = get_term_by('slug', 'softregs', 'product_cat');
                       if ($fb_softregs_cats) echo get_category_link($fb_softregs_cats->term_id) ?>">Facebook Softregs</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $softregs = array(
                                'product_cat' => 'softregs',
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="facebook-aged shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $fb_aged_cats = get_term_by('slug', 'aged', 'product_cat');
                       if ($fb_aged_cats) echo get_category_link($fb_aged_cats->term_id) ?>">Facebook Aged</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $aged = array(
                                'product_cat' => 'aged',
                                'posts_per_page' => 10,
                            );
                            $aged_product = new WP_Query($aged);
                            while ($aged_product->have_posts()): $aged_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>
                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="facebook-with-friends shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $fb_with_fr_cats = get_term_by('slug', 'with-friends', 'product_cat');
                       if ($fb_with_fr_cats) echo get_category_link($fb_with_fr_cats->term_id) ?>">Facebook With Friends</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $with_friends = array(
                                'product_cat' => 'with-friends',
                                'posts_per_page' => 10,
                            );
                            $with_friends_product = new WP_Query($with_friends);
                            while ($with_friends_product->have_posts()): $with_friends_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="facebook-with-friends-and-age shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $fb_with_fr_ag_cats = get_term_by('slug', 'with-friends-and-age', 'product_cat');
                       if ($fb_with_fr_ag_cats)echo get_category_link($fb_with_fr_ag_cats->term_id) ?>">Facebook With Friends & Age</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $with_friends_and_age = array(
                                'product_cat' => 'with-friends-and-age',
                                'posts_per_page' => 10,
                            );
                            $with_friends_and_age_product = new WP_Query($with_friends_and_age);
                            while ($with_friends_and_age_product->have_posts()): $with_friends_and_age_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="facebook-for-advertising shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $fb_ads_cats = get_term_by('slug', 'for-advertising', 'product_cat');
                       if ($fb_ads_cats)echo get_category_link($fb_ads_cats->term_id) ?>">Facebook for Advertising</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $for_advertising = array(
                                'product_cat' => 'advertising',
                                'posts_per_page' => 10,
                            );
                            $for_advertising_product = new WP_Query($for_advertising);
                            while ($for_advertising_product->have_posts()): $for_advertising_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="softreg-instagram shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $in_softreg_cats = get_term_by('slug', 'softregs-instagram', 'product_cat');
                       if ($in_softreg_cats)echo get_category_link($in_softreg_cats->term_id) ?>">Instagram Softregs</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $softreg_instagram = array(
                                'product_cat' => 'softregs-instagram',
                                'posts_per_page' => 10,
                            );
                            $softreg_instagram_product = new WP_Query($softreg_instagram);
                            while ($softreg_instagram_product->have_posts()): $softreg_instagram_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="aged-instagram shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $in_aged_cats = get_term_by('slug', 'aged-instagram', 'product_cat');
                       if ($in_aged_cats)echo get_category_link($in_aged_cats->term_id) ?>">Instagram Aged</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $aged_instagram = array(
                                'product_cat' => 'aged-instagram',
                                'posts_per_page' => 10,
                            );
                            $aged_instagram_product = new WP_Query($aged_instagram);
                            while ($aged_instagram_product->have_posts()): $aged_instagram_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="with-bot-subscribers shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $with_bot_cats = get_term_by('slug', 'bot-subscribers', 'product_cat');
                       if ($with_bot_cats)echo get_category_link($with_bot_cats->term_id) ?>">Instagram Bot Subscribers</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $with_bot_subscribers = array(
                                'product_cat' => 'bot-subscribers',
                                'posts_per_page' => 10,
                            );
                            $with_bot_subscribers_product = new WP_Query($with_bot_subscribers);
                            while ($with_bot_subscribers_product->have_posts()): $with_bot_subscribers_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="with-real-subscribers shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $in_with_real_cats = get_term_by('slug', 'real-subscribers', 'product_cat');
                       if ($in_with_real_cats)echo get_category_link($in_with_real_cats->term_id) ?>">Instagram Real Subscribers</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $with_real_subscribers = array(
                                'product_cat' => 'real-subscribers',
                                'posts_per_page' => 10,
                            );
                            $with_real_subscribers_product = new WP_Query($with_real_subscribers);
                            while ($with_real_subscribers_product->have_posts()): $with_real_subscribers_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="gmail shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $gmail_cats = get_term_by('slug', 'gmail', 'product_cat');
                      if ($gmail_cats) echo get_category_link($gmail_cats->term_id) ?>">Gmail</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $gmail = array(
                                'product_cat' => 'gmail',
                                'posts_per_page' => 10,
                            );
                            $gmail_product = new WP_Query($gmail);
                            while ($gmail_product->have_posts()): $gmail_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="twitter shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $twitter_cats = get_term_by('slug', 'twitter', 'product_cat');
                       if ($twitter_cats)echo get_category_link($twitter_cats->term_id) ?>">Twitter</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $twitter = array(
                                'product_cat' => 'twitter',
                                'posts_per_page' => 10,
                            );
                            $twitter_product = new WP_Query($twitter);
                            while ($twitter_product->have_posts()): $twitter_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="reddit shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $reddit_cats = get_term_by('slug', 'reddit', 'product_cat');
                       if ($reddit_cats)echo get_category_link($reddit_cats->term_id) ?>">Reddit</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $reddit = array(
                                'product_cat' => 'reddit',
                                'posts_per_page' => 10,
                            );
                            $reddit_product = new WP_Query($reddit);
                            while ($reddit_product->have_posts()): $reddit_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="other-email-services shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $other_email_cats = get_term_by('slug', 'other-email-services', 'product_cat');
                       if ($other_email_cats)echo get_category_link($other_email_cats->term_id) ?>">Other Email Services</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $other_email_services = array(
                                'product_cat' => 'other-email-services',
                                'posts_per_page' => 10,
                            );
                            $other_email_services_product = new WP_Query($other_email_services);
                            while ($other_email_services_product->have_posts()): $other_email_services_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
            <div class="social-networks shadow mb-4">
                <div class="product-header bg-dark">
                    <a class="product-category"
                       href="<?php $social_cats = get_term_by('slug', 'social-networks', 'product_cat');
                       if ($social_cats)echo get_category_link($social_cats->term_id) ?>">Social Networks</a>
                    <div class="product-quantity text-center">In stock</div>
                    <div class="label"></div>
                    <div class="product-cost text-center">Price</div>
                    <div class="add-to-cart"></div>
                </div>
                <div class="product-body">
                    <?php
                    if (woocommerce_product_loop()) {

                        if (wc_get_loop_prop('total')) {
                            $social_networks = array(
                                'product_cat' => 'social-networks',
                                'posts_per_page' => 10,
                            );
                            $social_networks_product = new WP_Query($social_networks);
                            while ($social_networks_product->have_posts()): $social_networks_product->the_post();
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
                                        <a class="product-buy-now" href="<?php echo get_permalink(); ?>" title="Buy Now"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        }
                    }
                    ?>

                </div>
                <div class="product-footer text-center pb-3">
                    <button type="button" class="loading-more btn">View more</button>
                </div>
            </div>
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
