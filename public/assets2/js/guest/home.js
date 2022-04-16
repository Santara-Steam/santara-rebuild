var swiper = new Swiper('#swiper-container-header', {
    lazy: true,
    slidesPerView: 1,
    centeredSlides: true,
    pagination: {
        el: '#swiper-pagination-header',
        clickable: true,
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
});

var swiper = new Swiper('#swiper-container-testimoni', {
    // Enable lazy loading
    lazy: true,
    pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true
    },
    navigation: {
        nextEl: '.swiper-button-testimoni-next',
        prevEl: '.swiper-button-testimoni-prev',
    },
});

var count_supporter = document.getElementById('count_supporter').value;
var swiper = new Swiper('#swiper-container-supporter', {
    slidesPerView: 3,
    freeMode: true,
    pagination: {
        el: '.swiper-pagination'
    },
    breakpoints: {
        640: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: count_supporter,
        },
        1024: {
            slidesPerView: count_supporter,
        },
    }
});


function pralistingDetail(url) {
    window.location.href = url;
}

function chooseBussiness(type) {
    fetchBussinessList({ type });
}

function fetchBussinessList(typeBussiness) {
    $.ajax({
        url: `/home/fetchTypeBussiness`,
        type: 'POST',
        dataType: "json",
        data: typeBussiness,
        timeout: 20000,
        success: function(data) {
            console.log('datadata', data)
            $('.view-bussiness-changer').html(data.datas);
        },
        error: function(data) {
            console.log('error', data);
        }
    });
}

// welcome popup
$(document).ready(function() {
    // if (localStorage.getItem('popState') != 'shown') {

    // }
    var popup = null;
    $.ajax({
        contentType: 'application/json; charset=utf-8',
        url: '/home/popup',
        dataType: "json",
        success: function(result) {
            popup = result.popup;
            popup_image = popup.website_pict;

            Swal.fire({
                imageUrl: popup_image,
                imageAlt: 'Welcome Screen',
                animation: true,
                customClass: 'swal-welcome',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                onBeforeOpen: function(element) {
                    $(element).find('button.swal2-confirm.swal2-styled').toggleClass('swal2-confirm swal2-styled swal2-confirm btn btn-welcome')
                }
            }).then((result) => {
                // localStorage.setItem('popState', 'shown');
            });
            if (popup.website_url != null) {
                $(Swal.getImage()).on('click', function(ev) {
                    // localStorage.setItem('popState', 'shown');

                    // open new tab
                    var a = document.createElement('a')
                    a.href = popup.website_url
                    a.target = '_blank'
                    document.body.appendChild(a)
                    a.click()
                    document.body.removeChild(a)
                    Swal.close()

                    // window.open(popup.website_url,'_blank');
                    // window.location = popup.website_url;
                });
            }
        }
    });    
});

const redirectCarousel = function(value, obj){
    obj.innerHTML = value;
    redirect(value);
}

function redirect(url) {
    window.location.href = url;
}