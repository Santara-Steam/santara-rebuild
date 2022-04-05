
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <div class="menu-profile">
                <div class="profile-greeting">Hallo,</div>
                <div class="profile-name">
                    <b>Satrya Wira Wicaksana</b>
                </div>
                <div class="profile-aset mb-2">
                    <table class="table-fixed">
                        <tr>
                            <td>Saldo</td>
                            <td>Rp. 0</td>
                        </tr>
                                                        <tr style="border-bottom: 1rem solid transparent;">
                            <td>Nilai Investasi</td>
                            <td>Rp. 7.500.000</td>
                        </tr>
                                                            <tr>
                                <td>Total Aset</td>
                                <td>Rp. 7.500.000</td>
                            </tr>
                        
                    </table>
                </div>
                <a href="#" class="btn btn-santara-red btn-block" type="button">
                    Mulai Investasi
                </a>
            </div>
            <li class=" nav-item "><a href="#"><i class="la la-credit-card"></i><span class="menu-title" data-i18n="eCommerce">Deposit</span></a>
            </li>
            <li class=" nav-item "><a href="#"><i class="la la-arrow-circle-down"></i><span class="menu-title" data-i18n="eCommerce">Penarikan</span></a>
            </li>
            <hr>
            <li class=" nav-item {{ 'user' == request()->path() ? 'active' : '' }}"><a href="{{url('user')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a>
            </li>
            <li class=" nav-item {{ 'user/transaksi' == request()->path() ? 'active' : '' }}"><a href="{{url('user/transaksi')}}"><i class="la la-money"></i><span class="menu-title" data-i18n="eCommerce">Transaksi</span></a>
            </li>
            {{-- <li class="navigation-header"><span data-i18n="Layouts">Penerbit</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li> --}}
            <li class=" nav-item {{ 'user/emiten' == request()->path() ? 'active' : '' }}"><a href="{{url('user/emiten')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="eCommerce">List Penerbit</span></a>
            </li>
            {{-- <li class="navigation-header"><span data-i18n="Layouts">Transaksi</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li> --}}
            <li class=" nav-item {{ 'user/pesan_saham' == request()->path() ? 'active' : '' }}"><a href="{{url('user/pesan_saham')}}"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="eCommerce">Pesan Saham</span></a>
            </li>
            {{-- <li class="navigation-header"><span data-i18n="Layouts">Bisnis</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li> --}}
            <li class=" nav-item"><a href="{{url('daftar-bisnis/create')}}"><i class="la la-plus-circle"></i><span class="menu-title" data-i18n="eCommerce">Daftarkan Bisnis</span></a>
            </li>
            <li class=" nav-item {{ 'user/bisnis_anda' == request()->path() ? 'active' : '' }}"><a href="{{url('user/bisnis_anda')}}"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="eCommerce">Bisnis Anda</span></a>
            </li>
            {{-- <li class="nav-item "><a href=""><i class="la la-external-link-square"></i><span class="menu-title" data-i18n="eCommerce">Direct Dashboard</span></a>
            </li>
             --}}
             <li class=" nav-item "><a href="#"><i class="la la-calendar"></i><span class="menu-title" data-i18n="eCommerce">Dividen</span></a>
             </li>
             <li class=" nav-item "><a href="#"><i class="la la-history"></i><span class="menu-title" data-i18n="eCommerce">Riwayat Pengguna</span></a>
             </li>
        </ul>
    </div>
</div>