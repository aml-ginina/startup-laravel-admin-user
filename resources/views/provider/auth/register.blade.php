@extends('layouts.auth')

@section('title', __('auth.registration.title'))
    
@section('content')

{!! Form::open(['route' => 'provider.register', 'type' => 'post', 'class' => 'form-horizontal form-material', 'id' => 'loginform']) !!}
    <h3 class="text-center m-b-20">@lang('auth.registration.title')</h3>
    <div class="form-group">
        <div class="col-xs-12">
            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="@lang('auth.name')">

            @error('name')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="@lang('auth.email')">

            @error('email')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input type="tel"
                name="phone"
                value="{{ old('phone') }}"
                class="form-control @error('phone') is-invalid @enderror"
                placeholder="@lang('auth.phone')">

            @error('phone')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="@lang('auth.password')">
        
            @error('password')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="@lang('auth.confirm_password')">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="terms" name="terms" value="agree">
                <label class="custom-control-label" for="terms">
                    @lang('auth.registration.i_agree')
                    <a href="#">@lang('auth.registration.terms')</a>
                </label>
            </div>
        </div>
        <!-- /.col -->
    </div>

    <div class="form-group text-center p-b-20">
        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">@lang('auth.register')</button>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div class="col-sm-12 text-center">
            @lang('auth.registration.have_membership') <a href="{{ route('provider.login') }}" class="text-info m-l-5"><b>@lang('auth.sign_in')</b></a>
        </div>
    </div>
</form>
@endsection