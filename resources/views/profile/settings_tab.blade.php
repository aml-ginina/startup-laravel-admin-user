<div class="tab-pane {{ $active == 'settings' ? 'active' : '' }}" id="settings" role="tabpanel">
    <div class="card-body">
        {!! Form::model($user, ['route' => 'profile.settings', 'files' => 'on']) !!}
            {!! Form::hidden('user', $user->id) !!}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="name">@lang('msg.name') *</label>
                    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="email">@lang('msg.email') *</label>
                    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="phone">@lang('msg.phone') *</label>
                    {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
                    @error('phone')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="image">@lang('msg.image') </label>
                    <div class="custom-file">
                        {!! Form::file('image', ['id' => 'image', 'class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
                        <label class="custom-file-label" data-browse="@lang('msg.browse')" for="image">
                            @if(!is_null($user->image)) {{ $user->image }} @else @lang('msg.upload_file') @endif
                        </label>
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('image') }}
                            </span> 
                        @endif
                    </div>
                </div>
                <div class="form-group col-sm-12 add_top_20">
                    <input type="submit" value="@lang('msg.submit')" class="btn btn-primary">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>