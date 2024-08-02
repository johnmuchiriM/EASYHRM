
@extends('admin.layouts.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-phone icon-gradient bg-premium-dark">
                    </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('holidays::lang.here-create-holiday') }}</div>
                </div>
            </div>
        </div>
    </div>            
      <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
       $('#calendar').fullCalendar({    
            timezone: 'local',
            events: "{{route('load.calendar')}}",
         });
</script>
@endpush
@endsection 

