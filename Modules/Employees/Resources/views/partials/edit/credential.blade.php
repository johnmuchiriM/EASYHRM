<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.create-employee-credential') }}</h5>               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>({{ __('employees::employee.login') }})</b> {{ __('employees::employee.username') }}</label><span class="text-danger"> *</span>
                            <input type="text" name="name" required value="{{$user->name ?? ''}}" class="form-control @error('name') is-invalid @enderror">  
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>({{ __('employees::employee.login') }})</b> {{ __('employees::employee.email') }}</label><span class="text-danger"> *</span>
                            <input type="email" value="{{$user->email ?? ''}}" class="form-control @error('email') is-invalid @enderror" required name="email">
                            @error('email')
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
                            <label>{{ __('employees::employee.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">  
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.confirm-password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   
                            <span id='message'></span>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="submit">
            </div>
        </div>
    </div>
</div>