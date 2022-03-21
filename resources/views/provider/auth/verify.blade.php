@extends('layouts.auth')

@section('content')

    <h3 class="card-title p-3">{{ __('auth.verify_email.title') }}</h3>

    @include('flash::message')
    <p class="mb-3">{{ __('auth.verify_email.notice') }}</p>
    {!! Form::open(['route' => ['provider.verification.resend', ['id' => $provider->id]], 'id' => 'resend-form']) !!}
    <a href="javascript:;" onclick="document.getElementById('resend-form').submit();">{{ __('auth.verify_email.another_req') }}</a>
    {!! Form::close() !!}
    
@endsection