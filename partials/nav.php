<nav id="primary-nav">
    <?php
    // removed sub_nav in latest verion
    if ($has_sub_nav && false) {
        ?>
        <div class="sub-menu">
            <div class="sub-menu-wrap<?php if (!empty($sub_nav_logo)) { echo ' has-sub-nav-logo'; } ?>">
                <?php
                if (!empty($sub_nav_logo)) {
                    echo "<a href='" . home_url() . "'><img src='$sub_nav_logo' alt='Skift Research' class='sub-nav-logo' /></a>";
                }
                ?>
                <ul>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => $sub_nav,
                        'container' => false,
                        'items_wrap' => '%3$s'
                    ));
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }

    ?>
    <ul id="navigation-menu" style="max-width: <?php echo $primary_nav_max_width; ?>;">
        <?php
        wp_nav_menu(array(
            'theme_location' => $primary_nav_name,
            'container' => false,
            'items_wrap' => '%3$s'
        ));
        ?>
    </ul>
</nav>
