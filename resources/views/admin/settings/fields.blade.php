<!-- Value Field -->
<div class="form-group col-sm-12">
    {!! Form::label($key = $setting->key, __('models/settings.keys.'.$key) . ':') !!}
    @if(($type = $setting->type) == 'file')
    <div class="custom-file">
        {!! Form::file($key, ['id' => $key, 'class' => 'custom-file-input' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
        <label class="custom-file-label" for="{{ $key }}">{{ !is_null($setting->value) ? $setting->value : __('Upload File') }}</label>
        @if ($errors->has($key))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first($key) }}
            </span> 
        @endif
    </div>
    @elseif($type == 'textarea')
    {!! Form::textarea($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : ''), 'rows' => 3]) !!}
    @elseif($type == 'editor')
    {!! Form::textarea($key, $setting->value, ['id' => $key, 'class' => 'textarea_editor form-control' . ($errors->has($key) ? ' is-invalid' : ''), 'rows' => '10']) !!}
    @push('scripts')
    <script src="{{ asset('elite/assets/node_modules/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script>
        $('#'+"{{ $key }}").wysihtml5();
    </script>
    @endpush
    @elseif($type == 'url')
    {!! Form::url($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @elseif($type == 'number')
    {!! Form::number($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @elseif($type == 'email')
    {!! Form::email($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @else
    {!! Form::text($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @endif

    @error($key)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>