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
            <form id="mobile-search-form" action="<?php echo $search_action; ?>" method="get">
                <input type="search" name="<?php echo $search_query_string; ?>" placeholder="<?php echo $search_placeholder; ?>" class="mobile-search-input" />
            </form>
        </div>
    </div>

    <ul>
        <?php
        global $url_paths;
        do_action('sk_header_before_nav', $mobile_nav_name);
        wp_nav_menu(array(
            'theme_location' => $mobile_nav_name,
            'container' => false,
            'items_wrap' => '%3$s'
        ));
        do_action('sk_header_after_nav', $mobile_nav_name);
        
        if ($show_login_form) {

            if ($signed_in) {
            ?>
                <li class="menu-item"><a href="<?php if (function_exists('mysk_get_logout_link')) echo mysk_get_logout_link(); ?>">Sign Out</a></li>
            <?php
            } else {
            ?>
                <li class="menu-item"><a href="<?php if (function_exists('mysk_get_login_link')) echo mysk_get_login_link(); ?>">Sign In</a></li>
            <?php
            }
        }
        ?>

    </ul>
</nav>
