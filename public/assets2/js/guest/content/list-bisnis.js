let limit = 8;
let offset = 1;

let search, minimal, maksimal, category, sort = null;
let timeout = null;

$(document).ready(function () {
    loadMore();
})

function loadMore() {
    $("#load-more").hide();
    $("#spinner-item").show();
    $("#empty-list-bisnis").hide();

    search = $("input[name='search']").val().toLowerCase();
    minimal = $("input[name='minimal']").val().replace(/\./g, '');
    maksimal = $("input[name='maksimal']").val().replace(/\./g, '');
    category = $("select[name='category']").val();
    sort = $("select[name='sort']").val();
    type = localStorage.getItem('filterType') || '';

    $.post("/bisnis/getBisnis", {
            limit,
            offset,
            search,
            minimal,
            maksimal,
            category,
            sort,
            type,
            jenis
        })
        .done(function (data) {
            data = JSON.parse(data);
            let html = data.html;
            if (!data.load_more) {
                $('#load-more').hide();
            } else {
                $('#load-more').show();
            }
            $('#list-bisnis').append(html);
            offset += 1;
            $('#empty-list-bisnis').hide();

            $("#spinner-item").hide();
            $("#list-bisnis").show();
        });
}

function loadFilter(type = '') {
    $("#list-bisnis").hide();
    $("#load-more").hide();
    $("#spinner-item").show();
    $("#empty-list-bisnis").hide();
    offset = 1;

    search = $("input[name='search']").val().toLowerCase();
    minimal = $("input[name='minimal']").val().replace(/\./g, '');
    maksimal = $("input[name='maksimal']").val().replace(/\./g, '');
    category = $("select[name='category']").val();
    sort = $("select[name='sort']").val();
    type = localStorage.getItem('filterType') || '';

    console.log('type', type)

    clearTimeout(timeout);

    console.log(limit);
    console.log(offset);
    timeout = setTimeout(function () {
        $.post("/bisnis/getBisnis", {
                search,
                minimal,
                maksimal,
                category,
                sort,
                type
            })
            .done(function (data) {
                let html = null;
                data = JSON.parse(data);
                if (!data.html) {
                    $("input[name='search']").val("");
                    $("input[name='minimal']").val("");
                    $("input[name='maksimal']").val("");
                    $("select[name='category']").val("");
                    $("select[name='sort']").val("");
                    $('#empty-list-bisnis').show();
                } else {
                    $('#empty-list-bisnis').hide();
                    offset += 1;

                }
                html = data.html;
                $('#list-bisnis').empty().append(html);

                $("#spinner-item").hide();
                $("#list-bisnis").show();
                if (!data.load_more) {
                    $('#load-more').hide();
                } else {
                    $("#load-more").show();
                }
            });

    }, 1000);
}

$('#minimal, #maksimal').on('keyup input', function (e) {
    if (this.value != '') {
        this.value = formatNumber(parseInt(this.value.replace(/\./g, '')));
    }
})

$('#search, #minimal, #maksimal').on('keyup', function (e) {
    e.preventDefault();
    loadFilter();
});

$('#category, #sort').on('change', function (e) {
    e.preventDefault();
    loadFilter();
});

$("#searchButton").click(function (e) {
    e.preventDefault();
    loadFilter();
});

$('#sukukType').on('change', function (e) {
    e.preventDefault();
    localStorage.setItem('filterType', 'sukuk');
    loadFilter('sukuk');
});

$('#sahamType').on('change', function (e) {
    e.preventDefault();
    localStorage.setItem('filterType', 'saham');
    loadFilter('saham');
});

$('#allType').on('change', function (e) {
    e.preventDefault();
    localStorage.removeItem('filterType');
    loadFilter();
});

window.onload = localStorage.removeItem('filterType');