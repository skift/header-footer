$(function () {
    if ($('.account-menu').length) {
        $('.account-menu-btn').click(function () {
            $('.account-menu').toggleClass('isOpen');
        });

        $('.account-menu li:first-child').hover(function () {
            $('.account-menu-popover').addClass('green-arrow');
        }, function () {
            $('.account-menu-popover').removeClass('green-arrow');
        });
    }
});
