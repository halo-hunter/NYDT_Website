<div class="nav-container primary-menu">
    <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a  class="nav-link" href="{{ route('customers->show') }}">--}}
{{--                    <div class="parent-icon"><i class='bx bx-building'></i>--}}
{{--                    </div>--}}
{{--                    <div class="menu-title">Clients (Old)</div>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('clients->show') }}">
                    <div class="parent-icon"><i class='bx bx-user-check'></i>
                    </div>
                    <div class="menu-title">Clients</div>
                </a>
            </li>
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('cases->show') }}">
                    <div class="parent-icon"><i class="bx bx-list-ul"></i>
                    </div>
                    <div class="menu-title">Cases</div>
                </a>
            </li>
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('calendar->index') }}">
                    <div class="parent-icon"><i class='bx bx-calendar'></i>
                    </div>
                    <div class="menu-title">Calendar</div>
                </a>
            </li>
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('attorneys->show') }}">
                    <div class="parent-icon"><i class='bx bxs-user-account'></i>
                    </div>
                    <div class="menu-title">Attorneys</div>
                </a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->user_level_id == 1)
                <li class="nav-item">
                    <a  class="nav-link" href="{{ route('users->show') }}">
                        <div class="parent-icon"><i class='bx bx-user'></i>
                        </div>
                        <div class="menu-title">Users</div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                        <div class="parent-icon"><i class="bx bx-cog"></i>
                        </div>
                        <div class="menu-title">Settings</div>
                    </a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="{{ route('company_info->show') }}"><i class="bx bx-right-arrow-alt"></i>Company Info</a>
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('settings->email_settings') }}"><i class="bx bx-right-arrow-alt"></i>Email Settings</a>
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('settings->payment_settings') }}"><i class="bx bx-right-arrow-alt"></i>Payment Settings</a>
                        </li>
                        <li class="nav-item dropend">
                            <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>API Connections</a>
                            <ul class="dropdown-menu submenu nav_2_submenu">
                                <li><a class="dropdown-item" href="{{ route('api_connections->twilio') }}"><i class="bx bx-radio-circle"></i>Twilio</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropend">
                            <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>System Status</a>
                            <ul class="dropdown-menu submenu nav_2_submenu">
                                <li><a class="dropdown-item" href="{{ route('system_status->twilio') }}"><i class="bx bx-radio-circle"></i>Twilio</a></li>
                            </ul>
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('settings->reminder_settings') }}"><i class="bx bx-right-arrow-alt"></i>Reminder Settings</a>
                        </li>
                    </ul>
                </li>
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">--}}
{{--                        <div class="parent-icon"><i class="bx bx-atom"></i>--}}
{{--                        </div>--}}
{{--                        <div class="menu-title">API Connections</div>--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        <li>--}}
{{--                            <a class="dropdown-item" href="{{ route('api_connections->twilio') }}"><i class="bx bx-right-arrow-alt"></i>Twilio</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            @endif

        </ul>
    </nav>
</div>
