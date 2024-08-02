@extends('admin.layouts.app')
@section('title', __('tasks::lang.create-task'))
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
                    <div class="page-title-subheading">{{ __('tasks::lang.here-create-task') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('admin.tasks')}}" class="btn create-modal mr-2 mb-2 btn-success btn-shadow">{{ __('employees::employee.back') }}</a>
                </div>
            </div>    
        </div>
    </div>     
    <form action="{{route('admin.task.store')}}" method="post" class="needs-validation" novalidate>
        <div class="card">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="projecttitle">{{ __('tasks::lang.choose-project') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                            <select required name="project_id" id="" class="form-control">
                                <option value="">--{{ __('tasks::lang.please-choose-project') }}-- </option>
                                @isset($projects)
                                    @foreach ($projects as $project)
                                        @if ($project->status == 'O')
                                            <option value="{{$project->id}}">{{$project->title}}</option>
                                        @endif
                                    @endforeach
                                @endisset
                            </select>
                            <div class="valid-feedback">
                                {{ __('tasks::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('tasks::lang.please-choose-project') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="projecttitle">{{ __('tasks::lang.project-assigned-to') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                            <select required name="assigned_to" id="" class="form-control">
                                <option value="">--{{ __('tasks::lang.please-project-assigned-to') }}-- </option>
                              
                                @isset($users)
                                    @foreach ($users as $user)
                                        @if($user->role->priority >= $priority)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                @endisset
                            </select>
                            <div class="valid-feedback">
                                {{ __('tasks::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('tasks::lang.please-project-assigned-to') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="tasktitle">{{ __('tasks::lang.title') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                            <input type="text" name="title" class="form-control" id="tasktitle" required placeholder="{{ __('tasks::lang.title') }}">
                            <div class="valid-feedback">
                                {{ __('tasks::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('tasks::lang.add-valid-name') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="task-specification">{{ __('tasks::lang.specification') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                            <textarea id="elm1" name="specification" required cols="30" rows="5" class="form-control" placeholder="{{ __('tasks::lang.enter-task-specification') }}"></textarea>
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="start_date">{{ __('tasks::lang.start-date') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                            <input type="text" name="create_date" class="form-control datetimepicker"  required placeholder="{{ __('tasks::lang.enter-task-start-date') }}">
                            <div class="valid-feedback">
                                {{ __('tasks::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('tasks::lang.valid-start_date') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="deadline">{{ __('tasks::lang.deadline') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                            <input type="text" name="deadline" class="form-control datetimepicker"  required placeholder="{{ __('tasks::lang.enter-task-deadline') }}">
                            <div class="valid-feedback">
                                {{ __('tasks::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('tasks::lang.valid-deadline') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('tasks::lang.create-task') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection 


