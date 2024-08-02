<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{__('dashboard::lang.attendance')}}</div>
                    <div class="widget-subheading">{{__('dashboard::lang.month-wise-count')}}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$attendance ?? ''}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{__('dashboard::lang.working-hour')}}</div>
                    <div class="widget-subheading">{{__('dashboard::lang.month-wise-count')}}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$dailyWorkHour ?? 0}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{__('dashboard::lang.assign-project')}}</div>
                    <div class="widget-subheading">{{__('dashboard::lang.project-assigned-count')}}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$assignedProject ?? 0}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">{{__('dashboard::lang.completed-project')}}</div>
                    <div class="widget-subheading">
                        {{__('dashboard::lang.completed-project-count')}}</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$completedProject ?? 0}}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
