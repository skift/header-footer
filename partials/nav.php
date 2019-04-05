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
            <div class="dropdown-menu">
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
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/all-categories/"><strong>All Sectors</strong></a></li>
                </ul>
            </div>
        </li>
        <li class="menu-item"><a href="<?php echo $url_paths['trends']; ?>/"<?php if ($select_tab === 'research') { echo ' class="selected"'; } ?>>Research</a></li>
        <li class="menu-item"><a href="<?php echo $url_paths['forum']; ?>/"<?php if ($select_tab === 'conferences') { echo ' class="selected"'; } ?>>Conferences</a></li>
        <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/newsletters/"<?php if ($select_tab === "newsletters") { echo ' class="selected"'; } ?>>Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
            <div class="dropdown-menu">
                <ul>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/daily/">Daily</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/weekly-review/">Weekly</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/business-of-loyalty/">Business of Loyalty</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/corporate-travel/">Corporate Travel</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/meetings/">Meetings</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/new-luxury/">New Luxury</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/travel-advisor/">Travel Advisor</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths['main']; ?>/newsletters/"><strong>All Newsletters</strong></a></li>
                </ul>
            </div>
        </li>
        <li class="menu-item"><a href="<?php echo $url_paths['skiftx']; ?>/"<?php if ($select_tab === 'advertising') { echo ' class="selected"'; } ?>>Advertising</a></li>
    </ul>
</nav>
