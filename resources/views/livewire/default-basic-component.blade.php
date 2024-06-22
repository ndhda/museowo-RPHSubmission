<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Index</h4>
            <div wire:ignore>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i data-feather="plus"></i> Create</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <x-alert />
        <div wire:ignore>
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
                            <td>
                                <div style="width: 50px; height: 50px; background-color: {{ $list->color }};"></div>
                            </td>
                            <td>
                                @if ($list->status == 'active')
                                    <span class="badge badge-success">{{ ucfirst($list->status) }}</span>
                                @else
                                    <span class="badge badge-danger">{{ ucfirst($list->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-info btn-sm" wire:click.prevent="openShowModal({{ json_encode($list->id) }})"><i data-feather="eye"></i></a>
                                <a class="btn btn-outline-warning btn-sm" wire:click.prevent="openEditModal({{ json_encode($list->id) }})"><i data-feather="edit"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ json_encode($list->id) }})"><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                </div>
                <x-alert />
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="short_text">Short Text<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('short_text') is-invalid @enderror" id="short_text" name="short_text" placeholder="" wire:model="short_text">
                                    <span class="text-muted"></span>
                                    @error('short_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="long_text">Long Text<span class="text-danger"></span></label>
                                    <textarea type="text" class="form-control @error('long_text') is-invalid @enderror" id="long_text" name="long_text" placeholder="" wire:model="long_text"></textarea>
                                    <span class="text-muted"></span>
                                    @error('long_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="file_upload">File Upload<span class="text-danger"></span></label>
                                    <input type="file" class="form-control @error('file_upload') is-invalid @enderror" id="file_upload" name="file_upload" wire:model="file_upload">
                                    <span class="text-muted">File format: pdf, doc, docx, xls, xlsx | Max Size: 2MB</span>
                                    @error('file_upload')
                                        <br>
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="image_upload">Image Upload<span class="text-danger"></span></label>
                                    <input type="file" class="form-control @error('image_upload') is-invalid @enderror" id="image_upload" name="image_upload" wire:model="image_upload">
                                    <span class="text-muted">File format: jpg, jpeg, png, gif | Max Size: 2MB</span>
                                    @error('image_upload')
                                        <br>
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="color">Color<span class="text-danger">*</span></label>
                                    <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="" wire:model="color">
                                    <span class="text-muted"></span>
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" wire:model="status">
                                        <option value="">-- Select --</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <span class="text-muted"></span>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" wire:ignore>
                        <button type="button" class="btn btn-outline-danger btn-sm" wire:click="closeModal"><i data-feather="x"></i> Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm"><i class="ph-floppy-disk"></i><i data-feather="save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Show Modal -->
    <div wire:ignore.self class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Show</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                </div>
                <x-alert />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="short_text">Short Text<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('short_text') is-invalid @enderror" id="short_text" name="short_text" placeholder="" wire:model="short_text" readonly>
                                <span class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="long_text">Long Text<span class="text-danger"></span></label>
                                <textarea type="text" class="form-control @error('long_text') is-invalid @enderror" id="long_text" name="long_text" placeholder="" wire:model="long_text" readonly></textarea>
                                <span class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="file_upload">File Upload<span class="text-danger"></span></label>
                                <span class="text-primary"><a href="{{ asset($file_upload) }}" class="badge badge-primary" target="_blank">View/Download</a></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label for="image_upload">Previous Upload<span class="text-danger"></span></label>
                                        <br>
                                        <a href="{{ asset($image_upload) }}" target="_blank"><img src="{{ asset($image_upload) }}" alt="Image" class="img-fluid img-thumbnail mt-2" style="width: 200px;"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="color">Color<span class="text-danger">*</span></label>
                                <br>
                                <div style="width: 50px; height: 50px; background-color: {{ $list->color }};"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" placeholder="" value="{{ ucfirst($list->status) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" wire:ignore>
                    <button type="button" class="btn btn-outline-danger btn-sm" wire:click="closeModal"><i data-feather="x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                </div>
                <x-alert />
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="short_text">Short Text<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('short_text') is-invalid @enderror" id="short_text" name="short_text" placeholder="" wire:model="short_text">
                                    <span class="text-muted"></span>
                                    @error('short_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="long_text">Long Text<span class="text-danger"></span></label>
                                    <textarea type="text" class="form-control @error('long_text') is-invalid @enderror" id="long_text" name="long_text" placeholder="" wire:model="long_text"></textarea>
                                    <span class="text-muted"></span>
                                    @error('long_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="file_new">File Upload<span class="text-danger"></span></label>
                                    <input type="file" class="form-control @error('file_upload') is-invalid @enderror" id="file_new" name="file_new" placeholder="">
                                    <span class="text-muted">File format: pdf, doc, docx, xls, xlsx | Max Size: 2MB</span>
                                    <br>
                                    <span class="text-primary">Previous File: <a href="{{ asset($list->file_upload) }}" class="badge badge-primary" target="_blank">View/Download</a></span>
                                    @error('file_new')
                                        <br>
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <div class="col-lg-2 col-12">
                                        <label for="image_upload">Previous Upload<span class="text-danger"></span></label>
                                        <br>
                                        <a href="{{ asset($image_upload) }}" target="_blank"><img src="{{ asset($image_upload) }}" alt="Image" class="img-fluid img-thumbnail mt-2" style="width: 200px;"></a>
                                    </div>
                                    <div class="col-lg-10 col-12">
                                        <div class="form-group">
                                            <label for="image_new">Image Upload<span class="text-danger"></span></label>
                                            <input type="file" class="form-control @error('image_upload') is-invalid @enderror" id="image_new" name="image_new" wire:model="image_new">
                                            <span class="text-muted">File format: jpg, jpeg, png, gif | Max Size: 2MB</span>
                                            @error('image_new')
                                                <br>
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="color">Color<span class="text-danger">*</span></label>
                                    <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="" wire:model="color">
                                    <span class="text-muted"></span>
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" wire:model="status">
                                        <option value="">-- Select --</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <span class="text-muted"></span>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" wire:ignore>
                        <button type="button" class="btn btn-outline-danger btn-sm" wire:click="closeModal"><i data-feather="x"></i> Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm"><i class="ph-floppy-disk"></i><i data-feather="save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

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
    <script>
        // Close Modals
        window.addEventListener('closeModal', () => {
            $("#createModal, #showModal").modal('hide');
        });

        // Open Show Modal
        window.addEventListener('openShowModal', () => {
            $("#showModal").modal('show');
        });

        // Open Edit Modal
        window.addEventListener('openEditModal', () => {
            $("#editModal").modal('show');
        });
    </script>
@endpush
