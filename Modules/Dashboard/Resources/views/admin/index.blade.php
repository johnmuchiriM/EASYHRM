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
                <div>{{ __('dashboard::lang.dashboard') }}
                    <div class="page-title-subheading">{{ __('dashboard::lang.slogan') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard::admin.partials.dashboard-cards')
    @include('dashboard::admin.partials.tasks')
    @include('dashboard::user.partials.top-emp')
    @include('dashboard::admin.partials.emp-list')
    @include('dashboard::admin.partials.on-leave-emp')
</div>
@endsection
