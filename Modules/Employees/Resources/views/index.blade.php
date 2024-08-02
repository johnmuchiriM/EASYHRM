@extends('admin.layouts.app')
@section('title',  __('employees::employee.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box2 icon-gradient bg-amy-crisp"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('employees::employee.here-create-employee') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('admin.employee.create')}}" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow">{{ __('employees::employee.create-employee') }}</a>
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
                                    <th>{{ __('employees::employee.employee-id') }}</th>
                                    <th>{{ __('employees::employee.employee-name') }}</th>
                                    <th>{{ __('employees::employee.role') }}</th>
                                    <th>{{ __('employees::employee.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($employees)
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->role->name }}</td>
                                            <td>
                                                <a href="{{route('admin.employee.edit',$employee->id)}}" class="edit-role btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit role"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$employee->id}}" class="delete-role btn btn-danger">
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
@push('scripts')
    <script>
        // on delete click call swal
        $(document).on('click','.delete-role',function(){
            swal({
                title: "{{ __('global-lang.are-you-sure') }}",
                text: "Once deleted, you will not be able to recover this employee!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("admin.employee.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            swal("{{ __('employees::employee.has-deleted') }}", {
                                icon: "success",
                            });
                            location.reload();
                        },
                        error: function(data) {
                            swal("Something went wrong !", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('employees::employee.not-deleted') }}");
                }
            });
        });
    </script>
@endpush
@endsection 

