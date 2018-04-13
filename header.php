<?php
require_once('partials/variables.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
            <div id="logo">
                <a href="<?php echo $url_paths["main"]; ?>">
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
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/news/"<?php if ($select_tab === "news") { echo ' class="selected"'; } ?>>News<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <div class="sub-menu">
                            <div class="sub-menu-wrap">
                                <ul>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/news/">Latest News</a></li>
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
                        </div>
                    </li>
                    <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>"<?php if ($select_tab === "research") { echo ' class="selected"'; } ?>>Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>"<?php if ($select_tab === "conferences") { echo ' class="selected"'; } ?>>Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters"<?php if ($select_tab === "newsletters") { echo ' class="selected"'; } ?>>Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <div class="sub-menu">
                            <div class="sub-menu-wrap">
                                <ul>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/daily/">Daily</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/weekly-review/">Weekly</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/business-of-loyalty/">Business of Loyalty</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/corporate-travel/">Corporate Travel</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/meetings/">Meetings</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/new-luxury/">New Luxury</a></li>
                                	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/airline/">Airline Innovation</a></li>
                                	<li class="menu-item"><a href="http://table.skift.com">Skift Table</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item"><a href="<?php echo $url_paths["edu"]; ?>"<?php if ($select_tab === "education") { echo ' class="selected"'; } ?>>Edu</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["skiftx"]; ?>"<?php if ($select_tab === "advertising") { echo ' class="selected"'; } ?>>Advertising</a></li>
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

        <div class="clearfix"></div>

        <?php
            if ($show_login_form) {
                require_once('partials/mobile.php');
            }
        ?>
    </header>

	<div id="header-pad"></div>
</div>

<?php
    require_once('partials/mobile-account-manager.php');
    require_once('partials/hubspot-loader.php');
?>
