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
                    <div class="page-title-subheading">{{ __('vacations::lang.here-create-vacations') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" onclick="showDays()" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow" data-toggle="modal" data-target="#create-modal">
                        {{__('vacations::lang.create-vacations')}}
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
                                    <th>{{ __('vacations::lang.vacations-id') }}</th>
                                    <th>{{ __('vacations::lang.vacations-start_date') }}</th>
                                    <th>{{ __('vacations::lang.vacations-end_date') }}</th>
                                    <th>{{ __('vacations::lang.vacations-reason') }}</th>
                                    <th>{{ __('vacations::lang.no_of_days') }}</th>
                                    <th>{{ __('vacations::lang.status') }} </th>
                                    <th>{{ __('vacations::lang.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($vacation)
                                    @foreach($vacation as $key => $vacations)
                                        <tr>
                                            <td>{{ $vacations->id }}</td>
                                            <td>{{ formatDate($vacations->start_date) }}</td>
                                            <td>{{ formatDate($vacations->end_date) }}</td>
                                            <td>{{ $vacations->reason }}</td>
                                            <td>{{ $vacations->days }}</td>
                                            <td>
                                                @if ($vacations->status=='P') 
                                                    <button class="btn btn-warning btn-sm" value="{{ __('vacations::lang.p') }}">{{ __('vacations::lang.pending') }}</button>
                                                @elseif ($vacations->status=='A')
                                                <button class="btn btn-success btn-sm" value="{{ __('vacations::lang.a') }}">{{ __('vacations::lang.approved') }}</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" value="{{ __('vacations::lang.r') }}">{{ __('vacations::lang.reject') }}</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{$vacations->id}}" class="edit-vacations btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit vacations"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$vacations->id}}" class="delete-vacations btn btn-danger">
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
        $(document).on('click','.delete-vacations',function(){
            swal({
                title: "{{ __('global-lang.are-you-sure') }}",
                text: "{{ __('vacations::lang.vacation-not-recover') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("vacations.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            swal("{{ __('vacations::lang.vacation-deleted') }}", {
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
                    swal("{{ __('vacations::lang.vacation-not-deleted') }}");
                }
            });
        });
        
        // edit vacations modal code
     
        $(document).on('click','.edit-vacations',function(){
            id = $(this).attr('id');
            var url = '{{ route("vacations.edit", ":id") }}';
            url = url.replace(':id',id);           
            axios({
            method  : 'GET',
            url : url,
            }).then((res)=>{
                $('#start-date').val(res.data.start_date);
                $('#end-date').val(res.data.end_date);
                $('#reason').val(res.data.reason);
                $('.vacation-id').val(res.data.id);
                $("#create-modal").modal('show');
                $(".modal-title").html("{{__('vacations::lang.edit-vacations')}}");
                $(".vacation-btn").html("{{__('vacations::lang.update-vacations')}}");   
            })
            .catch((err) => {throw err});
        });
        
        $('.datetimepicker-create').datetimepicker({
            format:'YYYY-MM-DD',
            icons: {
                date:'fa fa-calendar',
            },
        });
    </script>
@endpush
@endsection 
@include('vacations::component.modal')

