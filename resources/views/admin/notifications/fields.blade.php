<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/notifications.fields.title').'*') !!}
    {!! Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : '')]) !!}
    @error('title')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', __('models/notifications.fields.text').'*') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('text')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('text', __('models/notifications.fields.type').'*', ['class' => 'control-label']) !!}
        @foreach(['primary', 'info', 'success', 'warning', 'danger'] as $type)
        <div class="custom-control custom-radio">
            {!! Form::radio('type', $type, $type == 'primary' && !isset($notification) ? true : null, ['id' => "type-{$type}", 'class' => 'custom-control-input']) !!}
            {!! Form::label("type-{$type}", __("models/notifications.types.{$type}"), ['class' => "custom-control-label text-{$type}"]) !!}
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    {!! Form::label('to', __('models/notifications.fields.to').'*') !!}
    {!! Form::select('to', [
        'admin' => __('models/notifications.to.admin'),
        'user' => __('models/notifications.to.user')
        ], null, ['class' => 'form-control selectpicker' . ($errors->has('to') ? ' is-invalid' : '')]) !!}

    @error('to')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('admin_id', __('models/notifications.fields.admin_id').':') !!}
    <div class="custom-control custom-checkbox d-inline-block float-right">
        {!! Form::checkbox('all_admins', '1', null, ['class' => 'custom-control-input', 'id' => 'all-admins']) !!}
        {!! Form::label('all-admins', __('models/notifications.to.all_admins'), ['class' => 'custom-control-label']) !!}
    </div>
    {!! Form::select('admins[]', App\Models\Admin::where('id', '!=', Auth::guard('admin')->user()->id)->pluck('name', 'id'), null, ['class' => 'form-control custom-select select2' . ($errors->has('admins') ? ' is-invalid' : ''), 'multiple' => true, 'id' => 'admin_id']) !!}
    @error('admins')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('user_id', __('models/notifications.fields.user_id').':') !!}
    <div class="custom-control custom-checkbox d-inline-block float-right">
        {!! Form::checkbox('all_users', '1', null, ['class' => 'custom-control-input', 'id' => 'all-users']) !!}
        {!! Form::label('all-users', __('models/notifications.to.all_users'), ['class' => 'custom-control-label']) !!}
    </div>
    {!! Form::select('users[]', App\Models\User::pluck('name', 'id'), null, ['class' => 'form-control custom-select select2' . ($errors->has('users') ? ' is-invalid' : ''), 'multiple' => true, 'id' => 'user_id']) !!}
    @error('users')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', __('models/notifications.fields.url').':') !!}
    {!! Form::text('url', null, ['class' => 'form-control' . ($errors->has('url') ? ' is-invalid' : '')]) !!}
    @error('url')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/notifications.fields.icon').':') !!}
    {!! Form::text('icon', null, ['class' => 'form-control' . ($errors->has('icon') ? ' is-invalid' : '')]) !!}
    <small id="iconlHelp" class="form-text text-muted">ex: fa fa-user / icon-heart / ti-settings ...</small>
    @error('icon')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.notifications.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('third_party_stylesheets')
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.select2').select2();
        $('.selectpicker').selectpicker();

        $("#all-admins").on('change', function() {
            if($("#all-admins").is(':checked')) {
                $("#admin_id").select2('destroy').find('option').prop('selected', 'selected').end().select2();
            } else {
                $("#admin_id").select2('destroy').find('option').prop('selected', false).end().select2();
            }
        });

        $("#all-users").on('change', function() {
            if($("#all-users").is(':checked')) {
                $("#user_id").select2('destroy').find('option').prop('selected', 'selected').end().select2();
            } else {
                $("#user_id").select2('destroy').find('option').prop('selected', false).end().select2();
            }
        });

        $('#to').on('change', function() {
            adminOrUser();
        })

        function adminOrUser() {
            if($('#to').val() == 'admin') {
                $('#admin_id').closest('div').slideDown();
                $('#user_id').closest('div').hide();
            } else {
                $('#user_id').closest('div').slideDown();
                $('#admin_id').closest('div').hide();
            }
        }

        $(function() {
            adminOrUser();
        })
    </script>
@endpush