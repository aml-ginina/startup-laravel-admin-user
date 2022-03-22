<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/providers.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
    @error('name')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/providers.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
    @error('email')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/providers.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
    @error('phone')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', __('models/providers.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '')]) !!}
    @error('password')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/providers.fields.image')) !!}
    <div class="input-group">
        <div class="custom-file mb-3">
            {!! Form::file('image', ['class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
            {!! Form::label('image', isset($$MODEL_NAME) ? $Provider->image : __('msg.updoad_file'), ['class' => 'custom-file-label form-control', 'data-browse' => __('msg.browse')]) !!}
        </div>
    </div>
    @error('image')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>


<!-- Notes Field -->
<div class="form-group">
    {!! Form::label('notes', __('models/providers.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@if(isset($provider) && !$provider->approve)
<!-- Approve Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-switch">
        {!! Form::hidden('approve', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('approve', '1', null, ['class' => 'custom-control-input', 'id' => 'approve']) !!}
        {!! Form::label('approve', __('models/providers.fields.approve'), ['class' => 'custom-control-label']) !!}
      </div>
    @error('approve')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endif

<!-- Block Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-switch">
        {!! Form::hidden('block', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('block', '1', null, ['class' => 'custom-control-input', 'id' => 'block']) !!}
        {!! Form::label('block', __('models/providers.fields.block'), ['class' => 'custom-control-label']) !!}
      </div>
    @error('block')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Block Notes Field -->
<div class="form-group">
    {!! Form::label('block_notes', __('models/providers.fields.block_notes').':') !!}
    {!! Form::textarea('block_notes', null, ['class' => 'form-control' . ($errors->has('block_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('block_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.providers.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('page_scripts')
<script>
    function toggleBlockNotes() {
        if($('#block').is(':checked')) $('#block_notes').closest('div').slideDown(); else $('#block_notes').closest('div').slideUp();
    }
    $('#block').on('change', function() {
        toggleBlockNotes();
    })

    $(function() {
        toggleBlockNotes();
    })
</script>
@endpush