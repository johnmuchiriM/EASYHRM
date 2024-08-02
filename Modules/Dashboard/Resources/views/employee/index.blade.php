@extends('admin.layouts.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box2 icon-gradient bg-amy-crisp"> </i>
                </div>
                <div>{{$username ?? ''}}
                    <div class="page-title-subheading">{{ __('dashboard::lang.welcome-user') }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('dashboard')}}" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow">{{ __('global-lang.back') }}</a>
                </div>
            </div>    
        </div>
    </div>
    @include('dashboard::user.partials.dashboard-cards')
    @include('dashboard::user.partials.tasks')
    @include('dashboard::user.partials.emp-attendance')
</div>
@endsection
