<div class="modal fade" id="create-modal" class="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true"  data-toggle="modal" data-target="#myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" class="create-modal" id="create-modal">{{ __('vacations::lang.create-allocate-leave') }}</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  class="allocateLeaves-form needs-validation" novalidate>
                @csrf
                <input type="hidden" name="id" id="allocate-id">
                <div class="modal-body">
                    <div class="alert-danger"></div>
                    <div class="form-group">
                        <label for="allocate-leave ">{{ __('vacations::lang.allocate-leave') }}</label>
                        <input type="number" id="allocate_leave"  step="0.5" name="allocate_leave" class="form-control"
                            required placeholder="{{ __('vacations::lang.enter-allocate-leave') }}">
                    </div>
                    <div class="valid-feedback">
                        {{ __('vacations::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('vacations::lang.add-valid-allocate-leave') }}
                    </div>
                    <div class="form-group user-selected">
                        <label for="exampleFormControlSelect1">{{ __('vacations::lang.select-user') }}</label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">{{ __('vacations::lang.select-users') }}</option>
                                @if(isset($users))
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" @if (old('user_id') == "{{$user->id}}") {{ 'selected' }} @endif >{{$user->name ?? ''}}</option>
                                        @endforeach
                                @endif
                        </select>
                    </div>
                        <div class="valid-feedback">
                            {{ __('vacations::lang.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('vacations::lang.add-valid-parent') }}
                        </div>
                    <div class="form-group d-none leave">
                        <label for="employee name">{{ __('vacations::lang.emp-name') }}</label>
                        <input type="text" id="emp-name"  name="emp_name" disabled class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal"
                            data-dismiss="modal">{{ __('vacations::lang.close') }}</button>
                        <button type="submit" class="btn btn-primary"
                            id="submit">{{ __('vacations::lang.create-allocate-leave') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('.allocateLeaves-form').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(`[name="_token"]`).val()
                }
            });
            $.ajax({
                url: "{{route('allocate.leave.update')}}",
                method: 'post',
                data: {
                    allocate_leave: $(`[name="allocate_leave"]`).val(),
                    id: $(`[name="id"]`).val(),
                    user_id:$(`[name="user_id"]`).val(),
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




