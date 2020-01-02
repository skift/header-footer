<div id="header-sign-in-with-popover"<?php if ($signed_in) { echo ' class="my-account"'; } ?>>
    <?php
    if (!$signed_in && !$whitelisted_org && false) {
        ?>
        <div class="account"><a href="javascript:" class="account-btn trigger-sign-in">Sign In</a></div>
        <?php
    } else if ($whitelisted_org) {
        ?>
        <div class="account"><?php echo "Welcome $whitelisted_org!"; ?></div>
        <?php
    } else {
        ?>
        <div class="account account-menu">
            <a href="javascript:" class="account-menu-btn">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-user fa-stack-1x"></i>
                </span>
            </a>

            <div class="account-menu-popover">
                <ul>
                    <li><a href="<?php if (function_exists('mysk_get_dashboard_link')) echo mysk_get_dashboard_link(); ?>">Account</a></li>
                    <li><a href="javascript:" class="sign-out-btn trigger-sign-out">Sign Out</a></li>
                </ul>

                <?php
                global $mysk_current_user;
                if ($mysk_current_user && !empty($mysk_current_user->name)) {
                    ?>
                    <p>Welcome, <?php echo $mysk_current_user->name; ?>!</p>
                    <?php
                } else if ($mysk_current_user->is_authenticated) {
                    ?>
                    <p>Welcome!</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
