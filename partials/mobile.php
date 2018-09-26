<div id="mobile-search">
    <div id="search-trigger"><i class="fa fa-search"></i></div>
</div>

<div id="mobile-search-form">
    <?php
    $search = (isset($_GET['s']) && !empty($_GET['s'])) ? $_GET['s'] : '';
    ?>
    <form method="get" action="<?php echo $url_paths["main"]; ?>">
        <input type="button" value="&times;" id="mobile-search-close" name="clear" />
        <input type="search" value="<?php echo $search; ?>" name="s" id="mobile-search-box" class="text" />
        <button type="submit" id="mobile-search-go" name="go"><i class="fa fa-search"></i></button>
    </form>
</div>

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
        echo '<li class="menu-item"><a href="' . $url_paths["main"] . '">Home</a></li>';

        if (!$has_sub_nav) {
            ?>
            <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/news/">News</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>">Research</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>">Conferences</a></li>
            <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters">Newsletters</a></li>
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
                <li class="menu-item"><a href="<?php $url_paths['myskift'];?>/login?logout=true">Sign Out</a></li>
            <?php
            } else {
            ?>
                <li class="menu-item"><a href="<?php $url_paths['myskift'];?>/login">Sign In</a></li>
            <?php
            }
        }
        ?>

    </ul>
</nav>
