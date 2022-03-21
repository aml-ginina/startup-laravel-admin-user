@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/contacts.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">@lang('models/contacts.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
<a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-edit"></i> @lang('crud.edit')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('admin.contacts.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('admin.contacts.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection