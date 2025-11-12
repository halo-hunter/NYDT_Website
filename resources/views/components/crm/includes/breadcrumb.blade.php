<div class="container-fluid page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><a href="{{ route('dashboard') }}">CRM</a></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">

                @if(request()->route()->getName() == 'clients->show')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Clients</a>
                    </li>
                @endif


                @if(request()->route()->getName() == 'clients->insert')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('clients->show') }}">Clients</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Add Client</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'clients->edit')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('clients->show') }}">Clients</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Edit Client</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'clients->delete')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('clients->show') }}">Clients</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Delete Customer</a>
                    </li>
                @endif




                @if(request()->route()->getName() == 'cases->show')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Cases</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'cases->insert')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('cases->show') }}">Cases</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Add Case</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'cases->edit')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('cases->show') }}">Cases</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Edit Case</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'cases->delete')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('cases->show') }}">Cases</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Delete Case</a>
                    </li>
                @endif



                @if(request()->route()->getName() == 'attorneys->show')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Attorneys</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'attorneys->insert')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('attorneys->show') }}">Attorneys</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Add Attorney</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'attorneys->edit')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('attorneys->show') }}">Attorneys</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Edit Attorney</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'attorneys->delete')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('attorneys->show') }}">Attorneys</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Delete Attorney</a>
                    </li>
                @endif



                @if(request()->route()->getName() == 'users->show')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Users</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'users->insert')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('users->show') }}">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Add User</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'users->edit')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('users->show') }}">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Edit User</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'users->delete')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('users->show') }}">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Delete User</a>
                    </li>
                @endif



                @if(request()->route()->getName() == 'company_info->show')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Company Info</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'settings->email_settings')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Email Settings</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'settings->payment_settings')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Payment Settings</a>
                    </li>
                @endif



                @if(request()->route()->getName() == 'profile->settings')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Profile Settings</a>
                    </li>
                @endif



                @if(request()->route()->getName() == 'family_members->edit')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Edit Family Member</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'family_members->delete')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ url()->current() }}">Delete Family Member</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'api_connections->twilio')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            API Connections
                        </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('api_connections->twilio') }}">Twilio</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'system_status->twilio')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        System Status
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('system_status->twilio') }}">Twilio</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'settings->reminder_settings')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('settings->reminder_settings') }}">Reminder settings</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'entry_date->edit')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">
                        <a href="{{ url()->current() }}">Edit Entry Date</a>
                    </li>
                @endif

                @if(request()->route()->getName() == 'entry_date->delete')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">
                        <a href="{{ url()->current() }}">Delete Entry Date</a>
                    </li>
                @endif

                    @if(request()->route()->getName() == 'calendar->index')
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ url()->current() }}">Calendar</a>
                        </li>
                    @endif

            </ol>
        </nav>
    </div>
</div>
