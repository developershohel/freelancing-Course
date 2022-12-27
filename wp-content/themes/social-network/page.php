<?php
get_header();
?>
    <div class="container my-5 shadow p-5">
        <?php
        if (have_posts()):
            while (have_posts()):the_post();
                echo '<div class="page-title"><h2 class="entry-title">' . get_the_title() . '</h2></div>';
                echo '<div class="page-content">';
                the_content();
                echo '</div>';
            endwhile;
        endif;
        ?>
    </div>
<?php
get_footer();