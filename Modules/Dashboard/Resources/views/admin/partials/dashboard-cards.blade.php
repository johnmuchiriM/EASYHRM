<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{ __('dashboard::lang.emp') }}</div>
                    <div class="widget-subheading">{{ __('dashboard::lang.emp-count') }}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{totalEmployee()}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{ __('dashboard::lang.emp-logged-in') }}</div>
                    <div class="widget-subheading">{{__('dashboard::lang.emp-logged-in')}}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{empOnLeavesCount()}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{ __('dashboard::lang.projects') }}</div>
                    <div class="widget-subheading">{{ __('dashboard::lang.project-count') }}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{totalProjects()}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{ __('dashboard::lang.total-worked-hours') }}</div>
                    <div class="widget-subheading">
                        {{ __('dashboard::lang.sum-of-total-worked-hours', ['curr_month' => date('F, Y')]) }}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{monthlyWorkedHours()}}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
