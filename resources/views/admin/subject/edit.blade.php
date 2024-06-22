@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Edit</h4>
                    <div>
                        <a href="{{ route('admin.subject.index') }}" class="btn btn-outline-danger"><i data-feather="arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.subject.update', $list->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="name">Subject Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ $list->name }}">
                                <span class="text-muted"></span>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="code">Subject Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="" value="{{ $list->code }}">
                                <span class="text-muted"></span>
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="description">Subject Description<span class="text-danger"></span></label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="">{{ $list->description }}</textarea>
                                <span class="text-muted"></span>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-success w-100"><i data-feather="save"></i> Save</button>
                        </div>
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
