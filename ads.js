var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];

(function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' === document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);


    // send sector page view to GA

    var sectorMapping = {
        'destinations': 'tourism',
        'africa': 'tourism',
        'asia-destinations': 'tourism',
        'australia-new-zealand-south-pacific': 'tourism',
        'central-south-america': 'tourism',
        'europe-destinations': 'tourism',
        'middle-east': 'tourism',
        'north-america': 'tourism',
        'digital': 'travel-tech',
        'booking-sites': 'online-booking',
        'media': 'travel-tech',
        'mobile': 'travel-tech',
        'services': 'travel-tech',
        'startups': 'travel-tech',
        'venture-capital': 'travel-tech',
        'food-beverage': 'food-beverage',
        'chefstech': 'food-beverage',
        'rooms': 'accommodations',
        'hotels': 'accommodations',
        'rentalsandshares': 'accommodations',
        'transport': 'airlines',  //maybe not?
        'airlines': 'airlines',
        'airports': 'airlines',
        'cars': 'ground-transport',
        'cruises': 'cruises',
        'transit': 'ground-transport',
        'trains': 'ground-transport',
        'travel-services': 'travel-agents-and-tour-operators',
        'corporate-travel': 'corporate-travel',
        'luxury-travel': 'travel-agents-and-tour-operators',
        'meetings-and-events': 'meetings-and-events',
        'tour-operators': 'travel-agents-and-tour-operators',
        'travel-agents': 'travel-agents-and-tour-operators'
    };

    if (categories && categories.length) {
        var sectors = [];
        var thisSector;


        // loop through all categories
        for (var i = 0; i < categories.length; i++) {
            thisSector = sectorMapping[categories[i]];
            ga('send', 'event', 'category', 'page view', categories[i]);

            // if we haven't sent a particular sector yet...
            if (typeof thisSector !== 'undefined' && thisSector && sectors.indexOf(thisSector) === -1) {
                sectors.push(thisSector);

                // ...and push it to GA
                ga('send', 'event', 'sector', 'page view', thisSector);
            }
        }
    }

})();

googletag.cmd.push(function() {
    googletag.pubads().enableSingleRequest();
    googletag.pubads().disableInitialLoad();
    googletag.enableServices();
});

function exists(obj) {
    return typeof obj !== "undefined" && obj;
}

var nextSlotID = 1;

function generateAdSlotID() {
    return 'skiftAd' + nextSlotID++;
}

function parseBool(bool) {
    return bool === "1" || bool === 1 || bool === "yes" || bool === "true" || bool ? true : false;
}

function lookForActualHeight(e) {
    var eHeight = e.height();

    if (eHeight === 0) {
        return lookForActualHeight(e.parent());
    } else {
        return eHeight;
    }
}

var screenWidth = function() { return $(window).width(); };

function removeIncompatibleAdSizes(ad) {
    var sizes = ad.size;

    if (typeof sizes[0] === "number") {
        sizes = [sizes];
    }

    var containerHeight = lookForActualHeight(ad.container);

    for (var i = sizes.length - 1; i >= 0; i--) {
        if (sizes[i].length !== 2) {
            sizes.splice(i,1);
        } else {
            if (typeof sizes[i][0] !== "number" || typeof sizes[i][1] !== "number") {
                sizes.splice(i,1);
            } else {
                if (!ad.ignoreContainerWidth && sizes[i][0] > ad.container.width()) {
                    sizes.splice(i,1);
                } else {
                    if (!ad.ignoreContainerHeight && sizes[i][1] > containerHeight) {
                        sizes.splice(i,1);
                    }
                }
            }
        }
    }

    return sizes;
}

function createAd(ad,callback) {
    if (!exists(ad.slot) || !exists(ad.size)) {
        return false;
    }

    if (exists(ad.mobileSize)) {
        if (screenWidth() <= 730) {
            ad.size = ad.mobileSize;
            ad.adClass = ad.adClass + ' mobileSize';
        }
    }

    ad.container = ad.appendTo;
    if (exists(ad.insertAfter)) {
        ad.container = ad.insertAfter.parent();
    }

    ad.size = removeIncompatibleAdSizes(ad);

    if (!ad.size.length || (exists(ad.minScreenSize) && (screenWidth() < ad.minScreenSize)) || (exists(ad.maxScreenSize) && (screenWidth() >= ad.maxScreenSize))) {
        return false;
    }

    ad.slotName = generateAdSlotID();

    var adContainer = $("<div />").attr("id",ad.slotName);

    if (exists(ad.adClass)) {
        adContainer.addClass(ad.adClass);
    }

    if (exists(ad.insertAfter)) {
        adContainer.insertAfter(ad.insertAfter);
    } else {
        if (exists(ad.appendTo)) {
            adContainer.appendTo(ad.appendTo);
        }
    }

    googletag.cmd.push(function() {
        var slot = googletag.defineSlot(ad.slot, ad.size, ad.slotName).addService(googletag.pubads());
        googletag.display(ad.slotName);

        if (exists(postID)) {
            slot.setTargeting("postID", postID);
        }

        if (exists(categories)) {
            slot.setTargeting("categories", categories);
        }

        if (exists(tags)) {
            slot.setTargeting("tags", tags);
        }

        if (exists(ad.targeted) && exists(ad.targeted.targetType) && exists(ad.targeted.target) ) {
            slot.setTargeting(ad.targeted.targetType, ad.targeted.target);
        } else {
        //  slot.clearTargeting();
        }

        googletag.pubads().refresh([slot]);


        if (typeof callback === "function") {
            googletag.pubads().addEventListener('slotRenderEnded', function(event) {
                if (event.slot.getSlotElementId() === ad.slotName) {
                    callback();
                }
            });
        }
    });
}
