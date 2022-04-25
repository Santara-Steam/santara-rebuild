@extends('front_end/template_front_end/app')

@section('content')
    <link rel="canonical" href="https://santara.co.id/pertanyaan">
    <link rel="apple-touch-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/juf5ftz.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://santara.co.id/app-assets/new-santara/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="https://santara.co.id/assets/new-santara/css/new-pertanyaan.css?v=5.8.8">
    <style>
        .menu-view-body .navbar-nav{
            padding: 0px 0px;
            margin-left: 0px;
        }
    </style>
    <main>
        <div style="padding-top: 80px;">
<div class="content-header">
    <div class="pertanyaan-header lazyload">
    </div>
</div>
<div class="bg-dark">
    <div class="pertanyaan">
        <h2 class="pertanyaan-title c-gold"><b>Pertanyaan Yang Sering Ditanyakan</b></h2>
        <hr style="margin-left: 0.8rem;margin-right: 0.8rem;margin-bottom: 2rem;" />
    </div>

    <div class="container">
        <div class="row">
            <div class="container-pertanyaan align-items-start">
                <div class="nav col-12 col-md-4  flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link ff-n active mb-2" id="umum-tab" data-bs-toggle="pill" data-bs-target="#umum" type="button" role="tab" aria-controls="umum" aria-selected="true">
                        Umum <i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-akun-santara-tab" data-bs-toggle="pill" data-bs-target="#v-pills-akun-santara" type="button" role="tab" aria-controls="v-pills-akun-santara" aria-selected="false">
                        Akun Santara<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-deposit-tab" data-bs-toggle="pill" data-bs-target="#v-pills-deposit" type="button" role="tab" aria-controls="v-pills-deposit" aria-selected="false">
                        Deposit<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-pembelian-saham-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pembelian-saham" type="button" role="tab" aria-controls="v-pills-pembelian-saham" aria-selected="false">
                        Pembelian Saham<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-penarikanDana-tab" data-bs-toggle="pill" data-bs-target="#v-pills-penarikanDana" type="button" role="tab" aria-controls="v-pills-penarikanDana" aria-selected="false">
                        Penarikan Dana<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-penjualanSaham-tab" data-bs-toggle="pill" data-bs-target="#v-pills-penjualanSaham" type="button" role="tab" aria-controls="v-pills-penjualanSaham" aria-selected="false">
                        Penjualan Saham<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-Dividen-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Dividen" type="button" role="tab" aria-controls="v-pills-Dividen" aria-selected="false">
                        Dividen<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                    <button class="nav-link ff-n mb-2" id="v-pills-Penerbit-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Penerbit" type="button" role="tab" aria-controls="v-pills-Penerbit" aria-selected="false">
                        Penerbit<i class="fas fa-arrow-right float-end arrow-btn"></i>
                    </button>
                </div>
                <div class="col-12 col-md-8 card tab-content" id="v-pills-tabContent">
                    <div class="row col-12 tab-pane fade show active" style="padding: 10px 0px 10px 20px;" id="umum" role="tabpanel" aria-labelledby="umum-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Apa itu Santara
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        SANTARA adalah Platform Layanan Urun Dana Melalui Penawaran Saham Berbasis Teknologi Informasi (Equity Crowdfunding) yang telah berizin dan diawasi oleh Otoritas Jasa Keuangan (OJK)

                                        Melalui Santara anda dapat mengambil peluang sebagai Pemodal dan Penerbit. Pada sisi Pemodal, Anda dapat membeli saham bisnis UKM yang kami tawarkan dan menikmati penghasilan dari dividen UKM yang Anda beli sahamnya tersebut.

                                        Sedangkan dari sisi Penerbit, Anda dapat menawarkan saham dari bisnis UKM yang Anda miliki kepada para Pemodal yang terdaftar di Santara sehingga mendapatkan tambahan permodalan untuk pengembangan bisnis UKM Anda.

                                        Selengkapnya tentang Santara juga dapat disimak dalam video berikut ini.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Apa peran Santara ?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        Peran Santara dalam mempertemukan Pemodal dan Penerbit adalah :
                                        <ol type="a">
                                            <li>Melakukan review terhadap bisnis calon Penerbit yang ingin mendapatkan pendanaan.</li>
                                            <li>Menyediakan system penggalangan dana investasi (Equity Crowdfunding).</li>
                                            <li>Menjadi penghubung antara Pemodal, Penerbit, dan regulator terkait.</li>
                                            <li>Melakukan pengawasan terhadap berjalannya proses bisnis dalam layanan urun dana ini (baik dari sisi pemodal dan penerbit) agar dapat tetap berjalan sesuai koridor peraturan yang berlaku. </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Kenapa Saya Harus Berinvestasi Kepada Bisnis UKM Melalui Santara?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Sebagian dari Anda mungkin berpikir “kalau berinvestasi pada bisnis UKM, kenapa tidak secara langsung saja?.</p>
                                        <p>Betul, Anda bisa saja mencari pebisnis UKM yang bisnisnya bagus dan sedang berencana ekspansi. Anda bisa saja melakukan negosiasi sendiri dan kalau beruntung Anda bisa mendapatkan kesepakatan yang menarik untuk bekerja sama investasi dengan UKM tersebut. Namun Santara memberikan Anda 5 kemudahan bagi Anda untuk berinvestasi di bisnis UKM.</p>
                                        <p>Yang Santara dapat tawarkan untuk Anda diantaranya :
                                        <ol>
                                            <li>
                                                <p><strong>Ada banyak pilihan bisnis UKM.</strong></p>
                                                <p>Jika Anda ingin berinvestasi di banyak bisnis, maka Santara adalah tempat yang tepat. Anda tidak perlu mencari dan berkenalan dengan owner bisnis yang Anda mau satu per satu. Santara menawarkan bisnis-bisnis UKM dari berbagai bidang mulai dari kuliner, jasa, manufaktur dan lain sebagainya yang bisa Anda pilih sesuka hati.</p>
                                            </li>
                                            <li>
                                                <p><strong>Passive Income, tidak perlu terlibat operasional</strong></p>
                                                <p>Berinvestasi pada UKM di Santara memungkinkan Anda mendapatkan dividen usaha UKM tanpa perlu terlibat dalam operasional UKM yang Anda investasikan.</p>
                                            </li>
                                            <li>
                                                <p><strong>Praktis, Semua Layanan Dalam Satu Platform</strong></p>
                                                <p>Proses memilih UKM, investasi hingga mendapatkan dividen bisa dilakukan di satu platform saja.</p>
                                            </li>
                                            <li>
                                                <p><strong>Modal Terjangkau</strong></p>
                                                <p>Dengan sistem Equity Crowdfunding maka berinvestasi dengan memiliki sebagian saham di bisnis UKM bisa dimulai dengan modal yang relatif terjangkau. </p>
                                            </li>
                                            <li>
                                                <p><strong>Anda berhak menentukan bisnis yang akan listing</strong></p>
                                                <p>Melalui fitur Pralisting, para pengguna bisa bersama-sama melakukan review dan penilaian terhadap bisnis yang mengajukan menjadi diri menjadi Penerbit di Santara. Sehingga penilaian bisa lebih objektif dan komprehensif. Bandingkan jika Anda berinvestasi sendiri, Anda akan dan harus melakukan penilaian sendiri terhadap UKM tersebut.</p>
                                            </li>
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-akun-santara" role="tabpanel" aria-labelledby="v-pills-akun-santara-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Bagaimana cara bergabung dengan Santara ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Untuk bergabung di Santara anda bisa melakukan langkah sebagai berikut :</p>
                                        <ol>
                                            <li>Registrasi di halaman utama klik <b>Member Area</b> atau untuk pengguna aplikasi bisa klik menu <b>Account</b>.</li>
                                            <li>Setelah itu klik <b>Daftar</b> atau <b>Sign Up</b>. Selanjutnya masukan nomor handphone aktif menggunakan kode negara (+62), Nama Lengkap, Email aktif dan Password. Setelah selesai klik <b>Register</b>.</li>
                                            <li>Setelah itu akan muncul permintaan OTP yang kodenya akan dikirimkan melalui SMS ke nomor yang dicantumkan saat registrasi awal. Setelah sms kode OTP masuk bisa dimasukan kode OTP nya dan kemudian setelah berhasil bisa dilanjutkan verifikasi email dengan memasukan email yang sudah didaftarkan, lalu buka email anda dan klik <b>Verifikasi Email</b>.</li>
                                            <li>Apabila sudah verifikasi emailnya, anda bisa masuk kembali ke akun Santara anda dengan log in, kemudian mengisi Biodata (KYC), isi semua biodata anda dengan lengkap klik <b>Lanjutkan</b> lalu tunggu di verifikasi admin.</li>
                                            <li>Setelah akun Anda terverifikasi. Anda sudah bisa berinvestasi di Santara.</li>
                                        </ol>
                                        <p>Anda juga bisa melihat tutorialnya dalam video <a href="https://youtu.be/_wABtcZMV7g" target="_blank">berikut ini</a> . </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Berapa lama proses verifikasi akunnya ya?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Untuk verifikasi akun maksimal 2 hari kerja.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Apa yang bisa saya lakukan setelah memiliki akun ?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Setelah melakukan registrasi anda bisa melakukan deposit pengisian saldo dan bisa langsung melakukan pembelian saham yang sedang ditawarkan tanpa khawatir kehabisan karena telat transfer dana.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-deposit" role="tabpanel" aria-labelledby="v-pills-deposit-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Bagaimana cara deposit di akun saya ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Untuk melakukan Deposit Anda bisa melakukan langkah-langkah sebagai berikut :</p>
                                        <ol>
                                            <li>Login ke akun Santara, klik <b>Account</b> di pojok kanan bawa</li>
                                            <li>Selanjutnya klik menu <b>Deposit</b>.</li>
                                            <li>Isi Jumlah Deposit yang ingin Anda tambahkan.</li>
                                            <li>Pilih metode transfer pembayaran yang ingin Anda gunakan, ada 2 pilihan yaitu Virtual Account dan Bank Transfer.</li>
                                            <li>Apabila anda memilih untuk menggunakan metode pembayaran <b>Virtual Account</b>, silakan pilih bank pembayarannya. Silakan cek Riwayat Deposit lalu klik Lanjutkan Pembayaran. Salin Nomor Virtual akun dan lakukan pembayaran di akun bank Anda untuk pembayaran menggunakan virtual account. Setelah berhasil, otomatis dana yang anda transfer pun akan masuk ke wallet akun Santara anda.</li>
                                            <li>Apabila anda memilih untuk menggunakan metode pembayaran <b>Bank Transfer</b>, silakan masukan nomor rekening yang akan Anda gunakan untuk melakukan transfer beserta bank account Anda. Silakan cek Riwayat Deposit lalu klik Lanjutkan Pembayaran. Lakukan bank transfer ke salah satu nomor rekening dan upload bukti transfer. Kami akan membutuhkan waktu untuk selanjutnya kami verifikasi dan deposit masuk di akun anda. Setelah kami verifikasi, saldo deposit anda akan muncul di wallet akun Santara anda.</li>
                                        </ol>
                                        <p>Selengkapnya dapat juga Anda tonton dalam video <a href="https://youtu.be/_wABtcZMV7g" target="_blank">berikut ini</a> . </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Apakah saldo saya bisa diambil kembali? Bagaimana caranya?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Bisa, silakan melakukan langkah sebagai berikut :</p>
                                        <ol>
                                            <li>Login ke akun Santara Anda</li>
                                            <li>Klik Menu Account</li>
                                            <li>Klik Withdraw dari saldo Santara yang anda miliki</li>
                                            <li>Masukan jumlah penarikan perlu diketahui bahwa penarikan dana akan dikenakan biaya administrasi sebesar 25.000 rupiah di setiap transaksi withdraw.</li>
                                            <li>Silakan Isi data rekening dan bank penerima dana.</li>
                                            <li>Klik Lanjutkan</li>
                                            <li>Anda tinggal menunggu tim Santara melakukan verifikasi dan transfer penarikan dana Anda dengan estimasi waktu 2 hari kerja.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-pembelian-saham" role="tabpanel" aria-labelledby="v-pills-pembelian-saham-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Apa itu Saham ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Dilansir dari laman idx.co.id Saham dapat didefinisikan sebagai tanda penyertaan modal seseorang atau pihak (badan usaha) dalam suatu perusahaan atau perseroan terbatas.</p>
                                        <p>Dengan menyertakan modal tersebut, maka pihak tersebut memiliki klaim atas pendapatan perusahaan dan aset perusahaan.</p>
                                        <p>Misalkan ada sebuah bisnis membutuhkan dana 500 juta rupiah dengan menjual 50% saham bisnisnya.</p>
                                        <p>Kemudian, melalui Santara Anda membeli saham tersebut sesuai budget Anda, artinya Anda telah memiliki sepersekian persen kepemilikan atas usaha tersebut.</p>
                                        <p>Dan nantinya Anda juga berhak atas dividen perusahaan tersebut sesuai porsi saham yang Anda miliki.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Bagaimana cara membeli saham bisnis di Santara?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Pembelian saham dapat dilakukan ketika ada Penerbit yang sedang menawarkan saham, adapun langkah-langkah dalam melakukan pembelian saham adalah sebagai berikut :</p>
                                        <ol>
                                            <li>Login ke akun Santara Anda</li>
                                            <li>Pilih saham yang ingin Anda beli</li>
                                            <li>Baca prospektus dan pelajar penawaran saham tersebut</li>
                                            <li>Pastikan Anda sudah paham dan siap dengan segala potensi dan resiko penawaran saham tersebut</li>
                                            <li>Masukan jumlah lembar saham yang ingin Anda beli</li>
                                            <li>Klik BELI SAHAM</li>
                                            <li>Pilih metode pembayaran yang ingin Anda lakukan.<br>Ada 3 metode pembayaran yaitu Bank Transfer, Virtual Account dan Deposit.</li>
                                            <li>Silakan lakukan pembayaran sesuai petunjuk dalam metode pembayaran yang Anda pilih</li>
                                            <li>Tunggu pembayaran Anda terverifikasi</li>
                                            <li>Selamat, Anda berhasil membeli saham</li>
                                        </ol>
                                        <p>Untuk tutorial lengkapnya, Anda bisa juga simak dalam video <a href="https://www.youtube.com/watch?v=vmAFdcrzf88" target="_blank">berikut ini</a>.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Apa saja pilihan metode pembayaran yang ada di Santara?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Saat ini ada 3 pilihan metode pembayaran di Santara :</p>
                                        <ol>
                                            <li>Saldo Deposit<br>Metode pembayaran ini kami rekomendasikan untuk Anda yang tidak ingin kehabisan saham bisnis yang sedang melakukan penawaran saham. Karena salah satu keunggulannya adalah proses verifikasi yang otomatis, dalam hitungan detik pembelian saham Anda bisa langsung terverifikasi berhasil.<br>Untuk itu sebelum penawaran dimulai, sebaiknya Anda sudah mengisi saldo deposit di akun Anda. Caranya dapat Anda simak dalam informasi tentang deposit di bagian atas halaman ini.</li>
                                            <li>Virtual Account<br>Melalui metode virtual account proses pembayaran juga cepat, karena verifikasi pembayarannya juga sudah otomatis. Jadi begitu Anda melakukan transfer, dalam beberapa detik pembayaran Anda akan terverifikasi.<br>Sebagai tambahan informasi untuk pembayaran melalui virtual account, nomor rekening yang dituju adalah atas nama PT Sinar Digital Terdepan (Xendit) selaku pihak payment gateway yang ditunjuk Santara.</li>
                                            <li>Transfer Manual<br>Melalui metode pembayaran ini Anda dapat melakukan pembayaran baik itu setor tunai, ATM, M-Banking, maupun internet banking ke nomor rekening atas nama PT Santara Daya Inspiratama.<br>Kemudian Anda perlu mengupload bukti pembayaran tersebut ke sistem, untuk selanjutnya tim kami akan memverifikasi pembayaran tersebut secara manual. Hal ini memerlukan waktu maksimal 1 hari kerja.</li>
                                        </ol>
                                        <p>Perlu kami sampaikan bahwa pembelian saham Anda dinyatakan berhasil mendapatkan slot saham adalah ketika sistem berhasil memverifikasi pembayaran Anda.</p>
                                        <p>Bukan pada saat Anda melakukan booking pemesanan.<br>Pembayaran yang paling cepat terverifikasi maka ia yang berhasil mendapatkan slot.</p>
                                        <p>Mengenai batas pembayaran untuk tiap transaksi pembelian adalah 1 hari kerja, namun transaksi pembelian tersebut akan otomatis kadaluarsa apabila slot saham sudah terpenuhi.</p>
                                        <p>Hal ini berlaku untuk semua metode pembayaran.</p>
                                        <p>Apabila dana pembelian yang sudah terlanjur ditransfer ke rekening Santara namun tidak mendapatkan slot saham, maka dana tersebut masuk ke dalam saldo deposit akun Anda dan dapat digunakan untuk pembelian di penawaran saham selanjutnya.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingempat">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseempat" aria-expanded="false" aria-controls="flush-collapseempat">
                                        Apa yang saya dapatkan setelah membeli saham di Santara?
                                    </button>
                                </h2>
                                <div id="flush-collapseempat" class="accordion-collapse collapse" aria-labelledby="flush-headingempat" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Setelah melakukan pembelian, Anda akan menerima email bukti pembelian saham.</p>
                                        <p>Kemudian setelah masa penjualan saham bisnis tersebut selesai, Anda akan dikirimi saldo saham sejumlah yang Anda beli maksimal 15 hari kerja setelah saham dinyatakan sold out / habis terjual.</p>
                                        <p>Kabar baiknya, Santara telah bekerjasama dengan PT Kustodian Sentral Efek Indonesia (KSEI) sebagai lembaga pencatatan efek. Sehingga nantinya portfolio investasi Anda di Santara tercatat resmi dan dapat Anda pantau melalui dashboard Akses KSEI, seperti halnya portfolio efek lainnya di pasar modal.</p>
                                        <p>Selanjutnya, Anda tinggal menunggu update informasi perkembangan usaha dan masa pembagian dividen usaha UKM tersebut.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headinglima">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapselima" aria-expanded="false" aria-controls="flush-collapselima">
                                        Berapa Minimum Pembelian Saham di Santara?
                                    </button>
                                </h2>
                                <div id="flush-collapselima" class="accordion-collapse collapse" aria-labelledby="flush-headinglima" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Mengacu pada Peraturan Otoritas Jasa Keuangan (POJK) Nomor 37/POJK.04/2018 jumlah minimal pembelian saham adalah jumlah dana yang ditawarkan dibagi sisa maksimal pemilik saham untuk atas nama Masyarakat. Sehingga minimal pembelian saham tiap Penerbit bisa berbeda.</p>
                                        <p>Contoh :<br>Sebuah bisnis menghendaki maksimal pemilik saham mereka adalah 300 orang, kemudian ia menjual saham dengan nilai 600 juta. Saat ini dalam bisnis mereka sudah ada 2 orang pemilik saham, berarti kuota pemilik sahamnya tinggal 298 orang.<br>Maka minimum pembelian pada saat awal penawaran saham adalah 600juta / 298 = 2.013.00 (dibulatkan).<br>Angka minimum tersebut juga dapat turun dan semakin terjangkau melalui fitur Dynamic Minimum Investment di Santara. Dimana jika ada seorang Pemodal yang membeli lebih dari batas minimum pembelian (memborong saham) maka otomatis mengurangi jumlah sisa saham dibagi dengan sisa kuota pemilik sahamnya. Sehingga minimum pembelian semakin terjangkau hingga maksimal 100.000 Rupiah.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingEnam">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEnam" aria-expanded="false" aria-controls="flush-collapseEnam">
                                        Berapa Maksimal Pembelian Saham?
                                    </button>
                                </h2>
                                <div id="flush-collapseEnam" class="accordion-collapse collapse" aria-labelledby="flush-headingEnam" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Mengacu pada ketentuan POJK 37 Pasal 42 Ayat 2, ada beberapa limit pembelian maksimal saham berdasarkan penghasilan pemodal pertahun sebagai berikut : </p>
                                        <ol>
                                            <li>setiap Pemodal dengan penghasilan sampai dengan Rp500.000.000,00 (lima ratus juta rupiah) per tahun, dapat membeli saham melalui Layanan Urun Dana paling banyak sebesar 5% (lima persen) dari penghasilan per tahun; dan</li>
                                            <li>setiap Pemodal dengan penghasilan lebih dari Rp500.000.000,00 (lima ratus juta rupiah) per tahun, dapat membeli saham melalui Layanan Urun Dana paling banyak sebesar 10% (sepuluh persen) dari penghasilan per tahun.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTujuh">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTujuh" aria-expanded="false" aria-controls="flush-collapseTujuh">
                                        Bagaimana cara membuka limit jumlah investasi saya?
                                    </button>
                                </h2>
                                <div id="flush-collapseTujuh" class="accordion-collapse collapse" aria-labelledby="flush-headingTujuh" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Batasan maksimal pembelian saham oleh Pemodal sebagaimana dimaksud pada POJK 37 Tahun 2018 Pasal 42 ayat (2) tidak berlaku dalam hal Pemodal, jika Anda :</p>
                                        <ol>
                                            <li>Membeli saham atas nama badan hukum (misalkan perusahaan Anda)</li>
                                            <li>Anda memiliki pengalaman berinvestasi di Pasar Modal yang dibuktikan dengan kepemilikan rekening Efek paling sedikit 2 (dua) tahun sebelum penawaran saham hal ini dapat dibuktikan dengan SID.</li>
                                        </ol>
                                        <p>Artinya, jika Anda sudah memiliki rekening efek yang dibuktikan dengan Single Investor Identification minimal 2 tahun atau Anda membeli saham atas nama perusahaan, Anda bisa berinvestasi tanpa limit atau batas pembelian.<br>Untuk membuka limit investasi (pembelian saham) Anda bisa menghubungi Customer Support kami.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingDelapan">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDelapan" aria-expanded="false" aria-controls="flush-collapseDelapan">
                                        Apabila sudah membeli saham apakah bisa dibatalkan?
                                    </button>
                                </h2>
                                <div id="flush-collapseDelapan" class="accordion-collapse collapse" aria-labelledby="flush-headingDelapan" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Bisa dibatalkan maksimal 2 x 24 Jam setelah Anda melakukan transaksi pembeliah saham</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSembilan">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSembilan" aria-expanded="false" aria-controls="flush-collapseSembilan">
                                        Bagaimana Agar Saya Bisa Meminimalisir Kerugian Investasi?

                                    </button>
                                </h2>
                                <div id="flush-collapseSembilan" class="accordion-collapse collapse" aria-labelledby="flush-headingSembilan" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Sebagai Pemodal, Anda harus melakukan analisa terhadap bidang usaha penerbit dan mempelajari setiap informasi yang disajikan di dalam prospektus dengan cermat.</p>
                                        <p>Beberapa contoh informasi yang Anda harus pelajari yaitu terkait dengan rencana penggunaan dana oleh Penerbit. Apakah rencana tersebut mampu menaikan skala usaha dan menaikan pendapatan keuntungan untuk dibagikan kepada Pemodal ataukah ada faktor-faktor lain yang tidak tereskpose di dalam prospektus tersebut, namun jadi pertimbangan tersendiri bagi Anda.</p>
                                        <p>Hal yang tidak kalah penting adalah, lakukan self risk assesment terhadap kemampuan Anda untuk menyerap kemungkinan risiko yang akan terjadi di kemudian hari</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSepuluh">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSepuluh" aria-expanded="false" aria-controls="flush-collapseSepuluh">
                                        Apa Langkah Santara Untuk Meminimalisir Kerugian?
                                    </button>
                                </h2>
                                <div id="flush-collapseSepuluh" class="accordion-collapse collapse" aria-labelledby="flush-headingSepuluh" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Sebagai Penyelenggara Equity Crowdfunding, Santara melakukan upaya-upaya dalam meminimalisasi RISIKO Pemodal diantaranya adalah :
                                        <ol>
                                            <li>
                                                <p><strong>MELAKUKAN REVIEW</strong></p>
                                                <p>Bisnis proses yang dijalankan di Santara tetap berpedoman kepada regulasi yang berlaku, dimana Santara sebagai pihak Penyelenggara memiliki kewajiban untuk melakukan review terhadap calon penerbit.</p>
                                                <p>Beberapa hal yang menjadi aspek yang direview diantaranya :</p>
                                                <ol>
                                                    <li>Legalitas Penerbit, meliputi pengesahan badan hukum, organ perseroan, aspek hukum penambahan modal, batasan Penerbit, dan perizinan yang berkaitan dengan kegiatan usaha Penerbit dan/atau proyek yang akan didanai dengan dana hasil penawaran saham melalui Layanan Urun Dana; dan</li>
                                                    <li>Dokumen dan/atau informasi yang wajib disampaikan oleh Penerbit kepada Penyelenggara</li>
                                                </ol>
                                            </li>
                                            <li>
                                                <p><strong>EDUKASI</strong></p>
                                                <p>Memberikan edukasi kepada investor sehingga investor dapat mengambil keputusan dengan logis.</p>
                                            </li>
                                            <li>
                                                <p><strong>EVALUASI</strong></p>
                                                <p>Melakukan evaluasi atas jalannya kerjasama dalam proses bisnis ini sebagai pihak penyelenggara. </p>
                                            </li>
                                        </ol>
                                        </p>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-penarikanDana" role="tabpanel" aria-labelledby="v-pills-penarikanDana-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Bagaimana cara penarikan dana dari akun Santara ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Untuk melakukan penarikan dana bisa dilakukan di halaman <b>Account</b>. Kemudian pilih menu <b>Penarikan</b>. Kemudian isi formulir pengajuan penarikan dananya. Setelah itu kami proses 1 hari kerja bank hingga dana masuk ke rekening anda.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Berapa lama proses penarikan dana ?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Untuk proses withdraw maksimal kami layani dalam 3x hari kerja.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-penjualanSaham" role="tabpanel" aria-labelledby="v-pills-penjualanSaham-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Apakah saham bisa dijual kapan saja ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Tidak bisa. Saham hanya dapat dijual setelah melewati 1 Tahun penerbitan melalui secondary market yang dijalankan pada platform Santara.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Kapan Secondary Market Santara dibuka?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Merujuk pada peraturan dan surat keputusan OJK mengenai Secondary Market atau pasar sekunder pada layanan urun dana dibuka 2 kali dalam 1 tahun. </p>
                                        <p>Dalam menuju tahap tersebut ada serangkaian proses yang harus diselesaikan terlebih dahulu seperti penitipan efek di PT Kustodian Sentral Efek Indonesia (KSEI). Update hingga saat ini, proses administratif Santara dan KSEI sudah selesai, selanjutnya sedang dilakukan koordinasi penyesuaian teknis. Estimasi pasar sekunder dibuka pada Semester II tahun 2020.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-Dividen" role="tabpanel" aria-labelledby="v-pills-Dividen-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Berapa banyak dividen yang bisa saya dapatkan ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Pada prinsipnya, besaran dividen yang dibagikan kepada pemodal diputuskan melalui mekanisme RUPS. Namun, dalam rangka penawaran saham ini, penerbit dapat menuangkan kebijakan dividennya di dalam prospektus. </p>
                                        <p>Perlu kita pahami bersama, bahwa potensi dan resiko setiap bisnis bisa berbeda-beda. Selayaknya menjalankan bisnis, ada potensi untung dan rugi. Sehingga bisa jadi bisnis yang Anda miliki sahamnya merugi atau justru mendapatkan hasil yang melebihi proyeksi.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Kapan dividen dibagikan ?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Jadwal dividen di masing-masing Penerbit berbeda-beda. Ada yang setiap 6 bulan sekali dan ada juga yang setiap 12 bulan sekali. Periode dividen tersebut akan dicantumkan pada prospektus ketika awal bisnisnya ditawarkan kepada publik.</p>
                                        <p>Selain itu di prospektus akan dicantumkan Proyeksi Yield Dividen yang bisa menjadi estimasi dividen yang bisa diperoleh oleh pemodal. Proyeksi Yield Dividen hanya bersifat estimasi saja, sedangkan jumlah dividen yang diperoleh pemodal tetap mengacu pada kebijakan dividen penerbit dan atau melalui mekanisme RUPS pada umumnya.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTiga">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTiga" aria-expanded="false" aria-controls="flush-collapseTiga">
                                        Bagaimana perhitungan dividennya ?
                                    </button>
                                </h2>
                                <div id="flush-collapseTiga" class="accordion-collapse collapse" aria-labelledby="flush-headingTiga" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Pertamakali, penerbit akan memutuskan jumlah dividen yang dibagikan setelah melalui mekanisme RUPS dan atau berpedoman pada kebijakan dividen pada prospektus.</p>
                                        <p>Selanjutnya, jumlah dividen yang dibagikan tersebut akan didistribusikan secara proposional sesuai dengan kepemilikan saham penerbit melalui pihak Santara. Perlu diingat, bahwa saat ini regulasi kita mengatur tentang tax dividen yang bersifat final, hal ini berarti nilai dividen yang dikirimkan kepada pemodal merupakan nilai dividen final (setelah dikurangi tax dividen).</p>
                                        <p>Contoh :</p>
                                        <p>Anda memiliki 1000 lembar saham MLUT atau senilai 2% dari keseluruhan lembar saham yang dimiliki oleh pemegang saham.</p>
                                        <p>Sesuai keputusan RUPS, bahwa dividen yang dibagikan adalah sebesar Rp.100 Juta. Maka, nilai dividen yang Anda peroleh adalah sebesar Rp 2 juta.</p>
                                        <p>Nilai dividen yang didistribusikan kepada Anda adalah sebesar Rp.1,8 Juta, yaitu diperhitungkan dari : </p>
                                        <ul style="list-style-type:circle">
                                            <li>Nilai Dividen : Rp 2 Juta, dikurangi</li>
                                            <li>Tax Dividen WPOP Dalam Negeri : 10% x Rp2 Juta = Rp 200 Ribu</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingEmpat">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEmpat" aria-expanded="false" aria-controls="flush-collapseEmpat">
                                        Bagaimana jika perusahaan rugi atau bangkrut?
                                    </button>
                                </h2>
                                <div id="flush-collapseEmpat" class="accordion-collapse collapse" aria-labelledby="flush-headingEmpat" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Pada prinsipnya, Santara hanya bertindak sebagai pihak penyelenggara yang mempertemukan pihak Penerbit (UKM pelaku bisnis) dan Pemodal (investor). Bahwa dalam perjalanan operasional usaha Penerbit, sepenuhnya menjadi tanggung jawab manajemen Penerbit yang bersangkutan.</p>
                                        <p>Santara dalam hal ini bertindak mewakili Pemodal sebagai pemegang saham Penerbit termasuk dalam rapat umum pemegang saham Penerbit dan penandatanganan akta serta dokumen terkait lainnya. Santara sebagai penyelenggara juga menerapkan prinsip-prinsip manajemen risiko dalam rangka proses monitoring secara berkala terhadap keberlangsungan usaha Penerbit.</p>
                                        <p>Namun demikian, apabila terjadi case dimana suatu hari Penerbit tidak dapat bertahan dan harus menutup usahanya, maka ketentuan perihal likuidasi aset dan pembagiannya kepada pemegang saham, tetap merujuk pada peraturan perundangan yang berlaku.</p>
                                        <p>Anda sebagai pemodal, dapat melakukan langkah-langkah preventif agar sustainabilitas / kinerja bisnis dari saham yang Anda miliki dapat terus terjaga, salah satunya melalui pemberian masukan kepada manajemen penerbit, baik secara langsung kepada PIC yang ditunjuk oleh penerbit atau melalui pihak Santara.</p>
                                        <p>Anda juga dapat melakukan aktifitas penjualan saham melalui secondary market apabila penerbit menunjukan penurunan performa kinerja sebagai salah satu langkah preventif. Keputusan penjualan saham ini merupakan keputusan yang bersifat pribadi dari pemegang saham. Namun demikian, Santara tidak memberikan jaminan atas likuidasi dalam proses secondary market ke depan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 tab-pane fade" id="v-pills-Penerbit" role="tabpanel" aria-labelledby="v-pills-Penerbit-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Bagaimana perhitungan dividennya ?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Pertamakali, penerbit akan memutuskan jumlah dividen yang dibagikan setelah melalui mekanisme RUPS dan atau berpedoman pada kebijakan dividen pada prospektus.</p>
                                        <p>Selanjutnya, jumlah dividen yang dibagikan tersebut akan didistribusikan secara proposional sesuai dengan kepemilikan saham penerbit melalui pihak Santara. Perlu diingat, bahwa saat ini regulasi kita mengatur tentang tax dividen yang bersifat final, hal ini berarti nilai dividen yang dikirimkan kepada pemodal merupakan nilai dividen final (setelah dikurangi tax dividen).</p>
                                        <p>Contoh :</p>
                                        <p>Anda memiliki 1000 lembar saham MLUT atau senilai 2% dari keseluruhan lembar saham yang dimiliki oleh pemegang saham.</p>
                                        <p>Sesuai keputusan RUPS, bahwa dividen yang dibagikan adalah sebesar Rp.100 Juta. Maka, nilai dividen yang Anda peroleh adalah sebesar Rp 2 juta.</p>
                                        <p>Nilai dividen yang didistribusikan kepada Anda adalah sebesar Rp.1,8 Juta, yaitu diperhitungkan dari : </p>
                                        <ul style="list-style-type:circle">
                                            <li>Nilai Dividen : Rp 2 Juta, dikurangi</li>
                                            <li>Tax Dividen WPOP Dalam Negeri : 10% x Rp2 Juta = Rp 200 Ribu</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Bagaimana jika perusahaan rugi atau bangkrut?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Pada prinsipnya, Santara hanya bertindak sebagai pihak penyelenggara yang mempertemukan pihak Penerbit (UKM pelaku bisnis) dan Pemodal (investor). Bahwa dalam perjalanan operasional usaha Penerbit, sepenuhnya menjadi tanggung jawab manajemen Penerbit yang bersangkutan.</p>
                                        <p>Santara dalam hal ini bertindak mewakili Pemodal sebagai pemegang saham Penerbit termasuk dalam rapat umum pemegang saham Penerbit dan penandatanganan akta serta dokumen terkait lainnya. Santara sebagai penyelenggara juga menerapkan prinsip-prinsip manajemen risiko dalam rangka proses monitoring secara berkala terhadap keberlangsungan usaha Penerbit.</p>
                                        <p>Namun demikian, apabila terjadi case dimana suatu hari Penerbit tidak dapat bertahan dan harus menutup usahanya, maka ketentuan perihal likuidasi aset dan pembagiannya kepada pemegang saham, tetap merujuk pada peraturan perundangan yang berlaku.</p>
                                        <p>Anda sebagai pemodal, dapat melakukan langkah-langkah preventif agar sustainabilitas / kinerja bisnis dari saham yang Anda miliki dapat terus terjaga, salah satunya melalui pemberian masukan kepada manajemen penerbit, baik secara langsung kepada PIC yang ditunjuk oleh penerbit atau melalui pihak Santara.</p>
                                        <p>Anda juga dapat melakukan aktifitas penjualan saham melalui secondary market apabila penerbit menunjukan penurunan performa kinerja sebagai salah satu langkah preventif. Keputusan penjualan saham ini merupakan keputusan yang bersifat pribadi dari pemegang saham. Namun demikian, Santara tidak memberikan jaminan atas likuidasi dalam proses secondary market ke depan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="justify-content-center text-center daftarkan-bisnis-dua d-flex align-content-center flex-wrap">
        <div class=" align-self-center">
            <h1 class="row-header-bisnis ff-p fs-34" style="font-weight: 900;">Masih Bingung?</h1>
            <p class="fs-24 ff-m">Tanyakan pada tim support kami</p>
            <a href="https://api.whatsapp.com/send?phone=6281212227765&text=Saat%20ini%20Anda%20terhubung%20dengan%20Customer%20Service%20Santara%2C%20ada%20yang%20bisa%20kami%20bantu%3F%20" class="btn bg-white mt-4 c-red"><span class="fs-16" style="font-weight:bold ;padding: 10px 30px 10px 30px;">Tanya Tim Support</span></a>
        </div>

    </div>        </div>
    </main>




    <footer class="footer-static footer-light navbar-shadow">
        <!-- <div class="container-fluid p-5 ff-m">
    <div class="row kontak-align">
        <div class="col-md-2 d-flex justify-content-center">
            <img src="https://santara.co.id/assets/new-santara/img/logo/santara-white.svg" alt="logo santara" />
        </div>
        <div class="col-md-2 ff-m mt-kontak">
            <p class="fs-16 c-red">Cara Kerja</p>
            <p><a href="https://santara.co.id/cara-investasi" class="fs-12 c-white" style="text-decoration:none">Cara Investasi</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <p class="fs-16 c-red">Tentang Kami</p>
            <p><a href="http://berita.santara.co.id" target="_blank" class="fs-12 c-white" style="text-decoration:none">Berita</a></p>
            <p><a href="https://santara.co.id/career" target="_blank" class="fs-12 c-white" style="text-decoration:none">Karir</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <p class="fs-16 c-red">Support</p>
            <p><a href="https://santara.co.id/syarat-ketentuan-pemodal" class="fs-12 c-white" style="text-decoration:none">Syarat dan Ketentuan Pemodal</a></p>
            <p><a href="https://santara.co.id/syarat-ketentuan-penerbit" class="fs-12 c-white" style="text-decoration:none">Syarat dan Ketentuan Penerbit</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <div class="col-12">
                <p class="fs-16 c-red">Tentang Kami</p>
                <p class="fs-12">PT. Santara Daya Inspiratama</p>
                <p class="fs-12">Jl. Pasir No 35, Patukan, Gamping, Sleman Yogyakarta 55293</p>
            </div>
            <div class="row fs-12">
                <div class="col-12">
                    <p>Telepon:
                        <span class="c-red">(0274)2822744</span>
                    </p>
                </div>
                <div class="col-12">
                    <p>Email: <span class="c-red"><a href="mailto:customer.support@santara.co.id" style="text-decoration: none;" class="c-red">customer.support@santara.co.id</a></span></p>
                </div>
                <div class="col-12">
                    <p>WhatsApp: <span class="c-red"><a href="https://api.whatsapp.com/send?phone=6281212227765&text=Halo%2C%20apakah%20ada%20informasi%20terbaru%20tentang%20Santara%3F" class="c-red" style="text-decoration: none;">+6281212227765</a></span></p>
                </div>
            </div>
        </div>
        <div class="col-md-2 ff-m">
            <div class="col-12 fs-16 c-red mt-kontak">Download</div>
            <div class="col-12 mt-3">
                <a href="https://santara.co.id/android"><img src="https://santara.co.id/assets/new-santara/img/android-ios/play-store.svg" alt="playstore" /></a>
            </div>
            <div class="col-12 mt-3">
                <a href="https://santara.co.id/ios"><img src="https://santara.co.id/assets/new-santara/img/android-ios/app-store.svg" alt="appstore" /></a>
            </div>
        </div>

    </div>
</div> -->
        
<div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

  <div class="container disclaimer-inner-bg fs-11">

    <h4 class="text-danger ff-a fs-16">Disclaimer:</h4>
    <div class="row ff-n" style="font-weight: normal;     text-align: justify;">
      <p class="mt-2" style="margin-bottom: 8px; color: #fff;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
      </p>
    </div>
  </div>

</div>
@endsection