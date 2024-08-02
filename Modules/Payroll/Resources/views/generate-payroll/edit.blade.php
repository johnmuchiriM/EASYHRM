@extends('admin.layouts.app')
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
                    <div class="page-title-subheading">{{ __('payroll::lang.here-create-payroll') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('payroll')}}"
                        class="btn create-modal mr-2 mb-2 btn-success btn-shadow">{{ __('employees::employee.back') }}</a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('payroll.update',$payroll->id)}}" method="post" class="needs-validation" novalidate>
        @csrf
        @include('payroll::generate-payroll.edit-partial.employee')
        @include('payroll::generate-payroll.edit-partial.employee-earning')
        @include('payroll::generate-payroll.edit-partial.employee-deduction')
    </form>
</div>
@endsection
