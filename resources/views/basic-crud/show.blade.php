@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Show</h4>
                    <div>
                        <a href="{{ route('basic-crud.index') }}" class="btn btn-outline-danger"><i data-feather="arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label for="short_text">Short Text<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('short_text') is-invalid @enderror" id="short_text" name="short_text" placeholder="" value="{{ $list->short_text }}" readonly>
                            <span class="text-muted"></span>
                            @error('short_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label for="long_text">Long Text<span class="text-danger"></span></label>
                            <textarea type="text" class="form-control @error('long_text') is-invalid @enderror" id="long_text" name="long_text" placeholder="" readonly>{{ $list->long_text }}</textarea>
                            <span class="text-muted"></span>
                            @error('long_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label for="file_upload">File Upload<span class="text-danger">*</span></label>
                            <span class="text-primary"><a href="{{ asset($list->file_upload) }}" class="badge badge-primary" target="_blank">View/Download</a></span>
                            @error('file_upload')
                                <br>
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <label for="image_upload">Previous Upload<span class="text-danger">*</span></label>
                                <br>
                                <a href="{{ asset($list->image_upload) }}" target="_blank"><img src="{{ asset($list->image_upload) }}" alt="Image" class="img-fluid img-thumbnail mt-2" style="width: 200px;"></a>
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
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" placeholder="" value="{{ ucfirst($list->status) }}" readonly>
                            <span class="text-muted"></span>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
