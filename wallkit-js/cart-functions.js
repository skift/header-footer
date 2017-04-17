$(function() {

    var currentCartContents;

    var cartCloser;

    var refreshCart = function(cartContents) {

        if (JSON.stringify(currentCartContents) !== JSON.stringify(cartContents) ) {
            currentCartContents = cartContents;

            $cart = $(".shopping-cart .cart-contents");

            $cart.find(".spinner").hide();

            $cart.find(".cart-item:not(.template)").remove();

            $(".shopping-cart .total-price").html(cartContents.pricing.discounted_total_price);
            $(".shopping-cart .pre-total-price").html(cartContents.pricing.total_price);
            $(".shopping-cart .discount").html(cartContents.pricing.discount);

            var items = cartContents.items;

            $(".shopping-cart .badge").html(items.length);

            if (items.length > 0) {
                $cart.find(".no-items").fadeOut("fast");
                $(".shopping-cart .badge").show();
            } else {
                $cart.find(".no-items").fadeIn("fast");
                $(".shopping-cart .badge").hide();
            }

            for (var i = 0; i < items.length; i++) {
                var thisItem = items[i];

                $( $(".shopping-cart .cart-contents.popover .cart-item.template").clone() )
                    .find(".photo img").attr("src", thisItem.image).end()
                    .find(".item-name h3").html(thisItem.title).end()
                    .find(".item-price span").html(thisItem.price).end()
                    .find(".remove-from-cart-btn").data("index", thisItem.index).end()
                    .insertBefore($cart.find(".items .cart-item.template")).removeClass("template").fadeIn();
            }
        }
    };

    var getCartContents = function() {
        clearTimeout(cartCloser);

        var rand = Math.random(); // add a random number to the ajax request to avoid caching issues

        $.ajax({
            url: mySkiftAjaxPath + "get-cart-contents.php",
            method: "POST",
            data: {rand:rand},
            dataType: "json",
            xhrFields: {
                withCredentials: true
            },
            error: function(reason) {
                console.error("error getting cart contents", reason);
            },
            success: refreshCart
        });
    };

    getCartContents();

    $(document).on("click",".add-to-cart-btn",function() {
        var $button = $(this);

        var contentId = $button.data("contentid");
        var resourceId = $button.data("resourceid");
        var type = $button.data("type");

        if (typeof type === "undefined" || type === "") {
            type = "content";
        }

        var itemInfo = {
            contentId: contentId,
            resourceId: resourceId,
            type: type
        };

        $button.html("<i class='fa fa-cog fa-spin'></i> Adding to Cart").addClass("disabled in-cart-btn").removeClass("add-to-cart-btn");

        clearTimeout(cartCloser);

        $.ajax({
            url: mySkiftAjaxPath + "add-to-cart.php",
            method: "POST",
            data: itemInfo,
            dataType: 'json',
            xhrFields: {
                withCredentials: true
            },
            error: function(reason) {
                $button.html("error");
                console.error("Error adding to cart", reason);
            },
            success: function(response) {
                //console.log("add to cart response", response);
                $button.html("<i class='fa fa-check'></i> In Cart");

                var cartContents = response.cartContents;

                refreshCart(cartContents);

                if ($(".sign-in").hasClass("isOpen")) {
                    $(".sign-in").removeClass("isOpen");
                }

                $(".shopping-cart").addClass("isOpen");

                cartCloser = setTimeout(function() {
                    $(".shopping-cart").removeClass("isOpen");
                }, 3000);
            }
        });
    });

    $(document).on("click", ".remove-from-cart-btn", function() {
        var $button = $(this);
        var $cartItem = $button.closest(".cart-item");
        var $cart = $cartItem.closest(".cart-items");
        var index = $button.data("index");

        $button.html('<i class="fa fa-cog fa-spin"></i> Remove');
        $button.prop("disabled", true);

        $.ajax({
            url: mySkiftAjaxPath + "remove-from-cart.php",
            method: "POST",
            data: {index:index},
            dataType: "json",
            xhrFields: {
                withCredentials: true
            },
            error: function(reason) {
                $button.html("error");
            },
            complete: function(response) {
                $button.html('<i class="fa fa-trash"></i> Remove');

                $cartItem.fadeOut(function() {
                   $(this).remove();

                    if ($(".shopping-cart-page").length && $button.hasClass("floating-remove-from-cart-btn")) {
                        // user is on the cart page but deleted the item in the floating cart
                        location.reload();
                    } else {
                        if (!$cart.find(".cart-item").length) {
                            $cart.fadeOut();
                            $(".shopping-cart-page .totals-area").fadeOut(function() {
                                $(".shopping-cart-page .no-items").fadeIn();
                            });
                        }
                    }
                });

                getCartContents();

            }
        });
    });

    $(".cart-btn").click(function() {
        if ($(".sign-in").hasClass("isOpen")) {
            $(".sign-in").removeClass("isOpen");
        }

        getCartContents();

        $(".shopping-cart").toggleClass("isOpen");
    });

});