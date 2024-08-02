<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal">{{ __('projects::project.create-project') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="needs-validation form" novalidate>
                <div class="modal-body">
                    <div class="alert-danger"></div>
                    @csrf
                    <input type="hidden" id="project-id" name="project_id">
                    <div class="form-group">
                        <label for="project title">{{ __('projects::project.title') }}</label><span
                            class="text-danger">{{ __('projects::project.asterisk') }}</span>
                        <input type="text" name="title" class="form-control" id="project-title" required
                            placeholder="{{ __('projects::project.pro-title') }}">
                        <div class="valid-feedback">
                            {{ __('projects::project.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('projects::project.add-valid-name') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project specification">{{ __('projects::project.specification') }}</label><span
                            class="text-danger">{{ __('projects::project.asterisk') }}</span>
                        <textarea name="specification" id="specification" required cols="30" rows="5"
                            class="form-control" placeholder="{{ __('projects::project.pro-specification') }}"></textarea>
                        <div class="valid-feedback">
                            {{ __('projects::project.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('projects::project.valid-specification') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start date">{{ __('projects::project.start-date') }}</label><span
                            class="text-danger">{{ __('projects::project.asterisk') }}</span>
                        <input type="text" name="start_date" id="start-date" class="form-control datetimepicker"
                            required placeholder="{{ __('projects::project.enter-start-date') }}">
                        <div class="valid-feedback">
                            {{ __('projects::project.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('projects::project.valid-start_date') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deadline">{{ __('projects::project.deadline') }}</label><span
                            class="text-danger">{{ __('projects::project.asterisk') }}</span>
                        <input type="text" name="deadline" id="deadline" class="form-control datetimepicker" required
                            placeholder="{{ __('projects::project.pro-deadline') }}">
                        <div class="valid-feedback">
                            {{ __('projects::project.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('projects::project.valid-deadline') }}
                        </div>
                    </div>
                    <div class="form-group status d-none">
                        <label for="status">{{ __('projects::project.status') }}</label><span class="text-danger">{{ __('projects::project.asterisk') }}</span>
                        <select class="form-control" name="status" id="status" required="">
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
                        class="btn btn-primary project-btn">{{ __('projects::project.create-project') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
