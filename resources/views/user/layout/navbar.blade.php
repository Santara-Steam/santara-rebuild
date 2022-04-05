<nav style="background-color: #7f1d1d"
    class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img class="brand-logo" alt="modern admin logo" style="width:100%"
                            src="{{asset('public')}}/assets/images/logo_header.png">
                        {{-- <h3 class="brand-text">Modern</h3> --}}
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0"
                        data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 light"
                            data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <a class="btn btn-dark float-right" href="{{url('/')}}">Back to Homepage</a>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                data-toggle="dropdown"><i class="ficon ft-bell"></i><span
                                    class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span>
                                    </h6><span class="notification-tag badge badge-danger float-right m-0">5 New</span>
                                </li>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-plus-square icon-bg-circle bg-cyan mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">You have new order!</h6>
                                                <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor
                                                    sit amet, consectetuer elit.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">30 minutes
                                                        ago</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-download-cloud icon-bg-circle bg-red bg-darken-1 mr-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-1">99% Server load</h6>
                                                <p class="notification-text font-small-3 text-muted">Aliquam tincidunt
                                                    mauris eu risus.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Five hour
                                                        ago</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3 mr-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                                <p class="notification-text font-small-3 text-muted">Vestibulum auctor
                                                    dapibus neque.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-check-circle icon-bg-circle bg-cyan mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Complete the task</h6><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-file icon-bg-circle bg-teal mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Generate monthly report</h6><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1 user-name text-bold-700">{{Auth::user()->trader->name}}</span>
                                <span class="avatar avatar-online">
                                    @if (empty(Auth::user()->trader->photo))
                                    <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png" alt="Avatar" style="border-radius: 50%;"/>
                                    @else
                                    <img src="{{asset('public/storage/pictures')}}/{{Auth::user()->trader->photo}}" alt="Avatar" style="border-radius: 50%;width: "/>
                                    @endif
                                </span>
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">

                                    <i class="ft-power"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div> --}}
                            <div class="dropdown-menu dropdown-menu-right text-center">
                                {{-- <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png" alt="Foto Profile"> --}}

                                @if (empty(Auth::user()->trader->photo))
                                <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png" alt="Foto Profile" style="border-radius: 50%;padding:10px"/>
                                @else
                                <img src="{{asset('public/storage/pictures')}}/{{Auth::user()->trader->photo}}" alt="Foto Profile" style="border-radius: 50%;padding:10px;width: 200px"/>
                                @endif
                                <a class="dropdown-item" href="{{url('/edit_profile')}}/{{Auth::user()->id}}"><i
                                        class="ft-user"></i> Edit Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item"
                                    href="login-with-bg-image.html"><i class="ft-power red"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</nav>