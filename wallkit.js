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
    
    var mySkiftAjaxPath = "http://my.skift.com/ajax/";
    if (homeUrl.indexOf("localhost") !== false) {
        mySkiftAjaxPath = "http://localhost/myskift/ajax/";
    }
    
    var currentCartContents;
    
    var cartCloser;
    
    var refreshCart = function(cartContents) {
        console.log("cart contents", cartContents);
        
        if (JSON.stringify(currentCartContents) !== JSON.stringify(cartContents) ) {
            console.log("refresh", currentCartContents, cartContents);
            
            currentCartContents = cartContents;
            
            $cart = $(".shopping-cart .popover");
            
            $cart.find(".spinner").hide();
            
            $cart.find(".cart-item:not(.template)").remove();
            
            $cart.find(".total-price").html(cartContents.total);
            
            var items = cartContents.items;
            
            if (items.length > 0) {
                $cart.find(".no-items").fadeOut("fast");
            } else {
                $cart.find(".no-items").fadeIn("fast");
            }
            
            for (var i = 0; i < items.length; i++) {
                var thisItem = items[i];
                console.log(thisItem);
                
                $( $cart.find(".cart-item.template").clone() )
                    .find(".photo img").attr("src", thisItem.image).end() 
                    .find(".item-name h3").html(thisItem.title).end() 
                    .find(".item-price span").html(thisItem.price).end()
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
    
    $(document).on("click",".add-to-cart-btn",function() {
        var $button = $(this);
        
        var contentId = $button.data("contentid"); 
        var resourceId = $button.data("resourceid"); 
        
        var itemInfo = {
            contentId: contentId,
            resourceId: resourceId  
        };
        
        console.log("add to cart", contentId, resourceId);
        
        clearTimeout(cartCloser);

        $.post(mySkiftAjaxPath + "add-to-cart.php", itemInfo, function(response) {
            console.log("response non-json",response);
            response = $.parseJSON(response);
            console.log("response",response);
            
            var cartContents = response.cartContents;
            
            refreshCart(cartContents);
            
            if ($(".sign-in").hasClass("isOpen")) {
                $(".sign-in").removeClass("isOpen");
            }
            
            $(".shopping-cart").addClass("isOpen");
            
            
            cartCloser = setTimeout(function() {
                $(".shopping-cart").removeClass("isOpen");
            }, 5000);
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

        //a397868864c1ff5b5271927d2dff4b482e8cb121

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
                        
                        if (redirect === "") {
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
