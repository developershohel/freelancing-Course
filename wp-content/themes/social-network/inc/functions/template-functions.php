<?php
if (!function_exists('hu_single_blog_post_entry_meta')) {
    /**
     * Theme meta
     * Customize your blog-post meta
     */
    function tz_single_blog_post_entry_meta()
    { ?>
        <span class="author">
                    <i class="fa fa-user-tie"></i>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
			<?php the_author(); ?>
            </a>
		</span>

        <span class="entry-meta-category">
                    <i class="fa fa-archive"></i>
	        <?php
            $cats = get_categories(array(
                    'orderby' => 'name'
                )
            );

            foreach ($cats as $cat) {
                ?>
                <ul class="entry-categories">
			        <li>
				        <?php
                        printf('<a href="%1$s">%2$s</a>',
                            esc_url(get_category_link($cat->term_id)),
                            esc_html($cat->name));
                        ?>
			        </li>
		        </ul>
                <?php
            }
            ?>
		</span>

        <span class="comment">
		<?php
        $number = get_comments_number();
        $more = _n('%1$s Comment', '%1$s Comments', $number);
        $more = sprintf($more, number_format_i18n($number));
        if (!post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link"><i class="fa fa-comment-dots"></i>';
            comments_popup_link(__('No Comments'), __('1 Comment'),
                $more, __('Comment off')
            );
            echo '</span>';
        } ?>
		</span>

        <span class="entry-time">
                    <i class="fa fa-calendar"></i>
			<?php
            $current_time = current_time('timestamp');
            $previous_time = get_the_time('U');
            $modified_time = get_the_modified_time('U');
            if ($current_time > $modified_time || $current_time > $previous_time) {
                printf('<a href="%1$s"> %2$s ago</a>',
                    esc_url(get_the_permalink()), human_time_diff($previous_time, $current_time));
            }
            ?>
		</span>
        <?php

    }
}