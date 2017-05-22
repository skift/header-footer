function getQSParameterByName(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function cookiesEnabled() {
    return navigator.cookieEnabled;
}

function addCookieWarning(after) {
    $("<div />").addClass("error-text stay").html("This site requires cookies to be enabled.").show().insertAfter(after);
}

// @codekit-append "wallkit-js/myskift-path.js"
// @codekit-append "wallkit-js/banner-messages.js"
// @codekit-append "wallkit-js/cart-functions.js"
// @codekit-append "wallkit-js/mobile-account-manager.js"
// @codekit-append "wallkit-js/login.js"
// @codekit-append "wallkit-js/wk-tracking.js
