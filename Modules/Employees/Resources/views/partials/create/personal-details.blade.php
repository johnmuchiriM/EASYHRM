<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.emloyee-personal-details') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.name') }}</label> <span class="text-danger"> *</span>
                            <input type="text" name="employee_name" required class="form-control @error('employee_name') is-invalid @enderror" name="employee_name" value="{{ old('employee_name')}}" required autocomplete="employee_name">    
                            @error('employee_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.gender') }}</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="radio" checked name="gender" value="m"> {{ __('employees::employee.male') }}
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" name="gender" value="f"> {{ __('employees::employee.female') }}
                                </div> 
                                <div class="col-md-3">
                                    <input type="radio" name="gender" value="o"> {{ __('employees::employee.other') }}
                                </div> 
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.dob') }}</label> <span class="text-danger"> *</span>
                            <input type="text" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" name="date_of_birth" class="form-control dobpicker @error('date_of_birth') is-invalid @enderror">  
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.father-husband-name') }}</label> <span class="text-danger"> *</span>
                            <input type="text" value="{{ old('father_husband_name') }}" required autocomplete="father_husband_name" name="father_husband_name" class="form-control @error('father_husband_name') is-invalid @enderror"> 
                            @error('father_husband_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.email') }}</label> <span class="text-danger"> *</span>
                            <input type="primary_email" value="{{ old('primary_email') }}" required autocomplete="primary_email" name="primary_email" class="form-control @error('primary_email') is-invalid @enderror">   
                            @error('primary_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.mob-no') }}</label> <span class="text-danger"> *</span>
                            <input type="number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror">  
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.current-address') }}</label> <span class="text-danger"> *</span>
                            <textarea name="current_address" required autocomplete="current_address" cols="10" rows="5" class="form-control @error('current_address') is-invalid @enderror">{{ old('current_address') }}</textarea>
                            @error('current_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.permanent-address') }}</label> <span class="text-danger"> *</span>
                            <textarea name="permanent_address" required autocomplete="permanent_address" cols="10" rows="5" class="form-control @error('permanent_address') is-invalid @enderror">{{ old('permanent_address') }}</textarea>
                            @error('permanent_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.resume') }}</label> <span class="text-danger"> *</span>
                            <input type="file" name="resume"  required autocomplete="resume" class="form-control @error('resume') is-invalid @enderror">   
                            @error('resume')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror   
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.photo') }}</label> <span class="text-danger"> *</span>
                            <input type="file" name="photo" required autocomplete="photo" class="form-control @error('photo') is-invalid @enderror">
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.address-proof') }}<b> ({{ __('employees::employee.you-can-upload-multiple-file') }})</b></label><span class="text-danger"> *</span>
                            <input type="file" name="address_proof[]" required autocomplete="address_proof" multiple class="form-control @error('address_proof.*') is-invalid @enderror">   
                            @error('address_proof.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.pan-card') }} <b> ({{ __('employees::employee.you-can-upload-multiple-file') }})</b></label> <span class="text-danger"> *</span>
                            <input type="file" name="pan_card[]" required autocomplete="pan_card" multiple class="form-control @error('pan_card.*') is-invalid @enderror">
                            @error('pan_card.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror     
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.role') }}</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">-----{{ __('employees::employee.please-select-one-role') }}-----</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.hourly-rate') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" value="{{ old('hourly_rate')}}" autocomplete="hourly_rate"  name="hourly_rate">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">             
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.doj') }}</label>  <span class="text-danger"> *</span>
                            <input type="text" name="date_of_joining" value="{{ old('date_of_joining')}}" required autocomplete="date_of_joining" class="form-control datetimepicker @error('date_of_joining') is-invalid @enderror">
                            @error('date_of_joining')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.notes') }}</label>
                            <input type="text" class="form-control" value="{{ old('notes') }}" autocomplete="notes"  name="notes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>