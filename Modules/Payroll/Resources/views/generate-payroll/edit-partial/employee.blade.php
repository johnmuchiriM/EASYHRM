<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ __('payroll::lang.choose-employee') }}</h5>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="projecttitle">{{ __('payroll::lang.choose-employee') }}</label><span class="text-danger">{{ __('payroll::lang.asterisk') }}</span>
                    <select required name="user_id" id="" class="form-control">
                        <option value="">--{{ __('payroll::lang.please-choose-employee') }}-- </option>
                        @isset($users)
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{$payroll->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
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
                    <input type="number" disabled  name="working_days" value="{{$payroll->working_days ?? ''}}" class="form-control @error('working_days') is-invalid @enderror" id="workingdays" required placeholder="{{ __('payroll::lang.working-days') }}">
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
                    <input type="text" disabled name="paid_leave" class="form-control @error('paid_leave') is-invalid @enderror" value="{{$payroll->paid_leave ?? ''}}" id="paidleave" required placeholder="{{ __('payroll::lang.paid-leave') }}">
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
                    <label for="unpaid leave">{{ __('payroll::lang.unpaid-leave') }}</label><span class="text-danger">{{ __('payroll::lang.asterisk') }}</span>
                    <input type="text" disabled  name="unpaid_leave" class="form-control @error('unpaid_leave') is-invalid @enderror" value="{{$payroll->unpaid_leave ?? ''}}" id="unpaidleave" required placeholder="{{ __('payroll::lang.unpaid-leave') }}">
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
