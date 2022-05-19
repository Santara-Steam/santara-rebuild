<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ 'admin' == request()->path() ? 'active' : '' }}"><a href="{{ url('admin') }}"><i
                        class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a>
            </li>
            <li class="nav-item has-sub">
                <a href="#"><i class="la la-briefcase"></i> &nbsp; Penerbit</a>
                <ul class="menu-content">
                    <li class=" nav-item {{ 'admin/emiten' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/emiten') }}"><i class="la la-briefcase"></i><span class="menu-title"
                                data-i18n="eCommerce"> Penerbit</span></a>
                    </li>
                    {{-- <li class=" nav-item {{ 'admin/pralisting' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/pralisting') }}"><i class="la la-briefcase"></i><span class="menu-title"
                                data-i18n="eCommerce">Calon Penerbit</span></a>
                    </li> --}}
                    <li class=" nav-item {{ 'admin/laporan-keuangan' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/laporan-keuangan') }}"><i class="la la-file"></i><span
                                class="menu-title" data-i18n="eCommerce"> Approval Laporan<br/> Keuangan</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/penerbit/setting-tutorial' == request()->path() ? 'active' : '' }}"><a
                        href="{{ url('admin/penerbit/setting-tutorial') }}"><i class="la la-tags"></i><span class="menu-title"
                            data-i18n="eCommerce"> &nbsp; Setting Tutorial</span></a>
                    <li class=" nav-item {{ 'admin/category' == request()->path() ? 'active' : '' }}"><a
                        href="{{ url('admin/category') }}"><i class="la la-list"></i><span class="menu-title"
                            data-i18n="eCommerce"> &nbsp; Category</span></a>
                </ul>
            </li>
            <li class="nav-item has-sub">
                <a href="#"><i class="la la-briefcase"></i> &nbsp; Calon Penerbit</a>
                <ul class="menu-content">
                    <li class=" nav-item {{ 'admin/pralisting' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/pralisting') }}"><i class="la la-briefcase"></i><span class="menu-title"
                                data-i18n="eCommerce"> Penerbit</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub">
                <a href="#"><i class="la la-money"></i> &nbsp; Finance</a>
                <ul class="menu-content">
                    {{-- <li class=" nav-item {{ 'admin/pesan_saham' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/pesan_saham') }}"><i class="la la-pencil-square"></i><span
                                class="menu-title" data-i18n="eCommerce"> Pesan Saham</span></a>
                    </li> --}}
                    <li class=" nav-item {{ 'admin/transactions' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/transactions') }}"><i class="la la-shopping-cart"></i><span
                                class="menu-title" data-i18n="eCommerce"> Histori Transaksi</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/withdraw' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/withdraw') }}"><i class="la la-money"></i><span class="menu-title"
                                data-i18n="eCommerce"> Penarikan</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/deposit' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/deposit') }}"><i class="la la-university"></i><span class="menu-title"
                                data-i18n="eCommerce"> Deposit</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/dividen' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/dividen') }}"><i class="la la-calendar"></i><span class="menu-title"
                                data-i18n="eCommerce"> Dividen</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/wallet' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/wallet') }}"><i class="la la-tablet"></i><span class="menu-title"
                                data-i18n="eCommerce"> Wallet</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub">
                <a href="#"><i class="la la-bell"></i> &nbsp; CMS & Broadcast</a>
                <ul class="menu-content">
                    <li class=" nav-item {{ 'admin/crm/target-user' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/crm/target-user') }}"><i class="la la-user"></i><span
                                class="menu-title" data-i18n="eCommerce">Target User</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/crm/broadcasting' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/crm/broadcasting') }}"><i class="la la-bell"></i><span
                                class="menu-title" data-i18n="eCommerce">Broadcast Notification</span></a>
                    </li>
                    <li class=" nav-item {{ 'admin/cms/header' == request()->path() ? 'active' : '' }}"><a
                        href="{{ url('admin/cms/header') }}"><i class="la la-image"></i><span
                            class="menu-title" data-i18n="eCommerce"> Headers</span></a></li>
                    <li class=" nav-item {{ 'admin/cms/testimoni' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/cms/testimoni') }}"><i class="la la-comment"></i><span
                                class="menu-title" data-i18n="eCommerce"> Testimoni</span></a></li>
                    <li class=" nav-item {{ 'admin/cms/supporter' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/cms/supporter') }}"><i class="la la-life-ring "></i><span
                                class="menu-title" data-i18n="eCommerce"> Supporters</span></a></li>
                    <li class=" nav-item {{ 'admin/cms/shortened' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/cms/shortened') }}"><i class="la la-link"></i><span
                                class="menu-title" data-i18n="eCommerce"> Shorteneds</span></a></li>
                    <li class=" nav-item {{ 'admin/cms/popup' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/cms/popup') }}"><i class="la la-image"></i><span
                                class="menu-title" data-i18n="eCommerce"> Popup Management</span></a></li>
                    <li class=" nav-item {{ 'admin/cms/video' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/cms/video') }}"><i class="la la-play"></i><span
                                class="menu-title" data-i18n="eCommerce"> Video Management</span></a></li>
                    <li class=" nav-item {{ 'admin/cms/video-category' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/cms/video-category') }}"><i class="la la-list"></i><span
                                class="menu-title" data-i18n="eCommerce"> Kategori Video</span></a></li>
                </ul>
            </li>
            </li>
            <li class="nav-item has-sub">
                <a href="#"><i class="la la-user"></i> &nbsp; Data Users</a>
                <ul class="menu-content">
                    <li class=" nav-item {{ 'admin/kyc/belum-kyc' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/kyc/belum-kyc') }}"><i class="la la-user"></i><span
                                class="menu-title" data-i18n="eCommerce"> Belum KYC</span></a></li>
                    <li class=" nav-item {{ 'admin/kyc/sudah-kyc' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/kyc/sudah-kyc') }}"><i class="la la-user"></i><span
                                class="menu-title" data-i18n="eCommerce"> Sudah KYC</span></a></li>
                    <li class=" nav-item {{ 'admin/kyc/approve-kyc' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/kyc/approve-kyc') }}"><i class="la la-user"></i><span
                                class="menu-title" data-i18n="eCommerce"> KYC Disetujui</span></a></li>
                    <li class=" nav-item {{ 'admin/kyc/reject-kyc' == request()->path() ? 'active' : '' }}"><a
                            href="{{ url('admin/kyc/reject-kyc') }}"><i class="la la-user"></i><span
                                class="menu-title" data-i18n="eCommerce"> KYC Ditolak</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub">
                <a href="#"><i class="la la-gear"></i> &nbsp; Setting</a>
                <ul class="menu-content">
                    <li class=" nav-item {{ 'admin/setting/account' == request()->path() ? 'active' : '' }}"><a
                        href="{{ url('admin/setting/account') }}"><i class="la la-user"></i><span
                            class="menu-title" data-i18n="eCommerce"> Account</span></a></li>
                </ul>
        </ul>
    </div>
    {{-- <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ 'admin' == request()->path() ? 'active' : '' }}"><a href="{{url('admin')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">Penerbit</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/emiten' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/emiten')}}"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="eCommerce">Penerbit</span></a>
            </li>
            <li class=" nav-item {{ 'admin/pralisting' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/pralisting')}}"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="eCommerce">Calon Penerbit</span></a>
            </li>
            <li class=" nav-item {{ 'admin/laporan-keuangan' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/laporan-keuangan')}}"><i class="la la-file"></i><span class="menu-title" data-i18n="eCommerce">Laporan Keuangan</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">Transaksi</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/pesan_saham' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/pesan_saham')}}"><i class="la la-pencil-square"></i><span class="menu-title" data-i18n="eCommerce">Pesan Saham</span></a>
            </li>
            <li class=" nav-item {{ 'admin/transactions' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/transactions')}}"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="eCommerce">Histori Transaksi</span></a>
            </li>
            <li class=" nav-item {{ 'admin/withdraw' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/withdraw')}}"><i class="la la-money"></i><span class="menu-title" data-i18n="eCommerce">Penarikan</span></a>
            </li>
            <li class=" nav-item {{ 'admin/deposit' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/deposit')}}"><i class="la la-university"></i><span class="menu-title" data-i18n="eCommerce">Deposit</span></a>
            </li>
            <li class=" nav-item {{ 'admin/dividen' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/dividen')}}"><i class="la la-calendar"></i><span class="menu-title" data-i18n="eCommerce">Dividen</span></a>
            </li>
            <li class=" nav-item {{ 'admin/wallet' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/wallet')}}"><i class="la la-tablet"></i><span class="menu-title" data-i18n="eCommerce">Wallet</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">CRM</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/crm/target-user' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/crm/target-user')}}"><i class="la la-user"></i><span class="menu-title" data-i18n="eCommerce">Target User</span></a>
            </li>
            <li class=" nav-item {{ 'admin/crm/broadcasting' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/crm/broadcasting')}}"><i class="la la-bell"></i><span class="menu-title" data-i18n="eCommerce">Broadcast Notification</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">Category</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            <li class=" nav-item {{ 'admin/category' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/category')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="eCommerce">Category</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">New KYC</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/kyc/belum-kyc' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/kyc/belum-kyc')}}"><i class="la la-user"></i><span class="menu-title" data-i18n="eCommerce">Belum KYC</span></a>
            <li class=" nav-item {{ 'admin/kyc/sudah-kyc' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/kyc/sudah-kyc')}}"><i class="la la-user"></i><span class="menu-title" data-i18n="eCommerce">Sudah KYC</span></a>
            <li class=" nav-item {{ 'admin/kyc/approve-kyc' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/kyc/approve-kyc')}}"><i class="la la-user"></i><span class="menu-title" data-i18n="eCommerce">KYC Disetujui</span></a>
            <li class=" nav-item {{ 'admin/kyc/reject-kyc' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/kyc/reject-kyc')}}"><i class="la la-user"></i><span class="menu-title" data-i18n="eCommerce">KYC Ditolak</span></a>
            <li class="navigation-header"><span data-i18n="Layouts">Content Management System</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/cms/header' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/cms/header')}}"><i class="la la-image"></i><span class="menu-title" data-i18n="eCommerce">Headers</span></a>
            <li class=" nav-item {{ 'admin/cms/testimoni' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/cms/testimoni')}}"><i class="la la-comment"></i><span class="menu-title" data-i18n="eCommerce">Testimoni</span></a>
            <li class=" nav-item {{ 'admin/cms/supporter' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/cms/supporter')}}"><i class="la la-life-ring "></i><span class="menu-title" data-i18n="eCommerce">Supporters</span></a>
            <li class=" nav-item {{ 'admin/cms/shortened' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/cms/shortened')}}"><i class="la la-link"></i><span class="menu-title" data-i18n="eCommerce">Shorteneds</span></a>
            <li class=" nav-item {{ 'admin/cms/popup' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/cms/popup')}}"><i class="la la-image"></i><span class="menu-title" data-i18n="eCommerce">Popup Management</span></a>
            <li class=" nav-item {{ 'admin/cms/video' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/cms/video')}}"><i class="la la-play"></i><span class="menu-title" data-i18n="eCommerce">Video Management</span></a>
        </ul>
    </div> --}}
</div>
