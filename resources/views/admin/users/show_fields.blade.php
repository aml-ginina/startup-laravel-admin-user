<!-- Name Field -->
<tr>
    <td>@lang('models/users.fields.name')</td>
    <td>{{ $user->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <td>@lang('models/users.fields.email')</td>
    <td>{{ $user->email }}</td>
</tr>

<!-- Phone Field -->
<tr>
    <td>@lang('models/users.fields.phone')</td>
    <td>{{ $user->phone }}</td>
</tr>

<!-- Image Field -->
<tr>
    <td>@lang('models/users.fields.image')</td>
    <td><img src="{{ asset('images/users/'.$user->image) }}" alt="" /></td>
</tr>

<!-- Notes Field -->
<tr>
    <td>@lang('models/users.fields.notes')</td>
    <td>{{ $user->notes }}</td>
</tr>

<!-- Block Field -->
<tr>
    <td>@lang('models/users.fields.block')</td>
    <td>{!! $user->block_span !!}</td>
</tr>

@if($user->block)
<!-- Block Notes Field -->
<tr>
    <td>@lang('models/users.fields.block_notes')</td>
    <td>{{ $user->block_notes }}</td>
</tr>
@endif

<!-- Email Verified At Field -->
<tr>
    <td>@lang('models/users.fields.email_verified_at')</td>
    <td>{{ $user->email_verified_at }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('crud.created_at')</td>
    <td>{{ $user->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <td>@lang('crud.updated_at')</td>
    <td>{{ $user->updated_at }}</td>
</tr>