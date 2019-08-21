$(function() {
    var generateShareLink = function(baseLink, urlencode) {
        var shareLink = location.href;

        if (urlencode) {
            shareLink = encodeURIComponent(shareLink);
        }

        baseLink = baseLink.replace("_SHARELINK_", shareLink);

        return baseLink;
    };

    var socialPop = function(baseLink, title,width,height) {
        var link = generateShareLink(baseLink, true);
        window.open(link, title, "width=" + width + ", height=" + height + ", menubar=no, resizable=no, scrollbars=no, status=no, toolbar=no, titlebar=no");
    };

    var getGAtag = function(isTop) {
        var location = "bottom";

        if (isTop) {
          location = "top";
        }

        var gaTag = "article share button - " + location;

        return gaTag;
    };

    $(document).on("click",".article-social-btn.facebook,.header-social-btn.facebook",function() {
        ga('send', 'event', getGAtag($(this).hasClass("top")), 'Facebook', location.href);
        socialPop("http://www.facebook.com/share.php?u=_SHARELINK_&title=" + encodeURIComponent(document.title), "Share on Facebook", 555, 350);
    });

    $(document).on("click",".article-social-btn.twitter,.header-social-btn.twitter",function() {
        ga('send', 'event', getGAtag($(this).hasClass("top")), 'Twitter', location.href);

        var articleTitle = document.title.replace(" – Skift","");

        if (articleTitle.length > 241) {
            articleTitle = articleTitle.substring(0,70) + "[...]";
        }

        socialPop("http://twitter.com/share?url=_SHARELINK_&via=Skift&text=" + encodeURIComponent(articleTitle), "Tweet", 555, 275);
    });

    $(document).on("click",".article-social-btn.linkedIn,.header-social-btn.linkedIn",function() {
        ga('send', 'event', getGAtag($(this).hasClass("top")), 'LinkedIn', location.href);
        socialPop("http://www.linkedin.com/shareArticle?mini=true&url=_SHARELINK_&title=" + encodeURIComponent(document.title) + "&source=skift.com", "Share on LinkedIn", 555, 450);
    });

    $(document).on("click",".article-social-btn.email,.header-social-btn.email",function() {
        ga('send', 'event', getGAtag($(this).hasClass("top")), 'Email', location.href);
        var link = generateShareLink("_SHARELINK_", false);

        location.href = "mailto:?subject=" + encodeURIComponent(document.title) + "&body=" + encodeURIComponent(document.title + " " + link);
    });
});