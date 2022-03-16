@extends('layouts.app')

@section('title', __('msg.profile'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.profile')</li>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="{{ asset('images/users/' . $user->image) }}" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                    <h6 class="card-subtitle">User profile subtitle</h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                    </div>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                <small class="text-muted"> @lang('msg.email') </small>
                <h6>{{ $user->email }}</h6> 
                <small class="text-muted p-t-30 db">@lang('msg.phone')</small>
                <h6>{{ $user->phone }}</h6> 
                <small class="text-muted p-t-30 db">Address</small>
                <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                <div class="map-box">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div> <small class="text-muted p-t-30 db">Social Profile</small>
                <br/>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link {{ !isset($active) || is_null($active) || $active == 'profile' ? 'active' : '' }}" data-toggle="tab" href="#profile" role="tab">@lang('msg.profile')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'settings' ? 'active' : '' }}" data-toggle="tab" href="#settings" role="tab">@lang('msg.settings')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'password' ? 'active' : '' }}" data-toggle="tab" href="#password" role="tab">@lang('msg.password')</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--Profile tab-->
                @include('profile.profile_tab')
                
                <!-- Settings tab -->
                @include('profile.settings_tab')
                
                <!-- Password tab -->
                @include('profile.password_tab')
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
@endsection

