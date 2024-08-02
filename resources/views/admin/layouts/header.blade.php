<div class="app-header header-shadow header-text-light {{ getConfig('config_color_scheme_class') ?? 'bg-plum-plate'}}"
    id="main-header">
    <div class="app-header__logo">
        <div class="text-white font-weight-bold">{{getConfig('config_app_name') ?? 'EASY HRM' }}</div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-left">
            <ul class="header-menu nav">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-link-icon fa fa-database"> </i>
                        {{__('global-lang.dashboard')}}
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="{{route('admin.projects')}}" class="nav-link">
                        <i class="nav-link-icon fa fa-edit"></i>
                        {{__('global-lang.projects')}}
                    </a>
                </li>
                @if(Auth::user()->role_id == 1)
                <li class="dropdown nav-item">
                    <a href="{{route('configurations.index')}}" class="nav-link">
                        <i class="nav-link-icon fa fa-cog"></i>
                        {{__('global-lang.settings')}}
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div class="app-header-left mobile-top-menu">
            <div class="search-wrapper text-center">
               <a href="{{route('dashboard')}}">
                  <i class="nav-link-icon fa fa-database text-white h4 ml-2"> </i>
               </a>
               <a href="{{route('admin.projects')}}">
                  <i class="nav-link-icon fa fa-edit text-white h4 ml-2"></i>
              </a>
              @if(Auth::user()->role_id == 1)
                  <a href="{{route('configurations.index')}}">
                     <i class="nav-link-icon fa fa-cog text-white h4 ml-2"></i>
                  </a>
               @endif
            </div>
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            @auth
                            @php
                            $profilePic = Auth::user()->profile_pic;
                            if (!$profilePic) {
                            $profilePic = url('/User/default_profile_pic/avatar.png');
                            }
                            @endphp

                            @endauth
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" height="50" class="rounded-circle" src="{{profilePic()}}" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8 open-profile-dropdown"></i>
                                </a>

                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu profile-menu dropdown-menu-right">
                                    <a href="{{route('profile')}}" tabindex="0"
                                        class="dropdown-item">{{ __('profile::lang.profile') }}</a>
                                    <a href="{{route('profile.index')}}" tabindex="0" class="dropdown-item">
                                        {{ __('profile::lang.change-password') }}
                                    </a>
                                    @if(Auth::user()->role_id == 1)
                                    <a href="{{route('configurations.index')}}" tabindex="0"
                                        class="dropdown-item">{{ __('profile::lang.settings') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('profile::lang.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        @auth
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                {{Auth::user()->name}}
                            </div>
                            <div class="widget-subheading">
                                {{Auth::user()->role->name}}
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
