<!doctype html>
<html <?php language_attributes() ?>>
<head>
    <meta <?php bloginfo('charset'); ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!--<div class="root">-->
<div class="themezone-header-section text-white">
    <div class="top-header-section bg-dark border-bottom">
        <div class="container">
            <div class="row">
                <div class="top-header-left-section col-lg-8 col-md-12 col-sm-12">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#top-header" aria-controls="top-header"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!--                        <div class="collapse navbar-collapse" id="top-header">-->
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'top_header',
                            'container' => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id' => 'top-header',
                            'menu' => 'ul',
                            'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0'
                        ));
                        ?>
                    </nav>
                </div>
                <div class="top-header-right-section col-lg-4 col-md-12 col-sm-12 d-flex align-items-center justify-content-end">
                    <div class="social-icon me-3"><a href="https://telegram.org/" class="text-dark"><i
                                    class="fab fa-telegram"></i> @telegram</a></div>
                    <div class="account-section">
                        <button type="button" class="signup btn ">Sign UP</button>
                        <button type="button" class="login btn ">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header-section bg-light border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <nav class="navbar navbar-expand-lg">
                        <div class="navbar-brand">
                            <a href="<?php echo home_url(); ?>" class="custom-logo-link">
                                <?php
                                if (has_custom_logo()) {
                                    echo '<img src="' . wp_get_attachment_image_url(get_theme_mod('custom_logo')) . '" class="custom-logo" alt="' . get_bloginfo('name') . '">';
                                }
                                bloginfo('name');
                                ?>
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-5">
                    <div class="head-category-navigation">
                        <button class="category-button btn"><span>Select a category</span> <i class="fa fa-angle-down"></i></button>
                        <ul class="head-categories shadow">
                            <?php
                            $cats = get_categories(array('taxonomy' => 'product_cat', 'parent' => 0,
                                'hide_empty' => 0));
                            foreach ($cats as $cat) {
                                ?>
                                <li class="head-category border-bottom border-white" data-name="<?php echo $cat->slug;?>" data-slug="<?php echo $cat->slug;?>" data-id="<?php echo $cat->term_id;?>">
                                    <a href="<?php echo get_category_link($cat->term_id) ?>"
                                       class="<?php echo $cat->slug; ?> category-link">
                                        <?php
                                        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                                        if (!empty($thumbnail_id)):
                                            $image = wp_get_attachment_url($thumbnail_id);
                                            echo '<img src="' . $image . '" class="img-fluid category-img" alt="' . $cat->name . '" />';
                                        endif;
                                        echo $cat->name;
                                        ?>
                                    </a>
                                    <?php
                                    $child_cats = get_term_children($cat->term_id, 'product_cat');
                                    if ($child_cats) {
                                        echo '<ul class="sub-category shadow-lg">';
                                        foreach ($child_cats as $children) {
                                            $children_cat = get_term_by('id', $children, 'product_cat');
                                            echo '<li><a href="' . get_term_link($children, 'product_cat') . '">' . $children_cat->name . '</a></li>';
                                        }
                                        echo '</ul>';
                                    }
                                    ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <input type="hidden" id="cat-attrs" data-id="" data-name="" data-slug="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-sm-3 d-flex align-items-center">
                    <?php woocommerce_live_search(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
