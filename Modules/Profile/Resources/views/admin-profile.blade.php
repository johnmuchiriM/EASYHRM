@extends('admin.layouts.app')
@section('title',  __('profile::lang.title'))
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
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn btn-success">{{ __('profile::lang.role') }}<span class="badge badge-light">{{$user->role->name}}</span></button>
                </div>
            </div>    
        </div>
    </div>  
    <form action="{{route('profile.update')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf         
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('profile::lang.personal-details') }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('profile::lang.name') }}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{$user->name ?? ''}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <div class="valid-feedback">
                                        {{ __('global-lang.look-good') }}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __('global-lang.add-valid-name') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email">{{ __('profile::lang.email') }}</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" required
                                        value="{{$user->email ?? ''}}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                        <div class="valid-feedback">
                                            {{ __('global-lang.look-good') }}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ __('global-lang.add-valid-email') }}
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile_pic">{{ __('profile::lang.profile-pic') }}</label>
                                    <input type="file" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror">
                                    <br>
                                    <img src="{{profilePic()}}" width="50px" height="50px" />    
                                    @if ($errors->has('profile_pic'))
                                        <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                    @endif
                                    <div class="valid-feedback">
                                        {{ __('global-lang.look-good') }}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __('profile::lang.add-valid-profile-pic') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 float-right">{{ __('global-lang.submit')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection 

