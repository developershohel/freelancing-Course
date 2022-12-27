<article class="single-blog-post">
    <div class="thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium_large'); ?>
        </a>
    </div>
    <div class="post-content p-5">
        <div class="entry-header">
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h1>
            <div class="entry-meta d-flex align-items-center my-2">
                <?php tz_single_blog_post_entry_meta(); ?>
            </div>
        </div>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>
<?php if (is_tag()) { ?>
    <div class="single-post-tag">
        <h4 class="tag-title">Tags:</h4>
        <span class="entry-meta-tag">
             <?php
             $tags = get_tags(array(
                     'orderby' => 'name'
                 )
             );

             foreach ($tags as $tag) {
                 ?>
                 <ul class="entry-tags">
			        <li>
				        <?php
                        printf('<a href="%1$s">%2$s</a>',
                            esc_url(get_tag_link($tag->term_id)),
                            esc_html($tag->name));
                        ?>
			        </li>
		        </ul>
                 <?php
             }
             ?>
    </span>
    </div>
    <?php
}