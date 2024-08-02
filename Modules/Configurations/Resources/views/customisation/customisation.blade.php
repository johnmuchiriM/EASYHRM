<div class="card main-card mb-3">
    <div class="card-body">
        <div class="alert-danger"></div>
        <h4 class="card-title">
           {{ __('configurations::lang.app-customization') }}
        </h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_app_logo">{{ __('configurations::lang.app-logo') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top" title="{{ __('configurations::lang.title-app-logo') }}">
                        &#63;    
                    </span>
                    <input type="file" name="config_app_logo" class="form-control">
                </div>
                @if(getConfig('config_app_logo') != '')
                    <img src="{{getConfig('config_app_logo')}}" height="50" width="50" />
                @endif
                @if ($errors->has('config_app_logo'))
                  <span class="text-danger">{{ $errors->first('config_app_logo') }}</span>
                @endif
                    <div class="valid-feedback">
                        {{ __('global-lang.looks-good') }}
                    </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_app_favicon_icon ">{{ __('configurations::lang.app-favicon-icon') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top" title="{{ __('configurations::lang.title-favicon-icon') }}">
                        &#63;    
                    </span>
                    <input type="file" name="config_app_favicon_icon" class="form-control">
                </div>
                @if(getConfig('config_app_favicon_icon') != '')
                    <img src="{{getConfig('config_app_favicon_icon')}}" height="25" width="25" />
                @endif
                @if ($errors->has('config_app_favicon_icon'))
                <span class="text-danger">{{ $errors->first('config_app_favicon_icon') }}</span>
              @endif
                  <div class="valid-feedback">
                      {{ __('global-lang.looks-good') }}
                  </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mt-3">
                <label for="config_left_footer_2">{{ __('configurations::lang.fixed-sidebar') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-fixed-sidebar') }}">
                        &#63;
                    </span>
                    <div class="position-relative form-check">
                        <label class="form-check-label">
                            <input type="checkbox" value="fixed-sidebar" class="form-check-input" name="config_is_sidebar_fixed" id="config_is_sidebar_fixed" {{getConfig('config_is_sidebar_fixed') ? 'checked' : '' }}> {{ __('configurations::lang.fixed-sidebar') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mt-3">
                <label for="config_left_footer_2">{{ __('configurations::lang.fixed-header') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-fixed-header') }}">
                        &#63;
                    </span>
                    <div class="position-relative form-check">
                        <label class="form-check-label">
                            <input type="checkbox" value="fixed-header" class="form-check-input" name="config_is_header_fixed" id="config_is_header_fixed"
                            {{getConfig('config_is_header_fixed') ? 'checked' : '' }}> {{ __('configurations::lang.fixed-header') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('configurations::theme.color-config')
</div>
