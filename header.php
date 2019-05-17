<?php
require_once('partials/variables.php');

/*
New header config variables, change this to whatever method you want
*/
$logo = $logo ?? '<img src="' . get_template_directory_uri() . '/header-footer/img/logo.svg' . '" class="svg" alt="Skift logo" />';
$search_placeholder = $search_placeholder ?? 'Search';
$search_action = $search_action ?? home_url();
$search_query_string = $search_query_string ?? 's';
$primary_nav_name = $primary_nav_name ?? 'primary-nav';
$mobile_nav_name = $mobile_nav_name ?? 'primary-nav';

$primary_nav_max_width = $primary_nav_max_width ?? '650px';

global $url_paths;

$url_paths = array(
    "main"      => "https://skift.com",
    "trends"    => "https://research.skift.com",
    "edu"       => "http://edu.skift.com",
    "forum"     => "http://forum.skift.com",
    "skiftx"    => "http://www.skiftx.com",
    "myskift"   => "https://my.skift.com",
    "table"     => "https://table.skift.com",
    "wellness"  => "https://wellness.skift.com"
);

if ($_SERVER['HTTP_HOST'] === "localhost") {
    $url_paths = array(
        "main"      => "http://localhost/skift",
        "trends"    => "http://localhost/trends",
        "edu"       => "http://localhost/edu",
        "forum"     => "http://localhost/forum",
        "skiftx"    => "http://localhost/skiftx",
        "myskift"   => "http://localhost:3000",
        "table"     => "http://localhost/chefstech",
        "wellness"  => "http://localhost/wellness"
    );
}

if (strpos($_SERVER['HTTP_HOST'],".wpengine.com") !== false) {
    $url_paths = array(
        "main"      => "https://skiftish.staging.wpengine.com",
        "trends"    => "https://skiftproducts.staging.wpengine.com",
        "edu"       => "http://skiftedu.staging.wpengine.com",
        "forum"     => "http://skforums.staging.wpengine.com",
        "skiftx"    => "http://skiftx.staging.wpengine.com",
        "myskift"   => "https://myskiftv2.wpengine.com",
        "table"     => "https://chefstech.staging.wpengine.com",
        "wellness"  => "https://skiftwellness.staging.wpengine.com"
    );
}

if (strpos($_SERVER['HTTP_HOST'],"dev.") !== false) {
    $url_paths = array(
        "main"      => "https://dev.staging.wpengine.com",
        "trends"    => "http://dev.research.skift.com",
        "edu"       => "http://skiftedu.staging.wpengine.com",
        "forum"     => "http://skforum.staging.wpengine.com",
        "skiftx"    => "http://skiftx.staging.wpengine.com",
        "myskift"   => "https://my.skift.com",
        "table"     => "https://chefstech.staging.wpengine.com",
        "wellness"  => "https://skiftwellness.staging.wpengine.com"
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

if (function_exists('is_subscriber')) {
    $is_subscriber = isset($_COOKIE['usr']) && is_subscriber($_COOKIE['usr']);
} else {
    $is_subscriber = false;
}

$white_listed = false;
if (function_exists("is_whitelisted")) {
    $white_listed = is_whitelisted();
}
?>

<div id="header-container"<?php if ($has_sub_nav) { echo ' class="has-sub-nav"'; } ?>>

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
                <a href="<?php echo home_url(); ?>">
                    <?php echo $logo; ?>
                </a>
            </div>

            <?php 
            require_once('partials/nav.php');

            if ($show_login_form) {
                require_once('partials/wallkit.php');
            }
            ?>

            <div id="search-trigger"><i class="fa fa-search"></i></div>
            <div id="search-close">&times;</div>

            <div id="search-wrap">
                <i class="fa fa-search icon"></i>
                <form id="search-form" action="<?php echo $search_action; ?>" method="get">
                    <input type="search" placeholder="<?php echo $search_placeholder; ?>" name="<?php echo $search_query_string; ?>" class="search-box" />
                </form>
            </div>
        </div>

        <?php require_once('partials/mobile.php'); ?>
    </header>

	<div id="header-pad"></div>
</div>
<?php
    if ($show_login_form) {
        require_once('partials/mobile-account-manager.php');
    }
    require_once('partials/hubspot-loader.php');
?>
