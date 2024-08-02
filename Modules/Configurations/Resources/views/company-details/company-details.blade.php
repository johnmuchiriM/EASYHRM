<div class="main-card mb-3 card">
    <div class="card-body">
        <h4 class="card-title">
            {{ __('configurations::lang.company-details') }}
        </h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="company_name">{{ __('configurations::lang.company-name') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top" title="{{ __('configurations::lang.title-company-name') }}">
                        &#63;    
                    </span>
                    <input type="text" name="config_company_name" class="form-control" 
                        placeholder="{{ __('configurations::lang.enter-company-name') }}" value="{{ getConfig('config_company_name') ?? old('config_company_name') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="config_company_address">{{ __('configurations::lang.company-address') }}</label>
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top" title="">
                        &#63;    
                    </span>
                    <textarea class="form-control" rows="3" name="config_company_address" placeholder="{{ __('configurations::lang.enter-company-address') }}">{{ getConfig('config_company_address') ?? old('config_company_address') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
