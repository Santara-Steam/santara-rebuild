@extends('front_end/template_front_end/app')

@section('content')

      <div class="bg-2" style="background-image: url({{ asset('public/assets/images/hero-section-1@2x.png') }} ">
        <div class="banner_section layout_padding">
            <div class="container" style="margin-top: 60px">
               <div class="section">
                  <div class="header-dan-supporting-text">
                    <div class="tx-bn inter-bold-alabaster-48px">
                      <span class="text-urun inter-bold-alabaster">Langkah Sederhana Memulai Investasi di Santara</span>
                    </div>
                    <div class="tx-sb inter-normal-alabaster-18px">
                      <span class="text-sb inter-normal-alabaster"
                        >Investasi tidak perlu rumit, siapapun bisa berinvestasi.</span
                      >
                    </div>
                  </div>
                  <div class="actions2"> 
                        <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ route ('login')}}">Mulai Investasi</a>
                  </div>
                </div>
              </div>
              <img class="image-mul" src="{{ asset('public/assets/images/image-1@2x.png') }}" />
          </div>
      </div>
      <!-- fashion section start -->
      <div class="fashion_section" style="margin-top: 0px;">
         <div class="container">
          <div class="panduan-section">
          <div class="langkah-mudah-daftarkan-bisnis-anda inter-normal-alabaster-36px">
            <span class="text-urun inter-normal-alabaster"
              >Panduan singkat cara investasi dari kami dan dapatkan penghasilan rutin dari bagi hasil bisnis yang Anda
              pilih.</span
            >
          </div>
          <div class="panduan-1">
            <div class="panduan-2">
              <img class="image" src="{{ asset('public/assets/images/image-2@2x.png') }}" />
              <div class="content-4">
                <div class="x3-tunggu-verifikasi inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-24px">1. Daftar ke Santara</span>
                </div>
                <div class="buat-akun-di-santara inter-normal-alabaster-18px">
                  <span class="tx-np inter-normal-alabaster"
                    >Buat akun di Santara. Cukup dengan klik daftar di tab navigasi lalu isi form pendaftaran.</span
                  >
                </div>
              </div>
            </div>
            <div class="panduan">
              <img class="image" src="{{ asset('public/assets/images/image-3@2x.png') }}" />
              <div class="content-4">
                <div class="x3-tunggu-verifikasi inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-24px">2. Lengkapi Profilmu</span>
                </div>
                <div class="beritahu-kami-tentan inter-normal-alabaster-18px">
                  <span class="tx-np inter-normal-alabaster"
                    >Beritahu kami tentang diri Anda. Dengan mengisi form KYC, agar kami bisa mengetahui preferensi dan
                    memverifikasi keaslian profil untuk keamanan berinvestasi.</span
                  >
                </div>
              </div>
            </div>
            <div class="panduan">
              <img class="image" src="{{ asset('public/assets/images/image-4@2x.png') }}" />
              <div class="content-4">
                <div class="x3-tunggu-verifikasi inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-24px">3. Tunggu Verifikasi</span>
                </div>
                <div class="name inter-normal-alabaster">
                  <span class="tx-np inter-normal-alabaster-18px"
                    >Tim kami akan memverifikasi form biodata. Kami memastikan proses verifikasi dilakukan dalam 24-72
                    jam.</span
                  >
                </div>
              </div>
            </div>
            <div class="panduan">
              <img class="image" src="{{ asset('public/assets/images/image-5@2x.png') }}" />
              <div class="content-4">
                <div class="x3-tunggu-verifikasi inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-24px">4. Pilih Bisnis</span>
                </div>
                <div class="pilih-bisnis-favorit inter-normal-alabaster-18px">
                  <span class="tx-np inter-normal-alabaster"
                    >Pilih bisnis favorit. Bisnis sudah berjalan, lebih cepat untungnya lebih kecil risikonya.</span
                  >
                </div>
              </div>
            </div>
            <div class="panduan">
              <img class="image" src="{{ asset('public/assets/images/image-6@2x.png') }}" />
              <div class="content-4">
                <div class="x3-tunggu-verifikasi inter-normal-alabaster-18px">
                  <span class="inter-normal-alabaster-24px">5. Masukan Nilai Investasi</span>
                </div>
                <div class="masukan-nominal-inve inter-normal-alabaster-18px">
                  <span class="tx-np inter-normal-alabaster"
                    >Masukan nominal investasi yang diinginkan. Anda akan mendapatkan bagi hasil sesuai persentase
                    nominal yang dimasukkan.</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>      
            </div>
        </div>
        <div class="cta-section">
          <div class="container">
          <div class="ayo-daftarkan-bisnis-anda inter-normal-alabaster-40px">
            <span class="text-urun inter-normal-alabaster">Ayo Investasi di Santara!</span>
          </div>
          <div class="actions3 "> 
                        <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ route ('login')}}">Mulai Investasi</a>
                  </div>
          </div>
        </div>
            
           
            </div>
             </div>
          </div>

<div class="footer_section ">
         <div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

          <div class="container disclaimer-inner-bg" style="font-size: 11px;">

            <h4 class="text-danger ff-a fs-16" style="font-size: 16px; font-family: 'acumin-pro'; margin-left: 5px; margin-bottom: -2px">Disclaimer:</h4>
            <div class="row ff-n" style="font-weight: normal;     text-align: justify; margin-right: -15px; font-family: 'Nunito'; font-size: 11px;">
              <p class="mt-2" style="margin-bottom: -10px; color: #fff; font-size: 11px;line-height:1.5;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
              </p>
              <p style="margin-bottom: -10px; color: #fff; font-size: 11px;line-height:1.5; "; >
                Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
              </p>
              <p style="margin-bottom: -10px;color: #fff; font-size: 11px; line-height:1.5; ">
                “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
              </p>
              <p style="margin-bottom: -10px;color: #fff; font-size: 11px;  line-height:1.5;">
                “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
              </p>
              <p style="margin-bottom: -10px;color: #fff; font-size: 11px; line-height:1.5; ">
                “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
              </p>
            </div>
          </div>

        </div>
      </div>
@endsection