var headerOffset;

$(function() {
  'use strict';
  
  var $header = $("#header");
  var $headerPad = $("#header-pad");
  var scrollOffset;
  var headerTop = 0;
  
  var setHeaderOffset = function() {
    headerOffset = $header.offset().top;
    scrollOffset = $(window).scrollTop();
  };
  
  setHeaderOffset();
  
  var setHeaderFixed = function() {
    if (scrollOffset >= headerOffset) {
        if (!$header.hasClass("fixed")) {
            $header.addClass("fixed").css("top",headerTop);
            $headerPad.show();
        }
    } else {
        if ($header.hasClass("fixed")) {
            $header.removeClass("fixed").css("top",0);
            $headerPad.hide();
        }
    }
  };
  
  var checkForNanoBar = function() {
      bouncex.bcxReady = function() {
        var bouncexcampaigns = bouncex.campaigns;
            
        for (var campaign in bouncexcampaigns) {
            if (bouncexcampaigns.hasOwnProperty(campaign)) {
                if (bouncexcampaigns[campaign].type === "nanobar") {
                                    
                    var lookForBouncexNanoBar = setInterval(function() {
                        if ($(".bxc.bx-type-nanobar").length) {
                            headerTop = $(".bxc.bx-type-nanobar .bx-slab").height();
                            setHeaderFixed();
                            clearInterval(lookForBouncexNanoBar);
                        }
                    }, 50);
                    
                }
            }
        }
      };
  };
  
    var checkForBouncex = setInterval(function() {
        if (typeof bouncex !== "undefined") {
            checkForNanoBar();
            clearInterval(checkForBouncex);
        }
    }, 50);


  
  if (!$header.hasClass("no-banner")) {
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
  if (!$("#articleContainer, .about-page").length) {
    var headerAd = {
      adClass: 'landscapeAd headerAd',
      slot: '/22809282/leaderboard',
      size: [[728, 90],[970,90],[970,250],[970,418]],
      mobileSize: [[300,250],[300,90]],
      ignoreContainerHeight: true,
      appendTo: $("#top-banner")
    };

    createAd(headerAd, setHeaderOffset);
  }
  
  //social share buttons
  var socialPop = function(link,title,width,height) {
    window.open(link, title, "width=" + width + ", height=" + height + ", menubar=no, resizable=no, scrollbars=no, status=no, toolbar=no, titlebar=no");
  };

  var getGAtag = function(isHeader) {
    var gaTag = "new social share button";
    if (isHeader) {
      gaTag += " - header";
    } else {
      gaTag += " - article";
    }

    return gaTag;
  };

  $(document).on("click",".header-social-btn.facebook",function() {
    ga('send', 'event', getGAtag($(this).hasClass("headerShareBtn")), 'Facebook', location.href);
    socialPop("http://www.facebook.com/share.php?u=" + encodeURIComponent(location.href) + "&title=" + encodeURIComponent(document.title), "Share on Facebook", 555, 350);
  });

  $(document).on("click",".header-social-btn.twitter",function() {
    ga('send', 'event', getGAtag($(this).hasClass("headerShareBtn")), 'Twitter', location.href);
    
    var articleTitle = document.title.replace(" – Skift","");
        
    if (articleTitle.length > 101) {
      articleTitle = articleTitle.substring(0,70) + "[...]";
    }
    socialPop("http://twitter.com/share?url=" + encodeURIComponent(location.href) + "&via=Skift&text=" + encodeURIComponent(articleTitle), "Tweet", 555, 275);
  });

  $(document).on("click",".header-social-btn.linkedIn",function() {
    ga('send', 'event', getGAtag($(this).hasClass("headerShareBtn")), 'LinkedIn', location.href);
    socialPop("http://www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(location.href) + "&title=" + encodeURIComponent(document.title) + "&source=skift.com", "Share on LinkedIn", 555, 450);
  });

  $(document).on("click",".header-social-btn.email",function() {
    ga('send', 'event', getGAtag($(this).hasClass("headerShareBtn")), 'Email', location.href);

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

/*
  $("#primary-nav .sub-menu").each(function() {
    $("<div><i class='fa fa-chevron-down'></i></div>").addClass("ddCarrot").appendTo($(this).prev());
  });
*/

/*
  function supportsSvg() {
     return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image", "1.1");
  }

  if (!supportsSvg()) {
    var nonSVGlogo = homeUrl + "/img/skift_text_logo_gray.png";
    $("#logo img").attr("src",nonSVGlogo);
  }
*/

  function setUpMenus() {
    
    $("#primary-nav .sub-menu:eq(0)").width($("#primary-nav .menu-item-has-children:eq(0)").outerWidth());

  }

//   setUpMenus();

/*
  var windowResizeOccured = false;

  $(window).resize(function() {
    windowResizeOccured = true;
  });

  setInterval(function() {
    if (windowResizeOccured) {
      setUpMenus();

      windowResizeOccured = false;
    }
  }, 1000);
*/


  // if(document.cookie.indexOf('no-letter') > 0){
  //   // jQuery('#top-signup').slideToggle();
  //   if (jQuery('#top-signup').is(':visible')) jQuery('#top-signup').css('display','none');
  // }

/*
  $("#top-signup .close-btn").click(function() {
    $("#top-signup").slideUp();
    var expires = 15*24*60*60 ; //15 days
    // expires = 15; // 15 seconds
    document.cookie = "sk_no_signup=hide; max-age="+expires+";path=/";
  });
*/


});