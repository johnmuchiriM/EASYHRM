<div class="app-sidebar sidebar-shadow sidebar-text-light {{ getConfig('config_color_scheme_class') ?? 'bg-plum-plate'}}" id="main-sidebar">
    <div class="app-header__logo">
        <div class="logo-src"></div>
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
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">{{__('global-lang.dashboard')}}</li>
                <li>
                    <a href="{{route('dashboard')}}" class="{{isActive('dashboard')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        {{__('global-lang.dashboard')}}
                    </a>
                </li>
                <li class="app-sidebar__heading">{{__('global-lang.attendance')}}</li>
                @if(Auth::user()->role_id != 1)
                    <li>
                        <a href="{{route('attendances')}}" class="{{isActive('attendances')}}">
                            <i class="metismenu-icon pe-7s-timer"></i>
                            {{__('global-lang.attendance')}}
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('attendance.logs')}}" class="{{isActive('attendances')}}">
                            <i class="metismenu-icon pe-7s-note2"></i>
                            {{__('global-lang.attendance-logs')}}
                        </a>
                    </li>
                    <li class="app-sidebar__heading"> {{__('global-lang.employees')}}</li>
                    <li>
                        <a href="{{route('admin.employees')}}" class="{{isActive('employees')}}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            {{__('global-lang.employees')}}
                        </a>
                    </li>
                @endif
                <li class="app-sidebar__heading">{{__('global-lang.profile')}}</li>
                <li>
                    <a href="{{route('profile')}}" class="{{isActive('profile')}}">
                        <i class="metismenu-icon pe-7s-user"></i>
                        {{__('global-lang.profile')}}
                    </a>
                </li>
                @if(Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('admin.role')}}" class="{{isActive('role')}}">
                            <i class="metismenu-icon pe-7s-server"></i>
                            {{__('global-lang.roles')}}
                        </a>
                    </li>
                @endif
                <li class="app-sidebar__heading"> {{__('global-lang.projects')}}</li>
                <li>
                    <a href="{{route('admin.projects')}}" class="{{isActive('projects')}}">
                        <i class="metismenu-icon pe-7s-pen"></i>
                        {{__('global-lang.projects')}}
                    </a>
                </li>
                <li class="app-sidebar__heading">{{__('global-lang.tasks')}}</li>
                <li>
                    <a href="{{route('admin.tasks')}}" class="{{isActive('tasks')}}">
                        <i class="metismenu-icon pe-7s-phone"></i>
                        {{__('global-lang.task')}}
                    </a>
                @if(Auth::user()->role_id != 1)
                    <a href="{{route('task.mytasks')}}" class="{{isActive('my-task')}}">
                        <i class="metismenu-icon pe-7s-pen"></i>
                        {{__('global-lang.my-task')}}
                    </a>
                @endif
                </li>
                <li class="app-sidebar__heading">{{__('global-lang.vacation')}}</li>
                @if(Auth::user()->role_id != 1)
                    <li>
                        <a href="{{route('vacations')}}" class="{{isActive('vacations')}}">
                            <i class="metismenu-icon pe-7s-car"></i>
                            {{__('global-lang.my-vacation')}}
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('vacations.approval')}}" class="{{isActive('approve')}}">
                            <i class="metismenu-icon pe-7s-play"></i>
                            {{__('global-lang.approved-vacation')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('allocate.leave')}}" class="{{isActive('allocateleave')}}">
                            <i class="metismenu-icon pe-7s-wristwatch"></i>
                            {{__('global-lang.allocate-leave')}}
                       </a>
                    </li>
                @endif
                <li class="app-sidebar__heading">{{__('global-lang.holiday')}}</li>
                @if(Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('holiday')}}" class="{{isActive('holidays')}}">
                            <i class="metismenu-icon pe-7s-plane"></i>
                            {{__('global-lang.holiday')}}
                    </a>
                    </li>
                @endif
                @if(Auth::user()->role_id != 1)
                    <li>
                        <a href="{{route('holiday.calendar')}}" class="{{isActive('holidays')}}">
                            <i class="metismenu-icon pe-7s-date"></i>
                            {{__('global-lang.holiday-calendar')}}

                        </a>
                    </li>
                @endif
                <li class="app-sidebar__heading">{{__('global-lang.payroll')}}</li>
                <li>
                    @if(Auth::user()->role_id == 1)
                        <a href="{{route('payroll')}}" class="{{isActive('payroll')}}">
                            <i class="metismenu-icon pe-7s-cash"></i>
                             {{__('global-lang.generate-payroll')}}
                        </a>
                    @endif
                    @if(Auth::user()->role_id != 1)
                        <a href="{{route('salary.slip')}}" class="{{isActive('salary-slip')}}">
                            <i class="metismenu-icon pe-7s-diamond"></i>
                            {{__('global-lang.salary-slips')}}
                        </a>
                    @endif
                </li>
                @if(Auth::user()->role_id == 1)
                    <li class="app-sidebar__heading">{{__('global-lang.settings')}}</li>
                    <li>
                        <a href="{{route('configurations.index')}}" class="{{isActive('configurations')}}">
                            <i class="metismenu-icon pe-7s-settings"></i>
                            {{__('global-lang.configurations')}}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
