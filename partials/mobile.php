<div id="mobileMenuBtn">
    <div class="top-line"></div>
    <div class="middle">
        <div class="middle-line"></div>
        <div class="middle-dot"></div>
    </div>
    <div class="bottom-line"></div>
</div>

<nav id="mobile-menu">
    <ul>
        <?php
        global $url_paths;
        echo '<li class="menu-item"><a href="' . $url_paths["main"] . '">Home</a></li>';

        if (!$has_sub_nav) {
            ?>
            <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/news/">News</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>">Research</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>">Conferences</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/daily">Newsletters</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/advertising">Advertising</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["table"]; ?>">Skift Table</a></li>
            <?php if ($show_wellness_logo) { ?>
                <li class="menu-item"><a href="<?php echo $url_paths["wellness"]; ?>">Skift Wellness</a></li>
            <?php } ?>
            <?php
        } else {
            wp_nav_menu(array(
                'theme_location' => $sub_nav,
                'container' => false,
                'items_wrap' => '%3$s'
            ));
        }

        if ($show_login_form) {

            if ($signed_in) {
            ?>
                <li class="menu-item"><a href="<?php echo $url_paths['myskift'];?>/login?logout=true">Sign Out</a></li>
            <?php
            } else {
            ?>
                <li class="menu-item"><a href="<?php echo $url_paths['myskift'];?>/login">Sign In</a></li>
            <?php
            }
        }
        ?>

    </ul>
</nav>
