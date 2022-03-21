<div class="table-responsive m-t-30 m-b-20">
    <table id="admins-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/admins.fields.name')</th>
                <th>@lang('models/admins.fields.email')</th>
                <th>@lang('models/admins.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>
                    <a class="text-info" href="{{ route('admin.admins.show', $admin->id) }}">
                        {{ $admin->name }}
                    </a>
                </td>
                <td>{{ $admin->email }}</td>
                <td>{!! $admin->active_span !!}</td>
                <td>
                    <a href="{{ route('admin.admins.edit', [$admin->id]) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.admins.destroy', $admin->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
                        {!! Form::button('<i class="ti-trash"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-sm btn-confirm']) !!}
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
@endpush

@push('page_scripts')
<script>
    $(function () {
        // responsive table
        $('#admins-table').DataTable({
            responsive: true
        });
    });
</script>
@endpush