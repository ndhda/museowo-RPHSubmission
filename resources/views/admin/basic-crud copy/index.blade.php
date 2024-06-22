@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Index</h4>
                    <div>
                        <a href="{{ route('basic-crud.create') }}" class="btn btn-outline-primary"><i data-feather="plus"></i> Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="zero-config" class="dt-table-hover table" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>Short Text</th>
                            <th>Long Text</th>
                            <th>File Upload</th>
                            <th>Image Upload</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th class="no-content">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lists as $list)
                            <tr class="text-center">
                                <td>{{ $list->short_text }}</td>
                                <td>{{ $list->long_text }}</td>
                                <td><a href="{{ asset($list->file_upload) }}" target="_blank"><span class="badge badge-primary">View/Download</span></a></td>
                                <td><a href="{{ asset($list->image_upload) }}" target="_blank"><img src="{{ asset($list->image_upload) }}" alt="Image" class="img-fluid img-thumbnail" style="width: 50px;"></a></td>
                                <td><div style="width: 50px; height: 50px; background-color: {{ $list->color }};"></div></td>
                                <td>
                                    @if ($list->status == 'active')
                                        <span class="badge badge-success">{{ ucfirst($list->status) }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($list->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('basic-crud.show', $list->id) }}" class="btn btn-outline-info btn-sm"><i data-feather="eye"></i></a>
                                    <a href="{{ route('basic-crud.edit', $list->id) }}" class="btn btn-outline-warning btn-sm"><i data-feather="edit"></i></a>
                                    <form action="{{ route('basic-crud.destroy', $list->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')"><i data-feather="trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>
@endpush
