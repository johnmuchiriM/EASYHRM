<div class="card main-card mb-3">
    <div class="card-body">
        <h4 class="card-title">
           {{ __('configurations::lang.footer-config') }}
        </h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_right_footer_1">{{ __('configurations::lang.right-footer-1') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-right-footer-1') }}">
                        &#63;
                    </span>
                    <input type="text" name="config_right_footer_1" class="form-control" placeholder="{{ __('configurations::lang.enter-right-footer-1') }}"
                        value="{{ getConfig('config_right_footer_1') ?? old('config_right_footer_1') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_right_footer_2">{{ __('configurations::lang.right-footer-2') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-right-footer-2') }}">
                        &#63;
                    </span>
                    <input type="text" name="config_right_footer_2" class="form-control" placeholder="{{ __('configurations::lang.enter-right-footer-2') }}"
                        value="{{ getConfig('config_right_footer_2')?? old('config_right_footer_2') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_left_footer_1">{{ __('configurations::lang.left-footer-1') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-left-footer-1') }}">
                        &#63;
                    </span>
                    <input type="text" name="config_left_footer_1" class="form-control" placeholder="{{ __('configurations::lang.enter-left-footer-1') }}"
                        value="{{ getConfig('config_left_footer_1')?? old('config_left_footer_1') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_left_footer_2">{{ __('configurations::lang.left-footer-2') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-left-footer-2') }}">
                        &#63;
                    </span>
                    <input type="text" name="config_left_footer_2" class="form-control" placeholder="{{ __('configurations::lang.enter-left-footer-2') }}"
                        value="{{ getConfig('config_left_footer_2')?? old('config_left_footer_2') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mt-3">
                <label for="config_left_footer_2">{{ __('configurations::lang.fixed-footer') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-fixed-footer') }}">
                        &#63;
                    </span>
                    <div class="position-relative form-check">
                        <label class="form-check-label">
                            <input type="checkbox" value="fixed-footer" class="form-check-input" name="config_is_footer_fixed" id="config_is_footer_fixed"
                            {{getConfig('config_is_footer_fixed') ? 'checked' : '' }}> {{ __('configurations::lang.fixed-footer') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2">{{ __('global-lang.save')}}</button>
    </div>
</div>

