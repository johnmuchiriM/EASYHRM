<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">{{ __('profile::lang.personal-details') }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('profile::lang.name') }}</label>
                            <input type="text" name="name" class="form-control" required value="{{$user->name ?? ''}}">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <div class="valid-feedback">
                                {{ __('global-lang.look-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('global-lang.add-valid-name') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email">{{ __('profile::lang.email') }}</label>
                            <input type="text" name="primary_email" class="form-control" required
                                value="{{$user->employee->primary_email ?? ''}}">
                            @if ($errors->has('primary_email'))
                            <span class="text-danger">{{ $errors->first('primary_email') }}</span>
                            @endif
                            <div class="valid-feedback">
                                {{ __('global-lang.look-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('global-lang.add-valid-email') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">{{ __('profile::lang.mobile-number') }}</label>
                            <input type="number" name="mobile_number" class="form-control" required
                                value="{{$user->employee->mobile_number ?? ''}}">
                            @if ($errors->has('mobile_number'))
                            <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                            @endif
                            <div class="valid-feedback">
                                {{ __('global-lang.look-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('profile::lang.add-valid-mobile-number') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profile_pic">{{ __('profile::lang.profile-pic') }}</label>
                            <input type="file" name="profile_pic" class="form-control">
                            <br>
                            <img src="{{profilePic()}}" width="50px" height="50px" />
                            @if ($errors->has('profile_pic'))
                            <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                            @endif
                            <div class="valid-feedback">
                                {{ __('global-lang.look-good') }}
                            </div>
                            <div class="invalid-feedback">
                                {{ __('profile::lang.add-valid-profile-pic') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
