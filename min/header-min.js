var headerOffset,$header,$headerPad,noFix,scrollOffset=0;function setHeaderOffset(){headerOffset=$header.offset().top}function setHeaderFixed(e){noFix||($header.hasClass("fixed")&&null!==headerOffset||setHeaderOffset(),scrollOffset>=headerOffset?$header.hasClass("fixed")&&!e||($header.addClass("fixed").css("top",0),$headerPad.show()):($header.hasClass("fixed")||e)&&($header.removeClass("fixed").css("top",0),$headerPad.hide()))}$(function(){"use strict";if($header=$("#header"),$headerPad=$("#header-pad"),noFix=$header.hasClass("no-fix"),setHeaderOffset(),$header.hasClass("no-banner")||noFix||$(document).on("scroll",function(){scrollOffset=$(window).scrollTop(),setHeaderFixed()}),!$("#articleContainer").length&&!$("#skiftx-insight").length&&$("#top-banner").length&&"function"==typeof createAd){var e={adClass:"landscapeAd headerAd",slot:"/22809282/leaderboard",size:[[728,90],[970,90],[970,250],[970,418]],mobileSize:[[300,90],[300,50],[320,50]],ignoreContainerHeight:!0,appendTo:$("#top-banner")};createAd(e,function(){headerOffset=99999,setTimeout(function(){setHeaderOffset()},10)})}$("#mobileMenuBtn").click(function(){if($(this).hasClass("open"))$("#mobile-menu, #mobileMenuBtn").removeClass("open"),$("#header").removeClass("mobile-open"),$("body").css({overflow:"visible",position:"relative"});else{var e=function(){$("body").css({overflow:"hidden",position:"static"}),$("#mobile-menu, #mobileMenuBtn").addClass("open"),$("#header").addClass("mobile-open")};scrollOffset<headerOffset?$("html, body").animate({scrollTop:headerOffset},"fast",e):e()}})}),$(function(){$(document).on("click","#search-trigger, #search-close",function(e){$("#header").toggleClass("search-open"),$("#header").hasClass("search-open")&&$(".search-box").focus(),e.stopPropagation()}),$(document).on("click","#search-wrap .icon",function(){$("#search-form").submit()})}),$(function(){var e=function(e,t){var o=location.href;return t&&(o=encodeURIComponent(o)),e=e.replace("_SHARELINK_",o)},t=function(t,o,n,a){var s=e(t,!0);window.open(s,o,"width="+n+", height="+a+", menubar=no, resizable=no, scrollbars=no, status=no, toolbar=no, titlebar=no")},o=function(e){var t="bottom";return e&&(t="top"),"article share button - "+t};$(document).on("click",".article-social-btn.facebook,.header-social-btn.facebook",function(){ga("send","event",o($(this).hasClass("top")),"Facebook",location.href),t("http://www.facebook.com/share.php?u=_SHARELINK_&title="+encodeURIComponent(document.title),"Share on Facebook",555,350)}),$(document).on("click",".article-social-btn.twitter,.header-social-btn.twitter",function(){ga("send","event",o($(this).hasClass("top")),"Twitter",location.href);var e=document.title.replace(" – Skift","");e.length>241&&(e=e.substring(0,70)+"[...]"),t("http://twitter.com/share?url=_SHARELINK_&via=Skift&text="+encodeURIComponent(e),"Tweet",555,275)}),$(document).on("click",".article-social-btn.linkedIn,.header-social-btn.linkedIn",function(){ga("send","event",o($(this).hasClass("top")),"LinkedIn",location.href),t("http://www.linkedin.com/shareArticle?mini=true&url=_SHARELINK_&title="+encodeURIComponent(document.title)+"&source=skift.com","Share on LinkedIn",555,450)}),$(document).on("click",".article-social-btn.email,.header-social-btn.email",function(){ga("send","event",o($(this).hasClass("top")),"Email",location.href);var t=e("_SHARELINK_",!1);location.href="mailto:?subject="+encodeURIComponent(document.title)+"&body="+encodeURIComponent(document.title+" "+t)})}),$(function(){"undefinded"!=typeof Modernizr&&Modernizr&&(Modernizr.svg||$(".svg").each(function(){var e=$(this).attr("src");void 0!==e&&e&&(e=e.replace(".svg",".png"),$(this).attr("src",e))}))});