<div class="conatainer-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="main-card mb-3  card">
            <div class="card-body">
                <h4 class="card-title"><h4>{{ __('profile::lang.create-change-password') }}</h4></h4>      
                <div class="form-group mt-3">
                    <label for="current_password">{{ __('profile::lang.old_password') }}&nbsp;&nbsp;</label>
                    <input type="password" name="current_password" class="form-control"  required placeholder="Enter current password">
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        <div class="valid-feedback">
                            {{ __('profile::lang.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('profile::lang.add-valid-old_password') }}
                        </div>
        
                    <label for="new_password ">{{ __('profile::lang.new_password') }}&nbsp;&nbsp;</label>
                    <input type="password" name="new_password" class="form-control"  required placeholder="Enter the new password">
                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        <div class="valid-feedback">
                            {{ __('profile::lang.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                        {{ __('profile::lang.add-valid-new_password') }}
                        </div> 
        
                    <label for="confirm_password">{{ __('profile::lang.confirm_password') }}&nbsp;&nbsp;</label>
                    <input type="password" name="confirm_password" class="form-control" value="" required placeholder="Enter same password">
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        <div class="valid-feedback">
                            {{ __('profile::lang.looks-good') }}
                        </div>
                        <div class="invalid-feedback">
                            {{ __('profile::lang.add-valid-confirm_password') }}
                        </div>
                        <div class="d-flex justify-content-first mt-4 ml-2">
                            <button type="submit" class="btn btn-primary" id="formSubmit">{{ __('profile::lang.create-change-password') }}</button>
                        </div><hr>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


