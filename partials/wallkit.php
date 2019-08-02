<div id="header-sign-in-with-popover"<?php if ($signed_in) { echo ' class="my-account"'; } ?>>
    <div class="overlay"></div>
    <?php
    if (!$signed_in && !$white_listed) {
        ?>
        <div class="sign-in"><a href="<?php mysk_the_login_link();?>" class="sign-in-btn">Sign In</a></div>
        <?php
    } else if ($white_listed) {
        ?>
        <div class="sign-in"><?php echo "Welcome $white_listed!"; ?></div>
        <?php
    }
    ?>
</div>
