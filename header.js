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
  
  
    if ($(".mtsnb").length && $(".mtsnb").is(":visible")) {
        headerTop = $(".mtsnb").height();
        setHeaderOffset();
        setHeaderFixed(true);
    }
    
    $(".mtsnb-hide").click(function() {
        headerTop = 0; 
        setHeaderFixed(true);
    });
  

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
  

    //article pages generate their own header ad bacause sometimes the first story is sponsored and we want a targeted ad
    if (!$("#articleContainer").length && $("#top-banner").length && typeof createAd === "function") {
        var headerAd = {
            adClass: 'landscapeAd headerAd',
            slot: '/22809282/leaderboard',
            size: [[728, 90],[970,90],[970,250],[970,418]],
            mobileSize: [[300,250],[300,90]],
            ignoreContainerHeight: true,
            appendTo: $("#top-banner")
        };
        
        var useAirlinesAd = false;
        
        if ($("#archive-tag").length) {
            //tag page eg: airlines
            
            var pageName = $("#archive-header-container h1").text();
            
            if (pageName === "Airlines") {
                useAirlinesAd = true;
            }
        }
        
        if (useAirlinesAd) {
            console.log("use airlines ad");
            headerAd = {
                adClass: 'landscapeAd headerAd',
                slot: '/22809282/airlines',
                size: [970,90],
                ignoreContainerHeight: true,
                appendTo: $("#top-banner")
            };
        }
    
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


    // Header sign in popover
    
    if ($("#header-sign-in-with-popover").length) {
        
        var clearLoginState = function() {
            var $form = $("#header-sign-in-with-popover");
            var errorText = $form.find(".error-text");
            
            errorText.fadeOut(function() {
                $form.find(".form-group").removeClass("has-error");
            });
        };
        
        $("body").keyup(function(e) {
           if (e.keyCode === 27 && $(".sign-in").hasClass("isOpen")) {
               $(".sign-in").removeClass("isOpen");
               clearLoginState();  
           }
        });
        
        $(".sign-in-btn").click(function() {
            $(".sign-in").toggleClass("isOpen");
            clearLoginState(); 
            
            $("#sign-in-popover input").each(function() {
                if ($(this).val() !== "") {
                    $(this).parent().addClass("has-text");
                }
            });
        });
        
        $("#my-account-menu li:first-child a").hover(function() {
           $("#sign-in-popover").addClass("green-arrow"); 
        }, function() {
           $("#sign-in-popover").removeClass("green-arrow"); 
        });
        
        $("#header-sign-in-with-popover #overlay").click(function() {
            $(".sign-in").removeClass("isOpen"); 
            clearLoginState(); 
        });
        
        $(".sign-in").click(function(e) {
           e.stopPropagation();
        });
                
        var showLoginError = function(message, success) {
            var $form = $("#header-sign-in-with-popover");
            var errorText = $form.find(".error-text");
            
            errorText.fadeOut(function() {
                errorText.text(message).fadeIn();
               
                if (success) {
                    errorText.css("background-color","#4A9A4E");
                } else {
                    errorText.css("background-color","#d14339");
                } 
            });
        };
        
        $(".logout-btn").click(function() {
           document.cookie = "usr=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
           location.reload();
        });
        
        $("#sign-in-popover input").keyup(function() {
            if ($(this).val() !== "") {
                $(this).parent().addClass("has-text");
            } else {
                $(this).parent().removeClass("has-text");
            }
        });
        
        $(".login-btn").click(function(e) {
            
            var $form = $(this).closest("form");
            var goodToGo = true;
            
            $form.find("input").each(function() {
//                 $(this).parent().removeClass("has-error");
                
                if ($(this).val() === "") {
                    goodToGo = false;
                    
//                     $(this).parent().addClass("has-error");
                }   
            });
            
            if (goodToGo) {
                $(this).html('<i class="fa fa-cog fa-spin"></i> Sign In');
                
                $form.find("input,button").attr("disabled", true);
                
                $.ajax({
                    url: "https://wallkit.herokuapp.com/api/v1/user/authentication",
                    method: "POST",
                    data: { user: { email: $form.find(".username-field").val(), password: $form.find(".password-field").val() } },
                    complete: function() {
                        $form.find("button").html("Sign In");
                        $form.find("input,button").attr("disabled", false);
                    },
                    success: function(response) {
                        console.log("returned!", response);
                        //location.reload();
                        
                        document.cookie = "usr=" + response.data.token + "; path=/";
                        
                        showLoginError("You are now logged in",true);
                        
                        setTimeout(function() {
                            location.reload();
                        },500);
                    },
                    error: function(e) {
                        console.log("Error",e);
                        if (e.status === 401) {
                            console.log("bad auth!", e);
                            
                            showLoginError(e.responseJSON.error_description);
                        } else {
                            showLoginError("An unexpected error occured!");
                        }
                       
                    }
                });
            } else {
                showLoginError("Please enter both your email address and password.")
            }
            
            
            e.preventDefault();
            return false; 
        });
    }
    
});