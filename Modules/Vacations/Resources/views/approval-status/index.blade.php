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
                    <div class="page-title-subheading">{{ __('vacations::lang.here-create-approve-vacation') }}</div>
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
                                    <th>{{ __('vacations::lang.vacations-user_id') }}</th>
                                    <th>{{ __('vacations::lang.vacations-user_name') }}</th>
                                    <th>{{ __('vacations::lang.vacations-start_date') }}</th>
                                    <th>{{ __('vacations::lang.vacations-end_date') }}</th>
                                    <th>{{ __('vacations::lang.no_of_days') }}</th>
                                    <th>{{ __('vacations::lang.status') }} </th>
                                    <th>{{ __('vacations::lang.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($vacation)
                                    @foreach($vacation as $key => $vacations)
                                        <tr>
                                            <td>{{ $vacations->user->id }}</td>
                                            <td>{{ $vacations->user->name }}</td>
                                            <td>{{ formatDateTime($vacations->start_date) }}</td>
                                            <td>{{ formatDateTime($vacations->end_date) }}</td>
                                            <td>{{ $vacations->days }}</td>
                                            <td>
                                                @if ($vacations->status=='P') 
                                                    <button class="btn btn-warning btn-sm" value="Pending">{{ __('vacations::lang.pending') }}</button>
                                                @elseif($vacations->status=='A')
                                                    <button class="btn btn-success btn-sm">{{ __('vacations::lang.approved') }}</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm">{{ __('vacations::lang.reject') }}</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{$vacations->id}}" class="edit-vacations-status btn btn-primary ">           
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$vacations->id}}" class="delete-vacations-status btn btn-danger">
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
        $(document).on('click','.delete-vacations-status',function(){
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
                    var url = '{{ route("vacations.status.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            swal("{{ __('vacations::lang.approve-vacation-deleted') }}", {
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
                    swal("{{ __('vacations::lang.approve-vacation-not-deleted') }}");
                }
            });
        });
        
        // edit vacations modal code
        $(document).on('click','.edit-vacations-status',function(){
            id = $(this).attr('id');
            var url = '{{ route("vacations.status.edit", ":id") }}';
            url = url.replace(':id',id);           
            axios({
            method  : 'GET',
            url : url,
            }).then((res)=>{
                $('#start-date').val(res.data.start_date);
                $('#end-date').val(res.data.end_date);
                $('#reason').val(res.data.reason);
                $('#vacation-id').val(res.data.id);
                $("#create-modal").modal('show');
                $(".modal-title").html("{{ __('vacations::lang.approve-vacation')}}");
                if(res.data.status == 'A') {
                    $("#approved").attr("selected","selected");
                } else if (res.data.status == 'P'){
                    $("#pending").attr("selected","selected");
                } else if (res.data.status == 'R'){
                    $("#reject").attr("selected","selected");
                }
            })
            .catch((err) => {throw err});
        });

        $('.datetimepicker-create').datetimepicker({
            format:'YYYY-MM-DD hh:mm A',
            icons: {
                time:'fa fa-clock',
                date:'fa fa-calendar',

            },
        });

    </script>
@endpush
@endsection 
@include('vacations::approval-status.modal')




