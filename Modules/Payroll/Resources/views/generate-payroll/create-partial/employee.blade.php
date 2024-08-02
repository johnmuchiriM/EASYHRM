<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ __('payroll::lang.choose-employee') }}</h5>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="projecttitle">{{ __('payroll::lang.choose-employee') }}</label><span class="text-danger">{{ __('payroll::lang.asterisk') }}</span>
                    <select required name="user_id" id="user-id" class="form-control user-dropdown">
                        <option value="">--{{ __('payroll::lang.please-choose-employee') }}-- </option>
                        @isset($users)
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{old($user->id) == 'id' ? 'selected' : ''}}>{{($user->name) ?? ''}}</option>
                            @endforeach
                        @endisset
                    </select>
                    <div class="valid-feedback">
                        {{ __('payroll::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('payroll::lang.project-assigned-to') }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="workingdays">{{ __('payroll::lang.working-days') }}</label><span class="text-danger">{{ __('payroll::lang.asterisk') }}</span>
                    <input type="number" name="working_days" id ="working-days"  readonly="readonly"  class="form-control @error('working_days') is-invalid @enderror" id="workingdays"  placeholder="{{ __('payroll::lang.working-days') }}">
                    <div class="valid-feedback">
                        {{ __('payroll::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('payroll::lang.add-valid-working-days') }}
                    </div>
                    @error('basic_salary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="paid leave">{{ __('payroll::lang.paid-leave') }}</label><span class="text-danger">{{ __('payroll::lang.asterisk') }}</span>
                    <input type="number"  name="paid_leave" class="form-control @error('paid_leave') is-invalid @enderror" readonly="readonly"  id="paid-leave" placeholder="{{ __('payroll::lang.paid-leave') }}">
                    <div class="valid-feedback">
                        {{ __('payroll::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('payroll::lang.add-valid-paid-leave') }}
                    </div>
                    @error('paid_leave')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="onleave">{{ __('payroll::lang.unpaid-leave') }}</label><span class="text-danger">{{ __('payroll::lang.asterisk') }}</span>
                    <input type="number" step ="0.5" name="unpaid_leave" class="form-control @error('unpaid_leave') is-invalid @enderror" readonly="readonly"  id="unpaid-leave" placeholder="{{ __('payroll::lang.unpaid-leave') }}">
                    <div class="valid-feedback">
                        {{ __('payroll::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('payroll::lang.add-valid-unpaid-leave') }}
                    </div>
                    @error('unpaid_leave')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('change', '.user-dropdown',function () {
            var id = $(this).val();
            var url = '{{ route("payroll.get", ":id") }}';
            url = url.replace(':id',id);  
            axios({
            method  : 'GET',
            url : url,
            }).then((res)=>{
                console.log(res.data.attendance);
                console.log(res.data);
                $('#working-days').val(res.data.attendance);
                $('#paid-leave').val(res.data.paid_leave);
                $('#unpaid-leave').val(res.data.unpaid_leave);
            })
            .catch((err) => {throw err});
        });         
</script>
@endpush