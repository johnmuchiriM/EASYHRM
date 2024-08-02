<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal">{{ __('vacations::lang.create-vacations') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form  class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="vacation_id" class="vacation-id">
                    <div class="modal-body">
                        <div class="alert-danger"></div>
                        <div class="form-group Started-At">
                            <label for="start date ">{{ __('vacations::lang.vacations-start_date') }} <span class="text-danger">{{ __('vacations::lang.asterisk') }}</span></label>
                            <input type="text" id="start-date" name="start_date" class="form-control datetimepicker-create"
                                 required placeholder="{{ __('vacations::lang.start-date') }}">
                            
                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            <div class="valid-feedback">
                                {{ __('vacations::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('vacations::lang.add-valid-start_date') }}
                            </div>
                        </div>
                        <div class="form-group End-At">
                            <label for="end date">{{ __('vacations::lang.vacations-end_date') }} <span class="text-danger">{{ __('vacations::lang.asterisk') }}</span></label>
                            <input type="text" id="end-date" name="end_date" class="form-control  datetimepicker-create"
                                 required placeholder="{{ __('vacations::lang.end-date') }}">
                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            <div class="valid-feedback">
                                {{ __('vacations::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('vacations::lang.add-valid-end_date') }}
                            </div>
                        </div>
                        <div class="form-group reason">
                            <label for="reason">{{ __('vacations::lang.vacations-reason') }} <span class="text-danger">{{ __('vacations::lang.asterisk') }}</span></label>
                            <input type="text" id="reason" name="reason" class="form-control"  required
                                placeholder="{{ __('vacations::lang.reason') }}">
                                @if ($errors->has('reason'))
                                    <span class="text-danger">{{ $errors->first('reason') }}</span>
                                @endif
                            <div class="valid-feedback">
                                {{ __('vacations::lang.looks-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('vacations::lang.add-valid-reason') }}
                            </div>
                        </div>
                        <div class="form-group remaining-leave">
                            <label for="remaining leave">{{ __('vacations::lang.remaining-leave') }}<span class="text-danger">{{ __('vacations::lang.asterisk') }}</span></label>
                            <input type="number" step="0.5" id="remaining-leave" name="remaining_leave" class="form-control" disabled required @if(isset($remainingLeave->allocate_leave))value="{{($remainingLeave->allocate_leave - $paidLeaves)}}" @else value="0" @endif>
                        </div>
                        <div class="form-group paid-leave ">
                            <label for="paid leave">{{ __('vacations::lang.paid-leave') }}<span class="text-danger">{{ __('vacations::lang.asterisk') }}</span></label>
                            <input type="number" step="0.5" id="paid-leave" name="paid_leave" class="form-control" disabled required>
                        </div>
                        <div class="form-group unpaid-leave ">
                            <label for="remaining leave">{{ __('vacations::lang.unpaid-leave') }}<span class="text-danger">{{ __('vacations::lang.asterisk') }}</span></label>
                            <input type="number" step="0.5" id="unpaid-leave" name="unpaid_leave" class="form-control" disabled required >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-modal"
                                data-dismiss="modal">{{ __('vacations::lang.close') }}</button>
                            <button type="submit" class="btn btn-primary vacation-btn"
                                id="formSubmit">{{ __('vacations::lang.create-vacations') }}</button>
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
    $(".paid-leave").addClass("d-none");
    $(".unpaid-leave").addClass("d-none");
    $("#reason").click(function () {
        $(".paid-leave").removeClass("d-none");
        $(".unpaid-leave").removeClass("d-none");
      
        let leave = '{{$remainingLeave->allocate_leave ?? 0}}';
        let paidLeaves = parseInt('{{$paidLeaves}}');
       
        let start = $('#start-date').val();
        let end = $('#end-date').val();
       
        let from = new Date(start);
        let to = new Date(end);
        
        let days = ((to - from) / 1000 / 60 / 60 / 24);
        if (!start || !end){
            return 'not defined!';
        }
        let remainingLeaves = (leave - days);
        let remainingLeave = (remainingLeaves - paidLeaves);
        if (end == start) {
            days = 0.5;
            remainingLeave = (remainingLeave - 0.5);
        }
        if(remainingLeave > 0){
            $('#unpaid-leave').val(0);
            $('#paid-leave').val(days);
        } else {
            let unpaid = Math.abs(remainingLeave);
            $('#paid-leave').val(days - unpaid);
            $("#unpaid-leave").val(unpaid);
        }
    });
        $('form').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(`[name="_token"]`).val()
                }
            });
            $.ajax({
                url: "{{route('vacations.store')}}",
                method: 'post',
                data: {
                    reason: $(`[name="reason"]`).val(),
                    start_date: $(`[name="start_date"]`).val(),
                    end_date: $(`[name="end_date"]`).val(),
                    vacation_id : $(`[name="vacation_id"]`).val(),
                    allocate_leave : $(`[name="allocate_leave"]`).val(),
                    paid_leave : $(`[name="paid_leave"]`).val(),
                    unpaid_leave : $(`[name="unpaid_leave"]`).val(),

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
