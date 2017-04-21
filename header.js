var headerOffset;

$(function() {
  'use strict';

  var $header = $("#header");
  var $headerPad = $("#header-pad");
  var scrollOffset;
  var headerTop = 0;

  var noFix = $header.hasClass("no-fix");

  var setHeaderOffset = function() {
    headerOffset = $header.offset().top;
    headerOffset -= headerTop;

    scrollOffset = $(window).scrollTop();
  };

  setHeaderOffset();

  var setHeaderFixed = function(force) {

    if (!noFix) {

        if (scrollOffset >= headerOffset) {
            if (!$header.hasClass("fixed") || force) {
                $header.addClass("fixed").css("top",headerTop);
                $headerPad.show();
            }
        } else {
            if ($header.hasClass("fixed") || force) {
                $header.removeClass("fixed").css("top",0);
                $headerPad.hide();
            }
        }
    }
  };

  // replace svgs with pngs if svg isn't supported
  if (typeof Modernizr !== "undefinded" && Modernizr) {
      if (!Modernizr.svg) {
          $(".svg").each(function() {
             var image = $(this).attr("src");

             if (typeof image !== "undefined" && image) {
                 image = image.replace(".svg",".png");

                 $(this).attr("src",image);
             }
          });
      }
  }

  $("#mobile-search-close, #mobile-search #search-trigger").click(function() {
     $("#mobile-search-form").toggleClass("open");
  });

/*
    var lookForBouncexNanoBar = setInterval(function() {
        if ($(".bxc.bx-type-nanobar").length) {
            headerTop = $(".bxc.bx-type-nanobar .bx-slab").height();
            setHeaderFixed(true);
            setHeaderOffset();
            clearInterval(lookForBouncexNanoBar);
        }
    }, 50);


  var checkForNanoBar = function() {
      bouncex.bcxReady = function() {
        var bouncexcampaigns = bouncex.campaigns;

        for (var campaign in bouncexcampaigns) {
            if (bouncexcampaigns.hasOwnProperty(campaign)) {
                if (bouncexcampaigns[campaign].type === "nanobar") {

                   lookForBouncexNanoBar();

                }
            }
        }
      };
  };
*/

  if ($(".mtsnb").length && $(".mtsnb").is(":visible")) {
    headerTop = $(".mtsnb").height();
    setHeaderOffset();
    setHeaderFixed(true);
  }

  $(".mtsnb-hide").click(function() {
     headerTop = 0;
     setHeaderFixed(true);
  });

/*
    var checkForBouncex = setInterval(function() {
        if (typeof bouncex !== "undefined") {
            checkForNanoBar();
            clearInterval(checkForBouncex);
        }
    }, 50);
*/



  if (!$header.hasClass("no-banner") && !noFix) {
      $(window).scroll(function() {
        scrollOffset = $(window).scrollTop();

        setHeaderFixed();
      });
  }

  $("#mobileMenuBtn").click(function() {
    if ($(this).hasClass("open")) {
        $("#mobile-menu").fadeOut();

        //unlock scroll
        $("body").css({"overflow":"visible", "position":"relative"});
    } else {
        var lockScroll = function() {
            $("body").css({"overflow":"hidden", "position":"static"});
        };

        if (scrollOffset < headerOffset) {
            $("body").animate({ scrollTop:headerOffset },lockScroll);
        } else {
            lockScroll();
        }

        $("#mobile-menu").fadeIn();
     }
     $(this).toggleClass("open");
  });

  $("#search-trigger").click(function() {
    var headerRight = $("#header-right");

    if (headerRight.hasClass("open")) {
        $("#search-form form").submit();
    } else {
        $("#header-right").addClass("open");
    }
  });

  $("#search-box").click(function() {
    $("#header-right").addClass("open");
  });

  $("#search-clear").click(function() {
    $("#header-right").removeClass("open");
    $("#search-box").val('');
  });


  //article pages generate their own header ad bacause sometimes the first story is sponsored and we wanted a targeted ad
  if (!$("#articleContainer").length && $("#top-banner").length && typeof createAd === "function") {
    var headerAd = {
      adClass: 'landscapeAd headerAd',
      slot: '/22809282/leaderboard',
      size: [[728, 90],[970,90],[970,250],[970,418]],
      mobileSize: [[300,250],[300,90],[300,50]],
      ignoreContainerHeight: true,
      appendTo: $("#top-banner")
    };

    createAd(headerAd, setHeaderOffset);
  }

  //social share buttons
  var socialPop = function(link,title,width,height) {
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
    socialPop("http://www.facebook.com/share.php?u=" + encodeURIComponent(location.href) + "&title=" + encodeURIComponent(document.title), "Share on Facebook", 555, 350);
  });

  $(document).on("click",".article-social-btn.twitter,.header-social-btn.twitter",function() {
    ga('send', 'event', getGAtag($(this).hasClass("top")), 'Twitter', location.href);

    var articleTitle = document.title.replace(" – Skift","");

    if (articleTitle.length > 101) {
      articleTitle = articleTitle.substring(0,70) + "[...]";
    }
    socialPop("http://twitter.com/share?url=" + encodeURIComponent(location.href) + "&via=Skift&text=" + encodeURIComponent(articleTitle), "Tweet", 555, 275);
  });

  $(document).on("click",".article-social-btn.linkedIn,.header-social-btn.linkedIn",function() {
    ga('send', 'event', getGAtag($(this).hasClass("top")), 'LinkedIn', location.href);
    socialPop("http://www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(location.href) + "&title=" + encodeURIComponent(document.title) + "&source=skift.com", "Share on LinkedIn", 555, 450);
  });

  $(document).on("click",".article-social-btn.email,.header-social-btn.email",function() {
    ga('send', 'event', getGAtag($(this).hasClass("top")), 'Email', location.href);

    location.href = "mailto:?subject=" + encodeURIComponent(document.title) + "&body=" + encodeURIComponent(document.title) + " " + encodeURIComponent(location.href);
  });

  $("#search #search-trigger").click(function(e) {
    $("#header").toggleClass("searchOpen");

    if ($("#header").hasClass("searchOpen")) {
      $("#mobile-search .text").focus();
    } else {
      $("#mobile-search .text").blur();
    }

    e.stopPropagation();
  });


});
