<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('dashboard::lang.approved-leaves') }}</div>
                        <div class="widget-subheading">{{ __('dashboard::lang.approved-leaves-count') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-danger">{{$approvedLeaves ?? 0}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('dashboard::lang.finished-tasks') }}</div>
                        <div class="widget-subheading">{{ __('dashboard::lang.finished-task-count') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-success">{{$finishedTask ?? 0}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">{{ __('dashboard::lang.tasks') }}</div>
                        <div class="widget-subheading">{{ __('dashboard::lang.all-task-count') }}</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-secondary">{{$allTask ?? 0}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>