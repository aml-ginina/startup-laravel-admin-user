<div class="table-responsive m-t-30 m-b-20">
    <table id="notifications-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/notifications.singular')</th>
                <th>@lang('models/notifications.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>
                    <a href="{{ route('provider.notifications.show', $notification->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                @if(!is_null($notification->icon)) <i class="{{ $notification->icon }} text-{{ $notification->type }}"></i> @endif
                                {{ $notification->title }}
                            </h5>
                            <small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1" 
                            style="width: 100%; white-space: normal;">
                            {!! substr($notification->text, 0, 80) . (Str::length($notification->text) > 80 ? ' ..' : '') !!}
                        </p>
                    </a>
                </td>
                <td>
                    @if(!is_null($notification->read_at))
                    <span class="badge badge-success">@lang('models/notifications.read')</span>
                    @else
                    <span class="badge badge-danger">@lang('models/notifications.unread')</span>
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['provider.notifications.update', $notification->id], 'method' => 'patch', 'class' => 'd-inline']) !!}
                        {!! Form::button('<i class="ti-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm btn-confirm', 'data-title' => __('msg.confirm'), 'data-text' => $notification->read_at ? __('msg.mark_as_unread') : __('msg.mark_as_read')]) !!}
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['provider.notifications.destroy', $notification->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
                        {!! Form::button('<i class="ti-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-confirm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('third_party_stylesheets')
<link rel="stylesheet" type="text/css"
    href="{{ asset('elite/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('elite/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
@endpush

@push('third_party_scripts')
<!-- This is data table -->
<script src="{{ asset('elite/assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('elite/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
@endpush

@push('page_scripts')
<script>
    $(function () {
        // responsive table
        $('#notifications-table').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]]
        });
    });
</script>
@endpush