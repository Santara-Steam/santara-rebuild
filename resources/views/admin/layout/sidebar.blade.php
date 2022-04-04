<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ 'admin' == request()->path() ? 'active' : '' }}"><a href="{{url('admin')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">Penerbit</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/emiten' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/emiten')}}"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="eCommerce">Penerbit</span></a>
            </li>
            <li class="navigation-header"><span data-i18n="Layouts">Transaksi</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class=" nav-item {{ 'admin/pesan_saham' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/pesan_saham')}}"><i class="la la-pencil-square"></i><span class="menu-title" data-i18n="eCommerce">Pesan Saham</span></a>
            </li>
            <li class=" nav-item {{ 'admin/transactions' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/transactions')}}"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="eCommerce">Transaksi</span></a>
            </li>
            {{-- <li class="nav-item "><a href=""><i class="la la-external-link-square"></i><span class="menu-title" data-i18n="eCommerce">Direct Dashboard</span></a>
            </li> --}}
            
        </ul>
    </div>
</div>