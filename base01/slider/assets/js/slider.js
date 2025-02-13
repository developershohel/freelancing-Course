jQuery(function ($) {
    $("#img-slick-slider").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        speed: 2000,
        adaptiveHeight: false,
        centerPadding: "60px",
        autoplay: true,
        autoplaySpeed: 2000,
        // fade: true,
        // cssEase: "linear",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
        prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-angle-right"></i></button>'
    });

    $("#img-carousel").slick(
        {
            autoplay: true,
            slidesToScroll: 4,
            slidesToShow:4
        }
    );
    // $("#img-carousel").owlCarousel({
    //     items: 4,
    //     margin: 50,
    //     loop: true,
    //     center: true,
    //     mouseDrag: true,
    //     touchDrag: true,
    //     pullDrag: false,
    //     freeDrag: false,
    //     // stagePadding: 200,
    //     merge: true,
    //     autoWidth: false,
    //     nav: true,
    //     rewind: false,
    //     navText: [
    //         '<i class="fa-solid fa-angle-left"></i>',
    //         '<i class="fa-solid fa-angle-right"></i>',
    //     ],
    //     autoplay: true,
    //     autoplayTimeout: 3000,
    //     autoplayHoverPause: true,
    //     autoplaySpeed: true,
    //     responsive: {
    //         // breakpoint from 0 up
    //         0: {
    //             items: 1,
    //         },
    //         // breakpoint from 480 up
    //         480: {
    //             items: 1,
    //         },
    //         // breakpoint from 768 up
    //         768: {
    //             items: 2,
    //         },
    //         992: {
    //             items: 3,
    //         },
    //     },
    // });
});
