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