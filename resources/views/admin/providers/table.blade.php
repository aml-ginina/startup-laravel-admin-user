<div class="table-responsive m-t-30 m-b-20">
    <table id="providers-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/providers.fields.name')</th>
                <th>@lang('models/providers.fields.email')</th>
                <th>@lang('models/providers.fields.phone')</th>
                <th>@lang('models/providers.fields.image')</th>
                <th>@lang('models/providers.fields.block')</th>
                <th>@lang('models/providers.fields.approve')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($providers as $provider)
            <tr>
                <td>{{ $provider->id }}</td>
                <td>
                    <a class="text-info" href="{{ route('admin.providers.show', $provider->id) }}">
                        {{ $provider->name }}
                    </a>
                </td>
                <td>{{ $provider->email }}</td>
                <td>{{ $provider->phone }}</td>
                <td><img src="{{ asset('images/providers/'.$provider->image) }}" /></td>
                <td>{!! $provider->block_span !!}</td>
                <td>{!! $provider->approve_span !!}</td>
                <td>
                    <a href="{{ route('admin.providers.edit', [$provider->id]) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.providers.destroy', $provider->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
@endpush

@push('page_scripts')
<script>
    $(function () {
        // responsive table
        $('#providers-table').DataTable({
            responsive: true
        });
    });
</script>
@endpush