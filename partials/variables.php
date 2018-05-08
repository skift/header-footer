<?php
/** Declare variables that may be defined in theme header.php */
$sub_nav = isset($sub_nav) ? $sub_nav : null;
$sub_nav_logo = isset($sub_nav_logo) ? $sub_nav_logo : null;
$has_sub_nav = !empty($sub_nav);
$select_tab = isset($select_tab) ? $select_tab : null;
$dont_show_banner_ad = isset($dont_show_banner_ad) ? $dont_show_banner_ad : null;
$show_login_form = isset($show_login_form) ? $show_login_form : null; //Defined in products/header.php
die(var_dump($show_login_form));
global $url_paths;
$url_paths = array(
    'main'      => 'https://skift.com',
    'trends'    => 'https://research.skift.com',
    'edu'       => 'http://edu.skift.com',
    'forum'     => 'https://forum.skift.com',
    'skiftx'    => 'http://www.skiftx.com',
    'myskift'    => 'https://mybeta.skift.com'
);

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url_paths = array(
        'main'      => 'http://localhost/skift',
        'trends'    => 'http://localhost/trends',
        'edu'       => 'http://localhost/edu',
        'forum'     => 'http://localhost/forum',
        'skiftx'    => 'http://localhost/skiftx',
        'myskift'    => 'http://localhost:3000'
    );
}

if (strpos($_SERVER['HTTP_HOST'],'.wpengine.com') !== false) {
    $url_paths = array(
        'main'      => 'https://skiftish.staging.wpengine.com',
        'trends'    => 'https://skiftproducts.staging.wpengine.com',
        'edu'       => 'http://skiftedu.staging.wpengine.com',
        'forum'     => 'http://skforums.staging.wpengine.com',
        'skiftx'    => 'http://skiftx.staging.wpengine.com',
        'myskift'    => 'https://myskiftv2.wpengine.com'
    );
}

if (strpos($_SERVER['HTTP_HOST'],'dev.') !== false) {
    $url_paths = array(
        'main'      => 'https://dev.staging.wpengine.com',
        'trends'    => 'http://dev.research.skift.com',
        'edu'       => 'http://skiftedu.staging.wpengine.com',
        'forum'     => 'http://skforum.staging.wpengine.com',
        'skiftx'    => 'http://skiftx.staging.wpengine.com',
        'myskift'    => 'https://mybeta.skift.com'
    );
}

// user authentication
global $user_info;
$user_info = false;
$signed_in = false;
if (class_exists('User')) {
    // check user auth using the wallkit plugin
    $user_info = (new User())->info;
    $signed_in = !empty($user_info);
} else {
    if (function_exists('user_auth')) {
        // if here, we're on myskift, use the library
        $user_info = user_auth();
        $signed_in = !empty($user_info);
    }
}

$white_listed = false;
if (function_exists('is_whitelisted')) {
    $white_listed = is_whitelisted();
}

?>
