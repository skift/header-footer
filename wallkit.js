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

$(function() {
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

        $(".sign-in-btn").click(function() {
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

        $("#header-sign-in-with-popover #overlay").click(function() {
            $(".sign-in").removeClass("isOpen");
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
    
});
