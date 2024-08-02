@extends('admin.layouts.app')
@section('title',  __('configurations::lang.name'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-filter icon-gradient bg-warm-flame"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('profile::lang.here-create-profile') }}</div>
                </div>
            </div>
        </div>
    </div>   
    <form action="{{route('configurations.save')}}" method="post" enctype="multipart/form-data">
        @csrf 
        <div class="row ">
            <div class="col-md-12">
                    <!-- configurations -->
                    @include('configurations::configurations.config')
                    <div class="divider">
                    </div>

                    <!-- customization -->
                    @include('configurations::customisation.customisation')                    
                    <div class="divider">
                    </div>

                    <!-- company details -->
                    @include('configurations::company-details.company-details')
                    <div class="divider">
                    </div>

                    <!-- footer configurations -->
                    @include('configurations::footer.footer-config')
                    
            </div>
        </div>         
    </form>
</div>
@endsection
