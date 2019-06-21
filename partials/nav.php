<nav id="primary-nav">
    <ul id="navigation-menu" style="max-width: <?php echo $primary_nav_max_width; ?>;">
        <?php
        do_action('sk_header_before_nav', $primary_nav_name);
        wp_nav_menu(array(
            'theme_location' => $primary_nav_name,
            'container' => false,
            'items_wrap' => '%3$s'
        ));
        do_action('sk_header_after_nav', $primary_nav_name);
        ?>
    </ul>
</nav>
