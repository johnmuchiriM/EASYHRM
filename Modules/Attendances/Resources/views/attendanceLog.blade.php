@extends('admin.layouts.app')
@section('title',  __('attendances::lang.attendance-log-title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-ripe-malin"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('attendances::lang.you-can-see-attendance-logs') }}</div>
                </div>
            </div>
        </div>
    </div>            
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('attendances::lang.hash-tag') }}</th>
                                    <th>{{ __('attendances::lang.emp-id') }}</th>
                                    <th>{{ __('attendances::lang.emp') }}</th>
                                    <th>{{ __('attendances::lang.date') }}</th>
                                    <th>{{ __('attendances::lang.in') }}&nbsp;<b>&#8644;</b>&nbsp;{{ __('attendances::lang.out') }}</th>
                                    <th>{{ __('dashboard::lang.working-hour') }}</th>
                                    <th>{{ __('dashboard::lang.login-hours') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        // load datatable on page load
         var loadtable = $('.datatable').DataTable({
             processing: true,
             serverSide: true,
             dataSrc :"",
                 ajax: "{{route('attendance.getLogs')}}",
                 columns: [
                     {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                     {data: 'user_id', name: 'user_id'},
                     {data: 'user_name', name: 'user_name'},
                     {data: 'created_at', name: 'created_at'},
                     {data: 'login_logout', name: 'login_logout'},
                     {data: 'workingHour', name: 'workingHour'},
                     {data: 'totalhours', name: 'totalhours'},
                 ]
         });
        });
 </script>
@endpush
@endsection
