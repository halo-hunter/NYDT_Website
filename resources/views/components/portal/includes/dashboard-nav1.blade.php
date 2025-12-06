<div class="topbar d-flex align-items-center">
    <nav class="navbar navbar-expand">
        <div class="topbar-logo-header">
            <div class="">
                <a href="{{ route('dashboard') }}"><h4 class="logo-text">{{ config('app.company_short_name_for_portal') }}</h4></a>
            </div>
        </div>
        <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
        <div class="top-menu ms-auto"></div>
        <div class="user-box">
            <a class="d-flex align-items-center nav-link">
                <div class="user-info ps-3">
                    @php
                        $portalUser = Auth::guard('portal')->user();
                    @endphp
                    <p class="user-name mb-0 text-capitalize">{{ $portalUser?->firstname }} {{ $portalUser?->lastname }}</p>
                </div>
            </a>
        </div>
        <div class="user-box dropdown">
            <a class="d-flex align-items-center nav-link" href="{{ route('portal->logout') }}" role="button">
                <div class="user-info ps-3">
                    <p class="user-name mb-0 text-uppercase portal_logout_text_class">Logout</p>
                </div>
            </a>
        </div>
    </nav>
</div>
