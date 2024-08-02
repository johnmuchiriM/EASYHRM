<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal">{{ __('holidays::lang.create-holiday') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form  class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="id" id="holidayId" class="holiday-id">
                    <div class="modal-body">
                        <div class="alert-danger"></div>
                            <div class="form-group">
                                <label for="holiday name">{{ __('holidays::lang.holiday-name') }} <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"  required
                                    placeholder="{{ __('holidays::lang.enter-holiday-name') }}">
                                <div class="valid-feedback">
                                    {{ __('holidays::lang.looks-good') }}
                                </div>
                                <div class="invalid-feedback">
                                    {{ __('holidays::lang.add-valid-holiday-name') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="holiday date ">{{ __('holidays::lang.holiday-date') }} <span class="text-danger">*</span></label>
                                <input type="text" id="date" name="date" class="form-control datetimepicker-create"
                                    required placeholder="{{ __('holidays::lang.enter-holiday-date') }}">
                                <div class="valid-feedback">
                                    {{ __('holidays::lang.looks-good') }}
                                </div>
                                <div class="invalid-feedback">
                                    {{ __('holidays::lang.add-valid-holiday-date') }}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-modal"
                                    data-dismiss="modal">{{ __('holidays::lang.close') }}</button>
                                <button type="submit" class="btn btn-primary"
                                id="formSubmit">{{ __('holidays::lang.create-holiday') }}</button>
                            </div>
                    </div>
                </form>
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
                url: "{{route('holiday.update')}}",
                method: 'post',
                data: {
                    name: $(`[name="name"]`).val(),
                    date: $(`[name="date"]`).val(),
                    id: $(`[name="id"]`).val(),

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
</script>    
@endpush

