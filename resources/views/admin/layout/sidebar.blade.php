<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ 'admin' == request()->path() ? 'active' : '' }}"><a href="{{url('admin')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a>
            </li>
            <li class=" nav-item {{ 'admin/emiten' == request()->path() ? 'active' : '' }}"><a href="{{url('admin/emiten')}}"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="eCommerce">Penerbit</span></a>
            </li>
            <li class="nav-item "><a href=""><i class="la la-external-link-square"></i><span class="menu-title" data-i18n="eCommerce">Direct Dashboard</span></a>
            </li>
            
        </ul>
    </div>
</div>