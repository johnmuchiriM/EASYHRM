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
                    <div class="page-title-subheading">{{ __('payroll::lang.you-can-see-your-salary-slip') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('salary.slip')}}" class="btn create-modal mr-2 mb-2 btn-success btn-shadow">
                        {{ __('global-lang.back') }}
                    </a>
                    <a href="{{route('salary.download',$payroll->id)}}" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow">
                        {{ __('payroll::lang.download-salary-slip') }}
                    </a>
                </div>
            </div>  
        </div>
    </div>            
    <div class="card">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h1 class="text-center text-uppercase">{{ getConfig('config_company_name') ??  __('payroll::lang.company-name')}}</h1>
                                        <p class="text-center">
                                            {{ getConfig('config_company_address') ?? __('payroll::lang.company-address')}}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="text-center text-uppercase"><strong>{{ __('payroll::lang.statement') }}</strong></h3>
                                <p>
                                    <strong>{{ __('payroll::lang.emp-name')}}</strong><span class="text-uppercase"> {{$payroll->user->name}} </span> <br>
                                    <strong>{{ __('payroll::lang.designation')}}</strong> {{$payroll->user->role->name}} <br>
                                    <strong>{{ __('payroll::lang.month')}} &amp; {{ __('payroll::lang.year')}} </strong> {{$payroll->created_at->format('M, Y')}} <br>
                                </p>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>{{ __('payroll::lang.leave-information')}}</th>
                                            <th></th>
                                            <th>{{ __('payroll::lang.working-days')}}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.paid-leave')}}</strong></td>
                                            <td> {{$payroll->paid_leave}} </td>
                                            <td><strong>{{ __('payroll::lang.unpaid-leave')}}</strong></td>
                                            <td> {{$payroll->unpaid_leave}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.login-days')}}</strong></td>
                                            <td> {{$payroll->working_days}} </td>   
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>{{ __('payroll::lang.earning')}}</th>
                                            <th></th>
                                            <th>{{ __('payroll::lang.deduction')}}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.basic')}} &amp; {{ __('payroll::lang.salary')}}</strong></td>
                                            <td> {{$payroll->basic_salary}} </td>
                                            <td><strong>{{ __('payroll::lang.provident-fund')}}</strong></td>
                                            <td> {{$payroll->provident_fund}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.house-rent-allowance')}}</strong></td>
                                            <td> {{$payroll->house_rent_allowance}} </td>
                                            <td><strong>{{ __('payroll::lang.pf-arrear')}}</strong></td>
                                            <td> {{$payroll->pf_arrear}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.convenyace-allowance')}}</strong></td>
                                            <td> {{$payroll->convenyance_allowance}} </td>
                                            <td><strong>{{ __('payroll::lang.esi')}}</strong></td>
                                            <td> {{$payroll->esi}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.medical-allowance')}}</strong></td>
                                            <td> {{$payroll->medical_allowance}} </td>
                                            <td><strong>{{ __('payroll::lang.esic-arrear')}}</strong></td>
                                            <td>  {{$payroll->esic_arrear}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.skill-allowance')}}</strong></td>
                                            <td> {{$payroll->skill_allowance}} </td>
                                            <td><strong>{{ __('payroll::lang.tds')}}</strong></td>
                                            <td> {{$payroll->tds}}  </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.bonus')}}</strong></td>
                                            <td> {{$payroll->bonus}} </td>
                                            <td><strong>{{ __('payroll::lang.loan-deduction')}}</strong></td>
                                            <td> {{$payroll->loan_deduction}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong></strong></td>
                                            <td></td>
                                            <td><strong>{{ __('payroll::lang.incomplete-working-hours')}}</strong></td>
                                            <td> {{$payroll->incomplete_working_hours}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong></strong></td>
                                            <td></td>
                                            <td><strong>{{ __('payroll::lang.leave-deduction')}}</strong></td>
                                            <td> {{$payroll->leave_deduction}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong></strong></td>
                                            <td></td>
                                            <td><strong>{{ __('payroll::lang.other-deduction')}}</strong></td>
                                            <td> {{$payroll->other_deduction}} </td>
                                        </tr>
                                        <tr class="cap">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ __('payroll::lang.total')}}</strong></td>
                                            <td>{{$earning}}</td>
                                            <td><strong>{{ __('payroll::lang.total-deduction')}}</strong></td>
                                            <td>{{$deduction}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="active"><strong>{{ __('payroll::lang.net-salary')}}</strong></td>
                                            <td class="active"><strong>{{$payroll->gross_salary}} </strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <p class="text-capitalize">
                                    {{ getConfig('config_app_currency') ?? __('payroll::lang.rupee')}} {{number_to_words($payroll->gross_salary)}}
                                </p>
                                <br>
                                <p><i>{{ __('payroll::lang.thank-you')}}</i></p>
                                <p>
                                </p>
                                <p class="text-left">
                                    <strong>{{ __('payroll::lang.hr-manager')}}</strong>
                                </p>
                                <h3>{{ getConfig('config_company_name') ??  __('payroll::lang.company-name')}}</h3>
                                <p></p>
                                <p class="text-right"><small>{{ __('payroll::lang.computer-generated-salary-slip')}}</small></p>
                                <br>
                                <div class="break"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

