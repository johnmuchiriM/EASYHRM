<div class="card main-card mb-3">
    <div class="card-body">
        <h4 class="card-title">
           {{ __('configurations::lang.name') }}
        </h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_app_name">{{ __('configurations::lang.app-name') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-company-name') }}">
                        &#63;
                    </span>
                    <input type="text" name="config_app_name" class="form-control" placeholder="{{ __('configurations::lang.enter-company-name') }}"
                        value="{{ getConfig('config_app_name') ?? old('config_app_name') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_app_lang">{{ __('configurations::lang.app-lang') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-application-language') }}">
                        &#63;
                    </span>
                    <select class="form-control" name="config_app_lang">
                        <option disabled value="">{{ __('configurations::lang.application-language') }}</option>
                        <option value="{{ __('configurations::lang.en') }}" {{getConfig('config_app_lang') == 'en' ? 'selected' : ''}}>{{ __('configurations::lang.en') }}</option>
                        <option value="{{ __('configurations::lang.fr') }}" {{getConfig('config_app_lang') == 'fr' ? 'selected' : ''}}>{{ __('configurations::lang.fr') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_app_currency">{{ __('configurations::lang.app-currency') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-application-currency') }}">
                        &#63;
                    </span>
                    <select class="form-control" name="config_app_currency">
                   <option disabled value="">{{ __('configurations::lang.application-currency') }}</option>
                        <option value="INR" {{getConfig('config_app_currency') == 'INR' ? 'selected' : ''}}>{{ __('configurations::lang.inr') }}</option>
                        <option value="USD" {{getConfig('config_app_currency') == 'USD' ? 'selected' : ''}}>{{ __('configurations::lang.usd') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_app_timestamp">{{ __('configurations::lang.app-timestamp') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{ __('configurations::lang.title-application-timestamp') }}">
                        &#63;
                    </span>
                    <select class="form-control select2-single" name="config_app_timestamp">
                        <option disabled value="">{{ __('configurations::lang.application-timestamp') }}</option>
                        @foreach ($timezones as  $ts)
                            <option value="{{$ts->name}}" {{getConfig('config_app_timestamp') == $ts->name ? 'selected' : ''}}>{{$ts->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

