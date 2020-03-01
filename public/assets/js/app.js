var scrolled = 0;
$(document).ready(function () {
    $(".scroll-up").on('click', function () {
        scrolled = scrolled - 590;
        $(".list").animate({
            scrollTop: scrolled
        });
    });

    $(".scroll-down").on('click', function () {
        scrolled = scrolled + 590;
        $(".list").animate({
            scrollTop: scrolled
        });
    });
});

$(document).ready(function () {

    if ($(window).width() >= 490) {
        $('.carousel-custom').carousel({
            interval: 10000
        })

        $('.carousel-custom .carousel-item').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            if (next.next().length > 0) {
                next.next().children(':first-child').clone().appendTo($(this));
            }
            else {
                $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
            }
        });
    }
});

new WOW().init();