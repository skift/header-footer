<?php
use Skift\MySkift\User;

/** Declare variables that may be defined in theme header.php */
$sub_nav = isset($sub_nav) ? $sub_nav : null;
$sub_nav_logo = isset($sub_nav_logo) ? $sub_nav_logo : null;
$has_sub_nav = !empty($sub_nav);
$select_tab = isset($select_tab) ? $select_tab : null;
$dont_show_banner_ad = isset($dont_show_banner_ad) ? $dont_show_banner_ad : null;
$show_login_form = isset($show_login_form) ? $show_login_form : null; //Defined in products/header.php
global $url_paths;
$url_paths = array(
    'main'      => 'https://skift.com',
    'trends'    => 'https://research.skift.com',
    'edu'       => 'http://edu.skift.com',
    'forum'     => 'https://forum.skift.com',
    'skiftx'    => 'http://www.skiftx.com',
    'myskift'    => 'https://my.skift.com'
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
        'myskift'    => 'https://my.skift.com'
    );
}

// user authentication

global $mysk_current_user;

if (!$mysk_current_user) {
    $mysk_current_user = User::get_current_user();
}

$whitelisted = mysk_current_whitelisted_org();

?>
