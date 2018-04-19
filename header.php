<?php
require_once('partials/variables.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $url_paths;

$url_paths = array(
    "main"      => "https://skift.com",
    "trends"    => "https://research.skift.com",
    "edu"       => "http://edu.skift.com",
    "forum"     => "http://forum.skift.com",
    "skiftx"    => "http://www.skiftx.com",
    "myskift"    => "https://mybeta.skift.com"
);

if ($_SERVER['HTTP_HOST'] === "localhost") {
    $url_paths = array(
        "main"      => "http://localhost/skift",
        "trends"    => "http://localhost/trends",
        "edu"       => "http://localhost/edu",
        "forum"     => "http://localhost/forum",
        "skiftx"    => "http://localhost/skiftx",
        "myskift"    => "http://localhost:3000"
    );
}

if (strpos($_SERVER['HTTP_HOST'],".wpengine.com") !== false) {
    $url_paths = array(
        "main"      => "https://skiftish.staging.wpengine.com",
        "trends"    => "https://skiftproducts.staging.wpengine.com",
        "edu"       => "http://skiftedu.staging.wpengine.com",
        "forum"     => "http://skforums.staging.wpengine.com",
        "skiftx"    => "http://skiftx.staging.wpengine.com",
        "myskift"    => "https://myskiftv2.wpengine.com"
    );
}

if (strpos($_SERVER['HTTP_HOST'],"dev.") !== false) {
    $url_paths = array(
        "main"      => "https://dev.staging.wpengine.com",
        "trends"    => "http://dev.research.skift.com",
        "edu"       => "http://skiftedu.staging.wpengine.com",
        "forum"     => "http://skforum.staging.wpengine.com",
        "skiftx"    => "http://skiftx.staging.wpengine.com",
        "myskift"    => "https://mybeta.skift.com"
    );
}
// user authentication
global $user_info;

if (class_exists("User")) {
    // check user auth using the wallkit plugin
    $auth_user = new User();

    $user_info = $auth_user->info;
} else {
    if (function_exists("user_auth")) {
        // if here, we're on myskift, use the library
        $user_info = user_auth();
    } else {
        // if here, there is no wallkit install
        $user_info = false;
    }
}

$signed_in = !empty($user_info);

$white_listed = false;
if (function_exists("is_whitelisted")) {
    $white_listed = is_whitelisted();
>>>>>>> master
}
?>

<div id="header-container"<?php if ($has_sub_nav) { echo ' class="has-sub-nav"'; } ?>>

    <?php
    if (!$dont_show_banner_ad) {
        ?>
        <div id="top-banner">
            <!-- header banner loads into this -->
        </div>
        <!-- #top-banner -->
        <?php
    }
    ?>

    <header id="header" class="<?php if ($dont_show_banner_ad) { echo 'fixed no-banner'; } ?>">
        <div id="header-left">
<<<<<<< HEAD
            <div id="logo">
                <a href="<?php echo $url_paths['main']; ?>">
=======

            <div id="logo">
                <a href="<?php echo $url_paths["main"]; ?>">
>>>>>>> master
                    <img src="<?php echo get_template_directory_uri() ?>/header-footer/img/logo.svg" class="svg" alt="Skift Logo" />
                </a>
            </div>
            <nav id="primary-nav">
                <?php
                if ($has_sub_nav) {
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
                <ul id="navigation-menu">
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/news/"<?php if ($select_tab === 'news') { echo ' class="selected"'; } ?>>News<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <div class="sub-menu">
                            <div class="sub-menu-wrap">
                                <ul>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/news/">Latest News</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/rooms/hotels/">Hotels</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/destinations/">Destinations</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/digital/">Digital</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/digital/startups/">Startups</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/transport/airlines/">Airlines</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/travel-services/meetings-and-events/">Meetings</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/travel-services/travel-agents/">Travel Agents</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/transport/cruises/">Cruises</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/travel-services/corporate-travel/">Corporate Travel</a></li>
                                	<li class="all-sectors menu-item"><a href="<?php echo $url_paths['main']; ?>/all-categories/">All Sectors</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item"><a href="<?php echo $url_paths['trends']; ?>"<?php if ($select_tab === 'research') { echo ' class="selected"'; } ?>>Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['forum']; ?>"<?php if ($select_tab === 'conferences') { echo ' class="selected"'; } ?>>Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/newsletters"<?php if ($select_tab === "newsletters") { echo ' class="selected"'; } ?>>Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <div class="sub-menu">
                            <div class="sub-menu-wrap">
                                <ul>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/daily/">Daily</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/weekly-review/">Weekly</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/business-of-loyalty/">Business of Loyalty</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/corporate-travel/">Corporate Travel</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/meetings/">Meetings</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/new-luxury/">New Luxury</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/airline/">Airline Innovation</a></li>
                                	<li class="menu-item"><a href="http://table.skift.com">Skift Table</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item"><a href="<?php echo $url_paths['edu']; ?>"<?php if ($select_tab === 'education') { echo ' class="selected"'; } ?>>Edu</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['skiftx']; ?>"<?php if ($select_tab === 'advertising') { echo ' class="selected"'; } ?>>Advertising</a></li>
                </ul>
            </nav>

            <div class="clearfix"></div>

        </div>
        <!-- #header-menus -->

        <!-- Wallkit -->
        <div id="header-right">
            <?php
                require_once('partials/wallkit.php');
            ?>
        </div>
        <!-- End Wallkit -->

<<<<<<< HEAD
        <div class="clearfix"></div>
=======
        <nav id="mobile-menu">
            <ul>
                <?php
                echo '<li class="menu-item"><a href="' . $url_paths["main"] . '">Home</a></li>';

                if (!$hasSubNav || $useMainMobileMenu) {
                ?>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/news/">News</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>">Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>">Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters">Newsletters</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["edu"]; ?>">Education</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/advertising">Advertising</a></li>
                <?php
                } else {
                    wp_nav_menu(array(
                        'theme_location' => $sub_nav,
                        'container' => false,
                        'items_wrap' => '%3$s'
                    ));
                }

                if ($showLoginForm) {

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
>>>>>>> master

        <?php
            if ($show_login_form) {
                require_once('partials/mobile.php');
            }
        ?>
    </header>

	<div id="header-pad"></div>
</div>

<<<<<<< HEAD
<?php
    require_once('partials/mobile-account-manager.php');
    require_once('partials/hubspot-loader.php');
?>
=======

<?php if ($showLoginForm) { ?>
<div class="mobile-account-manager shopping-cart">
    <div class="top">
        <div class="user-info">
            <?php if ($signed_in) { ?>
                <a href="<?php echo $url_paths['myskift'];?>/">
                    <span class="fa-stack">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-user fa-stack-1x"></i>
                    </span>
                    <?php echo $user_info["first_name"] . ' ' . $user_info["last_name"]; ?>
                </a>
            <?php } else { ?>
            <a href="<?php echo $url_paths['myskift'];?>/login">Sign In</a>
        <?php } ?>
        </div>

        <div class="cart-btn">
            <i class="fa fa-shopping-cart fa-lg"></i>
            <div class="badge">0</div>
        </div>

        <div class="close-mobile-account-manager"><i class="fa fa-close"></i></div>
    </div>

    <div class="mobile-cart-items cart-contents">
        <div class="items">
            <div class='cart-item template'>
                <div class='photo'><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="/></div>
                <div class='item-details'>
                    <div class='item-name'><h3></h3></div>
                    <div class='item-price'>$<span></span></div>
                    <div class='remove-item'><button class='btn btn-green btn-xs remove-from-cart-btn'><i class='fa fa-trash'></i>  Remove</button></div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class='no-items'><p><small><i>Your cart is empty</i></small></p></div>
            <div class="spinner">Loading</div>
        </div>


        <div class="totals-area">
            <div class="total">
                <strong>Total</strong>
                <div class="pull-right">$<span class="total-price">0</span></div>
            </div>

            <div class="buttons">
                <a href="<?php echo $url_paths["myskift"]; ?>/cart" class="btn btn-green btn-sm">View Cart</a>
                <a href="<?php echo $url_paths["myskift"]; ?>/checkout" class="btn btn-yellow btn-sm">Checkout</a>
            </div>
        </div>
    </div>

</div>
<?php } ?>
<?php include "hubspot-loader.php"; ?>
>>>>>>> master
