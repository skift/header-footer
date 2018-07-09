$(function() {
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
});