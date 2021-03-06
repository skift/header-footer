<?php
/**
 * New header config variables, change this to whatever method you want
 */
$logo = $logo ?? '<img src="' . get_template_directory_uri() . '/header-footer/img/logo.svg' . '" class="svg" alt="Skift logo" />';
$search_placeholder = $search_placeholder ?? 'Search';
$search_action = $search_action ?? home_url();
$search_query_string = $search_query_string ?? 's';
$primary_nav_name = $primary_nav_name ?? 'primary-nav';
$mobile_nav_name = $mobile_nav_name ?? 'primary-nav';
$login_link = function_exists('mysk_get_login_link') ? mysk_get_login_link() : home_url() . '/auth/login';
$logout_link = home_url() . '/auth/logout';
$primary_nav_max_width = $primary_nav_max_width ?? '650px';

global $url_paths;

$url_paths = [
    'main'      => 'https://skift.com',
    'trends'    => 'https://research.skift.com',
    'forum'     => 'http://forum.skift.com',
    'skiftx'    => 'http://www.skiftx.com',
    'myskift'   => 'https://my.skift.com',
    'table'     => 'https://table.skift.com',
    'wellness'  => 'https://wellness.skift.com'
];

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url_paths = [
        'main'      => 'http://localhost/skift',
        'trends'    => 'http://localhost/trends',
        'forum'     => 'http://localhost/forum',
        'skiftx'    => 'http://localhost/skiftx',
        'myskift'   => 'http://localhost:3000',
        'table'     => 'http://localhost/chefstech',
        'wellness'  => 'http://localhost/wellness'
    ];
}

if (strpos($_SERVER['HTTP_HOST'],'.wpengine.com') !== false) {
    $url_paths = [
        'main'      => 'https://skiftstaging.wpengine.com',
        'trends'    => 'https://skresstaging.wpengine.com',
        'forum'     => 'http://skforumstaging.wpengine.com',
        'skiftx'    => 'http://skiftxstaging.wpengine.com',
        'myskift'   => 'https://myskstaging.wpengine.com',
        'table'     => 'https://sktablestaging.wpengine.com',
        'wellness'  => 'https://skwellstaging.wpengine.com'
    ];
}

// user authentication
global $mysk_current_user;
if (!$mysk_current_user && function_exists('mysk_get_current_user')) {
    $mysk_current_user = mysk_get_current_user();
}
$signed_in = !empty($mysk_current_user) && $mysk_current_user->is_authenticated;
$is_subscriber = function_exists('mysk_current_user_is_subscriber') && mysk_current_user_is_subscriber();
$whitelisted_org = function_exists('mysk_current_whitelisted_org') ? mysk_current_whitelisted_org() : false;
?>

<div id="header-container">

    <?php
    if (!$dont_show_banner_ad) {
        ?>
        <div id="top-banner">
            <!-- header banner loads into this container -->
        </div>
        
        <?php
    }
    ?>

    <header id="header" class="<?php if ($dont_show_banner_ad) { echo 'fixed no-banner'; } ?>">
        <div id="header-wrap">
            <div id="logo">
                <a href="<?php echo apply_filters('sk_header_logo_url', home_url()); ?>">
                    <?php echo $logo; ?>
                </a>
            </div>

            <?php 
            require_once 'partials/nav.php';

            if ($show_login_form) {
                require_once 'partials/myskift.php';
            }
            ?>

            <?php 
            
            $show_search = apply_filters('sk_header_show_search', true);

            if ($show_search) {
                ?>
                <div id="search-trigger"><i class="fa fa-search"></i></div>
                <div id="search-close">&times;</div>

                <div id="search-wrap">
                    <i class="fa fa-search icon"></i>
                    <form id="search-form" action="<?php echo $search_action; ?>" method="get">
                        <input type="search" placeholder="<?php echo $search_placeholder; ?>" name="<?php echo $search_query_string; ?>" class="search-box" />
                    </form>
                </div>
                <?php
            }
            
            ?>
        </div>

        <?php
        require_once 'partials/mobile.php'; 
        ?>
    </header>

	<div id="header-pad"></div>
</div>
<?php
    require_once 'partials/hubspot-loader.php';
?>