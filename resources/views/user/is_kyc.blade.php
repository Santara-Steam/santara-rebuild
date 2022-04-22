@if (Auth::user()->is_verified_kyc == 1)
<div class="card">
    <div class="card-body p-0">
        <div class="card-content">
            <div class="notification_kyc col-xs-12 col-xl-12 text-center">
                <div style="line-height: 30px; color: #000000;">
                    <div style="font-size: 18px;">
                        <b>Untuk melakukan transaksi. Anda harus melengkapi profil di
                            aplikasi Santara</b>
                    </div>
                    <div style="font-size: 15px; padding-bottom: 18px;">
                        Profile kamu akan diverifikasi oleh tim kami dalam waktu 1 x 24, yuk
                        lengkapi profilmu transaksi dapat berjalan dengan lancar.
                    </div>
                    <div><b><a href="https://play.google.com/store/apps/details?id=id.co.santara.app"
                                style="text-decoration: underline;" class="label-font"
                                target="_blank">
                                Download Aplikasi Android
                            </a></b></div>
                    <div><b><a href="https://apps.apple.com/id/app/santara-app/id1473570177"
                                style="text-decoration: underline;" class="label-font"
                                target="_blank">
                                Download Aplikasi IOS
                            </a></b></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
