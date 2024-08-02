<div class="card-body mb-3">
    <div class="p-0">
        <ul class="list-group">
            <li class="list-group-item">
                <label for="config_color_scheme_class">{{__('configurations::lang.choose-color-scheme')}}
                    <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                        title="{{__('configurations::lang.title-choose-color-scheme')}}">
                        &#63;
                    </span>
                </label>
                @php 

                    $bgCls = [
                        "bg-primary",
                        "bg-secondary",
                        "bg-success",
                        "bg-info",
                        "bg-warning",
                        "bg-danger",
                        "bg-light",
                        "bg-dark",
                        "bg-focus",
                        "bg-alternate",
                        "bg-vicious-stance",
                        "bg-midnight-bloom",
                        "bg-night-sky",
                        "bg-slick-carbon",
                        "bg-asteroid",
                        "bg-royal",
                        "bg-warm-flame",
                        "bg-night-fade",
                        "bg-sunny-morning",
                        "bg-tempting-azure",
                        "bg-amy-crisp",
                        "bg-heavy-rain",
                        "bg-mean-fruit",
                        "bg-malibu-beach",
                        "bg-deep-blue",
                        "bg-ripe-malin",
                        "bg-arielle-smile",
                        "bg-plum-plate",
                        "bg-happy-fisher",
                        "bg-happy-itmeo",
                        "bg-mixed-hopes",
                        "bg-strong-bliss",
                        "bg-grow-early",
                        "bg-love-kiss",
                        "bg-premium-dark",
                        "bg-happy-green"];

                        $userConfig = getConfig('config_color_scheme_class') ?? '';
                        if ($userConfig == '') {
                            $userConfig = 'sidebar-text-dark';
                        }
                        
                @endphp
                <div class="theme-settings-swatches">
                    @foreach ($bgCls as $bg)
                        <div class="swatch-holder {{$bg ?? 'bg-primary'}} switch-sidebar-cs-class {{$userConfig  == $bg ? 'active' : ''}}" data-class="{{$bg ?? 'bg-primary'}}">
                        </div>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
    <input type="hidden" value="{{getConfig('config_color_scheme_class') ?? '' }}" name="config_color_scheme_class" id="config_color_scheme_class" />
</div>

