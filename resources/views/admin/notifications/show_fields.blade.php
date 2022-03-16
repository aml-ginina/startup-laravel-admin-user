<!-- Title Field -->
<tr>
    <td>@lang('models/notifications.fields.title')</td>
    <td><i class="{{ $notification->icon }}"></i> {{ $notification->title }}</td>
</tr>

<!-- Text Field -->
<tr>
    <td>@lang('models/notifications.fields.text')</td>
    <td>{{ $notification->text }}</td>
</tr>

<!-- Url Field -->
<tr>
    <td>@lang('models/notifications.fields.url')</td>
    <td>
        @if(!is_null($notification->url))
        <a class="text-info" href="{{ $notification->url }}">{{ $notification->url }}</a>
        @endif
    </td>
</tr>

<!-- Type Field -->
<tr>
    <td>@lang('models/notifications.fields.type')</td>
    <td><span class="label label-{{ $notification->type }}">{{ $notification->type }}</span></td>
</tr>

<!-- Read At Field -->
<tr>
    <td>@lang('models/notifications.fields.read_at')</td>
    <td>{{ $notification->read_at }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('models/notifications.fields.created_at')</td>
    <td>{{ $notification->created_at }}</td>
</tr>