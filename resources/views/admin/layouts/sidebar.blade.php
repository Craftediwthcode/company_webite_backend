<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Dark -->
        <a href="{{ route('dashboard') }}" class="logo-dark">
            <img src="{{ \App\Helpers\Helper::getImageUrl(\App\Models\Setting::where('key', 'logo')->value('value') ?? '') }}" alt="dark logo" class="logo-lg"
                height="48">
            <img src="{{ \App\Helpers\Helper::getImageUrl(\App\Models\Setting::where('key', 'logo')->value('value') ?? '') }}" alt="small logo" class="logo-sm"
                height="38">
        </a>
    </div>
    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">
            <li class="menu-title">{{ __('Dashboard') }}</li>
            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><img src="{{ asset('assets/backend/images/icon/dashboard.png') }}"
                            width="25px"></span>
                    <span class="menu-text">{{ __('Dashboard') }} </span>
                </a>
            </li>
            <li class="menu-title">{{ __('Pages') }}</li>
            <li class="menu-item {{ Request::segment(2) == 'page' ? 'active' : '' }}">
                <a href="{{ route('page.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><img src="{{ asset('assets/backend/images/icon/info.png') }}"
                            width="25px"></span>
                    <span class="menu-text">{{ __('Pages') }}</span>
                </a>
            </li>
            <li class="menu-title">{{ __('Sub Sections') }}</li>
            <li class="menu-item {{ Request::segment(2) == 'sub-section' ? 'active' : '' }}">
                <a href="{{ route('sub-section.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><img src="{{ asset('assets/backend/images/icon/sections.png') }}"
                            width="25px"></span>
                    <span class="menu-text">{{ __('Sub Sections') }}</span>
                </a>
            </li>
            <li class="menu-title">{{ __('Our Work') }}</li>
            <li class="menu-item {{ Request::segment(2) == 'our-work' ? 'active' : '' }}">
                <a href="{{ route('our-work.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><img src="{{ asset('assets/backend/images/icon/static.png') }}"
                            width="25px"></span>
                    <span class="menu-text">{{ __('Our Work') }}</span>
                </a>
            </li>
            <li class="menu-title">{{ __('Contact US') }}</li>
            <li class="menu-item {{ Request::segment(2) == 'contact-us' ? 'active' : '' }}">
                <a href="{{ route('contact-us.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><img src="{{ asset('assets/backend/images/icon/sections.png') }}"
                            width="25px"></span>
                    <span class="menu-text">{{ __('Contact US') }}</span>
                </a>
            </li>
            <li class="menu-title">{{ __('Setting Management') }}</li>
            <li class="menu-item {{ Request::segment(2) == 'setting' ? 'active' : '' }}">
                <a href="{{ route('setting.list') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><img src="{{ asset('assets/backend/images/icon/settings.png') }}"
                            width="25px"></span>
                    <span class="menu-text">{{ __('Setting') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
