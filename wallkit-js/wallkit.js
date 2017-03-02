function getQSParameterByName(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

// @codekit-append "myskift-path.js"
// @codekit-append "banner-messages.js"
// @codekit-append "cart-functions.js"
// @codekit-append "mobile-account-manager.js"
// @codekit-append "login.js"