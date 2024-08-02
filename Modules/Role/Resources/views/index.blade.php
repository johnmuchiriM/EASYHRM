@extends('admin.layouts.app')
@section('title',  __('role::role.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-paint icon-gradient bg-arielle-smile"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('role::role.here-create-role') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow" data-toggle="modal" data-target="#create-modal">
                        {{ __('role::role.create-role') }}
                    </button>
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
                                    <th>{{ __('role::role.role-id') }}</th>
                                    <th>{{ __('role::role.role-name') }}</th>
                                    <th>{{ __('role::role.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($roles)
                                    @foreach($roles as $key => $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{$role->id}}" class="edit-role btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit role"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$role->id}}" class="delete-role btn btn-danger">
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
                text: "{{ __('role::role.not-recover') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("admin.role.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            if(data == 'false') {
                                swal("{{__('role::role.not-deleted')}}", {
                                    icon: "warning",
                                });
                             
                            } else {
                                swal("{{__('role::role.role-deleted')}}", {
                                    icon: "success",
                                });
                            }
                            location.reload(); 
                        },
                        error: function(data) {
                            swal("{{__('global-lang.something-went-wrong')}}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{__('role::role.role-not-deleted')}}");
                }
            });
        });
        
        // edit project modal code
        $(document).on('click','.edit-role',function(){
            id = $(this).attr('id');
            var url = '{{ route("admin.role.edit", ":id") }}';
            url = url.replace(':id',id);  
            var roles = @json($roles);         
            axios({
            method  : 'GET',
            url : url,
            })
            .then((res)=>{
                var rolesForShow = [];
                $("#priority").html("");
                var staticOpt1 = "{{ __('role::role.please-select-role') }}";
                var staticOpt2 = "{{ __('role::role.no-parent') }}";
                $('#priority').append('<option value="">'+ staticOpt1 +'</option>'
                + '<option value="0">' + staticOpt2 + '</option>');

                $.each(roles, function(key,role) {
                    if(role.id != res.data.id) {
                        $('#priority').append($("<option></option>").attr("value", role.id).text(role.name)); 
                    }
                }); 

                $('#rolename').val(res.data.name);
                $('#role-id').val(res.data.id);
                $('#priority').val(res.data.priority);
                $("#create-modal").modal('show');
                $(".modal-title").html("{{__('projects::project.edit-role')}}");
                $("#formRole").html("{{__('projects::project.update-role')}}");   
            })
            .catch((err) => {throw err});
        });
    </script>
@endpush
@endsection 
@include('role::component.modal')
