$(function() {

    $(".mobile-account-manager .top").click(function(e) {
        $(".mobile-account-manager").toggleClass("open");
        e.stopPropagation();
    });
    
    $("body").click(function() {
        if ($(".mobile-acount-manager").hasClass("open")) {
            $(".mobile-acount-manager").removeClass("open");
        }
    });
    
});