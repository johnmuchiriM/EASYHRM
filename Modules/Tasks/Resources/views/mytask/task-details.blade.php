@extends('admin.layouts.app')
@section('title', __('tasks::lang.task-details'))
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
                    <a href="{{route('task.mytask.history',$task->id)}}" class="btn create-modal mr-2 mb-2 btn-success btn-shadow"></i>{{ __('tasks::lang.task-history') }}</a>
                    <a href="{{route('task.mytasks')}}" class="btn create-modal mr-2 mb-2 btn-success btn-shadow"></i>{{ __('tasks::lang.back') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projecttitle">{{ __('tasks::lang.project-name') }}</label>
                                <select required name="project_id" id="" class="form-control" disabled>
                                    <option value="">--{{ __('tasks::lang.please-choose-project') }}-- </option>
                                    @isset($projects)
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}"
                                        {{$project->id == $task->project_id ? 'selected' : ''}}>{{$project->title}}
                                    </option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectassingeto">{{ __('tasks::lang.project-assigned-to') }}</label>
                                <select required name="assigned_to" id="" class="form-control" disabled>
                                    <option value="">--{{ __('tasks::lang.please-project-assigned-to') }}-- </option>
                                    @isset($users)
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$user->id == $task->assigned_to ? 'selected' : ''}}>
                                        {{$user->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projecttitle">{{ __('tasks::lang.title') }}</label><span
                                    class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                                <input type="text" disabled name="title" value="{{$task->title}}" class="form-control"
                                    id="projecttitle" required placeholder="{{ __('tasks::lang.enter-task-title') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project-specification">{{ __('tasks::lang.specification') }}</label><span
                                    class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                                <textarea  required cols="30" rows="5" class="form-control"
                                    id="elm2" placeholder="{{ __('tasks::lang.enter-specification') }}">{{$task->specification}}</textarea>
                                <div class="valid-feedback">
                                    {{ __('tasks::lang.looks-good') }}
                                </div>
                                <div class="invalid-feedback">
                                    {{ __('tasks::lang.valid-specification') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">{{ __('tasks::lang.start-date') }}</label>
                                <input disabled type="text" name="create_date" value="{{$task->create_date}}"
                                    class="form-control datetimepicker" required placeholder="{{ __('tasks::lang.enter-start-date') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deadline">{{ __('tasks::lang.deadline') }}</label>
                                <input disabled type="text" name="deadline" value="{{$task->deadline}}"
                                    class="form-control datetimepicker" required placeholder="{{ __('tasks::lang.enter-deadline') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('task.mytask.comment')}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="task_id" value="{{$task->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projecttitle">{{ __('tasks::lang.task-comment') }}</label>
                                    <textarea name="comment" cols="30" rows="5" class="form-control @error('comment') is-invalid @enderror"
                                    id="elm1" placeholder="{{ __('tasks::lang.enter-task-comment') }}"></textarea>
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit Comment">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        if ($("#elm2").length > 0) {
            tinymce.init({
                readonly : 1,
                selector: "textarea#elm2",
                content_style: ".mce-content-body {font-size:20px;font-family:Arial,sans-serif;}",
                theme: "modern",
                height: 200,
            });
        }
    });
</script>
@endpush
@endsection
