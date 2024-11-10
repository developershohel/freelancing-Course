jQuery(function ($) {
    $("#img-carousel").owlCarousel({
        items: 4,
        margin: 50,
        loop: true,
        center: true,
        mouseDrag: true,
        touchDrag: true,
        pullDrag: false,
        freeDrag: false,
        // stagePadding: 200,
        merge: true,
        autoWidth: false,
        nav: true,
        rewind: false,
        navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        autoplaySpeed: true,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items : 1,
            },
            // breakpoint from 480 up
            480 : {
                items : 1,
            },
            // breakpoint from 768 up
            768 : {
                items : 2,
            },
            992:{
                items: 3
            }
        }
    });
});

