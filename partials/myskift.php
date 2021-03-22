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
                    <?php
                    $logged_in = function_exists('mysk_current_reader_is_logged_in') ? mysk_current_reader_is_logged_in() : false;
                    if ($logged_in) {
                        ?>
                        <li><a href="<?php if (function_exists('mysk_get_dashboard_link')) echo mysk_get_dashboard_link(); ?>" rel="nofollow">Account</a></li>
                        <?php
                    }
                    ?>
                    <li><a href="<?php echo $logout_link; ?>" class="sign-out-btn trigger-sign-out" rel="nofollow">Sign Out</a></li>
                </ul>

                <?php
                $reader_name = function_exists('mysk_get_reader_name') ? mysk_get_reader_name() : false;
                if (!empty($reader_name)) {
                    ?>
                    <p>Welcome, <?php echo $reader_name; ?>!</p>
                    <?php
                } else if ($signed_in) {
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
