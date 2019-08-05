<div id="header-sign-in-with-popover"<?php if ($signed_in) { echo ' class="my-account"'; } ?>>
    <div class="overlay"></div>
    <?php
    if (!$signed_in && !$whitelisted_org) {
        ?>
        <div class="sign-in"><a href="<?php if (function_exists('mysk_get_login_link')) echo mysk_get_login_link(); ?>" class="sign-in-btn">Sign In</a></div>
        <?php
    } else if ($whitelisted_org) {
        ?>
        <div class="sign-in"><?php echo "Welcome $white_listed!"; ?></div>
        <?php
    } else {
        ?>
        <div class="sign-in hasPopover">
            <a href="javascript:" class="sign-in-btn my-account-btn">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-user fa-stack-1x"></i>
                </span>
            </a>

            <div id="sign-in-popover" class="popover">
                <ul id="my-account-menu">
                    <li><a href="<?php if (function_exists('mysk_get_dashboard_link')) echo mysk_get_dashboard_link(); ?>">Account</a></li>
                    <li><a href="<?php if (function_exists('mysk_get_logout_link')) echo mysk_get_logout_link();  ?>" class="logout-btn">Sign Out</a></li>
                </ul>

                <?php
                global $mysk_current_user;
                if ($mysk_current_user && !empty($mysk_current_user->name)) {
                    ?>
                    <p>Welcome, <?php echo $mysk_current_user->name; ?>!</p>
                    <?php
                } else {
                    ?>
                    <p>Welcome!</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="overlay"></div>
        <?php
    }
    ?>
</div>