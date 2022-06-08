@extends('front_end/template_front_end/app')

@section('content')
<div class="bg-2" style="margin-top: 96px;">
        <div class="banner_section">
            <div class="container" style="margin-top:60px">
               <div class="section">
                  <div class="header-dan-supporting-text">
                    <div class="tx-bn inter-bold-alabaster-48px">
                      <span class="text-urun inter-bold-alabaster">Daftarkan Bisnis Anda Dapatkan Modal Bisnis Dari Pemodal Setia Kami</span>
                    </div>
                  </div>
                  <div class="actions2">
                        <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ route('daftar-bisnis.create') }}">Daftarkan Bisnis</a>
                  </div>
                </div>
              </div>
          </div>
      </div>
      <!-- fashion section start -->
      <div class="fashion_section" style="margin-top: 0px;">
         <div class="container">
          <div class="section-langkah-mudah">
          <div class="langkah-mudah-daftarkan-bisnis-anda inter-normal-alabaster-36px">
            <span class="text-urun inter-normal-alabaster">Langkah Mudah Daftarkan Bisnis Anda</span>
          </div>
          <div class="content-1">
            <div class="content-2">
              <div class="content-3">
                <div class="x1-buat-akun inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-18px">1. Buat Akun</span>
                </div>
                <p class="buat-akun-di-santara inter-normal-alabaster-16px">
                  <span class="tx-np inter-normal-alabaster"
                    >Buat akun di Santara. Cukup dengan klik daftar di tab navigasi lalu isi form pendaftaran.</span
                  >
                </p>
              </div>
              <div class="content-4">
                <div class="x2-input-data-bisnis-anda inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-18px">2. Input Data Bisnis Anda</span>
                </div>
                <p class="masukkan-data-bisnis inter-normal-alabaster-16px">
                  <span class="tx-np inter-normal-alabaster"
                    >Masukkan data bisnis Anda beserta gambar dan video profil perusahaan untuk menarik Pemodal.</span
                  >
                </p>
              </div>
              <div class="content-4">
                <div class="x3-tunggu-verifikasi inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-18px">3. Tunggu Verifikasi</span>
                </div>
                <p class="tunggu-verifikasi-s inter-normal-alabaster-16px">
                  <span class="tx-np inter-normal-alabaster"
                    >Tunggu verifikasi. Setelah verifikasi bisnis Anda masuk ke pra listing dan Pemodal akan melakukan
                    vote untuk memilih bisnis yang akan listing selanjutnya.</span
                  >
                </p>
              </div>
              <div class="content-4">
                <div class="x4-listing-di-santara inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-18px">4. Listing di Santara</span>
                </div>
                <p class="bisnis-dengan-vote-y inter-normal-alabaster-16px">
                  <span class="tx-np inter-normal-alabaster"
                    >Bisnis dengan vote yang banyak dan memenuhi syarat listing dan Santara akan melakukan pendanaan.
                    Pemodal bisa investasi di perusahaan Anda.</span
                  >
                </p>
              </div>
            </div>
            <img class="image" src="{{ asset('assets/images/image-7@2x.png') }}" />
          </div>
        </div>
            </div>
        </div>
        <div class="cta-section">
          <div class="ayo-daftarkan-bisnis-anda inter-normal-alabaster-40px">
            <span class="text-urun inter-normal-alabaster">Ayo Daftarkan Bisnis Anda!</span>
          </div>
          <div class="actions3 ">
                        <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ route('daftar-bisnis.create') }}">Daftarkan Bisnis</a>
                  </div>
          </div>
        </div>


            </div>
             </div>
          </div>

          <!-- footer section start -->
      <div class="footer_section ">
         <div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

          <div class="container disclaimer-inner-bg" style="font-size: 11px;">

            <h4 class="text-danger ff-a fs-16" style="font-size: 16px; font-family: 'acumin-pro'; margin-left: 5px; margin-bottom: -2px">Disclaimer:</h4>
            <div class="row ff-n" style="font-weight: normal;     text-align: justify; margin-right: -15px; font-family: 'Nunito'; font-size: 11px;">
              <p class="mt-2" style="margin-bottom: 8px; color: #fff; font-size: 11px;line-height:1.5;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
              </p>
              <p style="margin-bottom: 8px; color: #fff; font-size: 11px;line-height:1.5; "; >
                Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
              </p>
              <p style="margin-bottom: 8px;color: #fff; font-size: 11px; line-height:1.5; ">
                “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
              </p>
              <p style="margin-bottom: 8px;color: #fff; font-size: 11px;  line-height:1.5;">
                “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
              </p>
              <p style="margin-bottom: 8px;color: #fff; font-size: 11px; line-height:1.5; ">
                “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
              </p>
            </div>
          </div>

        </div>
      </div>
@endsection
