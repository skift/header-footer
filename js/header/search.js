$(function() {    
    $(document).on('click', '#search-trigger, #search-close', function(e) {
        $('#header').toggleClass('search-open');

        if ($('#header').hasClass('search-open')) {
            $('.search-box').focus();
        }
        e.stopPropagation();
    });

    $(document).on('click', '#search-wrap .icon', function() {
        $('#search-form').submit();
    });
});