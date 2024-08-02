@extends('admin.layouts.app')
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
                    <div class="page-title-subheading">{{ __('profile::lang.here-change-password') }}</div>
                </div>
            </div> 
        </div>
    </div>  
    <form action="{{route('profile.change.password')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf         
        <div class="row ">
            <div class="col-md-12">
                <div class="main-card mb-3  card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <h4>{{ __('profile::lang.create-change-password') }}</h4>
                        </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="current_password">{{ __('profile::lang.old_password') }}</label>
                                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required
                                        placeholder="{{ __('profile::lang.old-password') }}">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @else
                                        <div class="valid-feedback">
                                            {{ __('profile::lang.looks-good') }}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ __('profile::lang.add-valid-old_password') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="new_password ">{{ __('profile::lang.new_password') }}</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                                        placeholder="{{ __('profile::lang.new-password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @else
                                        <div class="valid-feedback">
                                            {{ __('profile::lang.looks-good') }}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ __('profile::lang.add-valid-new_password') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="confirm_password">{{ __('profile::lang.confirm_password') }}</label>
                                    <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required placeholder="{{ __('profile::lang.confirm-password') }}">
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @else
                                        <div class="valid-feedback">
                                            {{ __('profile::lang.looks-good') }}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ __('profile::lang.add-valid-confirm_password') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-first mt-4 ml-2">
                                <button type="submit" class="btn btn-primary"
                                    id="formSubmit">{{ __('profile::lang.create-change-password') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </form>
</div>
@endsection 

