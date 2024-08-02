<div class="modal fade" id="create-modal" class="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true"  data-toggle="modal" data-target="#myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" class="create-modal" id="create-modal">{{ __('vacations::lang.approve-vacation') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  class="vacation-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden"  id="vacation-id" name="vacation_id" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="start date ">{{ __('vacations::lang.vacations-start_date') }}</label>
                        <input type="text" disabled id="start-date"  name="start_date" class="form-control datetimepicker-create"
                            required placeholder="{{ __('vacations::lang.start-date') }}">
                    </div>
                    <div class="form-group">
                        <label for="end date">{{ __('vacations::lang.vacations-end_date') }}</label>
                        <input type="text" disabled id="end-date" name="end_date" class="form-control  datetimepicker-create"
                            required placeholder="{{ __('vacations::lang.end-date') }}">
                    </div>
                    <div class="form-group">
                        <label for="reason">{{ __('vacations::lang.vacations-reason') }}</label>
                        <input type="text" id="reason" name="reason" class="form-control" disabled required
                            placeholder="{{ __('vacations::lang.reason') }}">
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('vacations::lang.vacations-status') }}</label>
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                        <select class="form-control" name="status" id="status">
                            <option value="{{ __('vacations::lang.p') }}" id="pending">{{ __('vacations::lang.pending') }}</option>
                            <option value="{{ __('vacations::lang.a') }}" id="approved">{{ __('vacations::lang.approved') }}</option>
                            <option value="{{ __('vacations::lang.r') }}" id="reject">{{ __('vacations::lang.reject') }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal"
                            data-dismiss="modal">{{ __('vacations::lang.close') }}</button>
                        <button type="submit" class="btn btn-primary"
                            id="submit">{{ __('vacations::lang.approve-vacation') }}</button>
                    </div>
                    <p></p>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('.vacation-form').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(`[name="_token"]`).val()
                }
            });
            $.ajax({
                url: "{{route('vacations.status.updateStatus')}}",
                method: 'post',
                data: {
                    status: $(`[name="status"]`).val(),
                    vacation_id : $(`[name="vacation_id"]`).val(),
                },
                success: function () {
                    $('#create-modal').modal('hide');
                    location.reload();
                }
            });
        });
    });
</script>    
@endpush










 


