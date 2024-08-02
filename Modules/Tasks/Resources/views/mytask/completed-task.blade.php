@extends('admin.layouts.app')
@section('title', __('tasks::lang.completed-task'))
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
                    <div class="page-title-subheading">{{ __('tasks::lang.here-you-can-see-task-list') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('task.mytasks')}}"
                        class="btn create-modal mr-2 mb-2 btn-success btn-shadow"></i>{{ __('tasks::lang.back') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable"width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('tasks::lang.task-name') }}</th>
                                    <th>{{ __('tasks::lang.project-name') }}</th>
                                    <th>{{ __('tasks::lang.task-status') }}</th>
                                    <th>{{ __('tasks::lang.duration') }}{{ __('tasks::lang.in-hours') }}</th>
                                    <th>{{ __('tasks::lang.action') }}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key =>  $task)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$task->title}}</td>
                                        <td>{{$task->project->title}}</td>
                                        <td><button class="btn btn-success">{{ __('tasks::lang.finished') }}</button></td>
                                        <td>{{$task->duration}}</td>
                                        <td>
                                            <a href="javascript:void(0)" id="{{$task->tid}}" class="edit-status btn btn-primary">
                                                <i class="fa fa-fw" aria-hidden="true" title="edit task"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('.task-id').val(id);
            $('#create-modal-my-task').modal('show');
        });
    </script>
@endpush
@endsection 
@include('tasks::mytask.component.my-status-task')