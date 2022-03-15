$(function () {

    if ($('.owl-2').length > 0) {
        $('.owl-2').owlCarousel({
            center: false,
            items: 1,
            stagePadding: 0,
            margin: 0,
            smartSpeed: 1000,
            // autoplay: true,
            nav: false,
            dots: false,
            pauseOnHover: true,
            // responsive:{
            //     600:{
            //         margin: 20,
            //         nav: true,
            //       items: 2
            //     },
            //     1000:{
            //         margin: 20,
            //         stagePadding: 0,
            //         nav: true,
            //       items: 3
            //     }
            // }
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                979: {
                    items: 3
                },
                1400: {
                    items: 4
                },
                1500: {
                    items: 4
                }
            },
        });
    }

})

$(function () {

    if ($('.owl-1').length > 0) {
        $('.owl-1').owlCarousel({
            center: true,
            items: 1,
            loop: false,
            stagePadding: 0,
            margin: 0,
            smartSpeed: 1000,
            // autoplay: true,
            nav: false,
            dots: false,
            pauseOnHover: true,
            infinite: true,
            singleItem: true,
            mobileFirst: true,
            // responsive:{
            //     600:{
            //         margin: 20,
            //         nav: true,
            //       items: 2
            //     },
            //     1000:{
            //         margin: 20,
            //         stagePadding: 0,
            //         nav: true,
            //       items: 3
            //     }
            // }
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                979: {
                    items: 3
                },
                1400: {
                    items: 4
                },
                1500: {
                    items: 4
                }
            },
        });
    }

})

$(document).ready(function () {
    console.log('in');
    var $tabs = $('.event-item');
    // $('.card-merchant-more', $tabs).hide();
    // $('#duration1', $tabs).hide();
    // $('.event-item')
    //     .hover(function () {
    //         if ($('.card-merchant-more', this).is(':visible')) {
    //             $('.card-merchant-more', this).slideUp(250);
    //             $('#totalDana', this).slideDown(250);
    //             $('#duration', this).slideDown(250);
    //             $('#duration1', this).slideUp(250);
    //             // $('#sosmed', this).slideDown(250);
    //         } else {
    //             $('.card-merchant-more', this).slideDown(250);
    //             $('#totalDana', this).slideUp(250);
    //             $('#duration', this).slideUp(250);
    //             $('#duration1', this).slideDown(250);
    //             // $('#sosmed', this).slideUp(250);
    //         }
    //     });
});