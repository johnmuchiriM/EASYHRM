<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">{{ __('employees::employee.parents-details') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.father-name') }}</label>
                            <input type="text" name="father_name" value="{{$user->relative->father_name ?? ''}}" class="form-control @error('father_name') is-invalid @enderror">
                            @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.father-mobile-number') }}</label>
                            <input type="number" class="form-control @error('father_mobile_number') is-invalid @enderror" value="{{$user->relative->father_mobile_number ?? ''}}" name="father_mobile_number">
                            @error('father_mobile_number')
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
                            <label>{{ __('employees::employee.mother-name') }}</label>
                            <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{$user->relative->mother_name ?? ''}}">    
                            @error('mother_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.mother-mobile-number') }}</label>
                            <div class="input-group mb-3">
                                <input type="number" name="mother_mobile_number" class="form-control @error('mother_mobile_number') is-invalid @enderror" value="{{$user->relative->mother_mobile_number ?? ''}}">   
                                @error('mother_mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.friend-relative-name') }}</label>
                            <input type="text" name="friend_name" class="form-control @error('friend_name') is-invalid @enderror" value="{{$user->relative->friend_name ?? ''}}">    
                            @error('friend_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('employees::employee.friend-relative-mobile-number') }}</label>
                            <div class="input-group mb-3">
                                <input type="number" name="friend_mobile_number" class="form-control @error('friend_mobile_number') is-invalid @enderror" value="{{$user->relative->friend_mobile_number ?? ''}}"> 
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