var hideBannerTimer;

function setBannerFadeoutTimer(bannerText) {
    hideBannerTimer = setTimeout(function() {
        bannerText.fadeOut(function() {
            $(this).removeClass("show");
        });
    }, 6000);
}

if ($(".error-text").is(":visible")) {
    setBannerFadeoutTimer($(".error-text"));
}

function showBannerMessage(message, $form, callback, success) {
    clearTimeout(hideBannerTimer);

    var bannerText = $form.find(".error-text");

    bannerText.fadeOut(function() {
        bannerText.text(message).fadeIn(function() {
            if (typeof callback === "function") {
                callback();
            }
        });

        if (success) {
            bannerText.addClass("success");
        } else {
            bannerText.removeClass("success");
        }

        setBannerFadeoutTimer(bannerText);
    });
}

function getQSParameterByName(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function() {
    // add-to-cart-btn

    var mySkiftAjaxPath = "https://my.skift.com/ajax/";
    var host = document.location.host;

    if (host.indexOf("localhost") > -1) {
        mySkiftAjaxPath = "http://localhost/myskift/ajax/";
    }
    
    if (host.indexOf("myskift.wpengine.com") > -1) {
        mySkiftAjaxPath = "http://myskift.wpengine.com/ajax/";
    }

    var currentCartContents;

    var cartCloser;

    var refreshCart = function(cartContents) {
        console.log("cart contents", cartContents);
        
        if (JSON.stringify(currentCartContents) !== JSON.stringify(cartContents) ) {            
            currentCartContents = cartContents;

            $cart = $(".shopping-cart .popover");

            $cart.find(".spinner").hide();

            $cart.find(".cart-item:not(.template)").remove();

            $cart.find(".total-price").html(cartContents.total);

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
                console.log("cart item", thisItem);

                $( $cart.find(".cart-item.template").clone() )
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

        $.post(mySkiftAjaxPath + "get-cart-contents.php", function(cartContents) {
            cartContents = $.parseJSON(cartContents);

            refreshCart(cartContents);
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

        console.log("add to cart", contentId, resourceId);

        clearTimeout(cartCloser);

        $.post(mySkiftAjaxPath + "add-to-cart.php", itemInfo, function(response) {
            console.log("response non-json",response);
            response = $.parseJSON(response);
            console.log("response",response);
            
            $button.css({ "height": $button.outerHeight(), "lineHeight": $button.height() + "px" }).html("<i class='fa fa-check'></i> Added to cart").addClass("disabled").removeClass("add-to-cart-btn");

            var cartContents = response.cartContents;

            refreshCart(cartContents);

            if ($(".sign-in").hasClass("isOpen")) {
                $(".sign-in").removeClass("isOpen");
            }

            $(".shopping-cart").addClass("isOpen");


            cartCloser = setTimeout(function() {
                $(".shopping-cart").removeClass("isOpen");
            }, 3000);
        });
    });

    var updateCartTotal = function($cart) {
        var total = 0;

        $cart.find(".cart-item").each(function() {
            total += parseFloat($(this).find(".item-price span").html());
        });

        $cart.find(".total-price").html(total);
    };

    $(document).on("click", ".remove-from-cart-btn", function() {
        var $button = $(this);
        var $cartItem = $button.closest(".cart-item");
        var $cart = $cartItem.closest(".cart-items");
        var index = $button.data("index");

        console.log("index", index);

        $button.html('<i class="fa fa-cog fa-spin"></i> Remove');
        $button.prop("disabled", true);

        $.post(mySkiftAjaxPath + "remove-from-cart.php", {index:index}, function(response) {
            console.log("response",response);
            $button.html('<i class="fa fa-trash"></i> Remove');

            $cartItem.fadeOut(function() {
               $(this).remove();

               if (!$cart.find(".cartItem").length) {
                   $cart.fadeOut();
                   $(".shopping-cart-page .totals-area").fadeOut(function() {
                       $(".shopping-cart-page .no-items").fadeIn();
                   });
               }
            });

            getCartContents();

        });
    });



    if ($("#header-sign-in-with-popover").length) {

        // Header sign in popover

        var clearLoginState = function() {
            var $form = $("#header-sign-in-with-popover");
            var bannerText = $form.find(".error-text");

            bannerText.fadeOut(function() {
                $form.find(".form-group").removeClass("has-error");
            });
        };

        $("body").keyup(function(e) {
           if (e.keyCode === 27 && $(".sign-in").hasClass("isOpen")) {
               $(".sign-in").removeClass("isOpen");
               clearLoginState();
           }
        });

        $(".cart-btn").click(function() {
            if ($(".sign-in").hasClass("isOpen")) {
                $(".sign-in").removeClass("isOpen");
            }

            getCartContents();

            $(".shopping-cart").toggleClass("isOpen");
        });

        $(".sign-in-btn").click(function() {
            if ($(".shopping-cart").hasClass("isOpen")) {
                $(".shopping-cart").removeClass("isOpen");
            }

            $(".sign-in").toggleClass("isOpen");

            clearLoginState();

            $("#sign-in-popover input").each(function() {
                if ($(this).val() !== "") {
                    $(this).parent().addClass("has-text");
                }
            });
        });

        $("#my-account-menu li:first-child a").hover(function() {
           $("#sign-in-popover").addClass("green-arrow");
        }, function() {
           $("#sign-in-popover").removeClass("green-arrow");
        });

        $("#header-sign-in-with-popover .overlay").click(function() {
            $(".sign-in, .shopping-cart").removeClass("isOpen");
            clearLoginState();
        });

        $(".sign-in").click(function(e) {
           e.stopPropagation();
        });

        $(".has-floating-label").keyup(function() {
            if ($(this).val() !== "") {
                $(this).parent().addClass("has-text");
            } else {
                $(this).parent().removeClass("has-text");
            }
        });

    }

    $(".login-btn").click(function(e) {
        var $form = $(this).closest(".login-form");

        var goodToGo = true;

        $form.find("input").each(function() {
//                 $(this).parent().removeClass("has-error");

            if ($(this).val() === "") {
                goodToGo = false;

//                     $(this).parent().addClass("has-error");
            }
        });

        var shakeLen = 65;
        var travelDist = 15;

        var shake = function(c, times) {
            c.css("position","relative");

            c.animate({
                left: "-"  + travelDist + "px"
            }, shakeLen, function() {
                c.animate({
                    left: travelDist + "px"
                }, shakeLen, function() {
                    if (times === 0) {
                        c.animate({
                            left: 0
                        }, shakeLen);
                    } else {
                        shake(c, --times);
                    }
                });
            });
        };

        if (goodToGo) {
            $(this).html('<i class="fa fa-cog fa-spin"></i> Sign In');

            $form.find("input,button").attr("disabled", true);

            var loginData = {
                login_email: $form.find(".username-field").val(),
                login_password: $form.find(".password-field").val()
            };

            $.post(mySkiftAjaxPath + "login.php", loginData, function(response) {
                response = $.parseJSON(response);
                console.log("response", response);

                $form.find("button").html("Sign In");
                $form.find("input,button").attr("disabled", false);

                if (response.success) {
                    showBannerMessage("You are now logged in", $form, function() {
                        var redirect = getQSParameterByName("redirect");

                        if (!redirect || redirect === "") {
                            location.href = homeUrl;
                        } else {
                            location.href = homeUrl + redirect;
                        }
                    }, true);
                } else {
                    showBannerMessage(response.errorMessage, $form)
                }
            });

        } else {
            showBannerMessage("Please enter both your email address and password.", $form)
        }


        e.preventDefault();
        return false;
    });

});
