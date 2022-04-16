$('img').addClass('lazyload');
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

$('#menu-tentang-kami').click(function () {
    if ($('#arrow-tentang-kami').hasClass('fa-chevron-down')) {
        $('#arrow-tentang-kami').removeClass('fa-chevron-down')
        $('#arrow-tentang-kami').addClass('fa-chevron-up')
    } else {
        $('#arrow-tentang-kami').addClass('fa-chevron-down')
        $('#arrow-tentang-kami').removeClass('fa-chevron-up')
    }
})

$(document).ready(function () {
    $('body').on('click', '.menu-toggle', function (e) {
        var $this = $($this)
        e.preventDefault();
        if ($('body').hasClass('off-view')) {
            $('body').removeClass('off-view');
        } else {
            $('body').addClass('off-view');
        }
    })

    $(document).mouseup(function (e) {
        var container = $('.menu-view');
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            if ($('body').hasClass('off-view')) {
                $('body').removeClass('off-view');
            }
        }
    })
})