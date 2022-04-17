@extends('admin.layout.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2><strong>Push Broadcast Notification</strong></h2>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light p-1 mb-1">
                                        <h5>Mengirim ke broadcast ke <span id="totalUser"></span> user dengan setiap halaman {{ $limit }} user</h5>
                                    </div>
                                    <form id="frmTambahNotifikasi" enctype="multipart/form-data">
                                        <h3>Kontent Pemberitahuan :</h3>
                                        <div class="card border border-light card-body">
                                            <h5 class="text-left text-danger"><strong>{{ $kategori }}</strong></h5>
                                            <h2>{{ $notif['title'] }}</h2>
                                            <p>{{ $notif['content'] }}</p>
                                        </div>
                                        <input type="hidden" id="broadcastCategoryName" name="broadcastCategoryName"
                                            value="{{ $kategori }}" />
                                        <input type="hidden" name="message" id="message"
                                            value="{{ $notif['content'] }}" />
                                        <input type="hidden" name="title" id="title" value="{{ $notif['title'] }}" />
                                        <input class="form-control" name="userId" id="userId" type="hidden" />
                                        <button class="btn btn-primary" id="btnPushNotif" type="submit">Kirim <i
                                                class="la la-bell"></i></button>
                                    </form>
                                    <nav class="row justify-content-between p-2">
                                        <h5 class="mt-1"><strong>Halaman</strong></h5>
                                        <ul class="pagination" id="pagination"></ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load a').css('color', '#dfecf6');
            $('#load').append(
                '<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />'
            );

            var url = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            loadData(page);
            window.history.pushState("", "", url);
        });

        loadData(1);
        var dataUserId = [];

        function loadData(page) {
            $.ajax({
                url: '{{ url('admin/get-push-notif/' . $broadcastId) }}' + '?page=' + page,
                type: 'GET',
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(res) {
                    $("#loader").hide();
                    dataUserId = [];
                    res.results.data.forEach(row => {
                        dataUserId.push(row['user_id']);
                    });
                    console.log(dataUserId);
                    $("#userId").val(dataUserId);
                    $("#totalUser").html(res.amount);
                    var stringPaginate = "";
                    res.results.links.forEach(row => {
                        stringPaginate += row['active'] ?
                            '<li class="page-item active"><a class="page-link" href="{{ url('admin/push-notif/' . $broadcastId) }}' +
                            '?page=' + parseInt(row['label']) + '">' + row['label'] + '</a></li>' :
                            '<li class="page-item"><a class="page-link" href="{{ url('admin/push-notif/' . $broadcastId) }}' +
                            '?page=' + parseInt(row['label']) + '">' + row['label'] + '</a></li>'
                    });
                    $("#pagination").html(stringPaginate)
                }
            })
        }

        $("#btnPushNotif").click(function(event) {
            event.preventDefault();
            var form = $("#frmTambahNotifikasi")[0];
            var data = new FormData(form);

            $.ajax({
                url: "{{ url('admin/broadcast-notif') }}",
                type: 'POST',
                dataType: "json",
                data: data,
                cache: false,
                async: true,
                processData: false,
                contentType: false,
                timeout: 60000, // sets timeout to 20 seconds
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(data) {
                    $("#loader").hide();
                    Swal.fire(
                        'Berhasil!',
                        data.message,
                        'success'
                    );
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (textStatus === "timeout" || textStatus === "error") {
                        $("#loader").hide();
                        Swal.fire({
                            title: 'Ooops...',
                            text: "Mohon periksa koneksi internet anda",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Muat ulang',
                            cancelButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                    }
                },
                complete: function() {
                    $("#loader").hide();
                }
            });
        });
    </script>
@endsection
