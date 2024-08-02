<div class="card mt-4" id="employeeEarning">
    <div class="card-body">
        <h5 class="card-title">{{ __('payroll::lang.employee-earning') }}</h5>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="basicsalary">{{ __('payroll::lang.basic-salary') }}</label><span class="text-danger">*</span>
                    <input type="number" name="basic_salary" value="{{ $payroll->basic_salary ?? ''}}" class="form-control txtCal @error('basic_salary') is-invalid @enderror" id="basicsalary" required placeholder="{{ __('payroll::lang.basic-salary') }}">
                    <div class="valid-feedback">
                        {{ __('payroll::lang.looks-good') }}
                    </div>
                    <div class="invalid-feedback">
                        {{ __('payroll::lang.add-valid-basic-salary') }}
                    </div>
                    @error('basic_salary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="houserentallowance">{{ __('payroll::lang.house-rent-allowance') }}</label>
                    <input type="number" name="house_rent_allowance" value="{{$payroll->house_rent_allowance ?? ''}}" class="form-control txtCal @error('house_rent_allowance') is-invalid @enderror" id="houserentallowance" placeholder="{{ __('payroll::lang.house-rent-allowance') }}">
                    @error('house_rent_allowance')
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
                    <label for="convenyanceallowance">{{ __('payroll::lang.convenyace-allowance') }}</label>
                    <input type="number" name="convenyance_allowance" value="{{$payroll->convenyance_allowance ?? ''}}" class="form-control txtCal @error('convenyance_allowance') is-invalid @enderror" id="convenyanceallowance" placeholder="{{ __('payroll::lang.convenyace-allowance') }}">
                    @error('convenyance_allowance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="medicalallowance">{{ __('payroll::lang.medical-allowance') }}</label>
                    <input type="number" name="medical_allowance"  value="{{$payroll->medical_allowance ?? ''}}" class="form-control txtCal @error('medical_allowance') is-invalid @enderror" id="medicalallowance" placeholder="{{ __('payroll::lang.medical-allowance') }}">
                    @error('medical_allowance')
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
                    <label for="skillallowance">{{ __('payroll::lang.skill-allowance') }}</label>
                    <input type="number" name="skill_allowance" value="{{$payroll->skill_allowance ?? ''}}" class="form-control txtCal @error('skill_allowance') is-invalid @enderror" id="skillallowance" placeholder="{{ __('payroll::lang.skill-allowance') }}">
                    @error('skill_allowance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="bonus">{{ __('payroll::lang.bonus') }}</label>
                    <input type="number" name="bonus" value="{{$payroll->bonus ?? ''}}"  class="form-control txtCal @error('bonus') is-invalid @enderror" id="bonus" placeholder="{{ __('payroll::lang.bonus') }}">
                    @error('bonus')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>