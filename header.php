<div id="header-container">
    
    <?php if (!$dontShowBannerAd) { ?>
    <div id="top-banner">
        <!-- header banner loads into this -->
    </div><!-- #top-banner -->
    <?php } ?>
    
    <header id="header"<?php if ($dontShowBannerAd) { echo ' class="fixed no-banner"'; } ?>>
        <div id="header-left">
            <div id="logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php bloginfo('template_directory') ?>/img/svg/logo.svg" class="svg" alt="Skift Logo" />
                </a>
            </div><!-- #logo -->
                        
            <nav id="primary-nav">
                <ul id="navigation-menu">
                    <li class="menu-item"><a href="<?php echo home_url(); ?>/2016">News<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/2016">Latest News</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/rooms/hotels/">Hotels</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/destinations/">Destinations</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/digital/">Digital</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/digital/startups/">Startups</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/transport/airlines/">Airlines</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/travel-services/meetings-conventions/">Meetings</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/travel-services/travel-agents/">Travel Agents</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/transport/cruises/">Cruises</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/travel-services/corporate-travel/">Corporate Travel</a></li>
                        	<li class="all-sectors menu-item"><a href="<?php echo home_url(); ?>/all-categories/">All Sectors</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="http://trends.skift.com/">Research</a></li>
                    <li class="menu-item"><a href="http://forum.skift.com/">Conferences</a></li>
                    <li class="menu-item"><a href="#">Services<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="http://podcast.skift.com/">Podcast</a></li>
                        	<li class="menu-item"><a href="http://www.skiftx.com">Skiftx</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="<?php echo home_url(); ?>/newsletters">Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/daily/">Daily</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/business-traveler/">Business Traveler</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/corporate-travel/">Corporate Travel</a></li>
                        	<li class="menu-item"><a href="<?php echo home_url(); ?>/meetings/">Meetings</a></li>
                        	<li class="menu-item"><a href="http://chefstech.co/subscribe">Chefs+Tech</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="<?php echo home_url(); ?>/advertise">Advertising</a></li>
                    <li class="menu-item"><a href="https://edu.skift.com/">Education</a></li>
                </ul>
            </nav>
            
            <div class="clearfix"></div>
        </div><!-- #header-menus -->
        
        <div id="header-right">
            <div id="header-social">
                <div class="header-social-btn facebook" title="Facebook"><a href="javascript:"><i class="fa fa-facebook"></i></a></div>
                <div class="header-social-btn twitter" title="Twitter"><a href="javascript:"><i class="fa fa-twitter"></i></a></div>
                <div class="header-social-btn linkedIn" title="LinkedIn"><a href="javascript:"><i class="fa fa-linkedin"></i></a></div>
                <div class="header-social-btn email" title="Email"><a href="javascript:"><i class="fa fa-envelope"></i></a></div>
            </div>
            
            <?php if ($showSignIn) { ?>
            <div id="header-sign-in"><a href="#">Sign In</a></div>
            <?php } ?>
            
            <div id="search">
                <div id="search-container">
                    <div id="search-trigger"><i class="fa fa-search"></i></div>
                    
                    <div id="search-form">
                        <form method="get" action="<?php echo home_url(); ?>">
                            <input type="search" name="s" id="search-box" class="text" />
                            <input type="button" value="&times;" id="search-clear" name="clear" />
                        </form>
                    </div>
                </div>
            </div><!-- #search -->
        </div><!-- #header-right -->
        
        <div class="clearfix"></div>
        
        <?php if (!empty($sub_nav)) { ?>
        <nav id="sub-nav">
            <ul id="sub-nav-menu">
                <?php 

                    wp_nav_menu(array(
                        'theme_location' => $sub_nav,
                        'container' => false,
                        'items_wrap' => '%3$s'
                    ));

                ?>
            </ul>
        </nav>
        <?php } ?>
        
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
/*
                    wp_nav_menu(array(
                        'theme_location' => 'primary-menu',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'depth' => 1
                    ));
*/
                ?>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-156125"><a href="http://skiftish.staging.wpengine.com/2016">News</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-156126"><a href="http://trends.skift.com/?__hstc=1833966.56de81dfb3bc35b495ac0e939473766a.1459881803857.1473884975445.1473895021008.110&amp;__hssc=1833966.2.1473895021008&amp;__hsfp=1775577900">Research</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-156127"><a href="http://forum.skift.com/?__hstc=1833966.56de81dfb3bc35b495ac0e939473766a.1459881803857.1473884975445.1473895021008.110&amp;__hssc=1833966.2.1473895021008&amp;__hsfp=1775577900">Conferences</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-196026"><a href="#">Services</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-196029"><a href="https://skift.com/newsletters/?__hstc=1833966.56de81dfb3bc35b495ac0e939473766a.1459881803857.1473884975445.1473895021008.110&amp;__hssc=1833966.2.1473895021008&amp;__hsfp=1775577900">Newsletters</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-196035"><a href="#">Advertising</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-186520"><a href="https://edu.skift.com/?__hstc=1833966.56de81dfb3bc35b495ac0e939473766a.1459881803857.1473884975445.1473895021008.110&amp;__hssc=1833966.2.1473895021008&amp;__hsfp=1775577900">Education</a></li>
            </ul>
        </nav>
    </header>
    
	<div id="header-pad"></div>
</div>