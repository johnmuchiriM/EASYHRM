@extends('admin.layouts.app')
@section('title', __('vacations::lang.title'))
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
                    <div class="page-title-subheading">{{ __('vacations::lang.here-create-allocate-leave') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow" data-toggle="modal" data-target="#create-modal">
                        {{__('vacations::lang.title')}}
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
                                    <th>{{ __('vacations::lang.emp-id') }}</th>
                                    <th>{{ __('vacations::lang.emp-name') }}</th>
                                    <th>{{ __('vacations::lang.allocate-leave') }}</th>
                                    <th>{{ __('vacations::lang.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($leaves)
                                    @foreach($leaves as $key => $leave)
                                        <tr>
                                            <td>{{ $leave->user->id }}</td>
                                            <td>{{ $leave->user->name }}</td>
                                            <td> {{ $leave->allocate_leave }}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{$leave->id}}" class="edit-leave btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit allocated leaves"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$leave->id}}" class="delete-leave btn btn-danger">
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
        $(document).on('click','.delete-leave',function(){
            swal({
                title: "{{ __('global-lang.are-you-sure') }}",
                text: "{{ __('vacations::lang.not-recover') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("allocate.leave.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            swal("{{ __('vacations::lang.allocate-leave-deleted') }}", {
                                icon: "success",
                            });
                            location.reload();
                        },
                        error: function(data) {
                            swal("{{ __('global-lang.something-went-wrong') }}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('vacations::lang.allocate-leave-not-deleted') }}");
                }
            });
        });
        
        // edit Allocated Leave modal code
        $(document).on('click','.edit-leave',function(){
            $(".user-selected").addClass("d-none");
            $(".leave").removeClass("d-none");
            id = $(this).attr('id');
            var url = '{{ route("allocate.leave.edit", ":id") }}';
            url = url.replace(':id',id);           
            axios({
            method  : 'GET',
            url : url,
            }).then((res)=>{
        
                $('#allocate_leave').val(res.data.allocate_leave);
                $('#allocate-id').val(res.data.id);
                $("#emp-name").val(res.data.name);
                $("#create-modal").modal('show');
                $(".modal-title").html("{{ __('vacations::lang.update-allocate-leave')}}");
                $("#submit").html("{{ __('vacations::lang.update-allocate-leave')}}");
                
            })
            .catch((err) => {throw err});
        });
    </script>
@endpush
@endsection 
@include('vacations::allocate-leave.modal')

