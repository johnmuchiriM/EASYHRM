@extends('admin.layouts.app')
@section('title',  __('profile::lang.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-filter icon-gradient bg-warm-flame"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('profile::lang.here-create-profile') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn btn-success">{{ __('profile::lang.role') }}<span class="badge badge-light">{{$user->role->name}}</span></button>
                </div>
            </div>    
        </div>
    </div>   
    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" class="needs-validation form" novalidate>
        @csrf         
        @include('profile::partials.basic-details')
        @include('profile::partials.relative')
        @include('profile::partials.employee-history')
        <button type="submit" class="btn btn-primary mb-2">{{ __('global-lang.submit')}}</button>
    </form>
</div>
@endsection 

