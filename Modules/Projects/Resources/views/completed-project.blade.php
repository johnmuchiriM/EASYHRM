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
                    <a href="{{route('admin.projects')}}" class="btn mr-2 mb-2 btn-success btn-shadow">
                        {{ __('global-lang.back') }}
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
                                                <a href="javascript:void(0)" id="{{$project->pid}}" class="edit-status btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit task"></i>
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
        $(document).on('click','.edit-status',function(){
            id = $(this).attr('id');
            $('.project-id').val(id);
            $('#create-modal-project').modal('show');
        });
    </script>
@endpush
@endsection 
@include('projects::component.project-status')













