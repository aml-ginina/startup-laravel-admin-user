<!-- Name Field -->
<tr>
    <th>@lang('models/providers.fields.name')</th>
    <td>{{ $provider->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <th>@lang('models/providers.fields.email')</th>
    <td>{{ $provider->email }}</td>
</tr>

<!-- Phone Field -->
<tr>
    <th>@lang('models/providers.fields.phone')</th>
    <td>{{ $provider->phone }}</td>
</tr>

<!-- Image Field -->
<tr>
    <th>@lang('models/providers.fields.image')</th>
    <td><img src="{{ asset('images/providers/'.$provider->image) }}" /></td>
</tr>

<!-- Notes Field -->
<tr>
    <th>@lang('models/providers.fields.notes')</th>
    <td>{{ $provider->notes }}</td>
</tr>

<!-- Block Field -->
<tr>
    <th>@lang('models/providers.fields.block')</th>
    <td>{!! $provider->block_span !!}</td>
</tr>

<!-- Block Notes Field -->
<tr>
    <th>@lang('models/providers.fields.block_notes')</th>
    <td>{{ $provider->block_notes }}</td>
</tr>

<!-- Approve Field -->
<tr>
    <th>@lang('models/providers.fields.approve')</th>
    <td>{!! $provider->approve_span !!}</td>
</tr>

<!-- Email Verified At Field -->
<tr>
    <td>@lang('models/providers.fields.email_verified_at')</td>
    <td>{{ $provider->email_verified_at }}</td>
</tr>

<!-- Phone Verified At Field -->
<tr>
    <td>@lang('models/providers.fields.phone_verified_at')</td>
    <td>{{ $provider->phone_verified_at }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('models/providers.fields.created_at')</td>
    <td>{{ $provider->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <td>@lang('models/providers.fields.updated_at')</td>
    <td>{{ $provider->updated_at }}</td>
</tr>

