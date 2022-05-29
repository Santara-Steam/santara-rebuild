@extends('admin.layout.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="basic-examples">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <h4><strong>Welcome {{ Auth::user()->trader->name }}!</strong></h4>
                            <p>Platform Equity Crowdfunding pertama yang berizin dan diawasi Otoritas Jasa Keuangan
                                berdasarkan Surat Keputusan Nomor: KEP-59/D.04/2019.</p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <a href="{{ url('admin/export_penerbit') }}">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body cleartfix">
                                            <div class="media align-items-stretch">
                                                <div class="align-self-center">
                                                    <i class="icon-briefcase info font-large-2 mr-2"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h4>Total Penerbit</h4>
                                                    <span>Total Penerbit Terdaftar</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <h3><strong>{{ angkaKoma($total_penerbit) }}</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <i class="la la-money info font-large-2 mr-2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Total Pendanaan</h4>
                                                <span>Total Pendanaan Penerbit</span>
                                            </div>
                                            <div class="align-self-center">
                                                <h3><strong>{{ rupiahBiasa($totalPendanaan->amount) }}</strong></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="card enable-click" id="card-user">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <i class="icon-user-following info font-large-2 mr-2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Total User</h4>
                                                <span>Total User Terdaftar</span>
                                            </div>
                                            <div class="align-self-center">
                                                <h3><strong>{{ angkaKoma($total_user) }}</strong></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <i class="icon-wallet info font-large-2 mr-2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Dana Wallet</h4>
                                                <span>Dana di dompet Santara</span>
                                            </div>
                                            <div class="align-self-center">
                                                <h3><strong>{{ rupiahBiasa($totalDompet[0]->total) }}</strong></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="card-body cleartfix">

                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <i class="icon-user info font-large-2 mr-2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Download Playstore </h4>
                                                <span>Total Download Playstore</span>
                                            </div>
                                            <div class="align-self-center">
                                                <h3><strong>{{ $playStore }}</strong></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="card-body cleartfix">

                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <i class="icon-user info font-large-2 mr-2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Download Appstore </h4>
                                                <span>Total Download Appstore</span>
                                            </div>
                                            <div class="align-self-center">
                                                <h3><strong>{{ $appStore }}</strong></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>

            </section>
        </div>
    </div>
    </div>

    {{-- Model Download User --}}
    <div class="modal fade" id="modalDownloadUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Data Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Rentang Tanggal Pendaftaran</label>
                        <input type="text" class="form-control" name="daterange" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="exportUser()">Export</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="tokenn" name="tokenn" value="{{ $secmar['token'] }}" />
    <input type="hidden" id="refreshToken" name="refreshToken" value="{{ $secmar['refresh_token'] }}" />
    <input type="hidden" id="exp" name="exp" value="{{ $secmar['expired_in'] }}" />
    <input type="hidden" id="username" name="username" value="{{ $secmar['username'] }}" />
    <input type="hidden" id="photos" name="photos" value="{{ $secmar['photos'] }}" />
    <input type="hidden" id="marketUrl" name="marketUrl" value="https://market.santara.co.id" />
    <input type="hidden" id="key" name="key" value="{{ env('PROJECT_DECRYPT_KEY') }}" />
@endsection
@section('js')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
                "columnDefs": [{
                        "width": "23%",
                        "targets": 5
                    },
                    {
                        "width": "5%",
                        "targets": 4
                    },
                ],
            });
        });

        var tglAwal = "";
        var tglAkhir = "";

        $('input[name="daterange"]').daterangepicker({
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')]
            }
        }, function(start, end, label) {
            tglAwal = start.format('YYYY-MM-DD');
            tglAkhir = end.format('YYYY-MM-DD');
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });

        $("#card-user").on("click", function() {
            $("#modalDownloadUser").modal('show');
        });

        function exportUser() {
            console.log("hai");
            if (tglAwal != "" && tglAkhir != "") {
                var url = "{{ url('admin/export_user') }}" + '?start_date=' + tglAwal + '&end_date=' +
                    tglAkhir;
                window.open(url, "_blank");
            } else {
                alert("Rentang tanggal belum dipilih")
            }
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"
        integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/aes.min.js"
        integrity="sha512-eqbQu9UN8zs1GXYopZmnTFFtJxpZ03FHaBMoU3dwoKirgGRss9diYqVpecUgtqW2YRFkIVgkycGQV852cD46+w=="
        crossorigin="anonymous"></script>
    {{-- <script src="<?= base_url() ?>assets/js/member/redirect.js?v=<?= WEB_VERSION ?>"></script> --}}
    <script>
        // const userData = document.getElementById('userData').innerHTML;
        const marketUrl = document.getElementById('marketUrl').value;
        const tokenn = document.getElementById('tokenn').value;
        const refreshToken = document.getElementById('refreshToken').value;
        const exp = document.getElementById('exp').value;
        const username = document.getElementById('username').value;
        const photos = document.getElementById('photos').value;
        const key = document.getElementById('key').value;
        // const parseData = JSON.parse(userData);
        const cookieName = '__AU2nQs04ys_';
        const cookieRefresh = 'd0AIh0HgMW_';
        const cookiePhoto = '_LOpSM4cK97';
        const hostName = window.location.hostname;
        const hostNameArray = hostName.split('.');

        // console.log(parseData);

        let cookieCrossDomain = '';

        if (hostName === 'dev.santara.id' || hostName === 'https://dev.santara.id') {
            cookieCrossDomain = hostNameArray.length > 1 ?
                `.${hostNameArray
        .filter((val, index) => index >= hostNameArray.length - 2)
        .join('.')}` // get last 2 words from hostname if array length > 1 (e.g. santara.id) and append them with '.' (ASCII 46)
                :
                hostName; // get hostName if array length = 1, e.g. localhost
        } else if (hostNameArray.length >= 3) {
            cookieCrossDomain = hostNameArray.length > 1 ?
                `.${hostNameArray
        .filter((val, index) => index >= hostNameArray.length - 3)
        .join('.')}` // get last 2 words from hostname if array length > 1 (e.g. santara.co.id) and append them with '.' (ASCII 46)
                :
                hostName; // get hostName if array length = 1, e.g. localhost
        } else {
            cookieCrossDomain = hostNameArray.length > 1 ?
                `.${hostNameArray
        .filter((val, index) => index >= hostNameArray.length - 2)
        .join('.')}` // get last 2 words from hostname if array length > 1 (e.g. santara.id) and append them with '.' (ASCII 46)
                :
                hostName; // get hostName if array length = 1, e.g. localhost
        }

        const ciphertext = CryptoJS.AES.encrypt(
            JSON.stringify(tokenn),
            key
        );

        const ciphertextRefreshToken = CryptoJS.AES.encrypt(
            JSON.stringify(refreshToken),
            key
        );

        const ciphertextPhoto = CryptoJS.AES.encrypt(
            JSON.stringify(photos),
            key,
        );

        function saveCookies(cookiesName, data) {
            document.cookie = cookiesName + '=' + data + ";domain=" + cookieCrossDomain + ";path=/";
        }

        const url = `${marketUrl}/api/post/session`;
        fetch(url, {
            method: "POST",
            body: JSON.stringify({
                token: ciphertext.toString(),
                expired_in: exp
            })
        }).then(
            response => response.json()
        ).then(
            result => {
                if (result.token) {
                    saveCookies(cookieName, result.token);
                    saveCookies(cookieRefresh, ciphertextRefreshToken.toString());
                    saveCookies(cookiePhoto, ciphertextPhoto.toString());
                }
                setTimeout(() => {
                    // window.location.href = `${marketUrl}/redirect/`;
                }, 1000);
            }
        );
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
