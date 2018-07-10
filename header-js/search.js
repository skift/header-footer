$(function() {
    $("#search-trigger").click(function(e) {
        var headerRight = $("#header-right");

        if (headerRight.hasClass("open")) {
            $("#search-form form").submit();
        } else {
            $("#header-right").addClass("open");
        }

        $("#header").toggleClass("searchOpen");

        if ($("#header").hasClass("searchOpen")) {
            $("#mobile-search .text").focus();
        } else {
            $("#mobile-search .text").blur();
        }

        e.stopPropagation();
    });

    $("#search-box").click(function() {
        $("#header-right").addClass("open");
    });

    $("#search-clear").click(function() {
        $("#header-right").removeClass("open");
        $("#search-box").val('');
    });

    $("#mobile-search-close, #mobile-search #search-trigger").click(function() {
        $("#mobile-search-form").toggleClass("open");
    });
});