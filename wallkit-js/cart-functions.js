var cartItems;
var itemDetails = {};
var cartCloser;
var displayedCartItems = 0;
var latestFetcherId = null;

var refreshCart = function() {
    $cart = $(".shopping-cart .cart-contents");
    $cart.find(".cart-item:not(.template)").remove();

    if (cartItems.length !== displayedCartItems) {
        updateCartTotal(cartItems);
        displayedCartItems = cartItems.length;
    }

    $(".shopping-cart .badge").html(cartItems.length);

    if (cartItems.length > 0) {
        $cart.find(".no-items").fadeOut("fast");
        $(".shopping-cart .badge").show();
    } else {
        $cart.find(".no-items").fadeIn("fast");
        $(".shopping-cart .badge").hide();
    }

    var itemsLoading = 0;

    for (var i = 0; i < cartItems.length; i++) {
        var item = cartItems[i];
        var itemDetail = itemDetails[item.content_id];

        if (itemDetail) {
            if (itemDetail.loading) {
                continue;
            }

            var image = itemDetail.images && itemDetail.images.length ? itemDetail.images[0].url : null;

            $( $(".shopping-cart .cart-contents.popover .cart-item.template").clone() )
                .data("contentid", item.content_id).data("resourceid", item.resource_id)
                .find(".photo img").attr("src", image).end()
                .find(".item-name h3").html(itemDetail.title).end()
                .find(".item-price span").html(itemDetail.price / 100).end()
                .insertBefore($cart.find(".items .cart-item.template")).removeClass("template").fadeIn();
        } else {
            // load item
            loadItemDetails(item);
            itemsLoading++;
        }
    }

    if (itemsLoading === 0) {
        $cart.find('.spinner').hide();
    }

};

function loadItemDetails(item) {
    $('.shopping-cart .spinner').show();
    itemDetails[item.content_id] = { loading: true };

    var path = mySkiftAjaxPath + 'subscription-detail?contentId=' + item.content_id;
    if (item.type === 'content') {
        path = mySkiftAjaxPath + 'item?contentId=' + item.content_id
    }

    $.ajax({
        url: path,
        method: 'GET',
        success: function(response) {
            if (response.data && response.data.length) {
                itemDetails[item.content_id] = response.data[0];
                refreshCart();
            }
        }
    });
}

function updateCartTotal(items) {
    var promoCode = getCookie('promo_code');
    var fetcherId = Math.floor(Math.random()*10000);

    latestFetcherId = fetcherId;

    var data = {
        cart: items,
        fetcherId: fetcherId
    };

    if (promoCode) {
        data.promoCode = promoCode;
    }

    $.ajax({
        url: mySkiftAjaxPath + 'cart-price',
        method: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            console.log('cart total', response);

            if (latestFetcherId === response.fetcherId) {
                $(".shopping-cart .total-price").html(response.total);
            }
        }
    });
}


$(function() {
    cartItems = getCookie('cart_contents');

    if (cartItems) {
        cartItems = JSON.parse(cartItems);
    } else {
        cartItems = [];
    }

    console.log('cartItems', cartItems);
    refreshCart();

    $(document).on("click",".add-to-cart-btn",function() {
        var $button = $(this);

        var contentId = $button.data("contentid");
        var resourceId = $button.data("resourceid");
        var type = $button.data("type");

        if (typeof type === "undefined" || type === "") {
            type = "content";
        }

        var itemInfo = {
            type: type,
            resource_id: resourceId,
            content_id: contentId
        };

        cartItems.push(itemInfo);
        saveCart(cartItems);

//         $button.addClass("disabled in-cart-btn").removeClass("add-to-cart-btn").find(".btn-container").html("<i class='fa fa-cog fa-spin'></i> Adding to Cart");

        clearTimeout(cartCloser);

        $(".buy-btn[data-contentid=" + contentId + "]").addClass("disabled in-cart-btn").removeClass("add-to-cart-btn").find(".btn-container").html("<i class='fa fa-check'></i> In Cart");

        refreshCart();

        $(".shopping-cart").addClass("isOpen");

        cartCloser = setTimeout(function() {
            $(".shopping-cart").removeClass("isOpen");
        }, 3000);
    });

    $(document).on("click", ".remove-from-cart-btn", function() {
        var $button = $(this);
        var $cartItem = $button.closest(".cart-item");
        var $cart = $cartItem.closest(".cart-items");

        var contentId = $cartItem.data("contentid");
        var resourceId = $cartItem.data("resourceid");

        $button.html('<i class="fa fa-cog fa-spin"></i> Remove');
        $button.prop("disabled", true);

        //console.log("remove data", {contentId:contentId, resourceId:resourceId});



        var newCart = [];
        var removedItem;

        for (var i = 0, e = cartItems.length; i < e; i++) {
            if (!(cartItems[i].resource_id === resourceId && cartItems[i].content_id === contentId)) {
                newCart.push(cartItems[i]);
            } else {
                removedItem = cartItems[i];
            }
        }

        console.log('removed item', removedItem);

        if (removedItem) {
            if (removedItem.type === "content") {
                $(".buy-btn[data-contentid=" + removedItem.content_id + "]").addClass("add-to-cart-btn").removeClass("disabled in-cart-btn").find(".btn-container").html("<div><strong>Buy This Report Now</strong></div><span>$295</span>");
            } else {
                $(".buy-btn[data-contentid=" + removedItem.content_id + "]").addClass("add-to-cart-btn").removeClass("disabled in-cart-btn").find(".btn-container").html("Subscribe Now");
            }
        }

        cartItems = newCart;

        saveCart(cartItems);

        refreshCart();
    });

    $(".cart-btn").click(function() {
        if ($(".sign-in").hasClass("isOpen")) {
            $(".sign-in").removeClass("isOpen");
        }

        clearTimeout(cartCloser);

        $(".shopping-cart").toggleClass("isOpen");
    });

});

function saveCart(items) {
    var cart = JSON.stringify(items);
    console.log('save cart', cart);
    setCookie('cart_contents', cart, 30);
}

function setCookie(name, val, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = 'expires=' + d.toUTCString();

    var host = window.location.hostname;
    var domain = host === 'localhost' ? 'localhost' : host.indexOf('skift.com') !== -1 ? '.skift.com' : '.wpengine.com';

    document.cookie = name + '=' + val + ';' + expires + ';path=/;domain=' + domain;
}

function getCookie(cname) {
    var name = cname + '=';

    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }

    return false;
}