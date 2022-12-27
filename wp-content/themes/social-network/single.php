<?php
/**
 * The Single page for our theme
 *
 * This is the template that displays all of the footer section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pronations Themes
 * @subpackage Pronations Landing Theme
 * @since 2.1.0
 */

get_header();
?>
    <div class="pn-single-page-content-section my-4">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <div class="pn-single-page-content shadow">
                        <?php
                        if (have_posts()):
                            while (have_posts()): the_post();
                                get_template_part('template-parts/content', 'single');
                                if (comments_open() || get_comments_number()) {
                                    comments_template();
                                }
                            endwhile;
                        else:
                            get_template_part('template-parts/content', 'none');
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();