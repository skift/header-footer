<div id="header-sign-in-with-popover"<?php if ($signed_in) { echo ' class="my-account"'; } ?>>
    <?php
    if (!$signed_in && !$whitelisted_org) {
        ?>
        <div class="account"><a href="<?php echo $login_link; ?>" class="account-btn" rel="nofollow">Sign In</a></div>
        <?php
    } else if ($whitelisted_org) {
        ?>
        <div class="account"><?php echo "Welcome $whitelisted_org!"; ?></div>
        <?php
    } else {
        ?>
        <div class="account account-menu">
            <a href="javascript:" class="account-menu-btn">
                <i class="fa fa-user"></i>
            </a>

            <div class="account-menu-popover">
                <ul>
                    <li><a href="<?php if (function_exists('mysk_get_dashboard_link')) echo mysk_get_dashboard_link(); ?>" rel="nofollow">Account</a></li>
                    <li><a href="<?php echo $logout_link; ?>" class="sign-out-btn trigger-sign-out" rel="nofollow">Sign Out</a></li>
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