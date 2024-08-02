@extends('admin.layouts.app')
@section('title',  __('employees::employee.create-employee'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-phone icon-gradient bg-premium-dark">
                    </i>
                </div>  
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('employees::employee.here-create-employee') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('admin.employees')}}" class="btn create-modal mr-2 mb-2 btn-success btn-shadow">{{ __('employees::employee.back') }}</a>
                </div>
            </div>    
        </div>
    </div>     
    <form action="{{route('admin.employee.store')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf       
        @include('employees::partials.create.personal-details')
        @include('employees::partials.create.relative-details')
        @include('employees::partials.create.previous-history')
        @include('employees::partials.create.credential')
    </form>
</div>
@endsection 

