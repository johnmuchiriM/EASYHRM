@extends('admin.layouts.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-diamond icon-gradient bg-ripe-malin"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('payroll::lang.you-can-see-payroll') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                </div>
            </div>  
        </div>
    </div>            
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('payroll::lang.your-employee-id') }}</th>
                                    <th>{{ __('payroll::lang.your-name') }}</th>
                                    <th>{{ __('payroll::lang.month') }}</th>
                                    <th>{{ __('payroll::lang.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($payrolls)
                                    @foreach($payrolls as $key => $payroll)
                                        <tr>
                                            <td>{{$payroll->user_id}}</td>
                                            <td>{{$payroll->user->name}}</td>
                                            <td>{{$payroll->created_at->format('M')}}</td>
                                            <td>
                                                <a href="{{route('salary.slip.view',$payroll->id)}}" class="edit-role btn btn-primary">
                                                    <i class="fa fa-eye" aria-hidden="true" title="{{__('payroll::lang.view-salary-slip')}}"></i>
                                                </a>
                                                <a href="{{route('salary.download',$payroll->id)}}" class="btn btn-danger">
                                                    <i class="fa fa-file-pdf" aria-hidden="true" title="{{__('payroll::lang.download-salary-slip')}}"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach     
                                @endisset    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
