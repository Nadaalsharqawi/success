<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" class="img-fluid" style="max-width:65px" alt="logo">
            <p class="logo-text" style="padding: 10px 10px 0 0;font-size: 24px;color: #4C2910;">{{ __('admin.app-name') }}
            </p>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="hover-circle">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul class="iq-menu">
                @if (Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('users.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/users.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.users') }} </span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('students.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.students') }} </span>
                    </a>
                </li>

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('providers.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.providers') }} </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('countries.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.countries') }} </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('universities.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.universities') }} </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('cities.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.cities') }} </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('services.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.services') }} </span>
                    </a>
                </li>
                @endif


                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('ads.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.ads') }} </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('memberships.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.memberships') }} </span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                <li>
                    <a href="{{ route('colleges.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/clients.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.colleges') }} </span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('settings.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/settings.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.settings') }} </span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
