<div class="row">
    <div class="col-md-12">
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
                            <input type="text" name="previous_company_name[]" class="form-control copy-row @error('previous_company_name.*') is-invalid @enderror">  
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
                            <input type="text" class="form-control copy-row @error('contact_person_name.*') is-invalid @enderror" name="contact_person_name[]">
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
                            <input type="number" class="form-control copy-row @error('contact_person_number.*') is-invalid @enderror" name="contact_person_number[]">
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
                            <input type="text" name="previous_company_date_of_joining[]" class="form-control copy-row  dobpicker">    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.dor') }}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="previous_company_date_of_relieving[]" class="form-control copy-row  dobpicker">    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.experience-letter') }}</label>
                            <input type="file" name="experience_letter[]" class="form-control copy-row @error('experience_letter.*') is-invalid @enderror">   
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
                            <input type="file" name="relieving_letter[]" class="form-control copy-row @error('relieving_letter.*') is-invalid @enderror">    
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
    </div>
</div>