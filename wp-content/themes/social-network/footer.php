</div>
<div class="tz-footer-content-section bg-dark">
    <?php
    $pn_footer_widget = get_theme_mod('pn_footer_widget', 4);
    ?>
    <div class="tz-footer-section">
        <div class="tz-static-widget">
            <div class="tz-footer-resources">
                <h3 class="tz-footer-title">Resources</h3>
                <nav class="resources-footer-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'resources',
                            'container' => 'ul',
                            'menu_class' => 'footer-menu',
                            'depth' => 1
                        )
                    );
                    ?>
                </nav>
            </div>

            <div class="tz-footer-community">
                <h3 class="tz-footer-title">Community</h3>
                <nav class="navbar community-footer-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'community',
                            'container' => 'ul',
                            'menu_class' => 'footer-menu',
                            'depth' => 1
                        )
                    );
                    ?>
                </nav>
            </div>

            <div class="tz-footer-company">
                <h3 class="tz-footer-title">Company</h3>
                <nav class="navbar company-footer-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'company',
                            'container' => 'ul',
                            'menu_class' => 'footer-menu',
                            'depth' => 1
                        )
                    );
                    ?>
                </nav>
            </div>
            <div class="tz-footer-follow-us">
                <h3 class="tz-footer-title"> Follow Us</h3>
                <div class="tz-footer-social-icon">
                    <ul class="tz-social-media-icon">
                        <li>
                            <a href="https://www.facebook.com/pronations.me/" target="_blank"> <i
                                        class="fab fa-facebook-square"></i> </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/developershohel" target="_blank"> <i
                                        class="fab fa-twitter-square"></i> </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/developershohel/" target="_blank"> <i
                                        class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/developershohel/" target="_blank"> <i
                                        class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCosj836K9IhlLIAR9PIZrfw" target="_blank"> <i
                                        class="fab fa-youtube-play"></i> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sroll-to-top"></div>
<div class="tz-copyright-section bg-dark border-top">
    <?php
    $copyright = get_theme_mod('pn_copyright_text');
    if (!empty($copyright)) {
        echo '<p class="copyright-text">' . $copyright . '</p>';
    } else {
        ?>
        <p class="copyright-text">Copyright &copy; <?php the_time('Y'); ?> <a
                    href="<?php echo esc_url(home_url()); ?>"> <?php bloginfo('name'); ?> </a> Global Inc. </p>
        <?php
    }
    ?>
</div>
<?php wp_footer(); ?>

</body>
</html>