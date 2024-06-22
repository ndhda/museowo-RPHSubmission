@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Create</h4>
                    <div>
                        <a href="{{ route('basic-crud.index') }}" class="btn btn-outline-danger"><i data-feather="arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('basic-crud.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-alert />
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="short_text">Short Text<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('short_text') is-invalid @enderror" id="short_text" name="short_text" placeholder="" value="{{ old('short_text') }}">
                                <span class="text-muted"></span>
                                @error('short_text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="long_text">Long Text<span class="text-danger"></span></label>
                                <textarea type="text" class="form-control @error('long_text') is-invalid @enderror" id="long_text" name="long_text" placeholder="">{{ old('long_text') }}</textarea>
                                <span class="text-muted"></span>
                                @error('long_text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="file_upload">File Upload<span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('file_upload') is-invalid @enderror" id="file_upload" name="file_upload">
                                <span class="text-muted">File format: pdf, doc, docx, xls, xlsx | Max Size: 2MB</span>
                                @error('file_upload')
                                    <br>
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="image_upload">Image Upload<span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image_upload') is-invalid @enderror" id="image_upload" name="image_upload">
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
                                <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="" value="{{ old('color') }}">
                                <span class="text-muted"></span>
                                @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">-- Select --</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-muted"></span>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-success w-100"><i data-feather="save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
