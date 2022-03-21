<!-- Name Field -->
<tr>
    <th>@lang('models/users.fields.name')</th>
    <td>{{ $user->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <th>@lang('models/users.fields.email')</th>
    <td>{{ $user->email }}</td>
</tr>

<!-- Phone Field -->
<tr>
    <th>@lang('models/users.fields.phone')</th>
    <td>{{ $user->phone }}</td>
</tr>

<!-- Image Field -->
<tr>
    <th>@lang('models/users.fields.image')</th>
    <td><img src="{{ asset('images/users/'.$user->image) }}" alt="" /></td>
</tr>

<!-- Notes Field -->
<tr>
    <th>@lang('models/users.fields.notes')</th>
    <td>{{ $user->notes }}</td>
</tr>

<!-- Block Field -->
<tr>
    <th>@lang('models/users.fields.block')</th>
    <td>{!! $user->block_span !!}</td>
</tr>

@if($user->block)
<!-- Block Notes Field -->
<tr>
    <th>@lang('models/users.fields.block_notes')</th>
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