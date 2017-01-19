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
    slot.setTargeting("postID", postID);
    slot.setTargeting("categories", categories);

    /*if (typeof categories !== 'undefined' && categories) {
    }*/

    slot.postID = postID;
    slot.categories = categories;
    console.log(slot);

    if (exists(ad.targeted) && exists(ad.targeted.targetType) && exists(ad.targeted.target) ) {
      slot.setTargeting(ad.targeted.targetType, ad.targeted.target);
    } else {
      slot.clearTargeting();
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
