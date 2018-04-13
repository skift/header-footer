<div class="mobile-account-manager shopping-cart">
    <div class="top">
        <div class="user-info">
            <?php
            if ($signed_in) {
                ?>
                <a href="<?php echo $url_paths['myskift'];?>/">
                    <span class="fa-stack">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-user fa-stack-1x"></i>
                    </span>
                    <?php echo $user_info['first_name'] . ' ' . $user_info['last_name']; ?>
                </a>
                <?php
            } else {
                ?>
                <a href="<?php echo $url_paths['myskift'];?>/login">Sign In</a>
                <?php
            }
            ?>
        </div>

        <div class="cart-btn">
            <i class="fa fa-shopping-cart fa-lg"></i>
            <div class="badge">0</div>
        </div>

        <div class="close-mobile-account-manager"><i class="fa fa-close"></i></div>
    </div>

    <div class="mobile-cart-items cart-contents">
        <div class="items">
            <div class='cart-item template'>
                <div class='photo'><img src='#' /></div>
                <div class='item-details'>
                    <div class='item-name'><h3></h3></div>
                    <div class='item-price'>$<span></span></div>
                    <div class='remove-item'><button class='btn btn-green btn-xs remove-from-cart-btn'><i class='fa fa-trash'></i>  Remove</button></div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class='no-items'><p><small><i>Your cart is empty</i></small></p></div>
            <div class="spinner">Loading</div>
        </div>

        <div class="totals-area">
            <div class="total">
                <strong>Total</strong>
                <div class="pull-right">$<span class="total-price">0</span></div>
            </div>

            <div class="buttons">
                <a href="<?php echo $url_paths['myskift']; ?>/cart" class="btn btn-green btn-sm">View Cart</a>
                <a href="<?php echo $url_paths['myskift']; ?>/checkout" class="btn btn-yellow btn-sm">Checkout</a>
            </div>
        </div>
    </div>

</div>
