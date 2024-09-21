@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.all.type') }}" class="btn btn-inverse-warning">Property Type List</a>
    </nav>
    <div class="col-md-8 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create Type</h6>

                    <form action="{{ route('admin.store.property.type') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Type Name</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                name="type" id="type" autocomplete="off" value="">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                name="icon" id="icon" autocomplete="off" value="">
                            @error('icon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                     
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
