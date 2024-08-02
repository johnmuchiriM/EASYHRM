<div class="row">
    <div class="col-md-12">
        @foreach ($employeeHistories as $employeeHistory)
        <input type="hidden" name="history_id[]" value="{{$employeeHistory->id}}">
        <div class="main-card mb-3 card after-add-more tr_clone">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.previous-details') }}</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('employees::employee.company-name') }}</label>
                            <input type="text" disabled  value="{{$employeeHistory->previous_company_name ?? ''}}" class="form-control copy-row">    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{ __('employees::employee.contact-person-name') }}</label>
                            <input type="text" disabled class="form-control copy-row" value="{{$employeeHistory->contact_person_name ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{ __('employees::employee.contact-person-number') }}</label>
                            <input type="number" disabled class="form-control copy-row" value="{{$employeeHistory->contact_person_number ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.doj') }}</label>
                            <input type="text" disabled value="{{$employeeHistory->previous_company_date_of_joining ?? ''}}" class="form-control copy-row datetimepicker">    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.dor') }}</label>
                            <div class="input-group mb-3">
                                <input type="text" disabled value="{{$employeeHistory->previous_company_date_of_relieving ?? ''}}" class="form-control copy-row datetimepicker">    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.experience-letter') }}</label>
                            <input type="file" disabled  class="form-control copy-row">  
                            @isset($employeeHistory->experience_letter)
                                <img class="border  border-primary mt-2" src="{{url('admin/uploads',$employeeHistory->experience_letter)}}" height="50px">    
                            @endisset
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.relieving-letter') }}</label>
                            <input type="file" disabled value="{{$employeeHistory->relieving_letter ?? ''}}" class="form-control copy-row">
                             @isset($employeeHistory->relieving_letter)
                                <img class="border  border-primary mt-2" src="{{url('admin/uploads',$employeeHistory->relieving_letter)}}" height="50px">     
                             @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>