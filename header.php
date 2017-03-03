<?php
$hasSubNav = !empty($sub_nav);

session_start();

global $url_paths;

$url_paths = array(
    "main"      => "https://skift.com",
    "trends"    => "https://research.skift.com",
    "edu"       => "http://edu.skift.com",
    "forum"     => "http://forum.skift.com",
    "skiftx"    => "http://www.skiftx.com",
    "myskift"    => "https://my.skift.com"
);

if ($_SERVER['HTTP_HOST'] === "localhost") {
    $url_paths = array(
        "main"      => "http://localhost/skift",
        "trends"    => "http://localhost/trends",
        "edu"       => "http://localhost/edu",
        "forum"     => "http://localhost/forum",
        "skiftx"    => "http://localhost/skiftx",
        "myskift"    => "http://localhost/myskift"
    );
}

if (strpos($_SERVER['HTTP_HOST'],".wpengine.com") !== false) {
    $url_paths = array(
        "main"      => "https://skiftish.staging.wpengine.com",
        "trends"    => "https://skiftproducts.staging.wpengine.com",
        "edu"       => "http://skiftedu.staging.wpengine.com",
        "forum"     => "http://skforum.staging.wpengine.com",
        "skiftx"    => "http://skiftx.staging.wpengine.com",
        "myskift"    => "https://myskift.wpengine.com"
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
?>

<div id="header-container"<?php if ($hasSubNav) { echo ' class="has-sub-nav"'; } ?>>

    <?php if (!$dontShowBannerAd) { ?>
    <div id="top-banner">
        <!-- header banner loads into this -->
    </div><!-- #top-banner -->
    <?php } ?>

    <?php
    $header_classes = '';

    if ($dontShowBannerAd) {
        $header_classes = 'fixed no-banner';
    }

    if ($dontFix) {
        $header_classes = 'no-fix';
    }

    if ($dontShowBannerAd && $dontFix) {
        $header_classes = 'no-banner no-fix';
    }
    ?>

    <header id="header" class="<?php echo $header_classes; ?>">
        <div id="header-left">
            <div id="logo">
                <a href="<?php echo $url_paths["main"]; ?>">
                    <img src="<?php echo get_template_directory_uri() ?>/header-footer/img/logo.svg" class="svg" alt="Skift Logo" />
                </a>
            </div><!-- #logo -->

            <nav id="primary-nav">
                <?php if ($hasSubNav) { ?>
                    <div class="sub-menu<?php if (!empty($sub_nav_logo)) { echo ' has-sub-nav-logo'; } ?>">
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
                <?php } ?>
                <ul id="navigation-menu">
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/<?php echo date("Y"); ?>/"<?php if ($select_tab === "news") { echo ' class="selected"'; } ?>>News<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <div class="sub-menu">
                            <ul>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/<?php echo date("Y"); ?>/">Latest News</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/rooms/hotels/">Hotels</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/destinations/">Destinations</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/digital/">Digital</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/digital/startups/">Startups</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/transport/airlines/">Airlines</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/travel-services/meetings-and-events/">Meetings</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/travel-services/travel-agents/">Travel Agents</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/transport/cruises/">Cruises</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/travel-services/corporate-travel/">Corporate Travel</a></li>
                            	<li class="all-sectors menu-item"><a href="<?php echo $url_paths["main"]; ?>/all-categories/">All Sectors</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>"<?php if ($select_tab === "research") { echo ' class="selected"'; } ?>>Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>"<?php if ($select_tab === "conferences") { echo ' class="selected"'; } ?>>Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters"<?php if ($select_tab === "newsletters") { echo ' class="selected"'; } ?>>Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <div class="sub-menu">
                            <ul>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/daily/">Daily</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/weekly-review/">Weekly</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/business-traveler/">Business Traveler</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/corporate-travel/">Corporate Travel</a></li>
                            	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/meetings/">Meetings</a></li>
                            	<li class="menu-item"><a href="http://chefstech.co/subscribe/">Chefs+Tech</a></li>
                            </ul>
                        </div>
                    </li>
<!--                     <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/advertise"<?php if ($select_tab === "advertising") { echo ' class="selected"'; } ?>>Advertising</a></li> -->
                    <li class="menu-item"><a href="<?php echo $url_paths["edu"]; ?>"<?php if ($select_tab === "education") { echo ' class="selected"'; } ?>>Edu</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["skiftx"]; ?>"<?php if ($select_tab === "advertising") { echo ' class="selected"'; } ?>>Advertising</a></li>
                </ul>
            </nav>

            <div class="clearfix"></div>

        </div>
        <!-- #header-menus -->

        <!-- WALLKIT -->

        <div id="header-right">

            <?php if ($showLoginForm) { ?>

                <div id="header-sign-in-with-popover"<?php if ($signed_in) { echo ' class="my-account"'; } ?>>
                    <div class="shopping-cart hasPopover">
                        <a href="javascript:" class="cart-btn">
                            <i class="fa fa-shopping-cart fa-lg"></i>
                            <div class="badge">0</div>
                        </a>
                        
                        <div id="cart-popover" class="popover cart-contents">
                            <div class="items">
                                <div class='cart-item template'>
                                    <div class='photo'><img src='#' /></div>
                                    <div class='item-details'>
                                        <div class='item-name'><h3></h3></div>
                                        <div class='item-price'>$<span></span></div>
                                        <div class='remove-item'><button class='btn btn-green btn-xs remove-from-cart-btn floating-remove-from-cart-btn'><i class='fa fa-trash'></i>  Remove</button></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                    
                                <div class='no-items'><p><small><i>Your cart is empty</i></small></p></div>
                                <div class="spinner">Loading</div>
                            </div>
                            <div class="chin">
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
                    
                    <div class="overlay"></div>
                    
                    <div class="sign-in hasPopover">

                        <?php if (!$signed_in) { ?>
                            <a href="javascript:" class="sign-in-btn">Sign In</a>
                        <?php } else { ?>
                            <a href="javascript:" class="sign-in-btn my-account-btn">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                                    <i class="fa fa-user fa-stack-1x"></i>
                                </span>
                            </a>
                        <?php } ?>

                        <div id="sign-in-popover" class="popover">
                            <?php if (!$signed_in) { ?>

                                <form class="login-form dark-bg account-form reload">
                                    <div class="alert alert-danger error-text"></div>

                                    <div class="form-group">
                                        <input type="text" class="form-control has-floating-label username-field" name="email" />
                                        <label for="username" class="floating-form-label">Email Address</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control has-floating-label password-field" name="password" />
                                        <label for="password" class="floating-form-label">Password</label>
                                        <a href="<?php echo $url_paths["myskift"]; ?>/login?forgot=true" class="forgot-password-btn">Forgot?</a>
                                    </div>

                                    <div class="text-center">
                                        <button class="login-btn btn btn-yellow btn-sm">Sign In</button>
                                        <a href="<?php echo $url_paths["myskift"]; ?>/create-account" class="under-btn-link">Create an Account</a>
                                    </div>
                                </form>

                            <?php } else { ?>

                                <ul id="my-account-menu">
                                    <li><a href="<?php echo $url_paths["myskift"]; ?>">My Account</a></li>
                                    <li><a href="<?php echo $url_paths["myskift"]; ?>/purchases">My Purchases</a></li>
                                    <li><a href="<?php echo $url_paths["myskift"]; ?>/login?logout=true" class="logout-btn">Logout</a></li>
                                </ul>

                                <p>Welcome, <?php echo $user_info["first_name"] . ' ' . $user_info["last_name"]; ?>!</p>

                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="overlay"></div>
                </div>

            <?php } else { ?>
                <div id="header-social">
                    <div class="social-btn" title="Facebook"><a href="https://www.facebook.com/Skiftnews/" target="_blank"><i class="fa fa-facebook"></i></a></div>
                    <div class="social-btn" title="Twitter"><a href="https://twitter.com/skift" target="_blank"><i class="fa fa-twitter"></i></a></div>
                    <div class="social-btn" title="LinkedIn"><a href="https://www.linkedin.com/company/2641998" target="_blank"><i class="fa fa-linkedin"></i></a></div>
    <!--                 <div class="header-social-btn email" title="Email"><a href="javascript:"><i class="fa fa-envelope"></i></a></div> -->
                </div>
            <?php } ?>

            <div id="search">
                <div id="search-container">
                    <div id="search-trigger"><i class="fa fa-search"></i></div>

                    <div id="search-form">
                        <form method="get" action="<?php echo $url_paths["main"]; ?>">
                            <input type="search" name="s" id="search-box" class="text" />
                            <input type="button" value="&times;" id="search-clear" name="clear" />
                        </form>
                    </div>
                </div>
            </div>
            <!-- #search -->
        </div>
        <!-- #header-right -->

        <div class="clearfix"></div>


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

                if (!$hasSubNav || $useMainMobileMenu) {
                ?>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/<?php echo date("Y"); ?>/">News</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>">Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>">Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters">Newsletters</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["edu"]; ?>">Education</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/advertising">Advertising</a></li>
                <?
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
                        <li class="menu-item"><a href="<?=$url_paths['myskift'];?>/login?logout=true">Sign Out</a></li>
    				<?php
    				} else {
    				?>
                        <li class="menu-item"><a href="<?=$url_paths['myskift'];?>/login">Sign In</a></li>
                    <?php
                    }
				}
				?>
                
            </ul>
        </nav>
    </header>

	<div id="header-pad"></div>
</div>


<? if ($showLoginForm) { ?>
<div class="mobile-account-manager shopping-cart">
    <div class="top">
        <div class="user-info">
            <? if ($signed_in) { ?>
                <a href="<?=$url_paths['myskift'];?>/">
                    <span class="fa-stack">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-user fa-stack-1x"></i>
                    </span>
                    <?php echo $user_info["first_name"] . ' ' . $user_info["last_name"]; ?>
                </a>
            <? } else { ?>
            <a href="<?=$url_paths['myskift'];?>/login">Sign In</a>
            <? } ?>
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
                <div class='photo'><img src='#' /></div>
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
<? } ?>

<?php include "hubspot-loader.php"; ?>
