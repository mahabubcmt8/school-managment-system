<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="index.html"><img src="{{ asset('backend/assets/images/icon-light.svg') }}" alt="HexaBit Logo" class="img-fluid logo"></a>
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
            <a href="javascript:void(0);" class="icon-menu btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
        </div>

        <div class="navbar-right">


            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    {{-- <li class="dropdown dropdown-animated scale-left">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="notification-dot"></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget">
                            <li class="header">You have 5 new Notifications</li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="feeds-left"><i class="fa fa-thumbs-o-up text-success"></i></div>
                                    <div class="feeds-body">
                                        <h4 class="title text-success">7 New Feedback <small class="float-right text-muted">Today</small></h4>
                                        <small>It will give a smart finishing to your site</small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="icon-menu" data-toggle="tooltip" data-placement="top" data-original-title="logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </li>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
