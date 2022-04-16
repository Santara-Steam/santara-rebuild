var swiper = new Swiper('#swiper-container-pralisting', {
    slidesPerView: 1,
    // init: false,
    pagination: {
        el: '#swiper-pagination-pralisting',
        clickable: true,
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    breakpoints: {
        768: {
            slidesPerView: 3,
            spaceBetween: 5,
        },
        1024: {
            slidesPerView: 3,
        },
    },
    navigation: {
        nextEl: '.swiper-button-pralisting-next',
        prevEl: '.swiper-button-pralisting-prev',
    }
});

var swiper = new Swiper('#swiper-container-pralisting-header', {
    pagination: {
        el: '.swiper-pagination-pralisting-header',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-pralisting-header-next',
        prevEl: '.swiper-button-pralisting-header-prev',
    }
});