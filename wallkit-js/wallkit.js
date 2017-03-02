var hideBannerTimer;

var mySkiftPath = "https://my.skift.com/";
var host = document.location.host;

if (host.indexOf("localhost") > -1) {
    mySkiftPath = "http://localhost/myskift/";
}

if (host.indexOf(".wpengine.com") > -1) {
    mySkiftPath = "https://myskift.wpengine.com/";
}

if (host.indexOf("myskift.wpengine.com") > -1 || host.indexOf("my.skift.com") > -1) {
    mySkiftPath = "/";
}

var mySkiftAjaxPath = mySkiftPath + "ajax/";
    
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

// @codekit-append "cart-functions.js"
// @codekit-append "mobile-account-manager.js"
// @codekit-append "login.js"

