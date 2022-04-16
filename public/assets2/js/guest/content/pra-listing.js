// loader
let limit = 1;
let offset = 7;

let limit_filter = 1;
let offset_filter = 7;

let search, category, sort = null;
let timeout = null;

$(document).ready(function() {
    loadMore();
})

function loadMore() {
    $("#load-more").hide();
    $("#spinner-item").show();
    $("#empty-pralisting-bisnis").hide();
    search = $("input[name='search']").val();
    if (search) {
        search = search.toLowerCase();
    }
    category = $("select[name='category']").val();
    sort = $("select[name='sort']").val();
    $.post("/pra-listing/getPraListing", { limit, offset, search, category, sort })
        .done(function(data) {
            data = JSON.parse(data);
            let html = data.html;
            if (!data.load_more) {
                $('#load-more').hide();
            } else {
                $('#load-more').show();
                limit += 1;
            }
            $('#list-pralisting').append(html);
            $("#list-pralisting").show();

            $('#empty-pralisting-bisnis').hide();
            $("#spinner-item").hide();

        });
}

function loadFilter() {
    $("#list-pralisting").hide();
    $("#load-more").hide();
    $("#spinner-item").show();
    $("#empty-pralisting-bisnis").hide();

    search = $("input[name='search']").val();
    if (search) {
        search = search.toLowerCase();
    }
    category = $("select[name='category']").val();
    sort = $("select[name='sort']").val();
    $.post("/pra-listing/getPraListing", { limit: limit_filter, offset: offset_filter, search, category, sort })
        .done(function(data) {
            data = JSON.parse(data);
            let html = null;
            if (!data.html) {
                limit = 1;
                $("input[name='search']").val("");
                $("select[name='category']").val("");
                $("select[name='sort']").val("");
                $('#empty-pralisting-bisnis').show();
            } else {
                $('#empty-pralisting-bisnis').hide();
            }

            html = data.html;

            if (!data.load_more) {
                $('#load-more').hide();
            } else {
                $('#load-more').show();
                limit = limit_filter + 1;
            }
            $('#list-pralisting').empty().append(html);
            $("#list-pralisting").show();

            $('#empty-list-bisnis').hide();
            $("#spinner-item").hide();
        });
}

$('#category, #sort').on('change', function(e) {
    e.preventDefault();
    loadFilter();
});

$("#searchButton").click(function(e) {
    e.preventDefault();
    loadFilter();
});