<?php
    if ($show_login_form) {
        ?>
        <div id="header-sign-in-with-popover"<?php if ($signed_in) { echo ' class="my-account"'; } ?>>
            <?php
                if (!$white_listed) {
                    ?>
                    <div class="shopping-cart hasPopover">
                        <a href="javascript:" class="cart-btn">
                            <i class="fa fa-shopping-cart fa-lg"></i>
                            <div class="badge">0</div>
                        </a>

                        <div id="cart-popover" class="popover cart-contents">
                            <div class="items">
                                <div class='cart-item template'>
                                    <div class='photo'><img src='#' /></div>
                                    <div class='item-details'>
                                        <div class='item-name'><h3></h3></div>
                                        <div class='item-price'>$<span></span> USD</div>
                                        <div class='remove-item'><button class='btn btn-green btn-xs remove-from-cart-btn floating-remove-from-cart-btn'><i class='fa fa-trash'></i>  Remove</button></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class='no-items'><p><small><i>Your cart is empty</i></small></p></div>
                                <div class="spinner">Loading</div>
                            </div>
                            <div class="chin">
                                <div class="total">
                                    <strong>Total</strong>
                                    <div class="pull-right">$<span class="total-price">0</span> USD</div>
                                </div>

                                <div class="buttons">
                                    <a href="<?php echo $url_paths["myskift"]; ?>/cart" class="btn btn-green btn-sm">View Cart</a>
                                    <a href="<?php echo $url_paths["myskift"]; ?>/checkout" class="btn btn-yellow btn-sm">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
            <div class="overlay"></div>
            <?php
                if (!$signed_in && !$white_listed) {
                    $redirect = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    ?>
                    <div class="sign-in"><a href="<?php echo $url_paths["myskift"]; ?>/login?redirect=<?php echo urlencode($redirect);?>" class="sign-in-btn">Sign In</a></div>
                    <?php
                } else if ($white_listed) {
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
                                <li><a href="<?php echo $url_paths["myskift"]; ?>">Account</a></li>
                                <li><a href="<?php echo $url_paths["myskift"]; ?>/purchases">Purchases</a></li>
                                <li><a href="<?php echo $url_paths["myskift"]; ?>/payment">Payment Methods</a></li>
                                <li><a href="<?php echo $url_paths["myskift"]; ?>/profile">Your Profile</a></li>
                                <li><a href="<?php echo $url_paths["myskift"]; ?>/login" class="logout-btn">Sign Out</a></li>
                            </ul>

                            <?php
                                if ($user_info["first_name"] && $user_info["last_name"]) {
                                    ?>
                                    <p>Welcome, <?php echo $user_info["first_name"] . ' ' . $user_info["last_name"]; ?>!</p>
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
        <?php
    } else {
        ?>
        <div id="header-social">
            <div class="social-btn" title="Facebook"><a href="https://www.facebook.com/Skiftnews/" target="_blank"><i class="fa fa-facebook"></i></a></div>
            <div class="social-btn" title="Twitter"><a href="https://twitter.com/skift" target="_blank"><i class="fa fa-twitter"></i></a></div>
            <div class="social-btn" title="LinkedIn"><a href="https://www.linkedin.com/company/2641998" target="_blank"><i class="fa fa-linkedin"></i></a></div>
            <div class="social-btn instagram" title="Instagram"><a href="https://instagram.com/skiftnews" target="_blank"><i class="fa fa-instagram"></i></a></div>
        </div>
        <?php
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
