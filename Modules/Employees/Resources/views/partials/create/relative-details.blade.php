<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.parents-details') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.father-name') }}</label>
                            <input type="text" value="{{ old('father_name') }}" name="father_name" class="form-control @error('father_name') is-invalid @enderror">    
                        </div>
                        @error('father_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.father-mobile-number') }}</label>
                            <input type="number" value="{{ old('father_mobile_number') }}" class="form-control @error('father_mobile_number') is-invalid @enderror" name="father_mobile_number">
                        </div>
                        @error('father_mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.mother-name') }}</label>
                            <input type="text" value="{{ old('mother_name') }}" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror">    
                        </div>
                        @error('mother_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.mother-mobile-number') }}</label>
                            <div class="input-group mb-3">
                                <input type="number"  value="{{ old('mother_mobile_number') }}" name="mother_mobile_number" class="form-control @error('mother_mobile_number') is-invalid @enderror">    
                            </div>
                            @error('mother_mobile_number')
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
                            <label>{{ __('employees::employee.friend-name') }}</label>
                            <input type="text" value="{{ old('friend_name') }}" name="friend_name" class="form-control @error('friend_name') is-invalid @enderror">    
                        </div>
                        @error('friend_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.friend-mobile-number') }}</label>
                            <div class="input-group mb-3">
                                <input type="number" value="{{ old('friend_mobile_number') }}" name="friend_mobile_number" class="form-control @error('friend_mobile_number') is-invalid @enderror"> 
                                @error('friend_mobile_number')
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
</div>