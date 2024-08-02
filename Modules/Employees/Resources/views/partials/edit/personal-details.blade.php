<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.emloyee-personal-details') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.name') }}</label> <span class="text-danger"> *</span>
                            <input type="text" name="employee_name" required class="form-control @error('employee_name') is-invalid @enderror" name="employee_name" value="{{ $employee->employee_name ?? ''}}" required autocomplete="employee_name">    
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
                                @php
                                    $genders = [
                                        'm' =>  __('employees::employee.male'),
                                        'f' =>  __('employees::employee.female'),
                                        'o' =>  __('employees::employee.other'),
                                    ];    
                                @endphp
                                @foreach ($genders as $key => $gender)
                                    <div class="col-md-3">
                                        <input type="radio" name="gender" {{ $key == $employee->gender ? 'checked' : ''}} value="{{$key}}"> {{$gender}}
                                    </div>
                                @endforeach
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.dob') }}</label> <span class="text-danger"> *</span>
                            <input type="text" value="{{ $employee->date_of_birth ?? '' }}" required autocomplete="date_of_birth" name="date_of_birth" class="form-control dobpicker @error('date_of_birth') is-invalid @enderror">  
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
                            <input type="text" value="{{ $employee->father_husband_name ?? '' }}" required autocomplete="father_husband_name" name="father_husband_name" class="form-control @error('father_husband_name') is-invalid @enderror"> 
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
                            <input type="primary_email" value="{{ $employee->primary_email ?? '' }}" required autocomplete="primary_email" name="primary_email" class="form-control @error('primary_email') is-invalid @enderror">   
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
                            <input type="number" value="{{ $employee->mobile_number ?? '' }}" required autocomplete="mobile_number" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror">  
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
                            <textarea name="current_address" required autocomplete="current_address" cols="10" rows="5" class="form-control @error('current_address') is-invalid @enderror">{{ $employee->current_address ?? '' }}</textarea>
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
                            <textarea name="permanent_address" required autocomplete="permanent_address" cols="10" rows="5" class="form-control @error('permanent_address') is-invalid @enderror">{{ $employee->permanent_address ?? '' }}</textarea>
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
                            <input type="file" name="resume" autocomplete="resume" class="form-control @error('resume') is-invalid @enderror">
                            <a href="{{url('admin/uploads',$employee->resume)}}" target="_blank">
                                <img class="border  border-primary mt-2" src="{{url('admin/uploads',$employee->resume)}}" height="50px">  
                            </a> 
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
                            <input type="file" name="photo" autocomplete="photo" class="form-control @error('photo') is-invalid @enderror">
                            <img class="border  border-primary mt-2" src="{{url('admin/uploads',$employee->photo)}}" height="50px">   
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
                            <input type="file" name="address_proof[]" autocomplete="address_proof" multiple class="form-control">   
                            @foreach ($addressProofFiles as $addressProofFile)
                                <a href="{{url('admin/uploads',$addressProofFile)}}" target="_blank">
                                    <img class="border  border-primary mt-2" src="{{url('admin/uploads',$addressProofFile)}}" height="50px">   
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.pan-card') }} <b> ({{ __('employees::employee.you-can-upload-multiple-file') }})</b></label> <span class="text-danger"> *</span>
                            <input type="file" name="pan_card[]" autocomplete="pan_card" multiple class="form-control">
                            @foreach ($panFiles as $panFile)
                                <a href="{{url('admin/uploads',$panFile)}}" target="_blank">
                                    <img class="border  border-primary mt-2" src="{{url('admin/uploads',$panFile)}}" height="50px">  
                                </a> 
                            @endforeach   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.role') }}</label>
                            <select name="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{$role->name}}</option>    
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
                                <input type="number" class="form-control" value="{{ $employee->hourly_rate ?? ''}}" autocomplete="hourly_rate"  name="hourly_rate">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">             
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.doj') }}</label>  <span class="text-danger"> *</span>
                            <input type="text" name="date_of_joining" value="{{ $employee->date_of_joining ?? ''}}" required autocomplete="date_of_joining" class="form-control datetimepicker @error('date_of_joining') is-invalid @enderror">
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
                            <input type="text" class="form-control" value="{{  $employee->notes ?? '' }}" autocomplete="notes"  name="notes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>