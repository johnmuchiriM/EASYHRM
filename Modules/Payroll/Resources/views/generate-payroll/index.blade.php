@extends('admin.layouts.app')
@section('title', __('payroll::lang.title'))
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
                    <div class="page-title-subheading">{{ __('payroll::lang.you-can-see-payroll') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('payroll.create')}}" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow">
                        {{ __('payroll::lang.create-payroll') }}
                    </a>
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
                                    <th>{{ __('payroll::lang.employee-id') }}</th>
                                    <th>{{ __('payroll::lang.employee-name') }}</th>
                                    <th>{{ __('payroll::lang.month') }}</th>
                                    <th>{{ __('payroll::lang.gross-salary') }}</th>
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
                                            <td>{{$payroll->gross_salary}}</td>
                                            <td>
                                                <a href="{{route('payroll.edit',$payroll->id)}}" class="edit-role btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit role"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$payroll->id}}" class="delete-payroll btn btn-danger">
                                                    <i class="fa fa-fw" aria-hidden="true" title="delete"></i>
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
@push('scripts')
    <script>
        // on delete click call swal
        $(document).on('click','.delete-payroll',function(){
            swal({
                title: "{{ __('global-lang.are-you-sure') }}",
                text: "{{ __('payroll::lang.once-you-delete') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("payroll.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            swal("{{ __('payroll::lang.payroll-has-been-deleted') }}", {
                                icon: "success",
                            });
                            location.reload();
                        },
                        error: function(data) {
                            swal("{{__('global-lang.something-went-wrong')}}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('payroll::lang.payroll-is-not-deleted') }}");
                }
            });
        });
    </script>
@endpush
