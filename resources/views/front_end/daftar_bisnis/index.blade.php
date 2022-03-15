@extends('front_end/template_front_end/app')

@section('content')
<div class="bg-2" style="background-image: url({{ asset('public/assets/images/background@1x.png') }}";>
        <div class="banner_section layout_padding">
            <div class="container">
               <div class="section">
                  <div class="header-dan-supporting-text">
                    <div class="tx-bn inter-bold-alabaster-48px">
                      <span class="text-urun inter-bold-alabaster">Daftarkan Bisnis Anda Dapatkan Modal Bisnis Dari Pemodal Setia Kami</span>
                    </div>
                  </div>
                  <div class="actions">
                      <div class="mulai-investasi button-cta-3 inter-medium-white-18px">
                        <a class="button-2 text-mulai btn btn-danger btn-hm inter-medium-white" href="{{ route('daftar-bisnis.add') }}">Daftarkan Bisnis</a>
                      </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
      <!-- fashion section start -->
      <div class="fashion_section">
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
            <img class="image" src="{{ asset('public/assets/images/image-7@2x.png') }}" />
          </div>
        </div>      
            </div>
        </div>
        <div class="cta-section">
          <div class="ayo-daftarkan-bisnis-anda inter-normal-alabaster-40px">
            <span class="text-urun inter-normal-alabaster">Ayo Daftarkan Bisnis Anda!</span>
          </div>
          <div class="mulai-investasi button-cta-3 inter-medium-white-18px">
                        <a class="button-2 text-mulai btn btn-danger btn-hm inter-medium-white" href="{{ route('daftar-bisnis.add') }}">Daftarkan Bisnis</a>
                      </div>
        </div>
            
           
            </div>
             </div>
          </div>
@endsection