var headerOffset, $header, $headerPad, noFix, scrollOffset;

function setHeaderOffset() {
    headerOffset = $header.offset().top;
}

function setHeaderFixed(force) {
    if (!noFix) {
        if (!$header.hasClass('fixed') || headerOffset === null) {
            setHeaderOffset();
        }

        if (scrollOffset >= headerOffset) {
            if (!$header.hasClass('fixed') || force) {
                $header.addClass('fixed').css('top', 0);
                $headerPad.show();
            }
        } else {
            if ($header.hasClass('fixed') || force) {
                $header.removeClass('fixed').css('top', 0);
                $headerPad.hide();
            }
        }
    }
}

$(function() {
    'use strict';

    $header = $('#header');
    $headerPad = $('#header-pad');
    noFix = $header.hasClass('no-fix');

    setHeaderOffset();

    if (!$header.hasClass('no-banner') && !noFix) {
        $(document).on('scroll', function() {
            scrollOffset = $(window).scrollTop();
            setHeaderFixed();
        });
    }

    // article pages generate their own header ad bacause sometimes the first story is sponsored and we wanted a targeted ad
    if (!$('#articleContainer').length && !$('#skiftx-insight').length && $('#top-banner').length && typeof createAd === 'function') {
        var headerAd = {
            adClass: 'landscapeAd headerAd',
            slot: '/22809282/leaderboard',
            size: [[728, 90],[970,90],[970,250],[970,418]],
            mobileSize: [[300,90],[300,50],[320,50]],
            ignoreContainerHeight: true,
            appendTo: $('#top-banner')
        };

        createAd(headerAd, function() {
            headerOffset = 99999;

            setTimeout(function() {
                setHeaderOffset();
            }, 10);
        });
    }

    // mobile menu
    $('#mobileMenuBtn').click(function() {
        if ($(this).hasClass('open')) {
            $('#mobile-menu').fadeOut();

            //unlock scroll
            $('body').css({ overflow: 'visible', position: 'relative' });
        } else {
            var lockScroll = function() {
                $('body').css({ overflow: 'hidden', position: 'static' });
            };

            if (scrollOffset < headerOffset) {
                $('body').animate({ scrollTop: headerOffset }, lockScroll);
            } else {
                lockScroll();
            }

            $('#mobile-menu').fadeIn();
         }
         $(this).toggleClass('open');
    });
});
