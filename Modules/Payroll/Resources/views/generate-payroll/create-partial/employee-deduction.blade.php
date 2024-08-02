<div class="card mt-4" id="employeeDeduction">
    <div class="card-body">
        <h5 class="card-title">{{ __('payroll::lang.employee-deduction') }}</h5>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="providentfund">{{ __('payroll::lang.provident-fund') }}</label>
                    <input type="number" name="provident_fund" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" value="{{ old('provident_fund')}}" id="providentfund"  placeholder="{{ __('payroll::lang.provident-fund') }}">
                    @error('provident_fund')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pfarrear">{{ __('payroll::lang.pf-arrear') }}</label>
                    <input type="number" name="pf_arrear" class="form-control txtCal  @error('pf_arrear') is-invalid @enderror" value="{{ old('pf_arrear')}}" id="pfarrear"  placeholder="{{ __('payroll::lang.pf-arrear') }}">
                    @error('pf_arrear')
                        <span class="invalid-feedback" role="alert">
                            {{ implode('', $errors->all(':message')) }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="esi">{{ __('payroll::lang.esi') }}</label>
                    <input type="number" name="esi" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" id="esi"  value="{{ old('esi')}}" placeholder="{{ __('payroll::lang.esi') }}">
                    @error('esi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="esic-arrear">{{ __('payroll::lang.esic-arrear') }}</label>
                    <input type="number" name="esic_arrear" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" value="{{ old('esic_arrear')}}" id="esic-arrear"  placeholder="{{ __('payroll::lang.esic-arrear') }}">
                    @error('esic_arrear')
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
                    <label for="tds">{{ __('payroll::lang.tds') }}</label>
                    <input type="number" name="tds" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" id="tds" value="{{ old('tds')}}"  placeholder="{{ __('payroll::lang.tds') }}">
                    @error('tds')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="loandeduction">{{ __('payroll::lang.loan-deduction') }}</label>
                    <input type="number" name="loan_deduction" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" value="{{ old('loan_deduction')}}" id="loandeduction"  placeholder="{{ __('payroll::lang.loan-deduction') }}">
                    @error('loan_deduction')
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
                    <label for="workinghours">{{ __('payroll::lang.incomplete-working-hours') }}</label>
                    <input type="number" name="incomplete_working_hours" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" value="{{ old('incomplete_working_hours')}}" id="workinghours"  placeholder="{{ __('payroll::lang.incomplete-working-hours') }}">
                    @error('incomplete_working_hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="leavededuction">{{ __('payroll::lang.informed-leave-deduction') }}</label>
                    <input type="number" name="leave_deduction" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" value="{{ old('leave_deduction')}}" id="leavededuction"  placeholder="{{ __('payroll::lang.informed-leave-deduction') }}">
                    @error('leave_deduction')
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
                    <label for="other-deduction">{{ __('payroll::lang.other-deduction') }}</label>
                    <input type="number" name="other_deduction" class="form-control txtCal @error('pf_arrear') is-invalid @enderror" value="{{ old('other_deduction')}}" id="other-deduction"  placeholder="{{ __('payroll::lang.other-deduction') }}">
                    @error('other_deduction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6 ">
                <div class="form-group total-salary d-none">
                    <label for="grossaalary">{{ __('payroll::lang.gross-salary') }}</label><span class="text-danger">*</span>
                    <input type="number" name="gross_salary"  class="form-control" value="{{ old('gross_salary')}}" id="gross-salary" placeholder="{{ __('payroll::lang.gross-salary') }}">
                    <div class="valid-feedback">
                        {{ __('payroll::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('payroll::lang.add-valid-gross-salary') }}
                    </div>
                    @error('gross_salary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="gross-salary btn btn-warning text-white">{{ __('payroll::lang.calculate-gross-salary') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('payroll::lang.generate-payroll') }}</button>
        </div>
    </div>
</div>
