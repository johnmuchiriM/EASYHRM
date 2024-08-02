<div class="modal fade" id="create-modal-project" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-project">{{ __('projects::project.edit-project-status') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.update.project.status')}}" method="post" class="needs-validation form " novalidate>
                <div class="modal-body">
                    <div class="alert-danger"></div>
                    @csrf
                    <input type="hidden" id="pid" name="project_id" class="project-id">
                    <div class="form-group">
                        <label for="status">{{ __('projects::project.project-status') }}</label><span class="text-danger">{{ __('projects::project.asterisk') }}</span>
                        <select class="form-control" name="status" id="status">
                            <option value="{{ __('projects::project.o') }}">{{ __('projects::project.ongoing') }}</option>
                            <option value="{{ __('projects::project.s') }}">{{ __('projects::project.stopped') }}</option>
                            <option value="{{ __('projects::project.f') }}">{{ __('projects::project.finished') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal"
                        data-dismiss="modal">{{ __('projects::project.close') }}</button>
                    <button type="submit"
                        class="btn btn-primary p-btn">{{ __('projects::project.edit-status') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>






