<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal">{{ __('role::role.create-role') }}</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="needs-validation form" novalidate>
                <div class="modal-body">
                    @csrf
                    <div class="alert-danger"></div>
                    <input type="hidden" name="role_id" id="role-id">
                    <div class="form-group">
                        <label for="rolename">{{ __('role::role.role-name') }}</label>
                        <input type="text" name="name" class="form-control" id="rolename" aria-describedby="emailHelp"  required placeholder="{{ __('role::role.enter-role-name') }}">
                        <div class="valid-feedback">
                            {{ __('role::role.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('role::role.add-valid-name') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">{{ __('role::role.role-parent') }}</label>
                         <select class="form-control" name="priority" id="priority" required>
                            <option value="">{{ __('role::role.please-select-role') }}</option>
                            <option value="{{ __('role::role.zero') }}">{{ __('role::role.no-parent') }}</option>
                                @if(isset($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name ?? ''}}</option>
                                    @endforeach
                                @endif
                        </select>
                        <div class="valid-feedback">
                            {{ __('role::role.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('role::role.add-valid-role-parent') }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">{{ __('role::role.close') }}</button>
                    <button type="submit" id='formRole' class="btn btn-primary">{{ __('role::role.create-role') }}</button>
                </div>
            </form>
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
            url: "{{route('admin.role.store')}}",
            method: 'post',
            data: {
                name: $(`[name="name"]`).val(),
                priority: $(`[name="priority"]`).val(),
                role_id: $(`[name="role_id"]`).val(),
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

$(document).on('click','.close-btn', function(){
    location.reload();
});
</script>
@endpush