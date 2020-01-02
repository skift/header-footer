$(function () {
    if ($('.account-menu').length) {
        $(document).on('click', '.account-menu-btn', function() {
            $('.account-menu').toggleClass('isOpen');
        });

        $('.account-menu li:first-child').hover(function () {
            $('.account-menu-popover').addClass('green-arrow');
        }, function () {
            $('.account-menu-popover').removeClass('green-arrow');
        });

        $(document).on('click', 'body', function() {
            $('.account-menu').removeClass('isOpen');
        });

        $(document).on('click', '.account-menu', function(e) {
            e.stopPropagation();
        });
    }
});
