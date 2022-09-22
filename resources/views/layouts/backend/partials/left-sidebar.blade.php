<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="index.html">
            <img src="{{ asset('backend/assets/images/icon-light.svg') }}" alt="Software Logo"
                class="img-fluid logo"><span>HexaBit</span>
        </a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right">
            <i class="lnr lnr-menu fa fa-chevron-circle-left"></i>
        </button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name"
                    data-toggle="dropdown"><strong>{{ auth()->user()->name ??
                        'Christy
                                                            Wert' }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i
                                class="icon-power"></i>Logout</a></li>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="active"><a href="{{ route('home') }}"><i class="fa icon-home"></i><span>Dashboard</span></a>
                </li>
                <li class="">
                    <a href="{{ route('users.index') }}">
                        <i class="fa fa-building-o"></i><span>Users</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('teacher.index') }}">
                        <i class="fa fa-building-o"></i><span>Teacher</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('class.index') }}">
                        <i class="fa fa-building-o"></i><span>Class</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('section.index') }}">
                        <i class="fa fa-adjust"></i><span>Section</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('classroom.index') }}">
                        <i class="fa icon-drawer"></i><span>Class Room</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('department.index') }}">
                        <i class="fa icon-layers"></i><span>Department</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('subject.store') }}">
                        <i class="fa  fa-table"></i><span>Subject</span>
                    </a>
                </li>
                <li>
                    <a href="#uiElements" class="has-arrow"><i class="icon-diamond"></i><span>Users</span></a>
                    <ul>
                        <li><a href="{{ route('roles.index') }}">Users Role</a></li>
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
