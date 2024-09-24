@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.add.property.type') }}" class="btn btn-inverse-warning">Add Property Type</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Type List</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>S1</th>
                                    <th>Type Name</th>
                                    <th>Type Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->icon }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.property.type', $item->id) }}" class="btn btn-inverse-info" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="{{ route('admin.delete.property.type', $item->id) }}" id="delete" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash"></i></a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
