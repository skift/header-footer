$(function() {
    var generateShareLink = function(baseLink, urlencode) {
        var shareLink = location.href;

        if (urlencode) {
            shareLink = encodeURIComponent(shareLink);
        }

        baseLink = baseLink.replace('_SHARELINK_', shareLink);

        return baseLink;
    };

    var socialPop = function(baseLink, title,width,height) {
        var link = generateShareLink(baseLink, true);
        window.open(link, title, 'width=' + width + ', height=' + height + ', menubar=no, resizable=no, scrollbars=no, status=no, toolbar=no, titlebar=no');
    };

    var getGAtag = function(isTop) {
        var location = 'bottom';

        if (isTop) {
          location = 'top';
        }

        var gaTag = 'article share button - ' + location;

        return gaTag;
    };

    var sendSocialToGA = function(isTop, network) {
        if (typeof window.gtag === 'function') {
            window.gtag('event', getGAtag(isTop), {
                'network': network,
                'url': location.href
            });
        }
    };

    $(document).on('click', '.article-social-btn.facebook, .header-social-btn.facebook', function() {
        socialPop('http://www.facebook.com/share.php?u=_SHARELINK_&title=' + encodeURIComponent(document.title), 'Share on Facebook', 555, 350);

        sendSocialToGA($(this).hasClass('top'), 'Facebook');
    });

    $(document).on('click', '.article-social-btn.twitter, .header-social-btn.twitter', function() {
        var articleTitle = document.title.replace(' – Skift', '');

        if (articleTitle.length > 241) {
            articleTitle = articleTitle.substring(0,70) + '[...]';
        }

        socialPop('http://twitter.com/share?url=_SHARELINK_&via=Skift&text=' + encodeURIComponent(articleTitle), 'Tweet', 555, 275);
    
        sendSocialToGA($(this).hasClass('top'), 'Twitter');
    });

    $(document).on('click', '.article-social-btn.linkedIn, .header-social-btn.linkedIn', function() {
        socialPop('http://www.linkedin.com/shareArticle?mini=true&url=_SHARELINK_&title=' + encodeURIComponent(document.title) + '&source=skift.com', 'Share on LinkedIn', 555, 450);
        
        sendSocialToGA($(this).hasClass('top'), 'LinkedIn');
    });

    $(document).on('click', '.article-social-btn.email, .header-social-btn.email', function() {
        var link = generateShareLink('_SHARELINK_', false);

        location.href = 'mailto:?subject=' + encodeURIComponent(document.title) + '&body=' + encodeURIComponent(document.title + ' ' + link);
    
        sendSocialToGA($(this).hasClass('top'), 'Email');
    });
});