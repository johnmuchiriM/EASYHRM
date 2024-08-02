<div class="row">
    <div class="col-md-12">
        @foreach ($employeeHistories as $employeeHistory)
        <input type="hidden" name="history_id[]" value="{{$employeeHistory->id}}">
        <div class="main-card mb-3 card after-add-more tr_clone">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.previous-details') }}</h5>
                <div class="input-group-btn text-right"> 
                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> {{ __('employees::employee.add') }}</button>
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> {{ __('employees::employee.remove') }}</button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('employees::employee.company-name') }}</label>
                            <input type="text" name="previous_company_name[]" value="{{$employeeHistory->previous_company_name ?? ''}}" class="form-control copy-row  @error('previous_company_name.*') is-invalid @enderror">    
                            @error('previous_company_name.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{ __('employees::employee.contact-person-name') }}</label>
                            <input type="text" class="form-control copy-row @error('contact_person_name.*') is-invalid @enderror" value="{{$employeeHistory->contact_person_name ?? ''}}" name="contact_person_name[]">
                            @error('contact_person_name.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{ __('employees::employee.contact-person-number') }}</label>
                            <input type="number" class="form-control copy-row  @error('contact_person_number.*') is-invalid @enderror" value="{{$employeeHistory->contact_person_number ?? ''}}" name="contact_person_number[]">
                            @error('contact_person_number.*')
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
                            <label>{{ __('employees::employee.doj') }}</label>
                            <input type="text" name="previous_company_date_of_joining[]" value="{{$employeeHistory->previous_company_date_of_joining ?? ''}}" class="form-control copy-row dobpicker">    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.dor') }}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="previous_company_date_of_relieving[]" value="{{$employeeHistory->previous_company_date_of_relieving ?? ''}}" class="form-control copy-row dobpicker">    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.experience-letter') }}</label>
                            <input type="file" name="experience_letter[]" class="form-control copy-row @error('experience_letter.*') is-invalid @enderror">    
                            @isset($employeeHistory->experience_letter)
                                <img class="border  border-primary mt-2" src="{{url('admin/uploads',$employeeHistory->experience_letter)}}" height="50px">        
                            @endisset
                            @error('experience_letter.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.relieving-letter') }}</label>
                            <input type="file" name="relieving_letter[]" value="{{$employeeHistory->relieving_letter ?? ''}}" class="form-control copy-row @error('relieving_letter.*') is-invalid @enderror"> 
                            @isset($employeeHistory->relieving_letter)
                                <img class="border  border-primary mt-2" src="{{url('admin/uploads',$employeeHistory->relieving_letter)}}" height="50px">    
                            @endisset
                            @error('relieving_letter.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>