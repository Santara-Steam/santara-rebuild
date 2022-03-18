<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ 'user' == request()->path() ? 'active' : '' }}"><a href="{{url('user')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a>
            </li>
            <li class=" nav-item {{ 'user/emiten' == request()->path() ? 'active' : '' }}"><a href="{{url('user/emiten')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Penerbit</span></a>
            </li>
            <li class=" nav-item {{ 'user/pesan_saham' == request()->path() ? 'active' : '' }}"><a href="{{url('user/pesan_saham')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Pesan Saham</span></a>
            </li>
            <li class="nav-item "><a href=""><i class="la la-external-link-square"></i><span class="menu-title" data-i18n="eCommerce">Direct Dashboard</span></a>
            </li>
            
        </ul>
    </div>
</div>