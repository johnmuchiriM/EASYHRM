@extends('admin.layouts.app')
@section('title',  __('projects::project.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-monitor icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('projects::project.here-create-project') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('admin.completed.project')}}" class="btn mr-2 mb-2 btn-success btn-shadow">
                        {{ __('projects::project.completed-project') }}
                    </a>
                </div>
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow" data-toggle="modal" data-target="#create-modal">
                        {{ __('projects::project.create-project') }}
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
                                    <th>{{ __('projects::project.project-id') }}</th>
                                    <th>{{ __('projects::project.project-name') }}</th>
                                    <th>{{ __('projects::project.created-by') }}</th>
                                    <th>{{ __('projects::project.project-status') }}</th>
                                    <th>{{ __('projects::project.duration') }}</th>
                                    <th>{{ __('projects::project.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($projects)
                                    @foreach($projects as $key => $project)
                                        <tr>
                                            <td>{{ $project->pid }}</td>
                                            <td>{{ $project->title }}</td>
                                            <td>{{ $project->user->name }}</td>
                                            @if($project->status == 'O')
                                                <td><button class="btn btn-primary">{{ __('projects::project.ongoing') }}</button></td>
                                            @elseif($project->status == 'F')
                                                <td><button class="btn btn-success">{{ __('projects::project.finished') }}</button></td>
                                            @else
                                                <td><button class="btn btn-danger">{{ __('projects::project.stopped') }}</button></td>
                                            @endif
                                            @php
                                                $fdate = $project->start_date;
                                                $tdate = $project->deadline;
                                                $datetime1 = new DateTime($fdate);
                                                $datetime2 = new DateTime($tdate);
                                                $interval = $datetime1->diff($datetime2);
                                                $days = $interval->format('%a');
                                            @endphp
                                            <td>{{$days}} days</td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{$project->id}}" class="edit-project btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit project"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$project->id}}" class="delete-project btn btn-danger">
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
        $(document).ready(function () {
            $('form').submit(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $(`[name="_token"]`).val()
                    }
                });
                $.ajax({
                    url: "{{route('admin.project.store')}}",
                    method: 'post',
                    data: {
                        title: $(`[name="title"]`).val(),
                        specification: $(`[name="specification"]`).val(),
                        start_date: $(`[name="start_date"]`).val(),
                        deadline: $(`[name="deadline"]`).val(),
                        project_id : $(`[name="project_id"]`).val(),
                        status : $(`[name="status"]`).val(),
                    },
                   
                    success: function (result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function (key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + value + '</li>');
                            });
                        } else {
                            $('.alert-danger').hide();
                            $('#create-modal').modal('hide');
                            location.reload();
                        }
                    }
                });
            });
        });

        // on delete click call swal
        $(document).on('click','.delete-project',function(){
            swal({
                title: "{{ __('global-lang.are-you-sure') }}",
                text: "{{ __('projects::project.not-recover') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("admin.project.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            if(data == 0) {
                                swal("{{ __('projects::project.in-use') }}", {
                                    icon: "warning",
                                });
                            } else {
                                swal("{{ __('projects::project.project-deleted') }}", {
                                    icon: "success",
                                });
                            }
                            location.reload();
                        },
                        error: function(data) {
                            swal("{{ __('global-lang.something-went-wrong') }}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('projects::project.project-not-deleted') }}");
                }
            });
        });
        
        // edit project modal code
        $(document).on('click','.edit-project',function(){
            id = $(this).attr('id');
            var url = '{{ route("admin.project.edit", ":id") }}';
            url = url.replace(':id',id);           
            axios({
            method  : 'GET',
            url : url,
            })
            .then((res)=>{
                console.log(res.data.id);
                $('#project-title').val(res.data.title);
                $('#specification').val(res.data.specification);
                $('#deadline').val(res.data.deadline);
                $('#start-date').val(res.data.start_date);
                $('#project-id').val(res.data.id);
                $('#status').val(res.data.status);
                $("#create-modal").modal('show');
                $(".status").removeClass('d-none');
                $(".modal-title").html("{{__('projects::project.edit-projects')}}");
                $(".project-btn").html("{{__('projects::project.update-projects')}}");   
            })
            .catch((err) => {throw err});
        });
    </script>
@endpush
@endsection 
@include('projects::component.modal')
