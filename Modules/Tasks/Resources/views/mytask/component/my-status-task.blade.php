<div class="modal fade" id="create-modal-my-task" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-my-task">{{ __('tasks::lang.edit-task-status') }}</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>    
            <form action="{{route('task.update.my.status')}}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="card">
                    <div class="modal-body">
                    <div class="alert-danger"></div>
                        <input type="hidden" id="tid" name="task_id" class="task-id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ __('tasks::lang.task-status') }}</label><span class="text-danger">{{ __('tasks::lang.asterisk') }}</span>
                                    <select name="status" id="status" class="form-control">
                                        <option value="{{ __('tasks::lang.f') }}">{{ __('tasks::lang.finished') }}</option>
                                        <option value="{{ __('tasks::lang.s') }}" >{{ __('tasks::lang.stopped') }}</option>
                                    </select>
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
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">{{ __('global-lang.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('tasks::lang.edit-status') }}</button>
                    </div>
                </div>
            </form>
        </div>    
    </div>
</div>
