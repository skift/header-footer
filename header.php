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
$is_subscriber = is_subscriber($_COOKIE['usr']);

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
            <!-- header banner loads into this -->
        </div>
        <!-- #top-banner -->
        <?php
    }
    ?>

    <header id="header" class="<?php if ($dont_show_banner_ad) { echo 'fixed no-banner'; } ?>">
        <div id="header-left">
            <div id="logo">
                <a href="<?php echo $url_paths['main']; ?>">
                    <img src="<?php echo get_template_directory_uri() ?>/header-footer/img/logo.svg" class="svg" alt="Skift Logo" />
                </a>
            </div>
            <?php require_once('partials/nav.php'); ?>
            <div class="clearfix"></div>
        </div>
        <!-- #header-menus -->

        <!-- #header-right (including Wallkit) -->
        <div id="header-right">
            <?php
                if ($show_login_form) {
                    require_once('partials/wallkit.php');
                } else {
                    require_once('partials/header-social.php');
                }
            ?>
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
        <!-- end #header-right -->
        <div class="clearfix"></div>
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
