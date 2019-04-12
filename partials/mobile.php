<div id="mobileMenuBtn">
    <div class="top-line"></div>
    <div class="middle">
        <div class="middle-line"></div>
        <div class="middle-dot"></div>
    </div>
    <div class="bottom-line"></div>
</div>

<nav id="mobile-menu">
    <div class="mobile-search">
        <div class="mobile-search-box">
            <i class="fa fa-search"></i>
            <form id="mobile-search-form" action="<?php echo home_url(); ?>" method="get">
                <input type="search" name="s" placeholder="<?php echo $search_placeholder; ?>" class="mobile-search-input" />
            </form>
        </div>
    </div>

    <ul>
        <?php
        global $url_paths;

        wp_nav_menu(array(
            'theme_location' => $mobile_nav_name,
            'container' => false,
            'items_wrap' => '%3$s'
        ));
        
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
