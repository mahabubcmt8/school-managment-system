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
                        'Christy Wert' }}</strong></a>
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
                <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}"><i
                            class="fa icon-home"></i><span>Dashboard</span></a>
                </li>
                <li class="{{ Request::routeIs('users.index') || Request::routeIs('roles.index') ? 'active' : '' }}">
                    <a href="#uiElements" class="has-arrow"><i class="fa icon-users"></i><span>Employee</span></a>
                    <ul>
                        <li class="{{ Request::routeIs('users.index') ? 'active' : '' }}"><a
                                href="{{ route('users.index') }}">Users</a></li>
                        <li class="{{ Request::routeIs('roles.index') ? 'active' : '' }}"><a
                                href="{{ route('roles.index') }}">Role & Permission</a></li>
                    </ul>
                </li>
                <li
                    class="{{ Request::routeIs('class.index') || Request::routeIs('section.index') || Request::routeIs('subject.index') || Request::routeIs('department.index') || Request::routeIs('classroom.index') ? 'active' : '' }}">
                    <a href="#uiElements" class="has-arrow"><i class="fa icon-book-open"></i><span>Academic</span></a>
                    <ul>
                        <li class="{{ Request::routeIs('class.index') ? 'active' : '' }}"><a
                                href="{{ route('class.index') }}">Class</a></li>
                        <li class="{{ Request::routeIs('section.index') ? 'active' : '' }}"><a
                                href="{{ route('section.index') }}">Section</a></li>
                        <li class="{{ Request::routeIs('subject.index') ? 'active' : '' }}"><a
                                href="{{ route('subject.index') }}">Subject</a></li>
                        <li class="{{ Request::routeIs('department.index') ? 'active' : '' }}"><a
                                href="{{ route('department.index') }}">Department</a></li>
                        <li class="{{ Request::routeIs('classroom.index') ? 'active' : '' }}"><a
                                href="{{ route('classroom.index') }}">Class Room</a></li>
                    </ul>
                </li>
                <li
                    class="{{ Request::routeIs('class-routine.create') || Request::routeIs('class-routine.index') ? 'active' : '' }}">
                    <a href="#uiElements" class="has-arrow"><i class="fa icon-book-open"></i><span>Class Routine</span></a>
                    <ul>
                        <li class="{{ Request::routeIs('class-routine.create') ? 'active' : '' }}"><a
                                href="{{ route('class-routine.create') }}">New Routine</a></li>
                        <li class="{{ Request::routeIs('class-routine.index') ? 'active' : '' }}"><a
                                    href="{{ route('class-routine.index') }}">Get Routine</a></li>
                    </ul>
                </li>
                <li
                    class="">
                    <a href="#uiElements" class="has-arrow"><i class="fa icon-book-open"></i><span>Exam</span></a>
                    <ul>
                        <li class="{{ Request::routeIs('exam.index') ? 'active' : '' }}"><a
                                href="{{ route('exam.index') }}">Exam List</a></li>
                        <li class="{{ Request::routeIs('schedule.index') ? 'active' : '' }}"><a
                                    href="{{ route('exam-schedule.index') }}">Exam Schedule</a></li>
                    </ul>
                </li>
                <li
                    class="">
                    <a href="#uiElements" class="has-arrow"><i class="fa icon-book-open"></i><span>Student</span></a>
                    <ul>
                        <li class="{{ Request::routeIs('students.create') ? 'active' : '' }}"><a
                                href="{{ route('students.create') }}">Add Student</a></li>
                        <li class="{{ Request::routeIs('students.index') ? 'active' : '' }}"><a
                                    href="{{ route('students.index') }}">All Student</a></li>
                        <li class="{{ Request::routeIs('guardians.index') ? 'active' : '' }}"><a
                                        href="{{ route('guardians.index') }}">Guardians</a></li>
                    </ul>
                </li>
                <li
                    class="{{ Request::routeIs('fees-type.index') || Request::routeIs('fees.index') || Request::routeIs('expense-type.index') || Request::routeIs('expense.index') ? 'active' : '' }}">
                    <a href="#uiElements" class="has-arrow"><i class=" icon-calculator"></i><span>Accounting</span></a>
                    <ul>
                        <li class="{{ Request::routeIs('fees-type.index') ? 'active' : '' }}"><a
                                href="{{ route('fees-type.index') }}">Fees Type</a></li>
                        <li class="{{ Request::routeIs('fees.index') ? 'active' : '' }}"><a
                                    href="{{ route('fees.index') }}">Fees List</a></li>
                        <li class="{{ Request::routeIs('expense-type.index') ? 'active' : '' }}"><a
                                        href="{{ route('expense-type.index') }}">Expense Type</a></li>
                        <li class="{{ Request::routeIs('expense.index') ? 'active' : '' }}"><a
                                            href="{{ route('expense.index') }}">Expense</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
