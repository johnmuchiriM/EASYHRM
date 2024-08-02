@extends('admin.layouts.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
                </div>
                <div>{{ __('dashboard::lang.hello') }} {{Auth::user()->name}}
                    <div class="page-title-subheading">{{ __('dashboard::lang.welcome-user') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard::user.partials.dashboard-cards')
    @include('dashboard::user.partials.tasks')
    @include('dashboard::user.partials.top-emp')
    @include('dashboard::user.partials.emp-attendance')
</div>
@endsection
